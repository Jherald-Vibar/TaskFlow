@extends('Layouts.app')
@section('content')

    <!--Task Today-->
    <div class="bg-white w-full rounded-xl shadow-xl overflow-hidden p-1" id="taskViewModal">
        @foreach ($tasks as $task)
        <div class="w-full flex justify-between p-3 pl-4 items-center hover:bg-gray-300 rounded-lg cursor-pointer">
            <div class="flex items-center">
                <div class="mr-4">
                    <input type="checkbox" class="task-checkbox h-6 w-6 cursor-pointer"
                        data-task-id="{{ $task->id }}" {{ $task->completed ? 'checked' : '' }}>
                </div>
                <div>
                    <div class="font-bold text-lg round-fill-lg task-name {{ $task->completed ? 'line-through text-gray-500' : '' }}"
                        id="task-{{ $task->id }}">
                        {{ $task->task_name }}
                    </div>
                    <div class="text-xs text-gray-500">
                        <span class="mr-2">{{ $task->due_date }}</span>
                        <span class="mr-2">{{ $task->description ?? 'No description' }}</span>
                        <span class="mr-2 font-semibold
                            {{ $task->priority == 'High' ? 'text-red-500' : ($task->priority == 'Medium' ? 'text-yellow-500' : 'text-green-500') }}">
                            {{ $task->priority }}
                        </span>
                        <div class="text-sm mt-2">
                            <span class="font-semibold">Progress: </span>
                            <span class="mr-2">{{ $task->progress->progress_percentage ?? 0 }}%</span>
                        </div>
                        <div class="text-sm">
                            <span class="font-semibold">Status: </span>
                            <span class="
                                {{ $task->progress ? ($task->progress->status == 'Completed' ? 'text-green-600' :
                                   ($task->progress->status == 'Ongoing' ? 'text-yellow-500' : 'text-gray-500')) : 'text-gray-500' }}">
                                {{ $task->progress->status ?? 'Pending' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex space-x-2">
                <a href="#"
                    class="bg-blue-500 text-white px-3 py-1 rounded-lg text-sm hover:bg-blue-600 transition"
                    onclick="openEditModal({{ $task->id }}, '{{ $task->task_name }}', '{{ $task->description }}', '{{ $task->due_date }}', '{{ $task->priority }}' , '{{ $task->category_id ?? '' }}', '{{ $task->progress->progress_percentage ?? 0 }}')">
                    <i class="fas fa-edit"></i>
                </a>
                <form action="{{ route('deleteTask', ['id' => $task->id]) }}" method="POST" id="delete-form-{{ $task->id }}">
                    @csrf
                    @method('DELETE')
                    <button type="button"
                            onclick="confirmButton(event, {{ $task->id }})"
                            class="bg-red-500 text-white px-3 py-1 rounded-lg text-sm hover:bg-red-600 transition">
                        <i class="fas fa-trash"></i
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

    <!--Form-->
    <div class="relative">
        <button class="bg-transparent text-black px-4 py-2 rounded flex items-center gap-2" onclick="toggleModal()">
            <i class="fas fa-plus"></i> Add Task
        </button>
        <div id="taskModal" class="absolute left-0 mt-2 bg-white p-4 rounded-lg shadow-lg w-full hidden z-50">
            <form id="taskForm" action="{{ route('task.store') }}" method="POST">
                @csrf
                <div class="mb-2 flex gap-2 relative">
                    <div class="relative">
                        <label for="prioritySelect" class="text-sm font-bold">Priority:</label>
                        <select id="prioritySelect" name="priority" class="border rounded px-3 py-2 bg-gray-100 w-full" required>
                            <option value="" disabled selected>Select Priority</option>
                            <option value="Low">Low</option>
                            <option value="Medium">Medium</option>
                            <option value="High">High</option>
                        </select>
                    </div>
                    <div class="relative">
                        <label for="dueDate" class="text-sm font-bold">Due Date:</label>
                        <input type="date" name="due_date" id="dueDate" class="border rounded px-3 py-2 bg-gray-100 w-full" required>
                    </div>
                    <div class="relative">
                        <label for="taskCategory" class="text-sm font-bold">Category:</label>
                        <select id="prioritySelect" name="category_id" class="border rounded px-3 py-2 bg-gray-100 w-full">
                            <option value="" disabled selected>Select Category</option>
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-2">
                    <input type="text" name="taskName" class="w-full border rounded px-3 py-2" id="taskName" placeholder="Task Name" required>
                </div>
                <div class="mb-2">
                    <textarea class="w-full border rounded px-3 py-2" id="taskDescription" name="description" placeholder="Description" rows="1"></textarea>
                </div>
                <div class="flex justify-end gap-2 mt-4">
                    <button type="button" onclick="closeModal()" class="bg-gray-400 text-white px-4 py-2 rounded">Cancel</button>
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <div id="dateModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-4 rounded-lg shadow-lg w-1/3">
            <h2 class="text-lg font-bold mb-2">Select Due Date</h2>
            <input type="date" id="datePicker" class="border px-3 py-2 rounded">
            <div class="flex justify-end gap-2 mt-3">
                <button onclick="closeDateModal()" class="bg-gray-400 text-white px-4 py-2 rounded">Cancel</button>
                <button onclick="setDate()" class="bg-green-500 text-white px-4 py-2 rounded">Confirm</button>
            </div>
        </div>
    </div>
    <div id="editTaskModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-xl font-bold mb-4">Edit Task</h2>
            <form id="editTaskForm" action="" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="editTaskId" name="taskId">

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Task Name</label>
                    <input type="text" id="editTaskName" name="taskName" class="w-full px-3 py-2 border rounded-lg">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Description</label>
                    <input type="text" id="editTaskDescription" name="description" class="w-full px-3 py-2 border rounded-lg">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Due Date</label>
                    <input type="date" id="editTaskDueDate" name="due_date" class="w-full px-3 py-2 border rounded-lg">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Progress (%)</label>
                    <input type="number" id="editTaskProgress" name="progress_percentage" min="0" max="100" class="w-full px-3 py-2 border rounded-lg">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Priority</label>
                    <select id="editTaskPriority" name="priority" class="w-full px-3 py-2 border rounded-lg">
                        <option value="Low">Low</option>
                        <option value="Medium">Medium</option>
                        <option value="High">High</option>
                    </select>
                </div>

                @if(!empty($categories) && $categories->count() > 0)
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Category</label>
                    <select id="editTaskCategory" name="category_id" class="w-full px-3 py-2 border rounded-lg">
                        <option value="" disabled selected>Select Category</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>
                @endif

                <div class="flex justify-end space-x-2">
                    <button type="button" class="bg-gray-500 text-white px-3 py-1 rounded-lg hover:bg-gray-600"
                            onclick="closeEditModal()">
                        Cancel
                    </button>
                    <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-600">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        @if(session('status'))
            Swal.fire({
                title: 'Success!',
                text: "{{ session('status') }}",
                icon: 'success',
                confirmButtonText: 'OK'
            });
        @endif

        @if ($errors->any())
            Swal.fire({
                title: "Validation Error!",
                text: `{!! implode('<br>', $errors->all()) !!}`,
                icon: "error"
            });
        @endif
    });

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
    document.getElementById('editTaskCategory').value = category_id;
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


</script>
@endsection
