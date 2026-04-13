<x-app-layout>
<x-slot name="header">
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
{{ __('Specialities Management') }}
</h2>
</x-slot>

<div class="py-12">
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

@if(session('success'))
<div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
{{ session('success') }}
</div>
@endif

<div class="bg-white shadow-xl sm:rounded-lg">

<div class="bg-blue-700 px-6 py-4 flex justify-between items-center">
<h3 class="text-white font-semibold text-lg">Specialities List</h3>

<a href="{{ route('specialities.create') }}"
class="px-4 py-2 bg-white text-blue-700 rounded font-semibold text-xs">
Add New Speciality
</a>
</div>

<div class="overflow-x-auto">

<table class="min-w-full divide-y divide-gray-200">

<thead class="bg-gray-800">

<tr>

<th class="px-6 py-3 text-left text-xs text-white uppercase">

<a href="{{ route('specialities.index', [
'sort'=>'id',
'direction'=> request('direction')=='asc'?'desc':'asc'
]) }}" class="flex items-center space-x-1">

<span>ID</span>

</a>

</th>

<th class="px-6 py-3 text-left text-xs text-white uppercase">

<a href="{{ route('specialities.index', [
'sort'=>'name',
'direction'=> request('direction')=='asc'?'desc':'asc'
]) }}" class="flex items-center space-x-1">

<span>Speciality Name</span>

</a>

</th>

<th class="px-6 py-3 text-right text-xs text-white uppercase">
Actions
</th>

</tr>

</thead>

<tbody class="bg-white divide-y divide-gray-200">

@forelse($specialities as $speciality)

<tr class="hover:bg-gray-50">

<td class="px-6 py-4 text-sm text-gray-500">
#{{ str_pad($speciality->id,3,'0',STR_PAD_LEFT) }}
</td>

<td class="px-6 py-4">

<div class="flex items-center">

<div class="h-10 w-10 bg-blue-100 rounded-lg flex items-center justify-center">

<span class="text-blue-600 font-semibold">
{{ strtoupper(substr($speciality->name,0,2)) }}
</span>

</div>

<div class="ml-4">

<div class="text-sm font-medium text-gray-900">
{{ $speciality->name }}
</div>

<div class="text-xs text-gray-500">
Added {{ $speciality->created_at? $speciality->created_at->diffForHumans():'N/A' }}
</div>

</div>

</div>

</td>

<td class="px-6 py-4 text-right">

<a href="{{ route('specialities.edit',$speciality->id) }}"
class="px-3 py-1 bg-yellow-500 text-white rounded text-xs">

Edit
</a>

<form action="{{ route('specialities.destroy',$speciality->id) }}"
method="POST"
class="inline"
onsubmit="return confirm('Delete this speciality?')">

@csrf
@method('DELETE')

<button class="px-3 py-1 bg-red-500 text-white rounded text-xs">
Delete
</button>

</form>

</td>

</tr>

@empty

<tr>

<td colspan="3" class="text-center py-10">

No specialities found

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

<div class="p-4">

{{ $specialities->appends(request()->query())->links() }}

</div>

</div>

</div>
</div>

</x-app-layout>