<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Doctor-wise Appointment Schedule') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Date Navigator with View Buttons (unchanged) -->
            <div class="bg-white rounded-lg shadow-md p-4 mb-4">
                <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('appointments.calendar', ['view' => $viewType, 'date' => date('Y-m-d', strtotime($selectedDate . ' -1 day'))]) }}" class="px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg transition text-sm">← Prev Day</a>
                        <a href="{{ route('appointments.calendar', ['view' => $viewType, 'date' => date('Y-m-d', strtotime($selectedDate . ' -7 day'))]) }}" class="px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg transition text-sm">← Prev Week</a>
                        <a href="{{ route('appointments.calendar', ['view' => $viewType, 'date' => date('Y-m-d', strtotime($selectedDate . ' -1 month'))]) }}" class="px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg transition text-sm">← Prev Month</a>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">{{ \Carbon\Carbon::parse($selectedDate)->format('l, d F Y') }}</h3>
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('appointments.calendar', ['view' => $viewType, 'date' => date('Y-m-d', strtotime($selectedDate . ' +1 month'))]) }}" class="px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg transition text-sm">Next Month →</a>
                        <a href="{{ route('appointments.calendar', ['view' => $viewType, 'date' => date('Y-m-d', strtotime($selectedDate . ' +7 day'))]) }}" class="px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg transition text-sm">Next Week →</a>
                        <a href="{{ route('appointments.calendar', ['view' => $viewType, 'date' => date('Y-m-d', strtotime($selectedDate . ' +1 day'))]) }}" class="px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg transition text-sm">Next Day →</a>
                    </div>
                </div>
                <div class="flex items-center justify-center mt-4 gap-4">
                    <div class="flex items-center bg-gray-100 rounded-lg p-1">
                        <a href="{{ route('appointments.calendar', ['view' => 'day', 'date' => $selectedDate]) }}" class="px-4 py-2 rounded-lg transition text-sm font-medium {{ $viewType == 'day' ? 'bg-blue-500 text-white' : 'hover:bg-gray-200' }}">Day</a>
                        <a href="{{ route('appointments.calendar', ['view' => 'week', 'date' => $selectedDate]) }}" class="px-4 py-2 rounded-lg transition text-sm font-medium {{ $viewType == 'week' ? 'bg-blue-500 text-white' : 'hover:bg-gray-200' }}">Week</a>
                        <a href="{{ route('appointments.calendar', ['view' => 'month', 'date' => $selectedDate]) }}" class="px-4 py-2 rounded-lg transition text-sm font-medium {{ $viewType == 'month' ? 'bg-blue-500 text-white' : 'hover:bg-gray-200' }}">Month</a>
                    </div>
                    <a href="{{ route('appointments.calendar', ['view' => $viewType]) }}" class="px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition font-medium">Today</a>
                </div>
            </div>

            @php
                $colorPalette = [
                    'bg-purple-100 text-purple-800',
                    'bg-blue-100 text-blue-800',
                    'bg-green-100 text-green-800',
                    'bg-orange-100 text-orange-800',
                    'bg-indigo-100 text-indigo-800',
                    'bg-teal-100 text-teal-800',
                    'bg-pink-100 text-pink-800',
                    'bg-yellow-100 text-yellow-800',
                    'bg-red-100 text-red-800',
                ];
            @endphp

            <!-- Scrollable Container with fixed height -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden mx-auto" style="max-width: 1200px;">
                <div class="overflow-auto" style="max-height: 70vh; min-height: 400px;">
                    <!-- Inner wrapper with minimum width -->
                    <div style="min-width: {{ 90 + (count($doctors) * 120) }}px;" class="relative">
                        <!-- Doctors Header Row (sticky top) -->
                        <div class="grid sticky top-0 z-20 bg-white shadow-sm" style="grid-template-columns: 90px repeat({{ count($doctors) }}, minmax(100px, 120px));">
                            <div class="px-2 py-2 font-semibold text-sm bg-gradient-to-r from-blue-500 to-blue-600 text-white border-r border-blue-400 text-center sticky left-0 z-30 shadow-[2px_0_5px_-2px_rgba(0,0,0,0.1)]">
                                @if($viewType == 'day')
                                    Time
                                @elseif($viewType == 'week')
                                    Week Days
                                @else
                                    Date
                                @endif
                            </div>
                            @foreach($doctors as $doctor)
                                @php
                                    $specialityName = $doctor->speciality->name ?? 'General';
                                    $shortForm = strtoupper(substr($specialityName, 0, 3));
                                    $hash = crc32($shortForm) % count($colorPalette);
                                    $badgeColor = $colorPalette[$hash];
                                    $isWorkingDay = $availability[$doctor->id] ?? false;
                                @endphp
                                <div class="px-2 py-2 text-center bg-gradient-to-r from-blue-500 to-blue-600 text-white border-r border-blue-400 last:border-r-0">
                                    <div class="font-bold text-sm truncate">{{ $doctor->name }}</div>
                                    @if(!$isWorkingDay)
                                        <div class="mt-1 text-xs bg-red-400 rounded-full px-2 py-0.5 inline-block">Not Available</div>
                                    @endif
                                    <div class="mt-1"><span class="inline-block px-2 py-0.5 text-xs font-bold rounded-full {{ $badgeColor }}">{{ $shortForm }}</span></div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Time Slots Grid -->
                        <div class="divide-y divide-gray-200">
                            @foreach($timeSlots as $slot)
                                <div class="grid" style="grid-template-columns: 90px repeat({{ count($doctors) }}, minmax(100px, 120px)); hover:bg-gray-50">
                                    <!-- Sticky Time Column -->
                                    <div class="px-2 py-2 text-sm font-medium text-gray-600 border-r border-gray-200 bg-gray-50 text-center sticky left-0 z-10 shadow-[2px_0_5px_-2px_rgba(0,0,0,0.05)]" style="background-color: #f9fafb;">
                                        @if($viewType == 'day')
                                            {{ \Carbon\Carbon::parse($slot)->format('h:i A') }}
                                        @elseif($viewType == 'week')
                                            @if(is_array($slot))
                                                {{ $slot['day'] ?? '' }}<br>
                                                <span class="text-xs">{{ \Carbon\Carbon::parse($slot['date'])->format('d M') }}</span>
                                            @endif
                                        @else
                                            @if(is_array($slot))
                                                {{ $slot['day'] ?? '' }}<br>
                                                <span class="text-xs">{{ \Carbon\Carbon::parse($slot['date'])->format('d M') }}</span>
                                            @endif
                                        @endif
                                    </div>

                                    <!-- Doctor Columns -->
                                    @foreach($doctors as $doctor)
                                        @php
                                            $appointment = null;
                                            if($viewType == 'day') {
                                                $appointment = $appointments->first(function($apt) use ($doctor, $slot, $selectedDate) {
                                                    return $apt->doctor_id == $doctor->id
                                                        && $apt->appointment_date->format('Y-m-d') == $selectedDate
                                                        && \Carbon\Carbon::parse($slot)->between(
                                                            \Carbon\Carbon::parse($apt->start_time),
                                                            \Carbon\Carbon::parse($apt->end_time)->subSecond()
                                                        );
                                                });
                                            } elseif($viewType == 'week' && is_array($slot)) {
                                                $appointment = $appointments->first(function($apt) use ($doctor, $slot) {
                                                    return $apt->doctor_id == $doctor->id 
                                                        && $apt->appointment_date->format('Y-m-d') == ($slot['date'] ?? '');
                                                });
                                            } else {
                                                $appointment = $appointments->first(function($apt) use ($doctor, $slot) {
                                                    return $apt->doctor_id == $doctor->id 
                                                        && $apt->appointment_date->format('Y-m-d') == (is_array($slot) ? ($slot['date'] ?? '') : $slot);
                                                });
                                            }
                                        @endphp

                                        <div class="p-1 border-r border-gray-200 last:border-r-0 min-h-[70px]">
                                            @if(!($availability[$doctor->id] ?? false))
                                                <div class="h-full w-full bg-gray-200 rounded-lg flex items-center justify-center">
                                                    <span class="text-xs text-gray-500 font-medium">Not Available</span>
                                                </div>
                                            @else
                                                @if($appointment)
                                                    @php
                                                        $isStart = $viewType == 'day' && \Carbon\Carbon::parse($slot)->equalTo(\Carbon\Carbon::parse($appointment->start_time));
                                                    @endphp

                                                    @if($viewType == 'day' && $isStart)
                                                        <div class="appointment-card status-{{ $appointment->status }} p-1.5 rounded-lg cursor-pointer hover:shadow-md transition" onclick="window.location.href='/appointments/{{ $appointment->id }}'" style="min-height: 70px;">
                                                            <div class="font-medium text-xs text-white truncate">{{ $appointment->patient->name }}</div>
                                                            <div class="text-[11px] text-white mt-0.5">
                                                                {{ \Carbon\Carbon::parse($appointment->start_time)->format('h:i A') }} - 
                                                                {{ \Carbon\Carbon::parse($appointment->end_time)->format('h:i A') }}
                                                            </div>
                                                            @if($appointment->notes)
                                                                <div class="text-[11px] text-white mt-0.5 opacity-75 truncate">📝 {{ Str::limit($appointment->notes, 20) }}</div>
                                                            @endif
                                                            <div class="flex items-center justify-between mt-0.5">
                                                                <span class="text-[10px] px-1.5 py-0.5 rounded-full bg-white bg-opacity-30 text-white">
                                                                    {{ ucfirst(str_replace('_', ' ', $appointment->status)) }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    @elseif($viewType == 'day')
                                                        <div class="h-full w-full bg-red-100 rounded-lg flex items-center justify-center">
                                                            <span class="text-xs text-red-500 font-medium">Booked</span>
                                                        </div>
                                                    @else
                                                        <div class="appointment-card status-{{ $appointment->status }} p-1.5 rounded-lg cursor-pointer hover:shadow-md transition" onclick="window.location.href='/appointments/{{ $appointment->id }}'">
                                                            <div class="font-medium text-xs text-white truncate">{{ $appointment->patient->name }}</div>
                                                            <div class="text-[11px] text-white mt-0.5">
                                                                {{ \Carbon\Carbon::parse($appointment->start_time)->format('h:i A') }} - 
                                                                {{ \Carbon\Carbon::parse($appointment->end_time)->format('h:i A') }}
                                                            </div>
                                                            @if($appointment->notes)
                                                                <div class="text-[11px] text-white mt-0.5 opacity-75 truncate">📝 {{ Str::limit($appointment->notes, 20) }}</div>
                                                            @endif
                                                            <div class="flex items-center justify-between mt-0.5">
                                                                <span class="text-[10px] px-1.5 py-0.5 rounded-full bg-white bg-opacity-30 text-white">
                                                                    {{ ucfirst(str_replace('_', ' ', $appointment->status)) }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @else
                                                    <div class="empty-slot h-full flex items-center justify-center cursor-pointer hover:bg-green-50 rounded-lg border border-dashed border-gray-300 transition"
                                                         onclick="bookAppointment({{ $doctor->id }}, '{{ $viewType == 'day' ? $selectedDate : (is_array($slot) && isset($slot['date']) ? $slot['date'] : $selectedDate) }}', '{{ $viewType == 'day' ? substr($slot, 0, 5) : '09:00' }}')">
                                                        <span class="text-xs text-gray-400 hover:text-blue-500 font-medium">+ Book Appointment</span>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Legend and Stats (unchanged) -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-4">
                <div class="bg-white rounded-lg shadow-md p-4">
                    <h4 class="font-semibold mb-2 text-sm">Status Legend</h4>
                    <div class="grid grid-cols-2 gap-2 text-xs">
                        <div class="flex items-center"><span class="w-3 h-3 bg-yellow-500 rounded-full mr-2"></span>Pending</div>
                        <div class="flex items-center"><span class="w-3 h-3 bg-blue-500 rounded-full mr-2"></span>Checked In</div>
                        <div class="flex items-center"><span class="w-3 h-3 bg-green-500 rounded-full mr-2"></span>Checked Out</div>
                        <div class="flex items-center"><span class="w-3 h-3 bg-red-500 rounded-full mr-2"></span>Cancelled</div>
                        <div class="flex items-center"><span class="w-3 h-3 bg-gray-500 rounded-full mr-2"></span>No Show</div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md p-4">
                    <h4 class="font-semibold mb-2 text-sm">Speciality Short Forms</h4>
                    <div class="grid grid-cols-2 gap-2 text-xs">
                        @php
                            $uniqueSpecialties = $doctors->pluck('speciality.name')->unique()->filter();
                            $shown = [];
                        @endphp
                        @foreach($uniqueSpecialties as $spec)
                            @php
                                $short = strtoupper(substr($spec, 0, 3));
                                if (in_array($short, $shown)) continue;
                                $shown[] = $short;
                                $hash = crc32($short) % count($colorPalette);
                                $legendColor = $colorPalette[$hash];
                            @endphp
                            <div class="p-1 {{ $legendColor }} rounded text-center font-bold">{{ $short }}</div>
                        @endforeach
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md p-4 md:col-span-2">
                    <h4 class="font-semibold mb-2 text-sm">Today's Summary</h4>
                    <div class="grid grid-cols-3 gap-2 text-center">
                        @php
                            $todayAppointments = $appointments->filter(function ($apt) use ($selectedDate) {
                                return $apt->appointment_date->format('Y-m-d') == $selectedDate;
                            });
                            $pendingCount = $todayAppointments->where('status', 'pending')->count();
                            $checkedOutCount = $todayAppointments->where('status', 'checked_out')->count();
                        @endphp
                        <div class="p-2 bg-blue-50 rounded"><div class="text-xs text-gray-600">Total</div><div class="text-xl font-bold text-blue-600">{{ $todayAppointments->count() }}</div></div>
                        <div class="p-2 bg-yellow-50 rounded"><div class="text-xs text-gray-600">Pending</div><div class="text-xl font-bold text-yellow-600">{{ $pendingCount }}</div></div>
                        <div class="p-2 bg-green-50 rounded"><div class="text-xs text-gray-600">Completed</div><div class="text-xl font-bold text-green-600">{{ $checkedOutCount }}</div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Custom scrollbar styling (optional) */
        .overflow-auto::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        .overflow-auto::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        .overflow-auto::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
        }
        .overflow-auto::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }
        /* Ensure sticky columns have proper background to avoid transparency */
        .sticky {
            background-color: inherit;
        }
        /* For the time column, we already set inline background-color */
        .appointment-card {
            transition: all 0.2s;
            min-height: 70px;
        }
        .appointment-card.status-pending { background: linear-gradient(135deg, #f59e0b, #fbbf24); }
        .appointment-card.status-checked_in { background: linear-gradient(135deg, #3b82f6, #60a5fa); }
        .appointment-card.status-checked_out { background: linear-gradient(135deg, #10b981, #34d399); }
        .appointment-card.status-cancelled { background: linear-gradient(135deg, #ef4444, #f87171); }
        .appointment-card.status-no_show { background: linear-gradient(135deg, #6b7280, #9ca3af); }
        .empty-slot { min-height: 70px; transition: all 0.2s; }
        .empty-slot:hover { border-color: #3b82f6; background-color: #eff6ff; }
        .grid { display: grid; }
        body { overflow-x: hidden; }
        .max-w-full { max-width: 100%; }
    </style>

    <script>
        function bookAppointment(doctorId, date, time) {
            window.location.href = `/appointments/create?doctor_id=${doctorId}&date=${date}&time=${time}`;
        }
    </script>
</x-app-layout>