<?php

namespace App\Http\Controllers\Auth;

use App\Notifications\WelcomeNotification;
use App\Notifications\NewUserNotification;
use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Speciality; 
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
{
    $specialities = Speciality::all();

    return view('auth.register', compact('specialities'));
}

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
  public function store(Request $request): RedirectResponse
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'role' => ['required'],
        'speciality_id' => ['nullable']
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role,
        'speciality_id' => $request->speciality_id
    ]);

    // ✅ Agar user doctor hai to doctors table me auto insert
    if ($user->role === 'doctor') {

        Doctor::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'speciality_id' => $user->speciality_id
        ]);

    }

    $user->notify(new WelcomeNotification());

    $admins = User::where('role', 'admin')->get();

    foreach ($admins as $admin) {
        $admin->notify(new NewUserNotification($user));
    }

    event(new Registered($user));

    Auth::login($user);

    return redirect(route('dashboard', absolute: false));
}
}
