@extends('layouts.app')
@section('content')


<div class="w-full mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-7 gap-2 text-sm text-gray-600 border-b pb-3 mb-6">
        @foreach($weekDates as $day => $date)
            @php
                $isActive = request('date') == $date->toDateString();
            @endphp
            <a href="{{ route('upcomingTask', ['date' => $date->format('Y-m-d')]) }}"
               class="text-center hover:bg-gray-100 rounded-lg py-2 transition block">

                <div class="font-medium {{ $isActive ? 'text-red-500' : 'text-gray-600' }}">
                    {{ $day }}
                </div>

                <div class="mt-1 text-base {{ $isActive ? 'text-red-500 font-bold' : 'text-gray-700' }}">
                    {{ $date->format('j') }}
                </div>
            </a>
        @endforeach
    </div>
    <div class="mt-5 overflow-x-auto rounded-lg" id="task-list">
        <table class="w-full whitespace-nowrap">
            <thead>
                <tr class="text-xs font-medium text-gray-600">
                    <th class="px-3 py-2 text-left"></th>
                    <th class="px-3 py-2 text-left">Name</th>
                    <th class="px-3 py-2 text-left">Priority Level</th>
                    <th class="px-3 py-2 text-left">Progress (%)</th>
                    <th class="px-3 py-2 text-left">Due Date</th>
                    <th class="px-3 py-2 text-left">Status</th>
                    <th class="px-3 py-2 text-left">View</th>
                    <th class="px-3 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if ($tasks->count())
                @foreach ($tasks as $task)
                <tr tabindex="0" class="focus:outline-none h-12 border border-gray-100 rounded">
                    <td class="px-3 py-2">
                        <div class="ml-3">
                            <div class="bg-gray-200 rounded-sm w-4 h-4 flex flex-shrink-0 justify-center items-center relative">
                                <input type="checkbox" class="focus:opacity-100 checkbox opacity-0 absolute cursor-pointer w-full h-full" />
                                <div class="check-icon hidden bg-indigo-700 text-white rounded-sm"></div>
                            </div>
                        </div>
                    </td>
                    <td class="px-3 py-2">
                        <div class="relative group flex items-center">
                            <p class="text-sm font-medium leading-none text-gray-700 mr-2">
                                {{ \Str::limit($task->task_name, 6) }}
                            </p>
                            <span class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 hidden group-hover:block bg-gray-800 text-white text-xs rounded py-1 px-2 z-10 whitespace-nowrap opacity-0 group-hover:opacity-100 transition duration-300">
                                {{ $task->task_name }}
                            </span>
                        </div>
                    </td>
                    <td class="px-3 py-2">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 20 20" fill="none">
                                <path d="M9.16667 2.5L16.6667 10C17.0911 10.4745 17.0911 11.1922 16.6667 11.6667L11.6667 16.6667C11.1922 17.0911 10.4745 17.0911 10 16.6667L2.5 9.16667V5.83333C2.5 3.99238 3.99238 2.5 5.83333 2.5H9.16667" stroke="#52525B" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
                                <circle cx="7.50004" cy="7.49967" r="1.66667" stroke="#52525B" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></circle>
                            </svg>
                            <p class="text-xs font-bold leading-none {{ $task->priority === 'Low' ? 'text-green-500' : ($task->priority === 'Medium' ? 'text-yellow-500' : 'text-red-500') }}">
                                {{ $task->priority }}
                            </p>
                        </div>
                    </td>
                    <td class="px-3 py-2">
                        <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden">
                            <div class="bg-green-500 h-full text-xs text-black text-center leading-4"
                                 style="width: {{ $task->progress->progress_percentage }}%;">
                                {{ $task->progress->progress_percentage }}%
                            </div>
                        </div>
                    </td>
                    <td class="px-3 py-2">
                        <div class="flex items-center">
                            <p class="text-xs leading-none text-gray-600">{{ $task->due_date }}</p>
                        </div>
                    </td>
                    <td class="px-3 py-2">
                        <button class="py-2 px-2 text-xs focus:outline-none leading-none
                            {{ $task->progress ? ($task->progress->status == 'Completed' ? 'bg-green-100 text-green-600' :
                            ($task->progress->status == 'Ongoing' ? 'bg-yellow-100 text-yellow-500' : 'bg-gray-100 text-gray-500')) : 'bg-gray-100 text-gray-500' }}
                            rounded">
                            <span class="{{ $task->progress ? ($task->progress->status == 'Completed' ? 'text-green-600' :
                                ($task->progress->status == 'Ongoing' ? 'text-yellow-500' : 'text-gray-500')) : 'text-gray-500' }}">
                                {{ $task->progress->status ?? 'Pending' }}
                            </span>
                        </button>
                    </td>
                    <td class="px-3 py-2">
                        <button class="focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-xs leading-none  text-gray-600 py-2 px-4 bg-gray-100 rounded hover:bg-gray-200 focus:outline-none" onclick="openViewModal({{ $task->id }}, '{{ $task->task_name }}', '{{ $task->description }}', '{{ $task->due_date }}', '{{ $task->due_time }}', '{{ $task->priority }}', '{{ $task->category_id ?? '' }}', '{{ $task->progress->progress_percentage ?? 0 }}', '{{$task->progress->status}}')">View</button>
                    </td>
                    <td class="px-3 py-2">
                        <div class="relative px-3 pt-2">
                            <button onclick="dropdownFunction(this)" class="focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600 hover:text-indigo-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v.01M12 12v.01M12 18v.01" />
                                </svg>
                            </button>
                            <div class="dropdown-content bg-white shadow-md rounded-md w-28 absolute z-30 right-0 mt-2 hidden border border-gray-200">
                                <a href="#"
                                   tabindex="0"
                                   class="flex items-center justify-start gap-2 text-gray-700 text-xs px-4 py-2 hover:bg-indigo-600 hover:text-white transition-colors rounded-t-md focus:outline-none"
                                   onclick="openEditModal({{ $task->id }}, '{{ $task->task_name }}', '{{ $task->description }}', '{{ $task->due_date }}', '{{ $task->due_time }}', '{{ $task->priority }}', '{{ $task->category_id ?? '' }}', '{{ $task->progress->progress_percentage ?? 0 }}')">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z" />
                                    </svg>
                                    <span>Edit</span>
                                </a>
                                <a href="#"
                                   tabindex="0"
                                   class="flex items-center justify-start gap-2 text-gray-700 text-xs px-4 py-2 hover:bg-indigo-600 hover:text-white transition-colors rounded-t-md focus:outline-none"
                                   onclick="openEditProgressModal({{ $task->id }},'{{ $task->progress->progress_percentage ?? 0 }}', '{{ $task->task_name}}')">
                                   <svg class="w-2 h-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z" />
                                </svg>
                                    <span>Progress</span>
                                </a>
                                <form action="{{ route('deleteTask', ['id' => $task->id]) }}" method="POST" id="delete-form-{{ $task->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="button"
                                        tabindex="0"
                                        class="flex items-center justify-start gap-2 text-red-600 text-xs px-4 py-2 hover:bg-red-600 hover:text-white transition-colors w-full focus:outline-none rounded-b-md" onclick="confirmButton(event, {{ $task->id }})">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M1 7h22M10 3h4a1 1 0 011 1v1H9V4a1 1 0 011-1z" />
                                        </svg>
                                        <span>Delete</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="9" class="text-center text-gray-500 py-4">
                        No Task Found
                    </td>
                </tr>
            @endif
            </tbody>
            <div class="mt-4">
                @if ($tasks->count())
                    {{ $tasks->links('pagination::tailwind') }}
                @else
                    <p class="text-gray-500 text-sm">No Task Found</p>
                @endif
            </div>
        </table>
        <div class="flex justify-start mt-4">
            <button onclick="toggleModal('date')" class="flex items-center  gap-2 hover:from-red-600 hover:to-red-800 text-black font-semibold text-sm px-5 py-2.5 hover:shadow-lg transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Add Task
            </button>
        </div>
        {{-- Missing Tasks Section at Bottom --}}
        @if($missingTasks->count())
        <div class="mt-10 border-t pt-6">
            <h2 class="text-lg font-semibold text-red-600 mb-4">⚠️ Overdue / Missing Tasks</h2>
            <div class="space-y-3">
                @foreach($missingTasks as $task)
                    <div class="flex justify-between items-center bg-red-50 border border-red-200 p-4 rounded-md">
                        <div>
                            <p class="font-medium text-gray-800">{{ $task->task_name }}</p>
                            <p class="text-xs text-gray-500">
                                Due: {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }} {{ $task->due_time }}
                                | Priority:
                                <span class="{{ $task->priority === 'Low' ? 'text-green-600' : ($task->priority === 'Medium' ? 'text-yellow-500' : 'text-red-600') }}">
                                    {{ $task->priority }}
                                </span>
                            </p>
                            <p class="text-xs text-gray-500">Status: {{ $task->progress->status ?? 'Pending' }}</p>
                        </div>
                        <div class="flex gap-2">
                            <button onclick="openViewModal({{ $task->id }}, '{{ $task->task_name }}', '{{ $task->description }}', '{{ $task->due_date }}', '{{ $task->due_time }}', '{{ $task->priority }}', '{{ $task->category_id ?? '' }}', '{{ $task->progress->progress_percentage ?? 0 }}', '{{ $task->progress->status ?? 'Pending' }}')"
                                class="text-xs px-3 py-1 bg-gray-200 hover:bg-gray-300 rounded">
                                View
                            </button>
                            <button onclick="openEditModal({{ $task->id }}, '{{ $task->task_name }}', '{{ $task->description }}', '{{ $task->due_date }}', '{{ $task->due_time }}', '{{ $task->priority }}', '{{ $task->category_id ?? '' }}', '{{ $task->progress->progress_percentage ?? 0 }}')"
                                class="text-xs px-3 py-1 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                                Reschedule
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
</div>


<!--Add New TaskFlow Task-->
<div id="taskModal" class="fixed inset-0 bg-black bg-opacity-40 z-50 hidden flex items-center justify-center transition-opacity duration-300 ease-in-out">
    <div class="bg-white w-full max-w-2xl mx-4 sm:mx-auto p-6 sm:p-8 rounded-2xl shadow-2xl transform scale-100 transition-transform duration-300 ease-in-out">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Add New Task</h2>
            <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <form id="taskForm" action="{{ route('task.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <div>
                    <label for="prioritySelect" class="block text-sm font-medium text-gray-700 mb-1">Priority</label>
                    <select id="prioritySelect" name="priority" class="w-full px-3 py-2 border rounded-lg bg-gray-50 text-sm" required>
                        <option value="" disabled selected>Select Priority</option>
                        <option value="Low">Low</option>
                        <option value="Medium">Medium</option>
                        <option value="High">High</option>
                    </select>
                </div>
                <div>
                    <label for="dueDate" class="block text-sm font-medium text-gray-700 mb-1">Due Date</label>
                    <input type="date" name="due_date" id="dueDate" class="w-full px-3 py-2 border rounded-lg bg-gray-50 text-sm" required>
                </div>
                <div>
                    <label for="dueTime" class="block text-sm font-medium text-gray-700 mb-1">Time</label>
                    <input type="time" name="due_time" id="dueTime" class="w-full px-3 py-2 border rounded-lg bg-gray-50 text-sm" required>
                </div>
                <div>
                    <label for="taskCategory" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <select id="taskCategory" name="category_id" class="w-full px-3 py-2 border rounded-lg bg-gray-50 text-sm">
                        <option value="" disabled selected>Select Category</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-4">
                <label for="taskName" class="block text-sm font-medium text-gray-700 mb-1">Task Name</label>
                <input type="text" name="taskName" id="taskName" placeholder="Enter task name" class="w-full px-3 py-2 border rounded-lg bg-gray-50 text-sm" required>
            </div>

            <div class="mb-6">
                <label for="taskDescription" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea id="taskDescription" name="description" rows="3" placeholder="Describe the task..." class="w-full px-3 py-2 border rounded-lg bg-gray-50 text-sm"></textarea>
            </div>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">Create Task</button>
            </div>
        </form>
    </div>
</div>

<!--Edit TaskFlow Task-->
<div id="editTaskModal" class="fixed inset-0 bg-black bg-opacity-40 z-50 hidden flex items-center justify-center transition-opacity duration-300 ease-in-out">
    <div class="bg-white w-full max-w-2xl mx-4 sm:mx-auto p-6 sm:p-8 rounded-2xl shadow-2xl transform scale-100 transition-transform duration-300 ease-in-out">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Edit Task</h2>
            <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <form id="editTaskForm" action="" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" id="editTaskId" name="taskId">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="editTaskName" class="block text-sm font-medium text-gray-700 mb-1">Task Name</label>
                    <input type="text" id="editTaskName" name="taskName" class="w-full px-3 py-2 border rounded-lg bg-gray-50 text-sm" required>
                </div>
                <div>
                    <label for="editTaskDueDate" class="block text-sm font-medium text-gray-700 mb-1">Due Date</label>
                    <input type="date" id="editTaskDueDate" name="due_date" class="w-full px-3 py-2 border rounded-lg bg-gray-50 text-sm">
                </div>
                <div>
                    <label for="editTaskDueTime" class="block text-sm font-medium text-gray-700 mb-1">Time</label>
                    <input type="time" id="editTaskDueTime" name="due_time" class="w-full px-3 py-2 border rounded-lg bg-gray-50 text-sm">
                </div>
            </div>

            <div class="mb-4">
                <label for="editTaskDescription" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea id="editTaskDescription" name="description" rows="3" placeholder="Describe the task..." class="w-full px-3 py-2 border rounded-lg bg-gray-50 text-sm"></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="editTaskPriority" class="block text-sm font-medium text-gray-700 mb-1">Priority</label>
                    <select id="editTaskPriority" name="priority" class="w-full px-3 py-2 border rounded-lg bg-gray-50 text-sm">
                        <option value="Low">Low</option>
                        <option value="Medium">Medium</option>
                        <option value="High">High</option>
                    </select>
                </div>
                <div>
                    <label for="editTaskProgress" class="block text-sm font-medium text-gray-700 mb-1">Progress (%)</label>
                    <input type="number" id="editTaskProgress" name="progress_percentage" min="0" max="100" class="w-full px-3 py-2 border rounded-lg bg-gray-50 text-sm">
                </div>
            </div>

            @if(!empty($categories) && $categories->count() > 0)
            <div class="mb-6">
                <label for="editTaskCategory" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                <select id="editTaskCategory" name="category_id" class="w-full px-3 py-2 border rounded-lg bg-gray-50 text-sm">
                    <option value="" disabled selected>Select Category</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>
            @endif
            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">Save Changes</button>
            </div>
        </form>
    </div>
</div>
<!--Edit Progress TaskFlow-->
<div id="editProgressModal" class="fixed inset-0 bg-black bg-opacity-40 z-50 hidden flex items-center justify-center transition-opacity duration-300 ease-in-out">
    <div class="bg-white w-full max-w-2xl mx-4 sm:mx-auto p-6 sm:p-8 rounded-2xl shadow-2xl transform scale-100 transition-transform duration-300 ease-in-out">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Change Progress</h2>
            <button onclick="closeProgressModal()" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <form id="editProgressForm" action="" method="POST" class="bg-white p-6 rounded-lg w-full max-w-lg mx-auto">
            @csrf
            @method('PUT')
            <input type="hidden" id="editTaskId" name="taskId">
            <div class="mb-6">
                <label for="taskNames" class="block text-sm font-medium text-gray-700 mb-1">Task Name</label>
                <span id="taskNames" class="text-gray-900 text-lg font-semibold"></span>
            </div>
            <div class="mb-6">
                <label for="editTaskProgress" class="block text-sm font-medium text-gray-700 mb-1">Progress (%)</label>
                <input type="number" id="editTaskProgress" name="progress_percentage" min="0" max="100" class="w-full px-4 py-2 border rounded-lg bg-gray-50 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div class="flex justify-end gap-2 mt-4">
                <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">Save Changes</button>
            </div>
        </form>
    </div>
</div>
<!--View TaskFlow Modal-->
<div id="viewModal" class="fixed inset-0 bg-black bg-opacity-40 z-50 hidden flex items-center justify-center transition-opacity duration-300 ease-in-out">
    <div class="bg-white w-full max-w-4xl mx-4 p-6 rounded-2xl shadow-2xl space-y-6 transform scale-100 transition-transform duration-300 ease-in-out">
        <!-- Header -->
        <div class="flex justify-between items-center border-b pb-4">
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-6h13M9 7v.01M3 3v18h18" />
                </svg>
                Task Details
            </h2>
            <button onclick="closeViewModal()" class="text-gray-400 hover:text-gray-600 transition">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-gray-50 rounded-xl p-4 shadow-md">
                <label class="flex items-center font-medium text-gray-600 mb-2">
                    <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6" />
                    </svg>
                    Task Name
                </label>
                <p id="viewTaskName" class="text-gray-900 font-semibold text-base"></p>
            </div>
            <div class="bg-gray-50 rounded-xl p-4 shadow-md">
                <label class="flex items-center font-medium text-gray-600 mb-2">
                    <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h8M8 8h8M8 16h8" />
                    </svg>
                    Description
                </label>
                <p id="viewTaskDescription" class="text-gray-700 text-sm"></p>
            </div>
            <div class="bg-gray-50 rounded-xl p-4 shadow-md">
                <label class="flex items-center font-medium text-gray-600 mb-2">
                    <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3M3 11h18" />
                    </svg>
                    Due Date
                </label>
                <p id="viewTaskDueDate" class="text-gray-700 text-sm"></p>
            </div>
            <div class="bg-gray-50 rounded-xl p-4 shadow-md">
                <label class="flex items-center font-medium text-gray-600 mb-2">
                    <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3M3 11h18" />
                    </svg>
                    Time
                </label>
                <p id="viewTaskDueTime" class="text-gray-700 text-sm"></p>
            </div>
            <div class="bg-gray-50 rounded-xl p-4 shadow-md">
                <label class="flex items-center font-medium text-gray-600 mb-2">
                    <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    Status
                </label>
                <p id="viewTaskStatus" class="font-semibold text-sm text-gray-800"></p>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
            <div class="bg-gray-50 rounded-xl p-4 shadow-md">
                <label class="flex items-center font-medium text-gray-600 mb-2">
                    <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3M12 6a9 9 0 110 18 9 9 0 010-18z"/>
                    </svg>
                    Progress
                </label>
                <p id="viewTaskProgressText" class="text-gray-700 font-medium"></p>
            </div>

            <!-- Circle Progress -->
            <div class="relative w-48 h-48 mx-auto">
                <div class="absolute inset-0 rounded-full bg-gray-200 shadow-inner"></div>
                <div id="progressCircle" class="absolute inset-0 rounded-full transition-all duration-500 ease-in-out" style="background: conic-gradient(#4f46e5 0%, #e5e7eb 0%);"></div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <span id="progressValue" class="text-3xl font-bold text-white">0%</span>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="flex justify-end">
            <button onclick="closeViewModal()" class="px-5 py-2 bg-indigo-100 text-indigo-700 rounded-lg hover:bg-indigo-200 transition font-medium shadow-sm">Close</button>
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


    function openEditModal(id, taskName, description, dueDate, dueTime, priority, category_id) {
    let formattedTime = dueTime ? convertTo12HourFormat(dueTime) : '00:00';
    document.getElementById('editTaskId').value = id;
    document.getElementById('editTaskName').value = taskName;
    document.getElementById('editTaskDescription').value = description || '';
    document.getElementById('editTaskDueDate').value = dueDate;
    document.getElementById('editTaskDueTime').value = formattedTime;
    document.getElementById('editTaskPriority').value = priority;
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

    function confirmButton(event, taskId) {
        event.preventDefault();

        Swal.fire({
            title: "Delete",
            text: "Are you sure you want to delete this task?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: 'Yes, Delete it!',
            cancelButtonText: 'No, Cancel',
            iconColor: "#d9534f"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + taskId).submit();
            }
        });
    }

    document.getElementById('filter-all').addEventListener('click', function() {
        window.location.href = '{{ route("filterTask", ["filter" => "all"]) }}';
    });

    document.getElementById('filter-done').addEventListener('click', function() {
        window.location.href = '{{ route("filterTask", ["filter" => "done"]) }}';
    });

    document.getElementById('filter-ongoing').addEventListener('click', function() {
        window.location.href = '{{ route("filterTask", ["filter" => "ongoing"]) }}';
    });

    document.getElementById('filter-pending').addEventListener('click', function() {
        window.location.href = '{{ route("filterTask", ["filter" => "pending"]) }}';
    });

    function openEditProgressModal(taskId, progressPercentage, taskName) {
    document.getElementById('editTaskId').value = taskId;
    document.getElementById('editTaskProgress').value = progressPercentage;

    document.getElementById('taskNames').innerText = taskName;

    let form = document.getElementById('editProgressForm');
    form.action = `/user/tasks/${taskId}`;


    const modal = document.getElementById('editProgressModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    }

    function closeProgressModal() {
        const modal = document.getElementById('editProgressModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function convertTo12HourFormat(time) {
            const [hours, minutes] = time.split(':');
            let hours12 = parseInt(hours);
            let ampm = hours12 >= 12 ? 'PM' : 'AM';
            hours12 = hours12 % 12;
            hours12 = hours12 ? hours12 : 12;
            return `${hours12}:${minutes} ${ampm}`;
        }

    function openViewModal(id, taskName, description, dueDate, dueTime, priority, category_id, progress, taskStatus) {
        const dueTime12Hour = convertTo12HourFormat(dueTime);
        document.getElementById('viewTaskName').textContent = taskName;
        document.getElementById('viewTaskDescription').textContent = description;
        document.getElementById('viewTaskDueDate').textContent = dueDate;
        document.getElementById('viewTaskDueTime').textContent = dueTime12Hour;
        document.getElementById('viewTaskStatus').textContent = taskStatus;
        document.getElementById('viewTaskProgressText').textContent = `${progress}%`;
        document.getElementById('viewModal').classList.remove('hidden');


        const clampedProgress = Math.min(Math.max(progress, 0), 100);
        document.getElementById('progressCircle').style.background = `conic-gradient(#a72525 ${clampedProgress}%, #e5e7eb ${clampedProgress}%)`;
        document.getElementById('progressValue').textContent = `${clampedProgress}%`;
        }
        function closeViewModal() {
            document.getElementById('viewModal').classList.add('hidden');
        }




</script>
@endsection
