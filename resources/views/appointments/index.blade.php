<table class="table-auto w-full border">
<thead>
<tr>
<th class="border p-2">Time</th>

@foreach($doctors as $doctor)
<th class="border p-2">{{ $doctor->name }}</th>
@endforeach

</tr>
</thead>

<tbody>

@foreach($times as $time)

<tr>

<td class="border p-2">{{ $time }}</td>

@foreach($doctors as $doctor)

<td class="border p-2">

@php
$appointment = $appointments
->where('doctor_id',$doctor->id)
->where('appointment_time',$time)
->first();
@endphp

@if($appointment)
<div class="bg-green-200 p-2 rounded">
{{ $appointment->patient->name }}
</div>
@endif

</td>

@endforeach

</tr>

@endforeach

</tbody>
</table>