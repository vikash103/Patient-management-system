<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Schedule New Appointment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Main Container -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden max-w-2xl mx-auto">
                <!-- Header Section with Gradient -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                    <div class="flex items-center space-x-3">
                        <div class="bg-white/20 rounded-lg p-2">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-white">Create New Appointment</h2>
                            <p class="text-blue-100 text-xs mt-1">Schedule an appointment with start and end time</p>
                        </div>
                    </div>
                </div>

                <!-- Form Container -->
                <div class="p-8">
                    <!-- Success Message (if any) -->
                    @if(session('success'))
                        <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="font-medium">{{ session('success') }}</span>
                        </div>
                    @endif

                    <!-- Error Summary -->
                    @if($errors->any())
                        <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg">
                            <div class="flex items-center mb-2">
                                <svg class="w-5 h-5 mr-2 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="font-medium">Please fix the following errors:</span>
                            </div>
                            <ul class="list-disc list-inside text-sm ml-7">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('appointments.store') }}" class="space-y-6">
                        @csrf

                        <!-- Doctor Selection -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Select Doctor <span class="text-red-500 ml-1">*</span>
                                </span>
                            </label>
                            <div class="relative">
                                <select name="doctor_id" 
                                        class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-blue-400 focus:ring-2 focus:ring-blue-200 transition-all duration-200 appearance-none bg-white @error('doctor_id') border-red-400 @enderror"
                                        required>
                                    <option value="" disabled selected>Choose a doctor</option>
                                    @foreach($doctors as $doctor)
                                        <option value="{{ $doctor->id }}" {{ old('doctor_id', $selectedDoctor) == $doctor->id ? 'selected' : '' }}>
                                            {{ $doctor->name }} - {{ $doctor->speciality->name ?? 'General' }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                            @error('doctor_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Patient Selection -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    Select Patient <span class="text-red-500 ml-1">*</span>
                                </span>
                            </label>
                            <div class="relative">
                                <select name="patient_id" 
                                        class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-blue-400 focus:ring-2 focus:ring-blue-200 transition-all duration-200 appearance-none bg-white @error('patient_id') border-red-400 @enderror"
                                        required>
                                    <option value="" disabled selected>Choose a patient</option>
                                    @foreach($patients as $patient)
                                        <option value="{{ $patient->id }}" {{ old('patient_id') == $patient->id ? 'selected' : '' }}>
                                            {{ $patient->name }} ({{ $patient->phone }})
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                            @error('patient_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Appointment Date -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    Appointment Date <span class="text-red-500 ml-1">*</span>
                                </span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <input type="date"
                                       name="appointment_date"
                                       id="appointment_date"
                                       value="{{ old('appointment_date', $selectedDate ?? '') }}"
                                       class="w-full border-2 border-gray-200 rounded-xl pl-10 pr-4 py-3 text-sm focus:border-blue-400 focus:ring-2 focus:ring-blue-200 transition-all duration-200 @error('appointment_date') border-red-400 @enderror"
                                       required>
                            </div>
                            @error('appointment_date')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Start and End Time Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Start Time Field -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Start Time <span class="text-red-500 ml-1">*</span>
                                    </span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <input type="time"
                                           name="start_time"
                                           id="start_time"
                                           value="{{ old('start_time', $selectedTime ?? '09:00') }}"
                                           class="w-full border-2 border-gray-200 rounded-xl pl-10 pr-4 py-3 text-sm focus:border-blue-400 focus:ring-2 focus:ring-blue-200 transition-all duration-200 @error('start_time') border-red-400 @enderror"
                                           required>
                                </div>
                                @error('start_time')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- End Time Field -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        End Time <span class="text-red-500 ml-1">*</span>
                                    </span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <input type="time"
                                           name="end_time"
                                           id="end_time"
                                           value="{{ old('end_time', '09:30') }}"
                                           class="w-full border-2 border-gray-200 rounded-xl pl-10 pr-4 py-3 text-sm focus:border-blue-400 focus:ring-2 focus:ring-blue-200 transition-all duration-200 @error('end_time') border-red-400 @enderror"
                                           required>
                                </div>
                                @error('end_time')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Duration Display (Auto-calculated) -->
                        <div class="bg-blue-50 rounded-xl p-4 border border-blue-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-sm font-medium text-gray-700">Appointment Duration:</span>
                                </div>
                                <span id="duration_display" class="text-sm font-bold text-blue-700 bg-white px-3 py-1 rounded-full">
                                    30 minutes
                                </span>
                            </div>
                        </div>

                        <!-- Quick Duration Buttons -->
                        <div class="flex flex-wrap gap-2">
                            <button type="button" onclick="setDuration(15)" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 text-sm rounded-full transition">
                                15 min
                            </button>
                            <button type="button" onclick="setDuration(30)" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 text-sm rounded-full transition">
                                30 min
                            </button>
                            <button type="button" onclick="setDuration(45)" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 text-sm rounded-full transition">
                                45 min
                            </button>
                            <button type="button" onclick="setDuration(60)" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 text-sm rounded-full transition">
                                1 hour
                            </button>
                            <button type="button" onclick="setDuration(90)" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 text-sm rounded-full transition">
                                1.5 hours
                            </button>
                            <button type="button" onclick="setDuration(120)" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 text-sm rounded-full transition">
                                2 hours
                            </button>
                        </div>

                        <!-- Additional Notes (Optional) -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Additional Notes (Optional)
                                </span>
                            </label>
                            <textarea name="notes"
                                      rows="3"
                                      class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-blue-400 focus:ring-2 focus:ring-blue-200 transition-all duration-200 resize-none"
                                      placeholder="Any special instructions or notes for this appointment...">{{ old('notes') }}</textarea>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                            <a href="{{ route('appointments.calendar') }}" 
                               class="px-6 py-3 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-colors duration-200 font-medium text-sm">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-200 shadow-md hover:shadow-lg font-medium text-sm">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                                </svg>
                                Schedule Appointment
                            </button>
                        </div>

                        <!-- Required Fields Note -->
                        <p class="text-xs text-gray-400 text-right">
                            <span class="text-red-500">*</span> Required fields
                        </p>
                    </form>
                </div>
            </div>

            <!-- Help Card -->
            <div class="mt-6 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-4 border border-blue-200 max-w-2xl mx-auto">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                    <div>
                        <h4 class="text-sm font-semibold text-gray-800">Appointment Scheduling Tips</h4>
                        <ul class="mt-2 text-xs text-gray-600 space-y-1 list-disc list-inside">
                            <li>Start time must be before end time</li>
                            <li>Click on duration buttons to auto-set end time</li>
                            <li>Appointments cannot overlap with existing ones</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Duration Calculation -->
    <script>
        function setDuration(minutes) {
            const startTime = document.getElementById('start_time').value;
            
            if (!startTime) {
                alert('Please select start time first');
                return;
            }

            // Get today's date for time calculation
            const today = new Date().toISOString().split('T')[0];
            
            // Create date objects
            const startDateTime = new Date(today + 'T' + startTime);
            const endDateTime = new Date(startDateTime.getTime() + minutes * 60000);

            // Format end time
            const endTime = endDateTime.toTimeString().slice(0, 5);

            // Set end time
            document.getElementById('end_time').value = endTime;

            // Update duration display
            updateDurationDisplay();
        }

        function updateDurationDisplay() {
            const startTime = document.getElementById('start_time').value;
            const endTime = document.getElementById('end_time').value;

            if (startTime && endTime) {
                // Use a dummy date for time comparison
                const today = new Date().toISOString().split('T')[0];
                const start = new Date(today + 'T' + startTime);
                const end = new Date(today + 'T' + endTime);
                
                if (end > start) {
                    const diffMinutes = Math.round((end - start) / 60000);
                    const hours = Math.floor(diffMinutes / 60);
                    const mins = diffMinutes % 60;
                    
                    let displayText = '';
                    if (hours > 0) {
                        displayText += hours + ' hour' + (hours > 1 ? 's ' : ' ');
                    }
                    if (mins > 0) {
                        displayText += mins + ' minutes';
                    }
                    if (diffMinutes < 60) {
                        displayText = diffMinutes + ' minutes';
                    }
                    
                    document.getElementById('duration_display').textContent = displayText;
                } else {
                    document.getElementById('duration_display').textContent = 'End time must be after start time';
                }
            }
        }

        // Add event listeners
        document.getElementById('start_time').addEventListener('change', updateDurationDisplay);
        document.getElementById('end_time').addEventListener('change', updateDurationDisplay);

        // Validate end time is after start time on form submit
        document.querySelector('form').addEventListener('submit', function(e) {
            const startTime = document.getElementById('start_time').value;
            const endTime = document.getElementById('end_time').value;

            if (startTime && endTime) {
                const today = new Date().toISOString().split('T')[0];
                const start = new Date(today + 'T' + startTime);
                const end = new Date(today + 'T' + endTime);

                if (end <= start) {
                    e.preventDefault();
                    alert('End time must be after start time');
                }
            }
        });

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateDurationDisplay();
        });
    </script>
</x-app-layout>