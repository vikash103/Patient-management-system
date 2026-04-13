<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AppointmentController extends Controller
{
    /**
     * Doctor-wise Calendar View
     */
    public function calendar(Request $request)
    {
        $viewType     = $request->get('view', 'day');
        $selectedDate = $request->get('date', now()->toDateString());
        $date = Carbon::parse($selectedDate);

        // Load doctors with their schedules and specialities
        $doctors = Doctor::with(['schedules', 'speciality'])->get();

        // Determine which doctor is selected (if any)
        $selectedDoctor = null;
        if ($request->has('doctor_id')) {
            $selectedDoctor = Doctor::with('speciality')->find($request->doctor_id);
        }

        // Compute working availability for each doctor on the selected date
        $currentDayFull  = $date->format('l');   // "Monday"
        $currentDayShort = $date->format('D');   // "Mon"
        $availability = [];

        foreach ($doctors as $doctor) {
            $schedule = $doctor->schedules->first();
            $isWorking = false;

            if ($schedule && !empty($schedule->week_days)) {
                $days = array_map('trim', explode(',', $schedule->week_days));
                // Check both full name and short name
                if (in_array($currentDayFull, $days) || in_array($currentDayShort, $days)) {
                    $isWorking = true;
                }
            }

            $availability[$doctor->id] = $isWorking;
        }

        $timeSlots = $this->generateTimeSlots($viewType, $date);
        $appointments = $this->getAppointmentsForView($viewType, $date);

        return view('appointments.calendar', compact(
            'viewType', 'selectedDate', 'doctors', 'availability', 'timeSlots', 'appointments', 'selectedDoctor'
        ));
    }

    /**
     * Generate time slots based on view type.
     */
    protected function generateTimeSlots($viewType, $date)
    {
        if ($viewType === 'day') {
            return ['09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00'];
        }

        if ($viewType === 'week') {
            $weekDays = [];
            $startOfWeek = $date->copy()->startOfWeek(Carbon::MONDAY);
            for ($i = 0; $i < 7; $i++) {
                $day = $startOfWeek->copy()->addDays($i);
                $weekDays[] = [
                    'day'  => $day->format('D'),
                    'date' => $day->toDateString(),
                ];
            }
            return $weekDays;
        }

        // Month view
        $monthDays = [];
        $startOfMonth = $date->copy()->startOfMonth();
        $endOfMonth = $date->copy()->endOfMonth();
        for ($day = $startOfMonth; $day <= $endOfMonth; $day->addDay()) {
            $monthDays[] = [
                'day'  => $day->format('D'),
                'date' => $day->toDateString(),
            ];
        }
        return $monthDays;
    }

    /**
     * Fetch appointments based on view type and date.
     */
    protected function getAppointmentsForView($viewType, $date)
    {
        if ($viewType === 'day') {
            return Appointment::whereDate('appointment_date', $date->toDateString())
                ->with('patient')
                ->get();
        }

        if ($viewType === 'week') {
            $start = $date->copy()->startOfWeek(Carbon::MONDAY);
            $end = $date->copy()->endOfWeek(Carbon::SUNDAY);
            return Appointment::whereBetween('appointment_date', [$start, $end])
                ->with('patient')
                ->get();
        }

        // Month view
        $start = $date->copy()->startOfMonth();
        $end = $date->copy()->endOfMonth();
        return Appointment::whereBetween('appointment_date', [$start, $end])
            ->with('patient')
            ->get();
    }

    /**
     * Create form
     */
    public function create(Request $request)
    {
        $doctors = User::where('role', 'doctor')->with('speciality')->get();
        $patients = Patient::all();

        return view('appointments.create', [
            'doctors'        => $doctors,
            'patients'       => $patients,
            'selectedDoctor' => $request->doctor_id,
            'selectedDate'   => $request->date,
            'selectedTime'   => $request->time,
        ]);
    }

    /**
     * Store a new appointment
     */
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id'        => 'required|exists:users,id',
            'patient_id'       => 'required|exists:patients,id',
            'appointment_date' => 'required|date',
            'start_time'       => 'required',
            'end_time'         => 'required|after:start_time',
            'notes'            => 'nullable|string',
        ]);

        $startTime = Carbon::parse($request->start_time)->format('H:i:s');
        $endTime = Carbon::parse($request->end_time)->format('H:i:s');

        // Check for overlapping appointments
        $existingAppointment = Appointment::where('doctor_id', $request->doctor_id)
            ->where('appointment_date', $request->appointment_date)
            ->where(function ($query) use ($startTime, $endTime) {
                $query->whereBetween('start_time', [$startTime, $endTime])
                    ->orWhereBetween('end_time', [$startTime, $endTime])
                    ->orWhere(function ($q) use ($startTime, $endTime) {
                        $q->where('start_time', '<=', $startTime)
                            ->where('end_time', '>=', $endTime);
                    });
            })
            ->exists();

        if ($existingAppointment) {
            return back()->withInput()->with('error', 'This time slot is already booked!');
        }

        Appointment::create([
            'doctor_id'        => $request->doctor_id,
            'patient_id'       => $request->patient_id,
            'appointment_date' => $request->appointment_date,
            'start_time'       => $startTime,
            'end_time'         => $endTime,
            'appointment_time' => $startTime,
            'notes'            => $request->notes,
            'status'           => 'pending',
        ]);

        return redirect()->route('appointments.calendar', [
            'date' => $request->appointment_date,
            'view' => 'day',
        ])->with('success', 'Appointment booked successfully!');
    }

    /**
     * Show a single appointment
     */
    public function show(Appointment $appointment)
    {
        return view('appointments.show', compact('appointment'));
    }

    /**
     * Edit form
     */
    public function edit(Appointment $appointment)
    {
        $doctors = User::where('role', 'doctor')->with('speciality')->get();
        $patients = Patient::all();
        return view('appointments.edit', compact('appointment', 'doctors', 'patients'));
    }

    /**
     * Update appointment
     */
    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'doctor_id'        => 'required|exists:users,id',
            'patient_id'       => 'required|exists:patients,id',
            'appointment_date' => 'required|date',
            'start_time'       => 'required',
            'end_time'         => 'required|after:start_time',
            'status'           => 'required|in:pending,checked_in,checked_out,cancelled,no_show',
            'notes'            => 'nullable|string',
        ]);

        $startTime = Carbon::parse($request->start_time)->format('H:i:s');
        $endTime = Carbon::parse($request->end_time)->format('H:i:s');

        // Check overlap excluding current appointment
        $existingAppointment = Appointment::where('doctor_id', $request->doctor_id)
            ->where('appointment_date', $request->appointment_date)
            ->where('id', '!=', $appointment->id)
            ->where(function ($query) use ($startTime, $endTime) {
                $query->whereBetween('start_time', [$startTime, $endTime])
                    ->orWhereBetween('end_time', [$startTime, $endTime])
                    ->orWhere(function ($q) use ($startTime, $endTime) {
                        $q->where('start_time', '<=', $startTime)
                            ->where('end_time', '>=', $endTime);
                    });
            })
            ->exists();

        if ($existingAppointment) {
            return back()->withInput()->with('error', 'This time slot is already booked!');
        }

        $appointment->update([
            'doctor_id'        => $request->doctor_id,
            'patient_id'       => $request->patient_id,
            'appointment_date' => $request->appointment_date,
            'start_time'       => $startTime,
            'end_time'         => $endTime,
            'status'           => $request->status,
            'notes'            => $request->notes,
        ]);

        return redirect()->route('appointments.calendar', [
            'date' => $request->appointment_date,
            'view' => 'day',
        ])->with('success', 'Appointment updated successfully!');
    }

    /**
     * Delete appointment (AJAX)
     */
    public function destroy($id)
    {
        $appointment = Appointment::find($id);
        if (!$appointment) {
            return response()->json(['error' => 'Not found'], 404);
        }
        $appointment->delete();
        return response()->json(['success' => true]);
    }

    /**
     * Update only the status (AJAX)
     */
   public function updateStatus(Request $request, Appointment $appointment)
{
    $request->validate([
        'status' => 'required|in:pending,checked_in,checked_out,cancelled,no_show'
    ]);

    $newStatus = strtolower(trim($request->status));
    $appointment->status = $newStatus;
    $appointment->save();

    // Redirect to calendar (day view of the appointment date)
    return redirect()
        ->route('appointments.calendar', [
            'date' => $appointment->appointment_date,
            'view' => 'day'
        ])
        ->with('success', 'Appointment ' . str_replace('_', ' ', $newStatus) . ' successfully!');
}
    /**
     * Check if a specific time slot is available (AJAX)
     */
    public function checkAvailability(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'date'      => 'required|date',
            'time'      => 'required',
        ]);

        $time = Carbon::parse($request->time)->format('H:i:s');
        $exists = Appointment::where('doctor_id', $request->doctor_id)
            ->where('appointment_date', $request->date)
            ->where(function ($query) use ($time) {
                $query->where('start_time', '<=', $time)
                    ->where('end_time', '>', $time);
            })
            ->exists();

        return response()->json(['available' => !$exists]);
    }

    /**
     * Get all available 15‑min slots for a given doctor and date (AJAX)
     */
    public function getAvailableSlots(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'date'      => 'required|date',
        ]);

        $appointments = Appointment::where('doctor_id', $request->doctor_id)
            ->where('appointment_date', $request->date)
            ->get();

        $bookedSlots = [];
        foreach ($appointments as $appointment) {
            $start = strtotime($appointment->start_time);
            $end = strtotime($appointment->end_time);
            for ($time = $start; $time < $end; $time = strtotime('+15 minutes', $time)) {
                $bookedSlots[] = date('H:i', $time);
            }
        }

        $allSlots = [];
        $start = strtotime('07:00');
        $end = strtotime('19:00');
        for ($time = $start; $time <= $end; $time = strtotime('+15 minutes', $time)) {
            $allSlots[] = date('H:i', $time);
        }

        $availableSlots = array_diff($allSlots, $bookedSlots);

        return response()->json([
            'available_slots' => array_values($availableSlots),
            'booked_slots'    => $bookedSlots,
        ]);
    }

    /**
     * FullCalendar events endpoint: returns available and booked slots
     */
    public function events(Request $request)
    {
        $doctorId = $request->query('doctor_id');
        if (!$doctorId) {
            return response()->json([]);
        }

        $doctor = Doctor::with('schedules')->findOrFail($doctorId);
        $start = Carbon::parse($request->query('start'));
        $end = Carbon::parse($request->query('end'));

        // Fetch all booked appointments in the date range
        $bookings = Appointment::where('doctor_id', $doctorId)
            ->whereBetween('appointment_date', [$start->toDateString(), $end->toDateString()])
            ->get();

        $events = [];

        // Booked appointments (red)
        foreach ($bookings as $booking) {
            $events[] = [
                'id'            => $booking->id,
                'title'         => 'Booked',
                'start'         => $booking->appointment_date . 'T' . $booking->start_time,
                'end'           => $booking->appointment_date . 'T' . $booking->end_time,
                'color'         => '#ef4444',
                'textColor'     => 'white',
                'extendedProps' => [
                    'status'      => $booking->status,
                    'doctor_name' => $doctor->name,
                    'doctor_id'   => $doctor->id,
                    'description' => $booking->notes ?? '',
                ]
            ];
        }

        // Get the doctor's schedule (first one, or you can add logic for multiple)
        $schedule = $doctor->schedules->first();

        // Generate available 15‑min slots (green)
        $currentDate = $start->copy()->startOfDay();
        while ($currentDate <= $end) {
            $dayFull  = $currentDate->format('l');   // Monday
            $dayShort = $currentDate->format('D');   // Mon
            $isWorking = false;

            if ($schedule && !empty($schedule->week_days)) {
                $days = array_map('trim', explode(',', $schedule->week_days));
                if (in_array($dayFull, $days) || in_array($dayShort, $days)) {
                    $isWorking = true;
                }
            }

            if ($isWorking && $schedule) {
                $scheduleStart = Carbon::parse($schedule->start_time);
                $scheduleEnd = Carbon::parse($schedule->end_time);
                $slotStart = $scheduleStart->copy();

                while ($slotStart < $scheduleEnd) {
                    $slotEnd = $slotStart->copy()->addMinutes(15);
                    $isBooked = $bookings->contains(function ($booking) use ($currentDate, $slotStart, $slotEnd) {
                        return $booking->appointment_date == $currentDate->toDateString()
                            && $booking->start_time == $slotStart->format('H:i:s')
                            && $booking->end_time == $slotEnd->format('H:i:s');
                    });

                    if (!$isBooked) {
                        $events[] = [
                            'id'        => 'avail_' . $currentDate->toDateString() . '_' . $slotStart->format('Hi'),
                            'title'     => 'Available',
                            'start'     => $currentDate->toDateString() . 'T' . $slotStart->format('H:i:s'),
                            'end'       => $currentDate->toDateString() . 'T' . $slotEnd->format('H:i:s'),
                            'color'     => '#22c55e',
                            'textColor' => 'white',
                            'display'   => 'background',
                        ];
                    }
                    $slotStart->addMinutes(15);
                }
            } else {
                // Doctor not working – gray background for the whole day
                $events[] = [
                    'id'      => 'not_working_' . $currentDate->toDateString(),
                    'title'   => 'Not Available',
                    'start'   => $currentDate->toDateString(),
                    'end'     => $currentDate->copy()->addDay()->toDateString(),
                    'color'   => '#9ca3af',
                    'display' => 'background',
                    'allDay'  => true,
                ];
            }
            $currentDate->addDay();
        }

        return response()->json($events);
    }

    /**
     * Get doctor info for AJAX (name + speciality)
     */
    public function doctorInfo($id)
    {
        $doctor = Doctor::with('speciality')->findOrFail($id);
        return response()->json([
            'name'       => $doctor->name,
            'speciality' => $doctor->speciality->name ?? 'General',
        ]);
    }
}