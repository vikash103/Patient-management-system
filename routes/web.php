<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DoctorScheduleController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SpecialityController;
use App\Models\Patient;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

// ================== CHATBOT ROUTES ==================
Route::get('/chat-ui', function () {
    return view('chat');
});

Route::post('/save-appointment', function (Request $request) {
    \App\Models\Appointment::create([
        'patient_name' => $request->name,
        'date' => $request->date
    ]);
    return response()->json(['success' => true]);
});

// ================== DASHBOARD ==================
Route::get('/dashboard', function () {
    $totalPatients   = Patient::count();
    $malePatients    = Patient::where('gender', 'male')->count();
    $femalePatients  = Patient::where('gender', 'female')->count();
    $deletedPatients = Patient::onlyTrashed()->count();
    $recentPatients  = Patient::latest()->paginate(5);

    return view('dashboard', compact(
        'totalPatients',
        'malePatients',
        'femalePatients',
        'deletedPatients',
        'recentPatients'
    ));
})->middleware(['auth'])->name('dashboard');

// ================== AUTH ROUTES ==================
Route::middleware('auth')->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Notifications
    Route::post('/notifications/mark-as-read', function () {
        auth()->user()->unreadNotifications->markAsRead();
        return response()->json(['success' => true]);
    })->name('notifications.read');

    // Patients
    Route::resource('patients', PatientController::class);
    Route::get('/patient/trash', [PatientController::class, 'trash'])->name('patients.trash');
    Route::get('/patients/{id}/restore', [PatientController::class, 'restore'])->name('patients.restore');
    Route::delete('/patients/{id}/force-delete', [PatientController::class, 'forceDelete'])->name('patients.forceDelete');

    // Specialities
    Route::resource('specialities', SpecialityController::class);

    // Doctors
    Route::resource('doctors', DoctorController::class);

    // Doctor Schedules
    Route::resource('doctor-schedules', DoctorScheduleController::class);

    // ================== APPOINTMENT ROUTES ==================
    Route::get('/appointments/calendar', [AppointmentController::class, 'calendar'])
        ->name('appointments.calendar');

    Route::get('/appointments/events', [AppointmentController::class, 'events'])
        ->name('appointments.events');

    Route::resource('appointments', AppointmentController::class);

    Route::put('/appointments/{id}/status', [AppointmentController::class, 'updateStatus'])
        ->name('appointments.status.update');

    Route::put('/appointments/{id}/doctor', [AppointmentController::class, 'changeDoctor'])
        ->name('appointments.changeDoctor');

    Route::get('/api/doctors', [AppointmentController::class, 'getDoctors'])
        ->name('api.doctors');
});

require __DIR__ . '/auth.php';