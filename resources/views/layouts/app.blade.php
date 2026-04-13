<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Laravel') }}</title>

<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Laravel') }}</title>

<!-- ✅ Yaha add karo -->
<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

@vite(['resources/css/app.css', 'resources/js/app.js'])

</head>



<body class="font-sans antialiased bg-gray-100">

<div class="flex min-h-screen">

<!-- Sidebar -->

<aside id="sidebar" class="w-64 bg-gray-900 text-white transition-all duration-300">

<div class="p-5 text-xl font-bold border-b border-gray-700">
Patient System
</div>

<nav class="p-4 space-y-2">

<a href="{{ route('dashboard') }}"
class="block px-4 py-2 rounded hover:bg-gray-700">
Dashboard
</a>

<a href="{{ route('patients.index') }}"
class="block px-4 py-2 rounded hover:bg-gray-700">
Patients
</a>

<a href="{{ route('specialities.index') }}"
class="block px-4 py-2 text-gray-200 hover:bg-gray-700 rounded">
Specialities
</a>

<a href="{{ route('patients.trash') }}"
class="block px-4 py-2 rounded hover:bg-gray-700">
Deleted Patients
</a>

<a href="{{ route('doctor-schedules.index') }}" 
class="block px-4 py-2 text-white hover:bg-gray-700">

Doctor Schedule

</a>


<a href="{{ route('doctors.index') }}"
class="block px-4 py-2 text-gray-200 hover:bg-gray-700 rounded">

Doctors

</a>

<a href="{{ route('appointments.calendar') }}"
class="block px-4 py-2 text-gray-200 hover:bg-gray-700 rounded">
Appointment Calendar


</aside>


<!-- Main Content -->

<div class="flex-1 flex flex-col">

<!-- Navbar -->

<div class="bg-white shadow p-4 flex items-center justify-between">

<!-- LEFT SIDE -->

<div class="flex items-center space-x-4">

<button onclick="toggleSidebar()" 
class="text-xl text-gray-600 hover:text-black">
☰
</button>

<x-application-logo class="block h-8 w-auto fill-current text-gray-800" />

<a href="{{ route('dashboard') }}" 
class="font-semibold text-gray-700">
Dashboard
</a>

</div>


<!-- RIGHT SIDE -->

<div class="flex items-center space-x-4">

<!-- Notification Bell -->

<div class="relative">

<button onclick="toggleNotifications()" class="text-xl text-gray-700 hover:text-black">
🔔
</button>

@if(auth()->user()->unreadNotifications->count() > 0)

<span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs px-2 rounded-full">
{{ auth()->user()->unreadNotifications->count() }}
</span>

@endif

<!-- Notification Dropdown -->

<div id="notificationDropdown"
class="hidden absolute right-0 mt-2 w-64 bg-white shadow rounded z-50">

@forelse(auth()->user()->unreadNotifications as $notification)

<div class="px-4 py-2 border-b text-sm text-gray-700">
{{ $notification->data['message'] }}
</div>

@empty

<div class="px-4 py-2 text-sm text-gray-500">
No Notifications
</div>

@endforelse

</div>

</div>


<!-- User Dropdown -->

<x-dropdown align="right" width="48">

<x-slot name="trigger">
<button class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-900">

{{ Auth::user()->name }}

<svg class="ml-1 h-4 w-4 fill-current" viewBox="0 0 20 20">
<path d="M5.23 7.21l4.77 4.77 4.77-4.77"/>
</svg>

</button>
</x-slot>

<x-slot name="content">

<x-dropdown-link :href="route('profile.edit')">
{{ __('Profile') }}
</x-dropdown-link>

<form method="POST" action="{{ route('logout') }}">
@csrf

<x-dropdown-link :href="route('logout')"
onclick="event.preventDefault(); this.closest('form').submit();">
{{ __('Log Out') }}
</x-dropdown-link>

</form>

</x-slot>

</x-dropdown>

</div>

</div>


@if(isset($header))
<header class="bg-white shadow">
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
{{ $header }}
</div>
</header>
@endif


<main class="p-6">
{{ $slot }}
</main>

</div>

</div>


<script>

function toggleSidebar() {

let sidebar = document.getElementById("sidebar");

if (sidebar.style.marginLeft === "-256px") {
sidebar.style.marginLeft = "0";
} else {
sidebar.style.marginLeft = "-256px";
}

}

// 🔔 Notification Toggle

function toggleNotifications() {

let dropdown = document.getElementById("notificationDropdown");

if (dropdown.classList.contains("hidden")) {

dropdown.classList.remove("hidden");

// mark notifications as read

fetch("{{ route('notifications.read') }}", {
method: "POST",
headers: {
"X-CSRF-TOKEN": "{{ csrf_token() }}",
"Content-Type": "application/json"
}
}).then(() => {

let badge = document.querySelector(".bg-red-500");

if(badge){
badge.style.display = "none";
}

});

} else {

dropdown.classList.add("hidden");

}

}

</script>

</body>

</html>