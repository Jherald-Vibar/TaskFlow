@extends('Layouts.app')

@section('content')

<<<<<<< HEAD
<div class="p-6 bg-gray-50 min-h-screen">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl shadow p-6">
                <h4 class="text-md font-semibold mb-4">📅 Weekly Completed Task Progress</h4>
                <canvas id="taskChart" class="w-full h-52"></canvas>
            </div>
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold text-gray-800">📅 To-Do</h2>
                    <a href="#" class="text-sm text-indigo-600 hover:underline">+ Add Task</a>
                </div>

                @foreach($taskss as $task)
                    <div class="bg-white rounded-2xl shadow p-4 flex flex-col md:flex-row justify-between items-start gap-4">
                        <div class="flex-1">
                            <h3 class="font-semibold text-lg text-gray-900">{{ $task->task_name }}</h3>
                            <p class="text-sm text-gray-600 mt-1">{{ $task->description }}</p>
                            <div class="text-xs text-gray-500 mt-2">
                                Priority: <span class="font-medium">{{ $task->priority }}</span> •
                                Status: <span class="font-medium">{{ $task->progress->status ?? 'N/A' }}</span> •
                                Created: {{ \Carbon\Carbon::parse($task->created_at)->format('d M Y') }}
                            </div>
                        </div>
                        @if($task->image)
                            <img src="{{ $task->image }}" alt="task image" class="w-20 h-20 object-cover rounded-xl">
                        @endif
                    </div>
                @endforeach
=======
<div class="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen p-6">
    <!-- Dashboard Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
        <p class="text-gray-600">Welcome back! Here's an overview of your tasks.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content - Left/Center -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Weekly Progress Chart -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="text-lg font-semibold text-gray-800">Weekly Task Progress</h4>
                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">This Week</span>
                    </div>
                    <canvas id="taskChart" class="w-full h-60"></canvas>
                </div>
            </div>

            <!-- To-Do Tasks Section -->
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold text-gray-800">My Tasks</h2>
                </div>

                @foreach($taskss as $task)
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow border border-gray-100 p-5">
                        <div class="flex flex-col md:flex-row justify-between items-start gap-4">
                            <div class="flex-1">
                                <div class="flex items-center gap-2">
                                    <h3 class="font-semibold text-lg text-gray-900">{{ $task->task_name }}</h3>
                                    <span class="px-2 py-1 text-xs font-medium rounded-full
                                        {{ $task->priority == 'High' ? 'bg-red-100 text-red-800' :
                                        ($task->priority == 'Medium' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') }}">
                                        {{ $task->priority }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-600 mt-2">{{ $task->description }}</p>
                                <div class="flex flex-wrap items-center gap-3 mt-3 text-xs text-gray-500">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                        </svg>
                                        Status:
                                        <span class="font-medium ml-1
                                            {{ ($task->progress->status ?? 'Pending') == 'Completed' ? 'text-green-600' :
                                            (($task->progress->status ?? 'Pending') == 'Ongoing' ? 'text-blue-600' : 'text-yellow-600') }}">
                                            {{ $task->progress->status ?? 'Pending' }}
                                        </span>
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        Created: {{ \Carbon\Carbon::parse($task->created_at)->format('d M Y') }}
                                    </div>
                                </div>
                            </div>
                            @if($task->image)
                                <img src="{{ $task->image }}" alt="task image" class="w-20 h-20 object-cover rounded-lg border border-gray-200">
                            @endif
                        </div>
                    </div>
                @endforeach

>>>>>>> b0762e7 (Updated)
                <div class="mt-6">
                    {{ $taskss->links() }}
                </div>
            </div>
        </div>
<<<<<<< HEAD
=======

        <!-- Right Sidebar -->
>>>>>>> b0762e7 (Updated)
        <div class="space-y-6">
            @php
                $total = $groupedTasks['Total'] ?: 1;
                $analytics = [
                    [
                        'label' => 'Completed',
                        'value' => round(($groupedTasks['Completed'] / $total) * 100),
                        'count' => $groupedTasks['Completed'],
                        'color' => 'green'
                    ],
                    [
                        'label' => 'Ongoing',
                        'value' => round(($groupedTasks['Ongoing'] / $total) * 100),
                        'count' => $groupedTasks['Ongoing'],
                        'color' => 'blue'
                    ],
                    [
                        'label' => 'Pending',
                        'value' => round(($groupedTasks['Pending'] / $total) * 100),
                        'count' => $groupedTasks['Pending'],
                        'color' => 'red'
                    ]
                ];
            @endphp

<<<<<<< HEAD
            <div class="bg-white rounded-2xl shadow p-6">
                <h4 class="text-md font-semibold mb-4">📊 Task Status</h4>
=======
            <!-- Task Status Overview -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h4 class="text-lg font-semibold text-gray-800 mb-4">Task Status Overview</h4>
>>>>>>> b0762e7 (Updated)
                <div class="grid grid-cols-3 gap-4 text-center">
                    @foreach ($analytics as $item)
                        <div class="flex flex-col items-center justify-center">
                            <canvas id="donut_{{ $loop->index }}" width="80" height="80"></canvas>
                            <div class="flex items-center justify-center gap-2 mt-2">
<<<<<<< HEAD
                                <span class="w-1 h-1 rounded-full bg-{{ $item['color'] }}-500"></span>
                                <p class="font-medium text-gray-700" style="font-size: 0.70rem">{{ $item['label'] }}</p>
                            </div>
                            <p class="text-gray-500" style="font-size: 0.5rem">{{ $item['value'] }}%</p>
                            <p class="font-medium text-gray-900 mt-2" style="font-size: 0.5rem">{{ $item['count'] }} Tasks</p>
=======
                                <span class="w-2 h-2 rounded-full bg-{{ $item['color'] }}-500"></span>
                                <p class="font-medium text-gray-700 text-sm">{{ $item['label'] }}</p>
                            </div>
                            <p class="text-gray-500 text-xs">{{ $item['value'] }}%</p>
                            <p class="font-medium text-gray-900 mt-1 text-sm">{{ $item['count'] }} Tasks</p>
>>>>>>> b0762e7 (Updated)
                        </div>
                    @endforeach
                </div>
            </div>

<<<<<<< HEAD
            <div class="bg-white rounded-2xl shadow p-6">
                <h4 class="text-md font-semibold mb-4">✅ Completed Task</h4>
                @foreach($tasks->filter(fn($t) => $t->progress && $t->progress->status === 'Completed')->take(2) as $task)
                    <div class="flex items-start gap-4 mb-4">
                        @if($task->image)
                            <img src="{{ $task->image }}" class="w-16 h-16 object-cover rounded-lg">
                        @endif
                        <div>
                            <p class="font-semibold text-gray-800">{{ $task->task_name }}</p>
                            <p class="text-xs text-gray-500">Completed {{ $task->progress->updated_at->diffForHumans() }}</p>
=======
            <!-- Completed Tasks -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h4 class="text-lg font-semibold text-gray-800 mb-4">Recently Completed</h4>
                @foreach($tasks->filter(fn($t) => $t->progress && $t->progress->status === 'Completed')->sortByDesc(fn($t) => $t->progress->updated_at)->take(2) as $task)
                    <div class="flex items-start gap-4 mb-4 pb-4 {{ !$loop->last ? 'border-b border-gray-100' : '' }}">
                        @if($task->image)
                            <img src="{{ $task->image }}" class="w-16 h-16 object-cover rounded-lg border border-gray-200">
                        @else
                            <div class="w-16 h-16 bg-green-100 rounded-lg flex items-center justify-center">
                                <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        @endif
                        <div>
                            <p class="font-semibold text-gray-800">{{ $task->task_name }}</p>
                            <p class="text-xs text-gray-500 mt-1">Completed {{ $task->progress->updated_at->diffForHumans() }}</p>
>>>>>>> b0762e7 (Updated)
                        </div>
                    </div>
                @endforeach
            </div>

<<<<<<< HEAD
            <div class="max-w-sm w-full bg-white rounded-lg shadow-sm dark:bg-gray-800 p-4 md:p-6">
                <div class="flex justify-between">
                  <div>
                    <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">{{$taskFiltered}}</h5>
                    <p class="text-base font-normal text-gray-500 dark:text-gray-400">Tasks this  {{ $filterLabel}}</p>
                  </div>
                  <div class="flex items-center px-2.5 py-0.5 text-base font-semibold
                  {{ $changePercent > 0 ? 'text-green-500' : 'text-red-500' }}
                  text-center">
                  {{ $changePercent }}%
                  <svg class="w-3 h-3 ms-1 {{ $changePercent > 0 ? 'text-green-500' : 'text-red-500' }}"
                       aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="{{ $changePercent > 0 ? 'M5 1v12M1 5l4-4l4 4' : 'M5 13V1M1 9l4 4l4-4' }}"/>
                  </svg>
              </div>
                </div>
                <div id="area-chart"></div>
                <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
                  <div class="flex justify-between items-center pt-5">
                    <div class="relative z-10 w-44">
                        <form action="{{ route('dashboard') }}" method="GET">
                            <label for="range" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">
                                Select Range
                            </label>
                            <select name="range" id="range" onchange="this.form.submit()"
                                class="block w-full px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600">
                                <option value="today" {{ request('range') === 'today' ? 'selected' : '' }}>Today</option>
                                <option value="yesterday" {{ request('range') === 'yesterday' ? 'selected' : '' }}>Yesterday</option>
                                <option value="7days" {{ request('range') === '7days' ? 'selected' : '' }}>Last 7 Days</option>
                                <option value="30days" {{ request('range') === '30days' ? 'selected' : '' }}>Last 30 Days</option>
                                <option value="60days" {{ request('range') === '60days' ? 'selected' : '' }}>Last 60 Days</option>
                                <option value="90days" {{ request('range') === '90days' ? 'selected' : '' }}>Last 90 Days</option>
                            </select>
                        </form>
                    </div>
                  </div>
                </div>
              </div>

        </div>
    </div>
</div>
=======
            <!-- Task Analytics Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <h5 class="text-2xl font-bold text-gray-900">{{$taskFiltered}}</h5>
                        <p class="text-sm text-gray-600">Tasks this {{ $filterLabel}}</p>
                    </div>
                    <div class="flex items-center px-3 py-1 rounded-full {{ $changePercent > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $changePercent }}%
                        <svg class="w-3 h-3 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="{{ $changePercent > 0 ? 'M5 1v12M1 5l4-4l4 4' : 'M5 13V1M1 9l4 4l4-4' }}"/>
                        </svg>
                    </div>
                </div>
                <div id="area-chart" class="py-3"></div>
                <div class="pt-4 border-t border-gray-100">
                    <form action="{{ route('dashboard') }}" method="GET">
                        <label for="range" class="block mb-2 text-sm font-medium text-gray-700">
                            Select Time Range
                        </label>
                        <select name="range" id="range" onchange="this.form.submit()"
                            class="w-full px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            <option value="today" {{ request('range') === 'today' ? 'selected' : '' }}>Today</option>
                            <option value="yesterday" {{ request('range') === 'yesterday' ? 'selected' : '' }}>Yesterday</option>
                            <option value="7days" {{ request('range') === '7days' ? 'selected' : '' }}>Last 7 Days</option>
                            <option value="30days" {{ request('range') === '30days' ? 'selected' : '' }}>Last 30 Days</option>
                            <option value="60days" {{ request('range') === '60days' ? 'selected' : '' }}>Last 60 Days</option>
                            <option value="90days" {{ request('range') === '90days' ? 'selected' : '' }}>Last 90 Days</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

>>>>>>> b0762e7 (Updated)
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const taskData = {!! json_encode($tasksProgress) !!};
    console.log(taskData);

    const ctx = document.getElementById('taskChart').getContext('2d');
    const taskChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thurs', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                label: 'Tasks Completed',
                data: [
                    taskData.Mon ?? 0,
                    taskData.Tue ?? 0,
                    taskData.Wed ?? 0,
                    taskData.Thurs ?? 0,
                    taskData.Fri ?? 0,
                    taskData.Sat ?? 0,
                    taskData.Sun ?? 0
                ],
<<<<<<< HEAD
                backgroundColor: '#22c55e',
                borderRadius: 10,
                barThickness: 30,
=======
                backgroundColor: '#6366f1',
                borderRadius: 8,
                barThickness: 24,
>>>>>>> b0762e7 (Updated)
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
<<<<<<< HEAD
=======
                },
                x: {
                    grid: {
                        display: false
                    }
>>>>>>> b0762e7 (Updated)
                }
            }
        }
    });

<<<<<<< HEAD

=======
>>>>>>> b0762e7 (Updated)
    const analytics = {!! json_encode($analytics) !!};

    analytics.forEach((item, index) => {
        const ctx = document.getElementById(`donut_${index}`).getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: [item.label, 'Remaining'],
                datasets: [{
                    data: [item.value, 100 - item.value],
                    backgroundColor: [
<<<<<<< HEAD
                        item.color === 'green' ? '#22c55e' :
                        item.color === 'blue' ? '#3b82f6' :
                        '#ef4444',
                        '#e5e7eb'
=======
                        item.color === 'green' ? '#10b981' :
                        item.color === 'blue' ? '#3b82f6' :
                        '#ef4444',
                        '#f3f4f6'
>>>>>>> b0762e7 (Updated)
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                cutout: '70%',
                plugins: {
                    legend: { display: false },
                    tooltip: { enabled: false }
                }
            }
        });
    });
</script>
@endsection
