@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-12 p-6 bg-white shadow-2xl rounded-3xl">
  <h2 class="text-3xl font-extrabold mb-10 text-center text-gray-800 tracking-tight">📊 Productivity Insights</h2>

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    <div class="bg-gradient-to-br from-blue-200 to-blue-100 p-6 rounded-2xl shadow-md text-center hover:scale-105 transition-transform duration-300">
      <h3 class="text-lg font-semibold text-blue-800">Completion Rate</h3>
      <p class="text-4xl font-extrabold mt-2 text-blue-900">{{ $completionRate }}%</p>
    </div>

    <div class="bg-gradient-to-br from-green-200 to-green-100 p-6 rounded-2xl shadow-md text-center hover:scale-105 transition-transform duration-300">
      <h3 class="text-lg font-semibold text-green-800">Most Productive Hour</h3>
      <p class="text-4xl font-extrabold mt-2 text-green-900">
        {{ $mostProductiveHour ? $mostProductiveHour . ':00' : 'No Data' }}
      </p>
    </div>

    <div class="bg-gradient-to-br from-rose-200 to-rose-100 p-6 rounded-2xl shadow-md text-center hover:scale-105 transition-transform duration-300">
      <h3 class="text-lg font-semibold text-red-800">Overdue Tasks</h3>
      <p class="text-4xl font-extrabold mt-2 text-red-900">{{ $overdueTasks }}</p>
    </div>


    <div class="bg-gradient-to-br from-yellow-200 to-yellow-100 p-6 rounded-2xl shadow-md text-center hover:scale-105 transition-transform duration-300">
      <h3 class="text-lg font-semibold text-yellow-800">Current Streak</h3>
      <p class="text-4xl font-extrabold mt-2 text-yellow-900">{{ $streak }} day{{ $streak !== 1 ? 's' : '' }}</p>
    </div>
  </div>

  <div class="mt-10 text-center">
    <a href="{{route('insights.downloadPdf')}}"
       class="inline-flex items-center gap-2 bg-indigo-600 text-white px-5 py-3 rounded-full shadow-lg hover:bg-indigo-700 transition duration-300">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
           stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 4v16m8-8H4" />
      </svg>
      Download PDF Report
    </a>
  </div>
</div>
@endsection
