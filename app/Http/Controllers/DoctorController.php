<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Speciality;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    // Doctor List
    public function index()
    {
        $doctors = Doctor::with(['user','speciality'])->get();

        return view('doctors.index', compact('doctors'));
    }

    // Create Doctor Page
    public function create()
    {
        $specialities = Speciality::all();

        return view('doctors.create', compact('specialities'));
    }

    // Store Doctor
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'speciality_id' => 'required|exists:specialities,id'
        ]);

        // Create User
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'doctor'
        ]);

        // Create Doctor
        Doctor::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'speciality_id' => $request->speciality_id
        ]);

        return redirect()->route('doctors.index')
            ->with('success', 'Doctor Added Successfully');
    }

    // Edit Doctor
    public function edit($id)
    {
        $doctor = Doctor::with('user')->findOrFail($id);
        $specialities = Speciality::all();

        return view('doctors.edit', compact('doctor','specialities'));
    }

    // Update Doctor
    public function update(Request $request, $id)
    {
        $doctor = Doctor::with('user')->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $doctor->user_id,
            'speciality_id' => 'required|exists:specialities,id'
        ]);

        // Update Doctor
        $doctor->update([
            'name' => $request->name,
            'speciality_id' => $request->speciality_id
        ]);

        // Update User
        $doctor->user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        return redirect()->route('doctors.index')
            ->with('success', 'Doctor Updated Successfully');
    }

    // Delete Doctor
    public function destroy($id)
    {
        $doctor = Doctor::findOrFail($id);

        if ($doctor->user) {
            $doctor->user->delete();
        }

        $doctor->delete();

        return redirect()->route('doctors.index')
            ->with('success', 'Doctor Deleted Successfully');
    }
}