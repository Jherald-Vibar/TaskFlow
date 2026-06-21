@extends('Layouts.app')

@section('content')
<div class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen py-6 px-4 sm:px-6">
    <div class="max-w-7xl mx-auto">
        <!-- Header Section with Back Button -->
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center">
                <a href="{{ route('categoryView') }}" class="mr-4 p-2 bg-white rounded-lg shadow-sm hover:bg-gray-50 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800 flex items-center">
                        <span class="bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-purple-600">
                            {{ $category->category_name }}
                        </span>
                    </h1>
                    <p class="text-gray-600 text-sm mt-1">Category Overview</p>
                </div>
            </div>
            <a href="{{ route('user-task') }}" class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium bg-indigo-50 text-indigo-700 hover:bg-indigo-100 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Add Task
            </a>
        </div>

        <!-- Category Info Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Main Info Card -->
            <div class="col-span-1 md:col-span-2 bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <!-- Category Header with Color Bar -->
                <div class="h-2 bg-gradient-to-r from-indigo-500 to-purple-500"></div>
                
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-semibold text-gray-800">Category Details</h2>
                        <span class="px-3 py-1 bg-indigo-50 text-indigo-700 rounded-lg text-sm font-medium">
                            {{ $tasks->count() }} {{ Str::plural('Task', $tasks->count()) }}
                        </span>
                    </div>

                    <!-- Stats & Progress -->
                    <div class="mb-6 space-y-3">
                        @php
                            $completedCount = $tasks->filter(function($task) {
                                return $task->progress && $task->progress->status === 'Completed';
                            })->count();
                            
                            $inProgressCount = $tasks->filter(function($task) {
                                return $task->progress && $task->progress->status === 'Ongoing';
                            })->count();
                            
                            $pendingCount = $tasks->filter(function($task) {
                                return !$task->progress || $task->progress->status === 'Pending';
                            })->count();
                            
                            $completionPercentage = $tasks->count() > 0 
                                ? round(($completedCount / $tasks->count()) * 100) 
                                : 0;
                        @endphp
                        
                        <!-- Overall Progress -->
                        <div>
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-sm font-medium text-gray-700">Task Completion</span>
                                <span class="text-sm font-medium text-indigo-600">{{ $completionPercentage }}%</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-2.5">
                                <div 
                                    class="bg-indigo-600 h-2.5 rounded-full" 
                                    style="width: {{ $completionPercentage }}%">
                                </div>
                            </div>
                        </div>
                        
                        <!-- Task Status Distribution -->
                        <div class="grid grid-cols-3 gap-4 mt-4">
                            <div class="rounded-lg bg-green-50 border border-green-100 p-3 text-center">
                                <span class="block text-2xl font-bold text-green-600">{{ $completedCount }}</span>
                                <span class="text-xs text-green-700">Completed</span>
                            </div>
                            <div class="rounded-lg bg-yellow-50 border border-yellow-100 p-3 text-center">
                                <span class="block text-2xl font-bold text-yellow-600">{{ $inProgressCount }}</span>
                                <span class="text-xs text-yellow-700">In Progress</span>
                            </div>
                            <div class="rounded-lg bg-gray-50 border border-gray-100 p-3 text-center">
                                <span class="block text-2xl font-bold text-gray-600">{{ $pendingCount }}</span>
                                <span class="text-xs text-gray-700">Pending</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Category Creation Info -->
                    <div class="bg-gray-50 rounded-lg p-4 text-sm text-gray-600">
                        <div class="flex flex-col sm:flex-row sm:justify-between gap-2">
                            <div>
                                <span class="font-medium text-gray-700">Created:</span> 
                                {{ $category->created_at->format('M d, Y \a\t h:i A') }}
                            </div>
                            <div>
                                <span class="font-medium text-gray-700">Last Updated:</span> 
                                {{ $category->updated_at->format('M d, Y \a\t h:i A') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Quick Stats Card -->
            <div class="col-span-1 bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Task Insights</h3>
                    
                    @if($tasks->count() > 0)
                        <!-- Priority Distribution -->
                        <div class="mb-5">
                            <h4 class="text-sm font-medium text-gray-700 mb-2">Priority Distribution</h4>
                            @php
                                $highPriority = $tasks->where('priority', 'High')->count();
                                $mediumPriority = $tasks->where('priority', 'Medium')->count();
                                $lowPriority = $tasks->where('priority', 'Low')->count();
                                
                                $highPercentage = $tasks->count() > 0 ? round(($highPriority / $tasks->count()) * 100) : 0;
                                $mediumPercentage = $tasks->count() > 0 ? round(($mediumPriority / $tasks->count()) * 100) : 0;
                                $lowPercentage = $tasks->count() > 0 ? round(($lowPriority / $tasks->count()) * 100) : 0;
                            @endphp
                            
                            <!-- Stacked bar chart -->
                            <div class="h-4 flex rounded-full overflow-hidden">
                                @if($highPercentage > 0)
                                    <div class="bg-red-500 h-full" style="width: {{ $highPercentage }}%"></div>
                                @endif
                                
                                @if($mediumPercentage > 0)
                                    <div class="bg-yellow-500 h-full" style="width: {{ $mediumPercentage }}%"></div>
                                @endif
                                
                                @if($lowPercentage > 0)
                                    <div class="bg-green-500 h-full" style="width: {{ $lowPercentage }}%"></div>
                                @endif
                            </div>
                            
                            <!-- Legend -->
                            <div class="flex justify-between text-xs mt-2">
                                <div class="flex items-center">
                                    <span class="w-2 h-2 inline-block bg-red-500 rounded-full mr-1"></span>
                                    <span class="text-gray-600">High ({{ $highPriority }})</span>
                                </div>
                                <div class="flex items-center">
                                    <span class="w-2 h-2 inline-block bg-yellow-500 rounded-full mr-1"></span>
                                    <span class="text-gray-600">Medium ({{ $mediumPriority }})</span>
                                </div>
                                <div class="flex items-center">
                                    <span class="w-2 h-2 inline-block bg-green-500 rounded-full mr-1"></span>
                                    <span class="text-gray-600">Low ({{ $lowPriority }})</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Upcoming Tasks -->
                        @php
                            $upcomingTasks = $tasks->filter(function($task) {
                                return $task->due_date >= now()->format('Y-m-d') && 
                                       (!$task->progress || $task->progress->status !== 'Completed');
                            })->sortBy('due_date')->take(3);
                        @endphp
                        
                        @if($upcomingTasks->count() > 0)
                            <div>
                                <h4 class="text-sm font-medium text-gray-700 mb-2">Upcoming Tasks</h4>
                                <ul class="space-y-2">
                                    @foreach($upcomingTasks as $task)
                                        <li class="flex justify-between items-center text-sm">
                                            <span class="truncate max-w-[70%] text-gray-700">{{ $task->task_name }}</span>
                                            <span class="text-xs px-2 py-0.5 rounded 
                                                {{ \Carbon\Carbon::parse($task->due_date)->isToday() ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-700' }}">
                                                {{ \Carbon\Carbon::parse($task->due_date)->format('M d') }}
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    @else
                        <div class="text-center py-6">
                            <svg class="h-12 w-12 text-gray-300 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            <p class="text-gray-500">No tasks available</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Tasks List -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-8">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-semibold text-gray-800">
                        Tasks in {{ $category->category_name }}
                    </h2>
                </div>

                @if($tasks->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Task
                                    </th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Priority
                                    </th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Due Date
                                    </th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Progress
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($tasks as $task)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900 max-w-xs truncate">
                                                {{ $task->task_name }}
                                            </div>
                                            @if($task->description)
                                                <div class="text-xs text-gray-500 max-w-xs truncate">
                                                    {{ $task->description }}
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                {{ $task->progress && $task->progress->status === 'Completed' ? 'bg-green-100 text-green-800' : 
                                                   ($task->progress && $task->progress->status === 'Ongoing' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                                {{ $task->progress ? $task->progress->status : 'Pending' }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                {{ $task->priority === 'Low' ? 'bg-green-100 text-green-800' : 
                                                   ($task->priority === 'Medium' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                                {{ $task->priority }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">
                                            {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}
                                            @if($task->due_time)
                                                <span class="text-xs text-gray-500">
                                                    {{ \Carbon\Carbon::parse($task->due_time)->format('h:i A') }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-1 h-2 w-24 bg-gray-200 rounded-full mr-2">
                                                    <div class="h-2 bg-indigo-600 rounded-full" 
                                                         style="width: {{ $task->progress ? $task->progress->progress_percentage : 0 }}%"></div>
                                                </div>
                                                <span class="text-xs font-medium text-gray-600">
                                                    {{ $task->progress ? $task->progress->progress_percentage : 0 }}%
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center py-12 bg-gray-50 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <p class="text-gray-500 text-lg font-medium">No Tasks in This Category</p>
                        <p class="text-gray-400 text-sm mt-1">You haven't added any tasks to this category yet</p>
                        <a href="{{ route('user-task') }}" class="mt-4 px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-300 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Add Task
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Animate the progress bars and charts
    document.addEventListener('DOMContentLoaded', function() {
        // Add a small delay for visual effect
        setTimeout(function() {
            // Animate progress bars
            const progressBars = document.querySelectorAll('.bg-indigo-600');
            progressBars.forEach(function(bar) {
                bar.style.transition = 'width 1s ease-in-out';
            });
            
            // Animate progress status cards
            const statusCards = document.querySelectorAll('.rounded-lg.bg-green-50, .rounded-lg.bg-yellow-50, .rounded-lg.bg-gray-50');
            statusCards.forEach(function(card, index) {
                card.style.transition = 'transform 0.5s ease-in-out, opacity 0.5s ease-in-out';
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                
                setTimeout(function() {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100 + 300);
            });
            
            // Animate table rows
            const tableRows = document.querySelectorAll('tbody tr');
            tableRows.forEach(function(row, index) {
                row.style.transition = 'opacity 0.3s ease-in-out';
                row.style.opacity = '0';
                
                setTimeout(function() {
                    row.style.opacity = '1';
                }, index * 50 + 300);
            });
        }, 300);
    });
</script>
@endpush 