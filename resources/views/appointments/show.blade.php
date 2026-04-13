<x-app-layout>
    <div class="max-w-3xl mx-auto py-10">
        <div class="bg-white shadow-xl rounded-xl p-6">
            <h2 class="text-2xl font-bold mb-6">Appointment Details</h2>
            
            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Error Message -->
            @if(session('error'))
                <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif
            
            <div class="space-y-4">
                <p>
                    <strong>Patient Name:</strong>
                    {{ $appointment->patient->name ?? 'N/A' }}
                </p>
                
                <p>
                    <strong>Doctor:</strong>
                    {{ $appointment->doctor->name ?? 'N/A' }}
                </p>
                
                <p>
                    <strong>Date:</strong>
                    {{ $appointment->appointment_date }}
                </p>
                
                <p>
                    <strong>Time:</strong>
                    {{ $appointment->appointment_time }}
                </p>
                
                <p>
                    <strong>Status:</strong>
                    <span class="px-3 py-1 rounded text-white
                        @if($appointment->status == 'pending') bg-yellow-500
                        @elseif($appointment->status == 'checked_in') bg-blue-500
                        @elseif($appointment->status == 'checked_out') bg-green-500
                        @elseif($appointment->status == 'cancelled') bg-red-500
                        @elseif($appointment->status == 'no_show') bg-gray-500
                        @endif
                    ">
                        {{ ucfirst(str_replace('_', ' ', $appointment->status)) }}
                    </span>
                </p>
            </div>

            <div class="flex flex-wrap gap-3 mt-8">
                <!-- Check-In Button -->
                @if($appointment->status != 'checked_in' && $appointment->status != 'checked_out' && $appointment->status != 'cancelled')
                <form method="POST" action="{{ route('appointments.status', $appointment) }}">
                    @csrf
                    <input type="hidden" name="status" value="checked_in">
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                        Check-In
                    </button>
                </form>
                @endif
                
                <!-- Check-Out Button -->
                @if($appointment->status == 'checked_in')
                <form method="POST" action="{{ route('appointments.status', $appointment) }}">
                    @csrf
                    <input type="hidden" name="status" value="checked_out">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                        Check-Out
                    </button>
                </form>
                @endif
                
                <!-- Cancel Button -->
                @if($appointment->status != 'cancelled' && $appointment->status != 'checked_out')
                <form method="POST" action="{{ route('appointments.status', $appointment) }}">
                    @csrf
                    <input type="hidden" name="status" value="cancelled">
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                        Cancel
                    </button>
                </form>
                @endif
                
                <!-- No Show Button -->
                @if($appointment->status != 'no_show' && $appointment->status != 'checked_out' && $appointment->status != 'cancelled')
                <form method="POST" action="{{ route('appointments.status', $appointment) }}">
                    @csrf
                    <input type="hidden" name="status" value="no_show">
                    <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                        No Show
                    </button>
                </form>
                @endif
                
                <!-- Undo to Pending Button -->
                @if($appointment->status != 'pending')
                <form method="POST" action="{{ route('appointments.status', $appointment) }}">
                    @csrf
                    <input type="hidden" name="status" value="pending">
                    <button type="submit" class="bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded">
                        Undo to Pending
                    </button>
                </form>
                @endif

                <!-- Back to Calendar Button -->
                <a href="{{ route('appointments.calendar') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                    Back to Calendar
                </a>
            </div>
        </div>
    </div>
</x-app-layout>