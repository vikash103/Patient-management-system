<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DoctorSchedule;
use Illuminate\Http\Request;

class DoctorScheduleController extends Controller
{
    public function index()
    {
        $schedules = DoctorSchedule::with('doctor')->latest()->paginate(10);

        return view('doctor_schedules.index', compact('schedules'));
    }

    public function create()
    {
        $doctors = User::where('role','doctor')->get();

        return view('doctor_schedules.create', compact('doctors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required',
            'week_days' => 'required|array',
            'start_time' => 'required',
            'end_time' => 'required',
            'slot_minutes' => 'required',
            'break_start' => 'nullable',
            'break_end' => 'nullable'
        ]);

        DoctorSchedule::create([
            'doctor_id' => $request->doctor_id,
            'week_days' => implode(',', $request->week_days),
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'slot_minutes' => $request->slot_minutes,
            'break_start' => $request->break_start,
            'break_end' => $request->break_end
        ]);

        return redirect()->route('doctor-schedules.index')
        ->with('success', 'Schedule Created Successfully');
    }

    public function edit(DoctorSchedule $doctorSchedule)
    {
        $doctors = User::where('role','doctor')->get();

        return view('doctor_schedules.edit', compact('doctorSchedule','doctors'));
    }

    public function update(Request $request, DoctorSchedule $doctorSchedule)
    {
        $request->validate([
            'doctor_id' => 'required',
            'week_days' => 'required|array',
            'start_time' => 'required',
            'end_time' => 'required',
            'slot_minutes' => 'required'
        ]);

        $doctorSchedule->update([
            'doctor_id' => $request->doctor_id,
            'week_days' => implode(',', $request->week_days),
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'slot_minutes' => $request->slot_minutes,
            'break_start' => $request->break_start,
            'break_end' => $request->break_end
        ]);

        return redirect()->route('doctor-schedules.index')
        ->with('success','Schedule Updated Successfully');
    }

    public function destroy(DoctorSchedule $doctorSchedule)
    {
        $doctorSchedule->delete();

        return redirect()->route('doctor-schedules.index')
        ->with('success','Schedule Deleted');
    }
}