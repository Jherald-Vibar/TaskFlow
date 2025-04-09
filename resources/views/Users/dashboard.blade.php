@extends('Layouts.app')

@section('content')

<div class="p-6 bg-gray-50 min-h-screen">
    <!-- Header -->
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-900 flex items-center gap-2">
            📊 Analytics Overview
        </h2>
        <p class="text-sm text-gray-500 mt-1">Monitor your task performance and weekly productivity.</p>
    </div>

    <!-- Task Status Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        @php
            $analytics = [
                ['label' => 'Completed Tasks', 'value' => 84, 'color' => 'green'],
                ['label' => 'In Progress', 'value' => 46, 'color' => 'blue'],
                ['label' => 'Not Started', 'value' => 13, 'color' => 'red'],
            ];
        @endphp

        @foreach($analytics as $item)
        <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition p-5">
            <p class="text-sm text-gray-600 mb-1">{{ $item['label'] }}</p>
            <div class="flex justify-between items-center">
                <h3 class="text-3xl font-bold text-{{ $item['color'] }}-500">{{ $item['value'] }}%</h3>
                <span class="text-xs text-gray-400">of total</span>
            </div>
            <div class="mt-3 h-2 bg-{{ $item['color'] }}-100 rounded-full">
                <div class="h-2 bg-{{ $item['color'] }}-500 rounded-full" style="width: {{ $item['value'] }}%"></div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Weekly Progress Chart -->
    <div class="bg-white rounded-2xl shadow-md p-6">
        <div class="flex justify-between items-center mb-4">
            <h4 class="text-lg font-semibold text-gray-800">📅 Weekly Task Progress</h4>
            <span class="text-sm text-gray-400">Last 7 days</span>
        </div>
        <canvas id="taskChart" class="w-full h-64"></canvas>
    </div>
</div>

<script>

</script>

@endsection()



