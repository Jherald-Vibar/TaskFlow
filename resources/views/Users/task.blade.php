@extends('Layouts.app')
@section('content')
<div class="sm:px-6 w-full">
    <div class="px-4 md:px-10 py-4 md:py-7">
        <div class="flex items-center justify-between">
            <p tabindex="0" class="focus:outline-none text-base sm:text-lg md:text-xl lg:text-2xl font-bold leading-normal text-gray-800">Tasks</p>
            <div class="py-3 px-4 flex items-center text-sm font-medium leading-none text-gray-600 bg-gray-200 hover:bg-gray-300 cursor-pointer rounded">
                <p>Sort By:</p>
                <select aria-label="select" class="focus:text-indigo-600 focus:outline-none bg-transparent ml-1">
                    <option class="text-sm text-indigo-800">Latest</option>
                    <option class="text-sm text-indigo-800">Oldest</option>
                    <option class="text-sm text-indigo-800">Latest</option>
                </select>
            </div>
        </div>
    </div>
    <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10">
        <div class="sm:flex items-center justify-between">
            <div class="flex items-center">
                <a id="filter-all" class="rounded-full focus:outline-none focus:ring-2 focus:bg-indigo-50 focus:ring-indigo-800" href="javascript:void(0)">
                    <div class="py-2 px-8 bg-indigo-100 text-indigo-700 rounded-full">
                        <p>All</p>
                    </div>
                </a>
                <a id="filter-done" class="rounded-full focus:outline-none focus:ring-2 focus:bg-indigo-50 focus:ring-indigo-800 ml-4 sm:ml-8" href="javascript:void(0)">
                    <div class="py-2 px-8 text-gray-600 hover:text-indigo-700 hover:bg-indigo-100 rounded-full ">
                        <p>Done</p>
                    </div>
                </a>
                <a id="filter-ongoing" class="rounded-full focus:outline-none focus:ring-2 focus:bg-indigo-50 focus:ring-indigo-800 ml-4 sm:ml-8" href="javascript:void(0)">
                    <div class="py-2 px-8 text-gray-600 hover:text-indigo-700 hover:bg-indigo-100 rounded-full ">
                        <p>Ongoing</p>
                    </div>
                </a>
                <a id="filter-pending" class="rounded-full focus:outline-none focus:ring-2 focus:bg-indigo-50 focus:ring-indigo-800 ml-4 sm:ml-8" href="javascript:void(0)">
                    <div class="py-2 px-8 text-gray-600 hover:text-indigo-700 hover:bg-indigo-100 rounded-full ">
                        <p>Pending</p>
                    </div>
                </a>
            </div>
            <button onclick="toggleModal()" class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 mt-4 sm:mt-0 inline-flex items-start justify-start px-6 py-3 bg-gradient-to-r from-red-500 via-red-600 to-red-700  hover:bg-indigo-600 focus:outline-none rounded">
                <p class="text-sm font-medium leading-none text-white">Add Task</p>
            </button>
        </div>
        <div class="mt-5 overflow-x-auto" id="task-list">
            <table class="w-full whitespace-nowrap">
                <thead>
                    <tr class="text-xs font-medium text-gray-600">
                        <th class="px-3 py-2 text-left"></th>
                        <th class="px-3 py-2 text-left">Name</th>
                        <th class="px-3 py-2 text-left">Priority Level</th>
                        <th class="px-3 py-2 text-left">Created At</th>
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
                            <div class="flex items-center">
                                <p class="text-sm font-medium leading-none text-gray-700 mr-2">
                                    {{ \Str::limit($task->task_name, 6) }}
                                </p>
                            </div>
                        </td>
                        <td class="px-3 py-2">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 20 20" fill="none">
                                    <path d="M9.16667 2.5L16.6667 10C17.0911 10.4745 17.0911 11.1922 16.6667 11.6667L11.6667 16.6667C11.1922 17.0911 10.4745 17.0911 10 16.6667L2.5 9.16667V5.83333C2.5 3.99238 3.99238 2.5 5.83333 2.5H9.16667" stroke="#52525B" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <circle cx="7.50004" cy="7.49967" r="1.66667" stroke="#52525B" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></circle>
                                </svg>
                                <p class="text-xs leading-none {{ $task->priority === 'Low' ? 'text-green-500' : ($task->priority === 'Medium' ? 'text-yellow-500' : 'text-red-500') }}">
                                    {{ $task->priority }}
                                </p>
                            </div>
                        </td>
                        <td class="px-3 py-2">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 20 20" fill="none">
                                    <circle cx="10" cy="10" r="8" stroke="#52525B" stroke-width="1.25" fill="none"/>
                                    <line x1="10" y1="10" x2="10" y2="6" stroke="#52525B" stroke-width="1.25" stroke-linecap="round"/>
                                    <line x1="10" y1="10" x2="13" y2="10" stroke="#52525B" stroke-width="1.25" stroke-linecap="round"/>
                                </svg>
                                <p class="text-xs leading-none text-gray-600">{{ $task->created_at }}</p>
                            </div>
                        </td>
                        <td class="px-3 py-2">
                            <div class="flex items-center">
                                <p class="text-xs leading-none text-gray-600">{{ $task->progress->progress_percentage }} %</p>
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
                            <button class="focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-xs leading-none text-gray-600 py-2 px-4 bg-gray-100 rounded hover:bg-gray-200 focus:outline-none">View</button>
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
                                       onclick="openEditModal({{ $task->id }}, '{{ $task->task_name }}', '{{ $task->description }}', '{{ $task->due_date }}', '{{ $task->priority }}', '{{ $task->category_id ?? '' }}', '{{ $task->progress->progress_percentage ?? 0 }}')">
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

    function openEditModal(id, taskName, description, dueDate, priority, category_id) {
    document.getElementById('editTaskId').value = id;
    document.getElementById('editTaskName').value = taskName;
    document.getElementById('editTaskDescription').value = description || '';
    document.getElementById('editTaskDueDate').value = dueDate;
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
        // Close the modal
        const modal = document.getElementById('editProgressModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

</script>
@endsection
