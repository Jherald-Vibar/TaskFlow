@extends('Layouts.app')
@section('content')

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
            </div>
        </div>

        <!-- Pending Tasks -->
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
            </div>
        </div>

        <!-- Completed Tasks -->
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
@endsection
