<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Patient') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header with improved styling -->
            <div class="mb-6 flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <div class="bg-blue-600 rounded-lg p-2">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold text-gray-900">Patient Registration</h1>
                </div>
                <a href="{{ route('patients.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors duration-200 shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to List
                </a>
            </div>

            <!-- Centered Form Container -->
            <div class="min-h-[70vh] flex items-center justify-center">
                <div class="bg-white rounded-2xl shadow-xl w-full max-w-2xl overflow-hidden">
                    <!-- Form Header -->
                    <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                        <h3 class="text-lg font-semibold text-white flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Enter Patient Details
                        </h3>
                        <p class="text-blue-100 text-xs mt-1">Please fill in all the required information below</p>
                    </div>

                    <!-- Form Body -->
                    <div class="p-8">
                        <form action="{{ route('patients.store') }}" method="POST">
                            @csrf

                            <!-- Name Field - Enhanced -->
                            <div class="mb-5">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        Full Name <span class="text-red-500 ml-1">*</span>
                                    </span>
                                </label>
                                <input type="text"
                                       name="name"
                                       value="{{ old('name') }}"
                                       class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-blue-400 focus:ring-2 focus:ring-blue-200 transition-all duration-200 @error('name') border-red-400 @enderror"
                                       placeholder="Enter patient's full name"
                                       required>
                                @error('name')
                                    <p class="text-red-500 text-xs mt-2 flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Age and Gender Grid - Enhanced -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                                <!-- Age Field -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Age <span class="text-red-500 ml-1">*</span>
                                        </span>
                                    </label>
                                    <input type="number"
                                           name="age"
                                           value="{{ old('age') }}"
                                           class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-blue-400 focus:ring-2 focus:ring-blue-200 transition-all duration-200 @error('age') border-red-400 @enderror"
                                           placeholder="Years"
                                           min="0"
                                           max="150"
                                           required>
                                    @error('age')
                                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Gender Field -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                            Gender <span class="text-red-500 ml-1">*</span>
                                        </span>
                                    </label>
                                    <div class="relative">
                                        <select name="gender"
                                                class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm appearance-none bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-200 transition-all duration-200 @error('gender') border-red-400 @enderror"
                                                required>
                                            <option value="" disabled selected>Select gender</option>
                                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                            <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                        <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    @error('gender')
                                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Phone Field - Enhanced -->
                            <div class="mb-5">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                        </svg>
                                        Phone Number <span class="text-red-500 ml-1">*</span>
                                    </span>
                                </label>
                                <input type="tel"
                                       name="phone"
                                       value="{{ old('phone') }}"
                                       class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-blue-400 focus:ring-2 focus:ring-blue-200 transition-all duration-200 @error('phone') border-red-400 @enderror"
                                       placeholder="Enter contact number"
                                       required>
                                @error('phone')
                                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Address Field - Enhanced -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        Residential Address
                                    </span>
                                </label>
                                <textarea name="address"
                                          rows="3"
                                          class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-blue-400 focus:ring-2 focus:ring-blue-200 transition-all duration-200 resize-none @error('address') border-red-400 @enderror"
                                          placeholder="Enter complete address">{{ old('address') }}</textarea>
                                @error('address')
                                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Form Actions - Enhanced -->
                            <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-100">
                                <a href="{{ route('patients.index') }}" 
                                   class="px-6 py-2.5 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-colors duration-200 font-medium text-sm">
                                    Cancel
                                </a>
                                <button type="submit" 
                                        class="inline-flex items-center px-8 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-200 shadow-md hover:shadow-lg font-medium text-sm">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                                    </svg>
                                    Save Patient
                                </button>
                            </div>

                            <!-- Required Fields Note -->
                            <p class="text-xs text-gray-400 mt-4 text-right">
                                <span class="text-red-500">*</span> Required fields
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>