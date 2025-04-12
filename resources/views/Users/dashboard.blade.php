@extends('Layouts.app')

@section('content')

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
                <div class="mt-6">
                    {{ $taskss->links() }}
                </div>
            </div>
        </div>
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

            <div class="bg-white rounded-2xl shadow p-6">
                <h4 class="text-md font-semibold mb-4">📊 Task Status</h4>
                <div class="grid grid-cols-3 gap-4 text-center">
                    @foreach ($analytics as $item)
                        <div class="flex flex-col items-center justify-center">
                            <canvas id="donut_{{ $loop->index }}" width="80" height="80"></canvas>
                            <div class="flex items-center justify-center gap-2 mt-2">
                                <span class="w-1 h-1 rounded-full bg-{{ $item['color'] }}-500"></span>
                                <p class="font-medium text-gray-700" style="font-size: 0.70rem">{{ $item['label'] }}</p>
                            </div>
                            <p class="text-gray-500" style="font-size: 0.5rem">{{ $item['value'] }}%</p>
                            <p class="font-medium text-gray-900 mt-2" style="font-size: 0.5rem">{{ $item['count'] }} Tasks</p>
                        </div>
                    @endforeach
                </div>
            </div>

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
                        </div>
                    </div>
                @endforeach
            </div>

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
                backgroundColor: '#22c55e',
                borderRadius: 10,
                barThickness: 30,
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
                }
            }
        }
    });


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
                        item.color === 'green' ? '#22c55e' :
                        item.color === 'blue' ? '#3b82f6' :
                        '#ef4444',
                        '#e5e7eb'
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
