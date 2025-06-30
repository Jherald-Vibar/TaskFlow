@extends('Layouts.app')
@section('content')

<<<<<<< HEAD
<div class="w-full mx-auto mt-10 px-4">
    <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3M16 7V3M4 11H20M5 19H19C20.1046 19 21 18.1046 21 17V7C21 5.89543 20.1046 5 19 5H5C3.89543 5 3 5.89543 3 7V17C3 18.1046 3.89543 19 5 19Z" />
        </svg>
        Tasks for Today
    </h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        <!-- Missing Tasks -->
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-6">
            <h3 class="text-md font-bold text-gray-800 dark:text-white mb-4 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6" />
                </svg>
                Missing Tasks
            </h3>
            <div class="space-y-4">
                @foreach ($missingTasks ?? [] as $task)
                    <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg shadow-sm hover:shadow-md transition">
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-white">{{ $task->task_name }}</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Due: {{ \Carbon\Carbon::parse($task->due_time)->format('h:i A') }}</p>
                        <p class="text-sm text-red-500 dark:text-red-400 font-semibold">Status: Missing</p>
                    </div>
                @endforeach
=======
<div class="w-full mx-auto mt-6 px-4">
    <!-- Enhanced header with gradient background -->
    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl px-6 py-8 mb-8 shadow-lg">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
            <div class="flex items-center gap-3 mb-4 md:mb-0">
                <div class="bg-white/20 p-3 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3M16 7V3M4 11H20M5 19H19C20.1046 19 21 18.1046 21 17V7C21 5.89543 20.1046 5 19 5H5C3.89543 5 3 5.89543 3 7V17C3 18.1046 3.89543 19 5 19Z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold text-white">Focus Today</h2>
                    <p class="text-indigo-100 text-sm md:text-base">{{ \Carbon\Carbon::now()->format('l, F d, Y') }}</p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <div class="bg-white/10 px-4 py-2 rounded-xl flex items-center gap-2">
                    <span class="text-white text-sm font-medium">Total Tasks: {{ $tasks->count() }}</span>
                </div>
                <div class="bg-white/10 px-4 py-2 rounded-xl flex items-center gap-2">
                    <span class="text-white text-sm font-medium">Completed: {{ ($groupedTasks['Completed'] ?? collect())->count() }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Task categories with improved cards and visualization -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
        <!-- Missing Tasks -->
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl overflow-hidden border border-red-100">
            <div class="bg-gradient-to-r from-red-500 to-red-600 px-6 py-4">
                <h3 class="text-lg font-bold text-white flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    Missing Tasks
                </h3>
                <p class="text-red-100 text-sm">Tasks that need immediate attention</p>
            </div>

            <div class="p-5 max-h-[350px] overflow-y-auto">
                @if(($missingTasks ?? collect())->count() > 0)
                    <div class="space-y-4">
                        @foreach ($missingTasks ?? [] as $task)
                            <div class="p-4 bg-red-50 dark:bg-red-900/20 rounded-lg border border-red-100 dark:border-red-800 hover:shadow-md transition group">
                                <div class="flex justify-between items-start mb-2">
                                    <h4 class="text-lg font-semibold text-gray-800 dark:text-white">{{ $task->task_name }}</h4>
                                    <span class="px-2 py-1 bg-red-100 text-red-600 text-xs font-medium rounded-full">Overdue</span>
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Due: {{ \Carbon\Carbon::parse($task->due_time)->format('h:i A') }}</p>
                                <div class="flex justify-between items-center pt-2 border-t border-red-100 dark:border-red-800/30 mt-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <a href="#" class="text-red-600 hover:text-red-800 text-sm font-medium flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                        </svg>
                                        View Details
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center py-8 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-red-200 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-gray-400 dark:text-gray-500">No missing tasks</p>
                        <p class="text-sm text-gray-400 dark:text-gray-500">You're all caught up!</p>
                    </div>
                @endif
>>>>>>> b0762e7 (Updated)
            </div>
        </div>

        <!-- Pending Tasks -->
<<<<<<< HEAD
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-6">
            <h3 class="text-md font-bold text-gray-800 dark:text-white mb-4 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v8l4 4" />
                </svg>
                Pending Tasks
            </h3>
            <div class="space-y-4">
                @foreach ($groupedTasks['Pending'] ?? [] as $task)
                    <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg shadow-sm hover:shadow-md transition">
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-white">{{ $task->task_name }}</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Due: {{ \Carbon\Carbon::parse($task->due_time)->format('h:i A') }}</p>
                        <p class="text-sm text-yellow-500 dark:text-yellow-400 font-semibold">Status: {{ $task->progress->status }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Ongoing Tasks -->
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-6">
            <h3 class="text-md font-bold text-gray-800 dark:text-white mb-4 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                Ongoing Tasks
            </h3>
            <div class="space-y-4">
                @foreach ($groupedTasks['Ongoing'] ?? [] as $task)
                    <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg shadow-sm hover:shadow-md transition">
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-white">{{ $task->task_name }}</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Due: {{ \Carbon\Carbon::parse($task->due_time)->format('h:i A') }}</p>
                        <p class="text-sm text-blue-500 dark:text-blue-400 font-semibold">Status: {{ $task->progress->status }}</p>
                    </div>
                @endforeach
=======
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl overflow-hidden border border-yellow-100">
            <div class="bg-gradient-to-r from-yellow-500 to-amber-500 px-6 py-4">
                <h3 class="text-lg font-bold text-white flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Pending Tasks
                </h3>
                <p class="text-yellow-100 text-sm">Tasks that need to be started</p>
            </div>

            <div class="p-5 max-h-[350px] overflow-y-auto">
                @if(($groupedTasks['Pending'] ?? collect())->count() > 0)
                    <div class="space-y-4">
                        @foreach ($groupedTasks['Pending'] ?? [] as $task)
                            <div class="p-4 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg border border-yellow-100 dark:border-yellow-800 hover:shadow-md transition group">
                                <div class="flex justify-between items-start mb-2">
                                    <h4 class="text-lg font-semibold text-gray-800 dark:text-white">{{ $task->task_name }}</h4>
                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-600 text-xs font-medium rounded-full">Pending</span>
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Due: {{ \Carbon\Carbon::parse($task->due_time)->format('h:i A') }}</p>
                                <div class="flex justify-between items-center pt-2 border-t border-yellow-100 dark:border-yellow-800/30 mt-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <a href="#" class="text-yellow-600 hover:text-yellow-800 text-sm font-medium flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                        </svg>
                                        View Details
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center py-8 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-yellow-200 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-gray-400 dark:text-gray-500">No pending tasks</p>
                        <p class="text-sm text-gray-400 dark:text-gray-500">Great job staying on top of things!</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl overflow-hidden border border-blue-100">
            <div class="bg-gradient-to-r from-blue-500 to-indigo-500 px-6 py-4">
                <h3 class="text-lg font-bold text-white flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    Ongoing Tasks
                </h3>
                <p class="text-blue-100 text-sm">Tasks you're currently working on</p>
            </div>

            <div class="p-5 max-h-[350px] overflow-y-auto">
                @if(($groupedTasks['Ongoing'] ?? collect())->count() > 0)
                    <div class="space-y-4">
                        @foreach ($groupedTasks['Ongoing'] ?? [] as $task)
                            <div class="p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-100 dark:border-blue-800 hover:shadow-md transition group">
                                <div class="flex justify-between items-start mb-2">
                                    <h4 class="text-lg font-semibold text-gray-800 dark:text-white">{{ $task->task_name }}</h4>
                                    <span class="px-2 py-1 bg-blue-100 text-blue-600 text-xs font-medium rounded-full">In Progress</span>
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Due: {{ \Carbon\Carbon::parse($task->due_time)->format('h:i A') }}</p>

                                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700 mb-2">
                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $task->progress->progress_percentage }}%"></div>
                                </div>
                                <p class="text-xs text-gray-500 mb-2">{{ $task->progress->progress_percentage }}% complete</p>

                                <div class="flex justify-between items-center pt-2 border-t border-blue-100 dark:border-blue-800/30 mt-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <a href="{{route('user-task')}}" class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                        </svg>
                                        View Details
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center py-8 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-200 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-gray-400 dark:text-gray-500">No ongoing tasks</p>
                        <p class="text-sm text-gray-400 dark:text-gray-500">Start working on a task!</p>
                    </div>
                @endif
>>>>>>> b0762e7 (Updated)
            </div>
        </div>

        <!-- Completed Tasks -->
<<<<<<< HEAD
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-6">
            <h3 class="text-md font-bold text-gray-800 dark:text-white mb-4 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Completed Tasks
            </h3>
            <div class="space-y-4">
                @foreach ($groupedTasks['Completed'] ?? [] as $task)
                    <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg shadow-sm hover:shadow-md transition">
                        <h4 class="text-lg font-semibold line-through text-gray-400 dark:text-gray-400">{{ $task->task_name }}</h4>
                        <p class="text-sm text-gray-400 dark:text-gray-400">Completed: {{ \Carbon\Carbon::parse($task->updated_at)->format('h:i A') }}</p>
                        <p class="text-sm text-green-500 dark:text-green-400 font-semibold">Status: {{ $task->progress->status }}</p>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</div>
=======
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl overflow-hidden border border-green-100">
            <div class="bg-gradient-to-r from-green-500 to-emerald-500 px-6 py-4">
                <h3 class="text-lg font-bold text-white flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Completed Tasks
                </h3>
                <p class="text-green-100 text-sm">Tasks you've successfully finished</p>
            </div>

            <div class="p-5 max-h-[350px] overflow-y-auto">
                @if(($groupedTasks['Completed'] ?? collect())->count() > 0)
                    <div class="space-y-4">
                        @foreach ($groupedTasks['Completed'] ?? [] as $task)
                            <div class="p-4 bg-green-50 dark:bg-green-900/20 rounded-lg border border-green-100 dark:border-green-800 hover:shadow-md transition group">
                                <div class="flex justify-between items-start mb-2">
                                    <h4 class="text-lg font-semibold line-through text-gray-500 dark:text-gray-400">{{ $task->task_name }}</h4>
                                    <span class="px-2 py-1 bg-green-100 text-green-600 text-xs font-medium rounded-full">Completed</span>
                                </div>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">Completed: {{ \Carbon\Carbon::parse($task->updated_at)->format('h:i A') }}</p>
                                <div class="flex justify-between items-center pt-2 border-t border-green-100 dark:border-green-800/30 mt-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <a href="#" class="text-green-600 hover:text-green-800 text-sm font-medium flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                        </svg>
                                        View Details
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center py-8 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-200 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        <p class="text-gray-400 dark:text-gray-500">No completed tasks yet</p>
                        <p class="text-sm text-gray-400 dark:text-gray-500">Start checking off some tasks!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Motivational quote section -->
    <div class="mt-8 bg-gradient-to-r from-purple-500 to-indigo-600 rounded-xl p-6 text-center shadow-lg">
        <blockquote class="text-white text-xl font-medium italic">{{$quoteText}}</blockquote>
        <p class="text-purple-200 mt-2">— {{$author}}</p>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const completedCount = {{ ($groupedTasks['Completed'] ?? collect())->count() }};
        if (completedCount > 0) {
        }
    });

    function openViewModal(id, taskName, description, dueDate, dueTime, priority, category_id, progress, taskStatus) {
        const dueTime12Hour = convertTo12HourFormat(dueTime);
        document.getElementById('viewTaskName').textContent = taskName;
        document.getElementById('viewTaskDescription').textContent = description || 'No description provided';
        document.getElementById('viewTaskDueDate').textContent = dueDate;
        document.getElementById('viewTaskDueTime').textContent = dueTime12Hour;

        const statusElem = document.getElementById('viewTaskStatus');
        statusElem.textContent = taskStatus;

        if (taskStatus === 'Completed') {
            statusElem.className = 'px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-medium';
        } else if (taskStatus === 'Ongoing') {
            statusElem.className = 'px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-sm font-medium';
        } else {
            statusElem.className = 'px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm font-medium';
        }

        document.getElementById('viewTaskProgressText').textContent = `${progress}%`;

        const clampedProgress = Math.min(Math.max(progress, 0), 100);
        document.getElementById('progressBar').style.width = `${clampedProgress}%`;
        document.getElementById('progressValue').textContent = `${clampedProgress}%`;

        const circle = document.getElementById('progressCircleSVG');
        const radius = 40;
        const circumference = radius * 2 * Math.PI;
        const offset = circumference - (clampedProgress / 100) * circumference;
        circle.style.strokeDasharray = `${circumference} ${circumference}`;
        circle.style.strokeDashoffset = offset;

        document.getElementById('viewModal').classList.remove('hidden');
    }

        function closeViewModal() {
            document.getElementById('viewModal').classList.add('hidden');
        }

</script>

>>>>>>> b0762e7 (Updated)
@endsection
