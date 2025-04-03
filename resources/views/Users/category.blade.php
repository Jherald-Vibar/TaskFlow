@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-4">
    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">Category Details</h2>
    <button onclick="document.getElementById('categoryModal').classList.remove('hidden')" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-700">
        Create Category
    </button>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
    @foreach ($categories as $category)
        <div class="bg-white border border-gray-200 rounded-3xl shadow-lg overflow-hidden dark:bg-gray-800 dark:border-gray-700 transform transition duration-500 hover:scale-105 hover:shadow-xl">
            <div class="p-6">
                <!-- Category Header -->
                <a href="{{ route('categoryView', $category->id) }}">
                    <h5 class="text-xl font-semibold text-gray-900 dark:text-white leading-tight hover:text-blue-600 transition-colors">
                        {{ $category->category_name }}
                    </h5>
                </a>

                <div class="flex items-center mt-3 mb-4">
                    <span class="text-sm text-gray-500 dark:text-gray-400">Tasks: {{ $category->tasks->count() }}</span>
                </div>

                @if($category->tasks->count() > 0)
                <div class="mt-3">
                    <h6 class="text-sm font-semibold text-gray-900 dark:text-white">Task Names:</h6>
                    <ul class="space-y-2 list-inside pl-4">
                        @foreach ($category->tasks as $task)
                            <li class="text-sm font-medium text-gray-600 dark:text-gray-400 flex justify-between items-center">
                                <div class="flex items-center">
                                    <span class="mr-2 text-xl text-gray-500 dark:text-gray-300">•</span>
                                    {{ $task->task_name }}
                                </div>
                                <span class="text-sm text-gray-500 dark:text-gray-400">{{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
                @else
                    <div class="mt-3 text-sm text-gray-500 dark:text-gray-400">No tasks in this category.</div>
                @endif
            </div>
        </div>
    @endforeach
</div>

<!-- Modal to Create Category -->
<div id="categoryModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center">
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-md w-full dark:bg-gray-800">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Create Category</h2>
        <form action="{{ route('categoryStore') }}" method="POST">
            @csrf
            <div class="mt-4">
                <label for="categoryName" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category Name</label>
                <input type="text" id="categoryName" name="categoryName" class="mt-1 p-2 w-full border rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>
            <div class="mt-4 flex justify-end">
                <button type="button" onclick="document.getElementById('categoryModal').classList.add('hidden')" class="mr-2 px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Save</button>
            </div>
        </form>
    </div>
</div>

@endsection
