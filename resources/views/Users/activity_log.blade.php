@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-gray-100 to-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Activity Log</h1>
            <p class="text-gray-600">Track all changes and activities in your system</p>
        </div>

        @if($activities->isEmpty())
            <!-- Empty State -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-12 text-center">
                <svg class="mx-auto h-16 w-16 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-1">No activity yet</h3>
                <p class="text-gray-500">Activity logs will appear here once actions are performed</p>
            </div>
        @else
            <!-- Activity List -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="max-h-[600px] overflow-y-auto">
                    <ul class="divide-y divide-gray-100">
                        @foreach($activities as $activity)
                            <li class="group hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 transition-all duration-200">
                                <div class="p-6">
                                    <div class="flex gap-4">
                                        <!-- Avatar/Icon -->
                                        <div class="flex-shrink-0">
                                            <div class="h-10 w-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-semibold shadow-md group-hover:shadow-lg transition-shadow">
                                                {{ substr($activity->causer?->name ?? 'S', 0, 1) }}
                                            </div>
                                        </div>

                                        <!-- Content -->
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-start justify-between gap-4">
                                                <div class="flex-1">
                                                    <!-- User Name & Action -->
                                                    <div class="flex items-center gap-2 mb-1">
                                                        <span class="text-sm font-semibold text-gray-900">
                                                            {{ $activity->causer?->name ?? 'System' }}
                                                        </span>
                                                        <span class="text-xs px-2 py-0.5 rounded-full bg-indigo-100 text-indigo-700 font-medium">
                                                            {{ ucfirst($activity->log_name ?? 'activity') }}
                                                        </span>
                                                    </div>

                                                    <!-- Description -->
                                                    <p class="text-gray-700 text-sm mb-2">
                                                        {{ $activity->description }}
                                                    </p>

                                                    <!-- Timestamp -->
                                                    <div class="flex items-center gap-1 text-xs text-gray-500">
                                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        <span>{{ $activity->created_at->diffForHumans() }}</span>
                                                    </div>
                                                </div>

                                                <!-- Changes Badge (if exists) -->
                                                @if(!empty($activity->properties['attributes']))
                                                    <div class="flex-shrink-0">
                                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                            {{ count($activity->properties['attributes']) }} {{ count($activity->properties['attributes']) === 1 ? 'change' : 'changes' }}
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Changes Details -->
                                            @if(!empty($activity->properties['attributes']))
                                                <div class="mt-4 bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-4 border border-gray-200">
                                                    <h4 class="text-xs font-semibold text-gray-700 uppercase tracking-wider mb-3">Changes Made</h4>
                                                    <div class="space-y-2.5">
                                                        @foreach($activity->properties['attributes'] as $key => $value)
                                                            @php
                                                                $oldValue = $activity->properties['old'][$key] ?? 'N/A';
                                                            @endphp
                                                            <div class="flex items-start gap-2 text-sm">
                                                                <svg class="w-4 h-4 text-indigo-500 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                                </svg>
                                                                <div class="flex-1">
                                                                    <span class="font-medium text-gray-900">{{ ucfirst(str_replace('_', ' ', $key)) }}:</span>
                                                                    <div class="mt-1 flex flex-wrap items-center gap-2">
                                                                        <span class="inline-flex items-center px-2.5 py-1 rounded-md bg-red-50 text-red-700 text-xs border border-red-200">
                                                                            <span class="line-through">{{ $oldValue }}</span>
                                                                        </span>
                                                                        <svg class="w-3.5 h-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                                                        </svg>
                                                                        <span class="inline-flex items-center px-2.5 py-1 rounded-md bg-green-50 text-green-700 text-xs font-semibold border border-green-200">
                                                                            {{ $value }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Pagination (if applicable) -->
            @if(method_exists($activities, 'links'))
                <div class="mt-6">
                    {{ $activities->links() }}
                </div>
            @endif
        @endif
    </div>
</div>
@endsection
