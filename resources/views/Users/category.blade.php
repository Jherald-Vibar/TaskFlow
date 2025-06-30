@extends('Layouts.app')

@section('content')
<<<<<<< HEAD

<div class="flex justify-between items-center mb-4">
    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">Category Details</h2>
    <button onclick="document.getElementById('categoryModal').classList.remove('hidden')" class="text-white bg-gradient-to-r from-red-500 via-red-600 to-red-700 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-700">
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
=======
<div class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen py-6 px-4 sm:px-6">
    <div class="max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">
                    <span class="bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-purple-600">Categories</span>
                </h1>
                <p class="text-gray-600 mt-1">Organize your tasks into categories for better management</p>
            </div>
            <button 
                onclick="document.getElementById('categoryModal').classList.remove('hidden')" 
                class="inline-flex items-center px-4 py-2.5 rounded-lg text-sm font-medium shadow-sm
                       bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800
                       text-white transition-all duration-200 transform hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Create Category
            </button>
        </div>

        <!-- Stats & Info Cards -->
        @if($categories->count() > 0)
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 mb-8">
            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
                <h3 class="text-sm font-medium text-gray-500">Total Categories</h3>
                <p class="text-3xl font-bold text-indigo-600 mt-1">{{ $categories->count() }}</p>
            </div>
            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
                <h3 class="text-sm font-medium text-gray-500">Total Tasks</h3>
                <p class="text-3xl font-bold text-indigo-600 mt-1">{{ $tasks->count() }}</p>
            </div>
            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 hidden sm:block">
                <h3 class="text-sm font-medium text-gray-500">Categorized Tasks</h3>
                <p class="text-3xl font-bold text-indigo-600 mt-1">{{ $tasks->whereNotNull('category_id')->count() }}</p>
            </div>
            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 hidden lg:block">
                <h3 class="text-sm font-medium text-gray-500">Uncategorized</h3>
                <p class="text-3xl font-bold text-indigo-600 mt-1">{{ $tasks->whereNull('category_id')->count() }}</p>
            </div>
        </div>
        @endif

        <!-- Categories Grid -->
        @if($categories->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($categories as $category)
                <div class="group bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition-all duration-300">
                    <div class="relative overflow-hidden">
                        <!-- Category Color Bar -->
                        <div class="absolute inset-x-0 top-0 h-1.5 bg-gradient-to-r from-indigo-500 to-purple-500"></div>
                        
                        <div class="p-5">
                            <!-- Category Header -->
                            <div class="flex items-start justify-between mb-4">
                                <a href="{{ route('singleCategoryView', $category->id) }}" class="group-hover:text-indigo-600 transition-colors duration-200">
                                    <h2 class="text-xl font-semibold text-gray-800 truncate max-w-[250px]">
                                        {{ $category->category_name }}
                                    </h2>
                                </a>
                                <span class="flex items-center justify-center px-2.5 py-1 bg-indigo-50 text-indigo-700 text-xs font-medium rounded-full">
                                    {{ $category->tasks->count() }} {{ Str::plural('Task', $category->tasks->count()) }}
                                </span>
                            </div>
                            
                            <!-- Task Info or Empty State -->
                            @if($category->tasks->count() > 0)
                                <div class="space-y-3 mb-4">
                                    <!-- Progress Overview -->
                                    <div>
                                        <div class="flex justify-between text-xs text-gray-500 mb-1">
                                            <span>Task Completion</span>
                                            <span>
                                                @php
                                                    $completedCount = $category->tasks->filter(function($task) {
                                                        return $task->progress && $task->progress->status === 'Completed';
                                                    })->count();
                                                    $percentage = $category->tasks->count() > 0 
                                                        ? round(($completedCount / $category->tasks->count()) * 100) 
                                                        : 0;
                                                @endphp
                                                {{ $completedCount }}/{{ $category->tasks->count() }} ({{ $percentage }}%)
                                            </span>
                                        </div>
                                        <div class="w-full bg-gray-100 rounded-full h-1.5">
                                            <div class="bg-indigo-500 h-1.5 rounded-full" 
                                                 style="width: {{ $percentage }}%;">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Recent Tasks Preview -->
                                    <div class="space-y-2">
                                        <h3 class="text-sm font-medium text-gray-700 flex items-center">
                                            <svg class="h-4 w-4 mr-1 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                            </svg>
                                            Recent Tasks
                                        </h3>
                                        <ul class="space-y-1 max-h-32 overflow-y-auto">
                                            @foreach($category->tasks->take(3) as $task)
                                                <li class="flex items-center justify-between text-sm">
                                                    <div class="flex items-center max-w-[70%]">
                                                        <span class="h-2 w-2 rounded-full mr-2 
                                                            {{ $task->progress && $task->progress->status === 'Completed' ? 'bg-green-500' : 
                                                               ($task->progress && $task->progress->status === 'Ongoing' ? 'bg-yellow-500' : 'bg-gray-400') }}">
                                                        </span>
                                                        <span class="truncate text-gray-700">{{ $task->task_name }}</span>
                                                    </div>
                                                    <span class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($task->due_date)->format('M d') }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @else
                                <div class="flex flex-col items-center justify-center py-4 mb-4 bg-gray-50 rounded-lg">
                                    <svg class="h-8 w-8 text-gray-400 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    <p class="text-sm text-gray-500">No tasks in this category</p>
                                </div>
                            @endif
                            
                            <!-- Category Footer with Actions -->
                            <div class="pt-3 flex justify-between items-center border-t border-gray-100">
                                <span class="text-xs text-gray-500">
                                    Created {{ \Carbon\Carbon::parse($category->created_at)->format('M d, Y') }}
                                </span>
                                <div class="flex space-x-2">
                                    <a href="{{ route('singleCategoryView', $category->id) }}" 
                                       class="text-xs font-medium text-indigo-600 hover:text-indigo-800 transition-colors">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8 text-center">
                <div class="max-w-md mx-auto">
                    <svg class="h-16 w-16 text-indigo-200 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No Categories Yet</h3>
                    <p class="text-gray-500 mb-6">Create your first category to organize your tasks more efficiently</p>
                    <button 
                        onclick="document.getElementById('categoryModal').classList.remove('hidden')" 
                        class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium
                            bg-indigo-600 hover:bg-indigo-700 text-white transition-all duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Create Your First Category
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Create Category Modal -->
<div id="categoryModal" class="hidden fixed inset-0 z-50">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-gray-900 bg-opacity-50 backdrop-blur-sm transition-opacity"></div>
    
    <!-- Modal Content -->
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-xl shadow-xl max-w-md w-full overflow-hidden transform transition-all">
            <!-- Modal Header -->
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-800">Create New Category</h3>
                    <button onclick="document.getElementById('categoryModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-500">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            
            <!-- Modal Body -->
            <form action="{{ route('categoryStore') }}" method="POST">
                @csrf
                <div class="p-6">
                    <div class="mb-4">
                        <label for="categoryName" class="block text-sm font-medium text-gray-700 mb-1">Category Name</label>
                        <input type="text" id="categoryName" name="categoryName" placeholder="Enter category name" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" required>
                        <p class="mt-1 text-xs text-gray-500">Choose a descriptive name for your category</p>
                    </div>
                </div>
                
                <!-- Modal Footer -->
                <div class="px-6 py-4 bg-gray-50 flex justify-end space-x-3">
                    <button type="button" 
                            onclick="document.getElementById('categoryModal').classList.add('hidden')" 
                            class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                        Create Category
                    </button>
                </div>
            </form>
        </div>
>>>>>>> b0762e7 (Updated)
    </div>
</div>

@endsection
<<<<<<< HEAD
=======

@push('scripts')
<script>
    // Animate the progress bars after page loads
    document.addEventListener('DOMContentLoaded', function() {
        // Add a small delay for visual effect
        setTimeout(function() {
            const progressBars = document.querySelectorAll('.bg-indigo-500');
            progressBars.forEach(function(bar) {
                bar.style.transition = 'width 1s ease-in-out';
            });
        }, 300);
        
        // Smooth modal transitions
        const categoryModal = document.getElementById('categoryModal');
        const backdrop = categoryModal.querySelector('.absolute.inset-0');
        const modalContent = categoryModal.querySelector('.transform');
        
        function openModal() {
            categoryModal.classList.remove('hidden');
            setTimeout(() => {
                backdrop.classList.add('opacity-100');
                modalContent.classList.add('scale-100');
                modalContent.classList.remove('scale-95', 'opacity-0');
            }, 10);
        }
        
        function closeModal() {
            backdrop.classList.remove('opacity-100');
            modalContent.classList.remove('scale-100');
            modalContent.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                categoryModal.classList.add('hidden');
            }, 300);
        }
        
        // Replace original modal open/close functions
        const openButtons = document.querySelectorAll('[onclick*="categoryModal\').classList.remove(\'hidden\'"]');
        openButtons.forEach(button => {
            button.onclick = null;
            button.addEventListener('click', openModal);
        });
        
        const closeButtons = document.querySelectorAll('[onclick*="categoryModal\').classList.add(\'hidden\'"]');
        closeButtons.forEach(button => {
            button.onclick = null;
            button.addEventListener('click', closeModal);
        });
    });
</script>
@endpush
>>>>>>> b0762e7 (Updated)
