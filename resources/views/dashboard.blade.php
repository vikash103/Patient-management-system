<x-app-layout>
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Section - Added for professionalism -->
            <div class="mb-8 bg-gradient-to-r from-blue-600 to-blue-700 rounded-2xl shadow-lg overflow-hidden">
                <div class="px-8 py-6 flex justify-between items-center">
                    <div class="flex items-center space-x-4">
                        <div class="bg-white/20 rounded-lg p-3">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-white">Welcome back, {{ auth()->user()->name }}!</h1>
                            <p class="text-blue-100 text-sm mt-1">Here's what's happening with your practice today</p>
                        </div>
                    </div>
                    
                    @if(in_array(auth()->user()->role, ['admin','staff']))
                        <a href="{{ route('patients.create') }}" 
                           class="inline-flex items-center px-6 py-3 bg-white text-blue-600 rounded-xl font-semibold hover:bg-gray-100 transition-all duration-200 hover:scale-105 shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Add New Patient
                        </a>
                    @endif
                </div>
            </div>

            <!-- Stats Cards - Exactly same structure, enhanced styling -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Patients Card -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-blue-500 hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Total Patients</p>
                            <h3 class="text-4xl font-bold text-gray-800 mt-2">{{ $totalPatients }}</h3>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-xs text-gray-400 mt-4">Total registered patients</p>
                </div>

                <!-- Male Patients Card -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-green-500 hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Male Patients</p>
                            <h3 class="text-4xl font-bold text-gray-800 mt-2">{{ $malePatients }}</h3>
                        </div>
                        <div class="bg-green-100 p-3 rounded-lg">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-xs text-gray-400 mt-4">{{ $totalPatients > 0 ? round(($malePatients/$totalPatients)*100, 1) : 0 }}% of total patients</p>
                </div>

                <!-- Female Patients Card -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-pink-500 hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Female Patients</p>
                            <h3 class="text-4xl font-bold text-gray-800 mt-2">{{ $femalePatients }}</h3>
                        </div>
                        <div class="bg-pink-100 p-3 rounded-lg">
                            <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-xs text-gray-400 mt-4">{{ $totalPatients > 0 ? round(($femalePatients/$totalPatients)*100, 1) : 0 }}% of total patients</p>
                </div>

                <!-- Deleted/Inactive Patients Card -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-red-500 hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Deleted Patients</p>
                            <h3 class="text-4xl font-bold text-gray-800 mt-2">{{ $deletedPatients }}</h3>
                        </div>
                        <div class="bg-red-100 p-3 rounded-lg">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-xs text-gray-400 mt-4">Inactive records</p>
                </div>
            </div>

            <!-- Recent Patients Section - Fixed ordering to show newest first -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <!-- Section Header -->
                <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                    <div class="flex justify-between items-center">
                        <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            Recently Registered Patients
                        </h3>
                        <div class="flex items-center space-x-2">
                            <span class="text-xs text-gray-500 bg-white px-3 py-1 rounded-full shadow-sm">
                                Latest first
                            </span>
                            <span class="text-xs text-gray-500 bg-white px-3 py-1 rounded-full shadow-sm">
                                Last {{ $recentPatients->count() }} records
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Table Container -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        Name
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <div class="flex items-center justify-center">
                                        <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Age
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <div class="flex items-center justify-center">
                                        <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                        </svg>
                                        Phone
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        </svg>
                                        Address
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <div class="flex items-center justify-center">
                                        <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Registered
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($recentPatients as $patient)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 bg-gradient-to-br from-blue-100 to-blue-200 rounded-full flex items-center justify-center">
                                                <span class="text-blue-600 font-semibold text-sm">
                                                    {{ collect(explode(' ', $patient->name))->map(fn($part) => strtoupper(substr($part, 0, 1)))->take(2)->join('') }}
                                                </span>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $patient->name }}</div>
                                                <div class="text-xs text-gray-500">ID: #{{ str_pad($patient->id, 4, '0', STR_PAD_LEFT) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                                            {{ $patient->age }} yrs
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-600">
                                        {{ $patient->phone }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600 max-w-xs truncate">
                                        {{ $patient->address ?? 'Not provided' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                        {{ $patient->created_at ? $patient->created_at->diffForHumans() : 'N/A' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                            </svg>
                                            <h3 class="mt-4 text-lg font-medium text-gray-900">No patients found</h3>
                                            <p class="mt-2 text-sm text-gray-500">Start by adding your first patient record.</p>
                                            @if(in_array(auth()->user()->role, ['admin','staff']))
                                                <a href="{{ route('patients.create') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                                    </svg>
                                                    Add New Patient
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination with enhanced styling -->
                @if($recentPatients->hasPages())
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                        <div class="flex items-center justify-between">
                            <p class="text-sm text-gray-600">
                                Showing <span class="font-medium">{{ $recentPatients->firstItem() }}</span> 
                                to <span class="font-medium">{{ $recentPatients->lastItem() }}</span> 
                                of <span class="font-medium">{{ $recentPatients->total() }}</span> results
                            </p>
                            <div class="flex space-x-2">
                                {{ $recentPatients->links() }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Quick Stats Footer -->
            <div class="mt-6 grid grid-cols-2 md:grid-cols-5 gap-4">
                <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-100">
                    <p class="text-xs text-gray-500">Average Age</p>
                    <p class="text-lg font-semibold text-gray-800">{{ $recentPatients->avg('age') ? round($recentPatients->avg('age')) : 0 }} years</p>
                </div>
                <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-100">
                    <p class="text-xs text-gray-500">Gender Ratio</p>
                    <p class="text-lg font-semibold text-gray-800">{{ $malePatients }}:{{ $femalePatients }}</p>
                </div>
                <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-100">
                    <p class="text-xs text-gray-500">Total Records</p>
                    <p class="text-lg font-semibold text-gray-800">{{ $totalPatients + $deletedPatients }}</p>
                </div>
                <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-100">
                    <p class="text-xs text-gray-500">Active Rate</p>
                    <p class="text-lg font-semibold text-gray-800">{{ $totalPatients > 0 ? round(($totalPatients/($totalPatients+$deletedPatients))*100, 1) : 0 }}%</p>
                </div>
                <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-100">
                    <p class="text-xs text-gray-500">Newest Patient</p>
                    <p class="text-lg font-semibold text-gray-800">{{ $recentPatients->first()?->created_at?->diffForHumans() ?? 'N/A' }}</p>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Optional: Add a visual indicator for newest records
        document.addEventListener('DOMContentLoaded', function() {
            const rows = document.querySelectorAll('tbody tr');
            if (rows.length > 0) {
                // Highlight the newest patient (first row) with a subtle indicator
                const newestRow = rows[0];
                if (newestRow) {
                    newestRow.classList.add('bg-blue-50/30');
                }
            }
        });
    </script>
    @endpush
</x-app-layout>