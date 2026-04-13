<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Patient Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Main Container -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <!-- Header Section with Gradient -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-3">
                            <div class="bg-white/20 rounded-lg p-2">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-white">Patients Directory</h2>
                        </div>
                        <div class="flex space-x-3">
                            @if(in_array(auth()->user()->role, ['admin','staff']))
                                <a href="{{ route('patients.create') }}" 
                                   class="inline-flex items-center px-4 py-2 bg-white text-blue-600 rounded-lg font-semibold hover:bg-gray-100 transition-all duration-200 hover:scale-105 shadow-md">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Add Patient
                                </a>
                            @endif
                            <a href="{{ route('patients.trash') }}" 
                               class="inline-flex items-center px-4 py-2 bg-red-500 text-white rounded-lg font-semibold hover:bg-red-600 transition-all duration-200 hover:scale-105 shadow-md">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Trash
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Content Section -->
                <div class="p-6">
                    <!-- Search Filter Section - Enhanced -->
                    <div class="bg-gray-50 rounded-xl p-5 mb-6 border border-gray-200">
                        <h3 class="text-sm font-medium text-gray-700 mb-3 flex items-center">
                            <svg class="w-4 h-4 mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Filter Patients
                        </h3>
                        <form method="GET" action="{{ route('patients.index') }}" class="flex flex-wrap gap-3">
                            <!-- Preserve sort parameters in search -->
                            <input type="hidden" name="sort" value="{{ $sort ?? 'id' }}">
                            <input type="hidden" name="direction" value="{{ $direction ?? 'desc' }}">
                            
                            <div class="flex-1 min-w-[200px]">
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <input type="text"
                                           name="name"
                                           placeholder="Search by name"
                                           value="{{ request('name') }}"
                                           class="w-full pl-10 pr-3 py-2.5 border-2 border-gray-200 rounded-lg focus:border-blue-400 focus:ring-2 focus:ring-blue-200 transition-all">
                                </div>
                            </div>

                            <div class="flex-1 min-w-[200px]">
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                        </svg>
                                    </div>
                                    <input type="text"
                                           name="phone"
                                           placeholder="Search by phone"
                                           value="{{ request('phone') }}"
                                           class="w-full pl-10 pr-3 py-2.5 border-2 border-gray-200 rounded-lg focus:border-blue-400 focus:ring-2 focus:ring-blue-200 transition-all">
                                </div>
                            </div>

                            <div class="w-44">
                                <div class="relative">
                                    <select name="gender"
                                            class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-blue-400 focus:ring-2 focus:ring-blue-200 transition-all appearance-none bg-white">
                                        <option value="">All Gender</option>
                                        <option value="male" {{ request('gender')=='male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ request('gender')=='female' ? 'selected' : '' }}>Female</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <button type="submit"
                                    class="inline-flex items-center px-5 py-2.5 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-all duration-200 shadow-md hover:shadow-lg">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                Search
                            </button>

                            <a href="{{ route('patients.index') }}"
                               class="inline-flex items-center px-5 py-2.5 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-all duration-200 shadow-md hover:shadow-lg">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                Reset
                            </a>
                        </form>
                    </div>

                    <!-- Success Message - Enhanced -->
                    @if(session('success'))
                        <div class="mb-5 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg flex items-center" role="alert">
                            <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="font-medium">{{ session('success') }}</span>
                        </div>
                    @endif

                    <!-- Stats Bar -->
                    <div class="flex justify-between items-center mb-4">
                        <p class="text-sm text-gray-600">
                            Showing <span class="font-semibold">{{ $patients->firstItem() ?? 0 }}</span> 
                            to <span class="font-semibold">{{ $patients->lastItem() ?? 0 }}</span> 
                            of <span class="font-semibold">{{ $patients->total() }}</span> patients
                        </p>
                        <div class="flex items-center space-x-4">
                            <p class="text-sm text-gray-600">
                                Sorted by: <span class="font-semibold text-blue-600">{{ ucfirst($sort ?? 'id') }}</span>
                                <span class="text-gray-400 mx-1">|</span>
                                <span class="font-semibold {{ ($direction ?? 'desc') === 'asc' ? 'text-green-600' : 'text-orange-600' }}">
                                    {{ ($direction ?? 'desc') === 'asc' ? 'Ascending ↑' : 'Descending ↓' }}
                                </span>
                            </p>
                            <p class="text-sm text-gray-600">
                                Total Records: <span class="font-semibold text-blue-600">{{ $patients->total() }}</span>
                            </p>
                        </div>
                    </div>

                    <!-- Patients Table - Enhanced with Sortable Headers -->
                    <div class="overflow-x-auto border border-gray-200 rounded-xl">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <a href="{{ route('patients.index', array_merge(request()->query(), ['sort' => 'name', 'direction' => ($sort === 'name' && $direction === 'asc') ? 'desc' : 'asc'])) }}" 
                                           class="flex items-center hover:text-blue-600 transition-colors group">
                                            <svg class="w-4 h-4 mr-1 text-gray-500 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                            Patient Name
                                            @if($sort === 'name')
                                                <span class="ml-1 text-blue-600">
                                                    {!! $direction === 'asc' ? '↑' : '↓' !!}
                                                </span>
                                            @endif
                                        </a>
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <a href="{{ route('patients.index', array_merge(request()->query(), ['sort' => 'age', 'direction' => ($sort === 'age' && $direction === 'asc') ? 'desc' : 'asc'])) }}" 
                                           class="flex items-center justify-center hover:text-blue-600 transition-colors group">
                                            <svg class="w-4 h-4 mr-1 text-gray-500 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Age
                                            @if($sort === 'age')
                                                <span class="ml-1 text-blue-600">
                                                    {!! $direction === 'asc' ? '↑' : '↓' !!}
                                                </span>
                                            @endif
                                        </a>
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <a href="{{ route('patients.index', array_merge(request()->query(), ['sort' => 'phone', 'direction' => ($sort === 'phone' && $direction === 'asc') ? 'desc' : 'asc'])) }}" 
                                           class="flex items-center justify-center hover:text-blue-600 transition-colors group">
                                            <svg class="w-4 h-4 mr-1 text-gray-500 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                            </svg>
                                            Phone
                                            @if($sort === 'phone')
                                                <span class="ml-1 text-blue-600">
                                                    {!! $direction === 'asc' ? '↑' : '↓' !!}
                                                </span>
                                            @endif
                                        </a>
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <a href="{{ route('patients.index', array_merge(request()->query(), ['sort' => 'address', 'direction' => ($sort === 'address' && $direction === 'asc') ? 'desc' : 'asc'])) }}" 
                                           class="flex items-center hover:text-blue-600 transition-colors group">
                                            <svg class="w-4 h-4 mr-1 text-gray-500 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            </svg>
                                            Address
                                            @if($sort === 'address')
                                                <span class="ml-1 text-blue-600">
                                                    {!! $direction === 'asc' ? '↑' : '↓' !!}
                                                </span>
                                            @endif
                                        </a>
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <a href="{{ route('patients.index', array_merge(request()->query(), ['sort' => 'id', 'direction' => ($sort === 'id' && $direction === 'asc') ? 'desc' : 'asc'])) }}" 
                                           class="flex items-center justify-center hover:text-blue-600 transition-colors group">
                                            <svg class="w-4 h-4 mr-1 text-gray-500 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16"></path>
                                            </svg>
                                            Actions
                                            @if($sort === 'id')
                                                <span class="ml-1 text-blue-600">
                                                    {!! $direction === 'asc' ? '↑' : '↓' !!}
                                                </span>
                                            @else
                                                <span class="ml-1 text-gray-400 text-xs">(Default ↓)</span>
                                            @endif
                                        </a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($patients as $patient)
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
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            @if(auth()->user()->role === 'admin')
                                                <div class="flex items-center justify-center space-x-3">
                                                    <a href="{{ route('patients.edit', $patient->id) }}" 
                                                       class="inline-flex items-center px-3 py-1.5 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition-all duration-200 text-sm shadow-sm">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                        </svg>
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                onclick="return confirm('Are you sure you want to delete this patient? This action cannot be undone.')"
                                                                class="inline-flex items-center px-3 py-1.5 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-all duration-200 text-sm shadow-sm">
                                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                            </svg>
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            @else
                                                <span class="inline-flex items-center px-3 py-1.5 bg-gray-100 text-gray-600 rounded-lg text-sm">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                    </svg>
                                                    View Only
                                                </span>
                                            @endif
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
                                                <p class="mt-2 text-sm text-gray-500">Try adjusting your search filters or add a new patient.</p>
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

                    <!-- Pagination - Enhanced -->
                    <div class="mt-6">
                        @if($patients->hasPages())
                            <div class="flex items-center justify-between">
                                <p class="text-sm text-gray-600">
                                    Showing <span class="font-semibold">{{ $patients->firstItem() }}</span> 
                                    to <span class="font-semibold">{{ $patients->lastItem() }}</span> 
                                    of <span class="font-semibold">{{ $patients->total() }}</span> results
                                </p>
                                <div class="flex space-x-2">
                                    {{ $patients->appends(request()->query())->links() }}
                                </div>
                            </div>
                        @else
                            <p class="text-sm text-gray-600 text-center">
                                Showing all {{ $patients->total() }} patients
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>