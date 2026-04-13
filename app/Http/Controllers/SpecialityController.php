<?php

namespace App\Http\Controllers;

use App\Models\Speciality;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class SpecialityController extends Controller implements HasMiddleware
{

    public static function middleware()
    {
        return [
            new Middleware('auth'),
            new Middleware('admin'),
        ];
    }

    public function index(Request $request)
    {
        $sort = $request->get('sort', 'id'); 
        $direction = $request->get('direction', 'desc');

        $specialities = Speciality::orderBy($sort, $direction)->paginate(10);

        return view('specialities.index', compact('specialities','sort','direction'));
    }

    public function create()
    {
        return view('specialities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        Speciality::create([
            'name' => $request->name
        ]);

        return redirect()->route('specialities.index')
            ->with('success', 'Speciality created successfully');
    }

    public function edit($id)
    {
        $speciality = Speciality::findOrFail($id);

        return view('specialities.edit', compact('speciality'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $speciality = Speciality::findOrFail($id);

        $speciality->update([
            'name' => $request->name
        ]);

        return redirect()->route('specialities.index')
            ->with('success', 'Speciality updated successfully');
    }

    public function destroy($id)
    {
        $speciality = Speciality::findOrFail($id);

        $speciality->delete();

        return redirect()->back()
            ->with('success', 'Speciality deleted successfully');
    }
}