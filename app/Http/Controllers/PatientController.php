<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller implements HasMiddleware
{

    public function index(Request $request)
    {
        $sort = $request->get('sort','id');
        $direction = $request->get('direction','desc');

        $patients = Patient::query()

            ->when($request->name,function($query) use ($request){
                $query->where('name','like','%'.$request->name.'%');
            })

            ->when($request->phone,function($query) use ($request){
                $query->where('phone','like','%'.$request->phone.'%');
            })

            ->when($request->gender,function($query) use ($request){
                $query->where('gender',$request->gender);
            })

            ->orderBy($sort,$direction)

            ->paginate(10)

            ->withQueryString();

        return view('patients.index',compact('patients','sort','direction'));
    }


    public function create()
    {
        if(!in_array(auth()->user()->role,['admin','staff'])){
            abort(403,'You are not allowed');
        }

        return view('patients.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required|min:3|max:255',
            'age'    => 'required|integer',
            'gender' => 'required',
            'phone'  => 'required|digits:10',
        ]);

        Patient::create([
            'name'       => $request->name,
            'age'        => $request->age,
            'gender'     => $request->gender,
            'phone'      => $request->phone,
            'address'    => $request->address,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('patients.index')
        ->with('success','Patient created successfully.');
    }


    public function show(string $id)
    {
        $patient = Patient::with('creator')->findOrFail($id);

        return view('patients.show',compact('patient'));
    }


    public function edit(string $id)
    {
        $patient = Patient::findOrFail($id);

        return view('patients.edit',compact('patient'));
    }


    public function update(Request $request,string $id)
    {
        $patient = Patient::findOrFail($id);

        $request->validate([
            'name'   => 'required|min:3|max:255',
            'age'    => 'required|integer',
            'gender' => 'required',
            'phone'  => 'required|digits:10',
        ]);

        $patient->update([
            'name'    => $request->name,
            'age'     => $request->age,
            'gender'  => $request->gender,
            'phone'   => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('patients.index')
        ->with('success','Patient updated successfully.');
    }


    public function destroy(string $id)
    {
        $patient = Patient::findOrFail($id);

        $patient->delete();

        return redirect()->route('patients.index')
        ->with('success','Patient deleted successfully.');
    }


    public function trash()
    {
        $patients = Patient::onlyTrashed()
                    ->latest()
                    ->paginate(10);

        return view('patients.trash',compact('patients'));
    }


    public function restore($id)
    {
        $patient = Patient::withTrashed()->findOrFail($id);

        $patient->restore();

        return redirect()->back()
        ->with('success','Patient restored successfully.');
    }


    public function forceDelete($id)
    {
        $patient = Patient::withTrashed()->findOrFail($id);

        $patient->forceDelete();

        return redirect()->back()
        ->with('success','Patient permanently deleted.');
    }


    public static function middleware(): array
    {
        return [

            new Middleware('auth'),

            new Middleware(function ($request,$next){

                if(auth()->user()->role === 'staff' && $request->method() === 'DELETE'){
                    abort(403,'Staff cannot delete records');
                }

                return $next($request);
            }),

        ];
    }
}