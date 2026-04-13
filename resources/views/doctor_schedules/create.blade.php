<x-app-layout>

<div class="p-6">

<div class="max-w-6xl mx-auto bg-white rounded-xl shadow-lg p-8">

<h2 class="text-2xl font-bold text-gray-700 mb-6">
Add Doctor Schedule
</h2>

<div class="flex justify-end mb-4">

<a href="{{ route('doctor-schedules.index') }}"
class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg shadow">

Back

</a>

</div>


<form action="{{ route('doctor-schedules.store') }}" method="POST">
@csrf

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

<div>
<label class="text-sm font-semibold text-gray-600">Doctor</label>

<select name="doctor_id"
class="mt-1 w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">

<option value="">Select Doctor</option>

@foreach($doctors as $doctor)

<option value="{{ $doctor->id }}">
{{ $doctor->name }}
</option>

@endforeach

</select>
</div>

<div>
<label class="text-sm font-semibold text-gray-600">Slot Duration</label>

<select name="slot_minutes"
class="mt-1 w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">

<option value="15">15 Minutes</option>
<option value="30">30 Minutes</option>
<option value="60">60 Minutes</option>

</select>
</div>

<div>
<label class="text-sm font-semibold text-gray-600">Start Time</label>

<input type="time" name="start_time"
class="mt-1 w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">

</div>

<div>
<label class="text-sm font-semibold text-gray-600">End Time</label>

<input type="time" name="end_time"
class="mt-1 w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">

</div>

</div>

<div class="mt-8">

<h3 class="text-lg font-semibold text-gray-700 mb-3">
Available Days
</h3>

<div class="flex flex-wrap gap-4">

<label class="flex items-center gap-2 bg-gray-100 px-3 py-2 rounded">
<input type="checkbox" name="week_days[]" value="Mon">
Mon
</label>

<label class="flex items-center gap-2 bg-gray-100 px-3 py-2 rounded">
<input type="checkbox" name="week_days[]" value="Tue">
Tue
</label>

<label class="flex items-center gap-2 bg-gray-100 px-3 py-2 rounded">
<input type="checkbox" name="week_days[]" value="Wed">
Wed
</label>

<label class="flex items-center gap-2 bg-gray-100 px-3 py-2 rounded">
<input type="checkbox" name="week_days[]" value="Thu">
Thu
</label>

<label class="flex items-center gap-2 bg-gray-100 px-3 py-2 rounded">
<input type="checkbox" name="week_days[]" value="Fri">
Fri
</label>

<label class="flex items-center gap-2 bg-gray-100 px-3 py-2 rounded">
<input type="checkbox" name="week_days[]" value="Sat">
Sat
</label>

<label class="flex items-center gap-2 bg-gray-100 px-3 py-2 rounded">
<input type="checkbox" name="week_days[]" value="Sun">
Sun
</label>

</div>

</div>

<div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">

<div>
<label class="text-sm font-semibold text-gray-600">Break Start</label>

<input type="time" name="break_start"
class="mt-1 w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">

</div>

<div>
<label class="text-sm font-semibold text-gray-600">Break End</label>

<input type="time" name="break_end"
class="mt-1 w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">

</div>

</div>

<div class="mt-10 flex justify-end">

<button
class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow">

Save Schedule

</button>

</div>

</form>

</div>

</div>

</x-app-layout>
