@extends('layouts.app')
@section('content')

<div class="flex justify-between items-center mb-4">
    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">Category Details</h2>
    <button onclick="document.getElementById('categoryModal').classList.remove('hidden')" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-700">
        Create Category
    </button>
</div>

@foreach ($categories as $category)
<div class="max-w-sm bg-white border border-gray-200 rounded-2xl shadow-md overflow-hidden dark:bg-gray-800 dark:border-gray-700">
    <div class="p-5">
        <a href="">
            <h5 class="text-lg font-semibold text-gray-900 dark:text-white leading-tight">
                {{$category->category_name}}
            </h5>
        </a>
        <div class="flex items-center mt-3 mb-4">
        </div>
        <div class="flex items-center justify-between">
            <span class="text-2xl font-bold text-gray-900 dark:text-white"></span>
        </div>
    </div>
</div>
@endforeach

<!-- Category Modal -->
<div id="categoryModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center">
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-md w-full dark:bg-gray-800">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Create Category</h2>
        <form action="{{route('categoryStore')}}" method="POST">
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
