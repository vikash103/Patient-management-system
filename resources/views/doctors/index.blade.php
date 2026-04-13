<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Doctors Directory') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Main Container -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <!-- Header Section with Gradient -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                    <div class="flex items-center space-x-3">
                        <div class="bg-white/20 rounded-lg p-2">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-white">Doctors Directory</h2>
                            <p class="text-blue-100 text-xs mt-1">Complete list of registered doctors and their specialities</p>
                        </div>
                    </div>
                </div>

                <!-- Content Section -->
                <div class="p-6">
                    <!-- Stats and Info Bar -->
                    <div class="flex justify-between items-center mb-6">
                        <div class="flex items-center space-x-4">
                            <div class="bg-blue-50 rounded-lg px-4 py-2">
                                <p class="text-xs text-gray-500">Total Doctors</p>
                                <p class="text-xl font-bold text-gray-800">{{ $doctors->count() }}</p>
                            </div>
                            <div class="bg-green-50 rounded-lg px-4 py-2">
                                <p class="text-xs text-gray-500">Specialities</p>
                                <p class="text-xl font-bold text-gray-800">{{ $doctors->pluck('speciality_id')->unique()->count() }}</p>
                            </div>
                        </div>
                        <div class="text-sm text-gray-500">
                            <span class="inline-flex items-center">
                                <svg class="w-4 h-4 mr-1 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                </svg>
                                Last updated: {{ now()->format('M d, Y') }}
                            </span>
                        </div>
                    </div>

                    <!-- Doctors Table - Enhanced -->
                    <div class="overflow-x-auto border border-gray-200 rounded-xl">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                            Doctor Name
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                            </svg>
                                            Email Address
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                            </svg>
                                            Speciality
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($doctors as $doctor)
                                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-12 w-12 bg-gradient-to-br from-blue-100 to-blue-200 rounded-full flex items-center justify-center shadow-sm">
                                                    <span class="text-blue-600 font-bold text-lg">
                                                        {{ collect(explode(' ', $doctor->name))->map(fn($part) => strtoupper(substr($part, 0, 1)))->take(2)->join('') }}
                                                    </span>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-base font-semibold text-gray-900">{{ $doctor->name }}</div>
                                                    <div class="text-xs text-gray-500 flex items-center mt-1">
                                                        <svg class="w-3 h-3 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                        </svg>
                                                        ID: #{{ str_pad($doctor->id, 4, '0', STR_PAD_LEFT) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center text-sm text-gray-600">
                                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                                </svg>
                                                <span class="font-mono">{{ $doctor->email }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($doctor->speciality)
                                                <span class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-50 to-blue-100 text-blue-700 rounded-full text-sm font-medium border border-blue-200 shadow-sm">
                                                    <svg class="w-4 h-4 mr-1.5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                                    </svg>
                                                    {{ $doctor->speciality->name }}
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-500 rounded-full text-sm border border-gray-200">
                                                    <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                                    </svg>
                                                    Not Assigned
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center justify-center">
                                                <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                                <h3 class="mt-4 text-lg font-medium text-gray-900">No doctors found</h3>
                                                <p class="mt-2 text-sm text-gray-500">There are no doctors registered in the system yet.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Summary Cards -->
                    @if($doctors->count() > 0)
                        <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Top Speciality Card -->
                            <div class="bg-gradient-to-r from-purple-50 to-purple-100 rounded-lg p-4 border border-purple-200">
                                <h4 class="text-sm font-medium text-gray-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-purple-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"></path>
                                    </svg>
                                    Most Common Speciality
                                </h4>
                                @php
                                    $specialityCounts = $doctors->groupBy('speciality_id')->map->count();
                                    $topSpecialityId = $specialityCounts->sortDesc()->keys()->first();
                                    $topSpeciality = $doctors->firstWhere('speciality_id', $topSpecialityId)?->speciality;
                                @endphp
                                <p class="text-xl font-bold text-gray-800 mt-2">
                                    {{ $topSpeciality?->name ?? 'N/A' }}
                                </p>
                                <p class="text-xs text-gray-500 mt-1">
                                    {{ $specialityCounts->max() ?? 0 }} doctor{{ $specialityCounts->max() != 1 ? 's' : '' }}
                                </p>
                            </div>

                            <!-- Email Domain Card -->
                            <div class="bg-gradient-to-r from-green-50 to-green-100 rounded-lg p-4 border border-green-200">
                                <h4 class="text-sm font-medium text-gray-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                    </svg>
                                    Common Email Domain
                                </h4>
                                @php
                                    $domains = $doctors->map(fn($d) => substr(strrchr($d->email, "@"), 1))->countBy();
                                    $topDomain = $domains->sortDesc()->keys()->first();
                                @endphp
                                <p class="text-xl font-bold text-gray-800 mt-2">{{ $topDomain ?? 'N/A' }}</p>
                                <p class="text-xs text-gray-500 mt-1">{{ $domains->max() ?? 0 }} doctors use this domain</p>
                            </div>

                            <!-- Quick Stats Card -->
                            <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg p-4 border border-blue-200">
                                <h4 class="text-sm font-medium text-gray-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM14 11a1 1 0 011 1v1h1a1 1 0 110 2h-1v1a1 1 0 11-2 0v-1h-1a1 1 0 110-2h1v-1a1 1 0 011-1z"></path>
                                    </svg>
                                    Distribution
                                </h4>
                                <div class="mt-2 space-y-2">
                                    <div class="flex justify-between items-center text-sm">
                                        <span class="text-gray-600">With Speciality</span>
                                        <span class="font-semibold text-gray-800">{{ $doctors->whereNotNull('speciality_id')->count() }}</span>
                                    </div>
                                    <div class="flex justify-between items-center text-sm">
                                        <span class="text-gray-600">Without Speciality</span>
                                        <span class="font-semibold text-gray-800">{{ $doctors->whereNull('speciality_id')->count() }}</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-1.5 mt-1">
                                        <div class="bg-blue-600 h-1.5 rounded-full" style="width: {{ ($doctors->whereNotNull('speciality_id')->count() / max($doctors->count(), 1)) * 100 }}%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Pagination -->
                    @if(method_exists($doctors, 'links'))
                        <div class="mt-6">
                            {{ $doctors->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>