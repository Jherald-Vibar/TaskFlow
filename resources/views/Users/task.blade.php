@extends('Layouts.app')
@section('content')
<div class="sm:px-6 w-full">
    <div class="px-4 md:px-10 py-4">
        <div class="flex flex-col md:flex-row gap-4 items-center justify-between mb-6">
            <div class="relative w-full md:w-1/2">
                <form action="{{ route('searchTask') }}" method="GET" class="w-full">
                    <input type="text" name="query" value="{{ request('query') }}"
                           placeholder="Search tasks..."
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                    <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-indigo-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </form>
            </div>
            <div class="flex items-center gap-3 w-full md:w-auto">
                <button onclick="document.getElementById('filterModal').showModal()"
                        class="px-4 py-2.5 bg-indigo-100 text-indigo-700 rounded-lg hover:bg-indigo-200 transition duration-300 flex items-center gap-2 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                Filter Tasks
            </button>

                <button onclick="toggleModal()"
                        class="px-4 py-2.5 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600 transition duration-300 flex items-center gap-2 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Task
                </button>
            </div>
        </div>
            <dialog id="filterModal" class="rounded-xl p-4 w-full max-w-sm shadow-lg">
                <form method="GET" action="{{ route('user-task') }}" class="space-y-4">
                    <h2 class="text-lg font-semibold mb-2">Filter Tasks</h2>
                    <div>
                        <label for="filter-date" class="block text-sm text-gray-600 mb-1">Date</label>
                        <input type="date" name="filter_date" id="filter-date" value="{{ request('filter_date') }}"
                               class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label for="sort" class="block text-sm text-gray-600 mb-1">Sort By</label>
                        <select name="sort" id="sort"
                                class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest</option>
                        </select>
                    </div>
                    <div>
                        <label for="priority" class="block text-sm text-gray-600 mb-1">Priority</label>
                        <select name="priority" id="priority"
                                class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                            <option value="">All</option>
                            <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>High</option>
                            <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                            <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Low</option>
                        </select>
                    </div>

                <div>
                    <label for="status" class="block text-sm text-gray-600 mb-1">Status</label>
                    <select name="status" id="status"
                            class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                        <option value="">All</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="ongoing" {{ request('status') == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        </select>
                    </div>

                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="document.getElementById('filterModal').close()" class="px-3 py-2 bg-gray-300 rounded-md">Cancel</button>
                        <button type="submit" class="px-3 py-2 bg-indigo-500 text-white rounded-md">Apply</button>
                    </div>
                </form>
            </dialog>
        </div>
    <div class="mt-5 overflow-x-auto rounded-lg" id="task-list">
            <div id="task-cards" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @php
                    $statusGroups = ['Pending', 'Ongoing', 'Completed'];
                @endphp
                @foreach ($statusGroups as $status)
                    <div class="status-column bg-gray-100 p-3 rounded-md" data-status="{{ $status }}">
                        <h2 class="text-center font-bold mb-2 text-{{ $status === 'Completed' ? 'green' : ($status === 'Ongoing' ? 'yellow' : 'gray') }}-700">
                            {{ $status }}
                        </h2>
                        <div class="task-drop-zone min-h-[300px] space-y-3" data-status="{{ $status }}">
                            @foreach ($tasks->where('progress.status', $status) as $task)
                                <div data-id="{{ $task->id }}"
                                    draggable="true"
                                    class="task-card bg-white border border-gray-200 rounded-lg p-4 shadow hover:shadow-md transition cursor-move">
                                    <div class="flex justify-between items-start mb-3">
                                        <h3 class="text-lg font-semibold text-gray-800 line-clamp-1" title="{{ $task->task_name }}">
                                            {{ $task->task_name }}
                                        </h3>
                                        <span class="ml-2 px-2.5 py-1 text-xs font-medium rounded-full
                                            {{ $task->priority === 'Low' ? 'bg-green-100 text-green-700' :
                                            ($task->priority === 'Medium' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                                            {{ $task->priority }}
                                        </span>
                                    </div>

                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        {{ $task->due_date }}
                                    </div>

                                    <div class="mt-2">
                                        <div class="w-full bg-gray-200 rounded-full h-3">
                                            <div class="bg-indigo-500 h-3 rounded-full text-[10px] text-center text-white" style="width: {{ $task->progress->progress_percentage }}%">
                                                {{ $task->progress->progress_percentage }}%
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-2 text-xs font-medium text-gray-600">
                                        {{ $task->progress->status }}
                                    </div>

                                    <div class="mt-3 flex justify-between text-xs text-gray-600 relative">
                                        <button
                                            class="text-indigo-600 hover:text-indigo-800 font-medium text-sm flex items-center"
                                            onclick="openViewModal({{ $task->id }}, '{{ addslashes($task->task_name) }}', '{{ addslashes($task->description) }}', '{{ $task->due_date }}', '{{ $task->due_time }}', '{{ $task->priority }}', '{{ $task->category_id ?? '' }}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            View
                                        </button>

                                        <div class="relative">
                                            <button onclick="toggleDropdowns(this)" class="hover:text-indigo-600 focus:outline-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v.01M12 12v.01M12 18v.01" />
                                                </svg>
                                            </button>

                                            <div class="dropdown-menu absolute right-0 mt-1 w-36 bg-white border border-gray-200 rounded-md shadow-lg hidden z-20">
                                                <button
                                                    onclick="openEditModal({{ $task->id }}, '{{ $task->task_name }}', '{{ $task->description }}', '{{ $task->due_date }}', '{{ $task->due_time }}', '{{ $task->priority }}', '{{ $task->category_id ?? '' }}', '{{ $task->progress->progress_percentage ?? 0 }}')"
                                                    class="block w-full text-left px-4 py-2 text-xs text-gray-700 hover:bg-indigo-50 hover:text-indigo-700">
                                                    ✏️ Edit
                                                </button>

                                                <form id="delete-form-{{ $task->id }}" action="{{ route('deleteTask', ['id' => $task->id]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        type="button"
                                                        onclick="confirmButton(event, {{ $task->id }})"
                                                        class="block w-full text-left px-4 py-2 text-xs text-red-600 hover:bg-red-50 hover:text-red-700">
                                                        🗑️ Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
</div>

<div id="taskModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center transition-opacity duration-300 ease-in-out backdrop-blur-sm">
    <div class="bg-white w-full max-w-2xl mx-4 sm:mx-auto p-6 sm:p-8 rounded-2xl shadow-2xl transform scale-100 transition-transform duration-300 ease-in-out">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Add New Task
            </h2>
            <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 focus:outline-none transition duration-200 transform hover:scale-110">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <form id="taskForm" action="{{ route('task.store') }}" method="POST" x-data="{ loading: false }" @submit="loading = true" class="space-y-5">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-4">
                    <div>
                        <label for="taskName" class="block text-sm font-medium text-gray-700 mb-1">Task Name</label>
                        <input type="text" name="taskName" id="taskName" placeholder="Enter task name"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition bg-white" required>
                    </div>

                    <div>
                        <label for="taskDescription" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea id="taskDescription" name="description" rows="4" placeholder="Describe the task..."
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition bg-white"></textarea>
                    </div>
                </div>

                <div class="space-y-4">
                <div>
                    <label for="prioritySelect" class="block text-sm font-medium text-gray-700 mb-1">Priority</label>
                        <div class="relative">
                            <select id="prioritySelect" name="priority"
                                    class="w-full appearance-none px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition bg-white" required>
                        <option value="" disabled selected>Select Priority</option>
                        <option value="Low">Low</option>
                        <option value="Medium">Medium</option>
                        <option value="High">High</option>
                    </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                </svg>
                            </div>
                        </div>
                </div>

                <div>
                    <label for="dueDate" class="block text-sm font-medium text-gray-700 mb-1">Due Date</label>
                        <input type="date" name="due_date" id="dueDate"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition bg-white" required>
                </div>

                <div>
                    <label for="dueTime" class="block text-sm font-medium text-gray-700 mb-1">Time</label>
                        <input type="time" name="due_time" id="dueTime"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition bg-white" required>
                </div>

                <div>
                    <label for="taskCategory" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                        <div class="relative">
                            <select id="taskCategory" name="category_id"
                                    class="w-full appearance-none px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition bg-white">
                        <option value="" disabled selected>Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                <button type="button" onclick="closeModal()"
                        class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition font-medium">
                    Cancel
                </button>

                <button
                    type="submit"
                    :disabled="loading"
                    class="bg-gradient-to-r from-indigo-500 to-indigo-700 hover:from-indigo-600 hover:to-indigo-800 text-white font-medium px-5 py-2.5 rounded-lg flex items-center gap-2 disabled:opacity-60 disabled:cursor-not-allowed transition shadow-sm"
                >
                    <svg x-show="loading" x-transition class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"/>
                    </svg>
                    <span x-text="loading ? 'Creating...' : 'Create Task'"></span>
                </button>
            </div>
        </form>
    </div>
</div>

<div id="editTaskModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center transition-opacity duration-300 ease-in-out backdrop-blur-sm">
    <div class="bg-white w-full max-w-2xl mx-4 sm:mx-auto p-6 sm:p-8 rounded-2xl shadow-2xl transform scale-100 transition-transform duration-300 ease-in-out">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z" />
                </svg>
                Edit Task
            </h2>
            <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600 focus:outline-none transition duration-200 transform hover:scale-110">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <form id="editTaskForm" action="" method="POST" class="space-y-5">
            @csrf
            @method('PUT')
            <input type="hidden" id="editTaskId" name="taskId">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-4">
                <div>
                    <label for="editTaskName" class="block text-sm font-medium text-gray-700 mb-1">Task Name</label>
                        <input type="text" id="editTaskName" name="taskName"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition bg-white" required>
                </div>

                <div>
                        <label for="editTaskDescription" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea id="editTaskDescription" name="description" rows="4" placeholder="Describe the task..."
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition bg-white"></textarea>
                </div>
            </div>

                <div class="space-y-4">
                <div>
                    <label for="editTaskPriority" class="block text-sm font-medium text-gray-700 mb-1">Priority</label>
                        <div class="relative">
                            <select id="editTaskPriority" name="priority"
                                    class="w-full appearance-none px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition bg-white">
                        <option value="Low">Low</option>
                        <option value="Medium">Medium</option>
                        <option value="High">High</option>
                    </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="editTaskDueDate" class="block text-sm font-medium text-gray-700 mb-1">Due Date</label>
                        <input type="date" id="editTaskDueDate" name="due_date"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition bg-white">
                    </div>

                    <div>
                        <label for="editTaskDueTime" class="block text-sm font-medium text-gray-700 mb-1">Time</label>
                        <input type="time" id="editTaskDueTime" name="due_time"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition bg-white">
                </div>

                <div>
                    <label for="editTaskProgress" class="block text-sm font-medium text-gray-700 mb-1">Progress (%)</label>
                        <div class="relative">
                            <input type="number" id="editTaskProgress" name="progress_percentage" min="0" max="100"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition bg-white">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <span class="text-gray-500">%</span>
                            </div>
                </div>
            </div>

            @if(!empty($categories) && $categories->count() > 0)
                    <div>
                <label for="editTaskCategory" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                        <div class="relative">
                            <select id="editTaskCategory" name="category_id"
                                    class="w-full appearance-none px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition bg-white">
                    <option value="" disabled selected>Select Category</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                <button type="button" onclick="closeEditModal()"
                        class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition font-medium">
                    Cancel
                </button>
                <button type="submit"
                        class="bg-gradient-to-r from-indigo-500 to-indigo-700 hover:from-indigo-600 hover:to-indigo-800 text-white font-medium px-5 py-2.5 rounded-lg transition shadow-sm">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

<div id="viewModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center transition-opacity duration-300 ease-in-out backdrop-blur-sm">
    <div class="bg-white w-full max-w-4xl mx-4 p-6 rounded-2xl shadow-2xl transform scale-100 transition-transform duration-300 ease-in-out">
        <div class="flex justify-between items-center border-b pb-4 mb-6">
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                Task Details
            </h2>
            <button onclick="closeViewModal()" class="text-gray-400 hover:text-gray-600 transition duration-200 transform hover:scale-110">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <div class="mb-8">
            <h3 id="viewTaskName" class="text-2xl font-bold text-gray-800 mb-2"></h3>
            <div class="flex flex-wrap gap-2 mb-4">
                <span class="px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full text-sm font-medium" id="viewTaskStatus"></span>
                <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm font-medium flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3M3 11h18M3 21h18" />
                    </svg>
                    <span id="viewTaskDueDate"></span>
                </span>
                <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm font-medium flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span id="viewTaskDueTime"></span>
                </span>
            </div>

            <div class="bg-gray-50 p-4 rounded-xl mb-6">
                <h4 class="text-sm font-medium text-gray-500 mb-2">Description</h4>
                <p id="viewTaskDescription" class="text-gray-700"></p>
            </div>
        </div>

        <div class="bg-indigo-50 rounded-xl p-6">
            <h4 class="text-lg font-semibold text-indigo-800 mb-4">Task Progress</h4>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                <div class="space-y-2">
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-sm font-medium text-gray-700">Completion Status</span>
                        <span id="viewTaskProgressText" class="text-sm font-semibold text-indigo-700"></span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                        <div id="progressBar" class="bg-indigo-600 h-full transition-all duration-500 ease-out" style="width: 0%"></div>
                    </div>
            </div>

                <div class="relative w-36 h-36 mx-auto">
                    <svg class="w-full h-full" viewBox="0 0 100 100">
                        <circle class="text-gray-200 stroke-current" stroke-width="10" cx="50" cy="50" r="40" fill="none" />
                        <circle id="progressCircleSVG" class="text-indigo-600 stroke-current" stroke-width="10" stroke-linecap="round"
                                cx="50" cy="50" r="40" fill="none" style="stroke-dasharray: 251.2; stroke-dashoffset: 251.2" />
                    </svg>
                <div class="absolute inset-0 flex items-center justify-center">
                        <span id="progressValue" class="text-2xl font-bold text-indigo-700">0%</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-3 pt-6 mt-6 border-t border-gray-100">
            <button onclick="closeViewModal()"
                    class="px-5 py-2.5 bg-indigo-100 text-indigo-700 rounded-lg hover:bg-indigo-200 transition font-medium shadow-sm">
                Close
            </button>
        </div>
    </div>
</div>

<style>
    .checkbox:checked + .check-icon {
        display: flex;
    }

    .dropdown-content {
        display: none;
    }

    .dropdown-content.show {
        display: block;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function dropdownFunction(element) {
        let dropdowns = document.getElementsByClassName("dropdown-content");
        let target = element.closest("td").querySelector(".dropdown-content");

        Array.from(dropdowns).forEach(el => {
            if (el !== target) el.classList.remove("show");
        });

        target.classList.toggle("show");
    }

    function toggleModal() {
        let modal = document.getElementById("taskModal");
        modal.classList.toggle("hidden");
    }

    function closeModal() {
        document.getElementById("taskModal").classList.add("hidden");
    }

    function openEditModal(id, taskName, description, dueDate, dueTime, priority, category_id, progress_percentage) {
        let formattedTime = dueTime ? convertTo12HourFormat(dueTime) : '00:00';
        document.getElementById('editTaskId').value = id;
        document.getElementById('editTaskName').value = taskName;
        document.getElementById('editTaskDescription').value = description || '';
        document.getElementById('editTaskDueDate').value = dueDate;
        document.getElementById('editTaskDueTime').value = formattedTime;
        document.getElementById('editTaskPriority').value = priority;
        document.getElementById('editTaskProgress').value = progress_percentage || 0;
        let categorySelect = document.getElementById('editTaskCategory');

        if (categorySelect) {
            categorySelect.value = category_id ? category_id : categorySelect.options[0].value;
        }

        let form = document.getElementById('editTaskForm');
            form.action = "{{ url('user/task') }}/" + id;

        document.getElementById('editTaskModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editTaskModal').classList.add('hidden');
    }

    function updateProgressValue(value) {
    }

    function confirmButton(event, taskId) {
        event.preventDefault();

        Swal.fire({
            title: "Delete Task",
            text: "Are you sure you want to delete this task?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: 'Yes, Delete it!',
            cancelButtonText: 'No, Cancel',
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            iconColor: "#ef4444"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + taskId).submit();
            }
        });
    }

    function openEditProgressModal() {
        console.log("Progress edit feature has been removed");
    }

    function closeProgressModal() {
    }

    function convertTo12HourFormat(time) {
            const [hours, minutes] = time.split(':');
            let hours12 = parseInt(hours);
            let ampm = hours12 >= 12 ? 'PM' : 'AM';
            hours12 = hours12 % 12;
            hours12 = hours12 ? hours12 : 12;
            return `${hours12}:${minutes} ${ampm}`;
        }

    function openViewModal(id, taskName, description, dueDate, dueTime, priority, category_id) {
        const taskCard = document.querySelector(`.task-card[data-id="${id}"]`);

        let taskStatus = 'Pending';
        let progress = 0;

        if (taskCard) {
            const liveStatusText = taskCard.querySelector('.mt-2.text-xs.font-medium.text-gray-600');
            taskStatus = liveStatusText ? liveStatusText.textContent.trim() : 'Pending';

            const liveProgressBar = taskCard.querySelector('.bg-indigo-500');
            if (liveProgressBar) {
                const progressText = liveProgressBar.textContent.trim().replace('%', '');
                progress = parseInt(progressText) || 0;
            }
        }

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

         document.addEventListener('DOMContentLoaded', function () {
       document.querySelectorAll('.task-drop-zone').forEach(zone => {
        new Sortable(zone, {
            group: 'shared',
            animation: 150,
            ghostClass: 'bg-gray-100',
            onEnd: function (evt) {
                const draggedId = evt.item.dataset.id;
                const newStatus = evt.to.dataset.status;
                const orderedIds = [...evt.to.children].map(el => el.dataset.id);
                console.log("Dragged Card ID:", draggedId);
                console.log("New Status:", newStatus);
                console.log("New Order in Column:", orderedIds);
                const reorderUrl = @json(route('task-reorder'));
                fetch(reorderUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        draggedId: draggedId,
                        newStatus: newStatus,
                        orderedIds: orderedIds
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Updated successfully:', data);
                    if (data.success) {
                        const draggedElem = document.querySelector(`.task-card[data-id="${draggedId}"]`);
                        if (!draggedElem) return;
                        const progressBar = draggedElem.querySelector('.bg-indigo-500');
                        if (progressBar) {
                            progressBar.style.width = data.progress_percentage + '%';
                            progressBar.textContent = data.progress_percentage + '%';
                        }
                        const statusText = draggedElem.querySelector('.mt-2.text-xs.font-medium.text-gray-600');
                        if (statusText) {
                            statusText.textContent = data.status;
                        }
                        const viewTaskStatus = draggedElem.querySelector('#viewTaskStatus');
                        if (viewTaskStatus) {
                            viewTaskStatus.textContent = data.status;
                        }
                    } else {
                        alert('Failed to update task on server');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error communicating with server');
                });
            }
        });
    });
});

    function toggleDropdowns(button) {
        const menu = button.nextElementSibling;
        document.querySelectorAll('.dropdown-menu').forEach(el => {
            if (el !== menu) el.classList.add('hidden');
        });
        menu.classList.toggle('hidden');
    }

    document.addEventListener('click', function (e) {
        const isDropdown = e.target.closest('.dropdown-menu');
        const isToggle = e.target.closest('button[onclick^="toggleDropdown"]');
        if (!isDropdown && !isToggle) {
            document.querySelectorAll('.dropdown-menu').forEach(el => el.classList.add('hidden'));
        }
    });
</script>
@endsection
