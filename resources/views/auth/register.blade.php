<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Medical Registration | {{ config('app.name', 'Hospital') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }
        .material-input:focus {
            border-bottom-color: #3b82f6;
            box-shadow: 0 1px 0 0 #3b82f6;
        }
    </style>
</head>
<body class="antialiased overflow-x-hidden">
    <div class="flex flex-col md:flex-row min-h-screen w-full">
        <!-- Left side: blurred doctor image with overlay -->
        <div class="relative w-full md:w-1/2 min-h-[50vh] md:min-h-screen overflow-hidden">
            <div class="absolute inset-0 bg-cover bg-center filter blur-md scale-105"
                 style="background-image: url('https://images.unsplash.com/photo-1579684385127-1ef15d5088a2?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');">
            </div>
            <div class="absolute inset-0 bg-blue-900/70"></div>
            <div class="relative z-10 flex flex-col items-center justify-center h-full text-center text-white p-4 md:p-6">
                <h1 class="text-2xl md:text-3xl font-bold mb-2">Medical Excellence</h1>
                <p class="text-sm md:text-base max-w-md">Join our dedicated team committed to exceptional patient care.</p>
                <div class="mt-4 flex flex-wrap justify-center gap-2">
                    <div class="bg-white/20 backdrop-blur-sm rounded-full px-2 py-0.5 text-xs">🏥 Trusted Care</div>
                    <div class="bg-white/20 backdrop-blur-sm rounded-full px-2 py-0.5 text-xs">👩‍⚕️ Expert Staff</div>
                </div>
            </div>
        </div>

        <!-- Right side: white card form -->
        <div class="w-full md:w-1/2 flex items-center justify-center p-3 md:p-4 bg-gray-50">
            <div class="max-w-md w-full bg-white rounded-xl shadow-lg p-5 md:p-6 transition-all">
                <div class="text-center mb-4">
                    <h2 class="text-xl md:text-2xl font-bold text-gray-800">Create Account</h2>
                    <p class="text-gray-500 text-xs md:text-sm mt-0.5">Start your journey with us</p>
                </div>

                <form method="POST" action="{{ route('register') }}" autocomplete="off" class="grid gap-4">
                    @csrf

                    <!-- Name -->
                    <div class="grid gap-0.5">
                        <label for="name" class="text-xs font-medium text-gray-700">Full Name</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                               class="material-input w-full border-b-2 border-gray-300 py-1.5 text-sm focus:outline-none transition"
                               placeholder="Dr. John Doe">
                        @error('name')
                            <p class="text-red-500 text-xs mt-0.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="grid gap-0.5">
                        <label for="email" class="text-xs font-medium text-gray-700">Email Address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                               class="material-input w-full border-b-2 border-gray-300 py-1.5 text-sm focus:outline-none transition"
                               placeholder="doctor@hospital.com">
                        @error('email')
                            <p class="text-red-500 text-xs mt-0.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="grid gap-0.5">
                        <label for="password" class="text-xs font-medium text-gray-700">Password</label>
                        <input id="password" type="password" name="password" required
                               class="material-input w-full border-b-2 border-gray-300 py-1.5 text-sm focus:outline-none transition"
                               placeholder="••••••••">
                        @error('password')
                            <p class="text-red-500 text-xs mt-0.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="grid gap-0.5">
                        <label for="password_confirmation" class="text-xs font-medium text-gray-700">Confirm Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                               class="material-input w-full border-b-2 border-gray-300 py-1.5 text-sm focus:outline-none transition"
                               placeholder="••••••••">
                        @error('password_confirmation')
                            <p class="text-red-500 text-xs mt-0.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Role -->
                    <div class="grid gap-0.5">
                        <label for="role" class="text-xs font-medium text-gray-700">Role</label>
                        <select id="role" name="role"
                                class="material-input w-full border-b-2 border-gray-300 py-1.5 text-sm bg-white focus:outline-none transition">
                            <option value="staff">Staff</option>
                            <option value="doctor">Doctor</option>
                            <option value="admin">Admin</option>
                        </select>
                        @error('role')
                            <p class="text-red-500 text-xs mt-0.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Speciality (conditional) -->
                    <div class="grid gap-0.5 hidden" id="speciality-field">
                        <label for="speciality_id" class="text-xs font-medium text-gray-700">Speciality</label>
                        <select id="speciality_id" name="speciality_id"
                                class="material-input w-full border-b-2 border-gray-300 py-1.5 text-sm bg-white focus:outline-none transition">
                            <option value="">Select Speciality</option>
                            @foreach($specialities as $speciality)
                                <option value="{{ $speciality->id }}">{{ $speciality->name }}</option>
                            @endforeach
                        </select>
                        @error('speciality_id')
                            <p class="text-red-500 text-xs mt-0.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-1">
                        <button type="submit"
                                class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-2 rounded-full text-sm shadow-md transition transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Create Account
                        </button>
                    </div>

                    <!-- Login link -->
                    <div class="text-center text-xs text-gray-600 mt-1">
                        Already have an account?
                        <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-800 transition">Sign in</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roleSelect = document.getElementById('role');
            const specialityField = document.getElementById('speciality-field');

            function toggleSpeciality() {
                if (roleSelect.value === 'doctor') {
                    specialityField.classList.remove('hidden');
                } else {
                    specialityField.classList.add('hidden');
                }
            }

            roleSelect.addEventListener('change', toggleSpeciality);
            toggleSpeciality();
        });
    </script>
</body>
</html>