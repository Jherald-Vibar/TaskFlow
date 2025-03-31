@extends('Layouts.app')
@section('content')

    <!--Task Today-->


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
                        <label for="categoryBtn" class="text-sm font-bold">Task Category (Optional)</label>
                        <button type="button" id="categoryBtn" onclick="openCategoryModal()" class="border rounded px-3 py-2 bg-gray-100 w-full text-left">
                            <span id="selectedCategory">Select Category</span>
                        </button>
                        <!-- Hidden input to store selected category -->
                        <input type="hidden" name="category_id" id="categoryInput">
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
    <div id="categoryModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-4 rounded-lg shadow-lg w-1/3">
            <h2 class="text-lg font-bold mb-2">Manage Task Categories</h2>
            <form id="categoryForm" onsubmit="saveCategory(event)">
                @csrf
                <div class="mb-3">
                    <label class="text-sm font-bold">New Category:</label>
                    <input type="text" id="newCategoryInput" name="categoryName" class="w-full border rounded px-3 py-2" placeholder="Enter New Category" required>
                </div>
                <div class="flex justify-end gap-2 mt-3">
                    <button type="button" onclick="closeCategoryModal()" class="bg-gray-400 text-white px-4 py-2 rounded">Cancel</button>
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Save</button>
                </div>
            </form>
            <div class="mt-5">
                <label class="text-sm font-bold">Select Category:</label>
                <select id="categorySelect" class="border rounded px-3 py-2 bg-gray-100 w-full" onchange="selectCategory()">
                    <option value="" disabled selected>Select Category</option>
                </select>
            </div>
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


</script>
@endsection