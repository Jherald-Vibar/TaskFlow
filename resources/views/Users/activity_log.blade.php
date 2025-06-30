@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto p-6 bg-gray-50 min-h-screen">
    <h1 class="text-3xl font-extrabold mb-6 text-gray-900 tracking-tight">Activity Log</h1>

    @if($activities->isEmpty())
        <div class="text-center text-gray-400 italic mt-20">No activity logs found.</div>
    @else
        <div class="bg-white shadow-lg rounded-xl divide-y divide-gray-200 overflow-hidden">
            <ul>
                @foreach($activities as $activity)
                    <li class="group hover:bg-gray-100 transition-colors duration-200 px-6 py-5 cursor-pointer">
                        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center">
                            <div>
                                <p class="text-base font-semibold text-indigo-700">
                                    {{ $activity->causer?->name ?? 'System' }}
                                </p>
                                <p class="text-gray-800 mt-1">
                                    {{ $activity->description }}
                                </p>
                                <p class="text-xs text-gray-400 mt-1">
                                    {{ $activity->created_at->diffForHumans() }}
                                </p>
                            </div>

                            @if(!empty($activity->properties['attributes']))
                                <div class="mt-4 sm:mt-0 sm:max-w-xl bg-indigo-50 rounded-md p-3">
                                    <p class="font-semibold text-indigo-900 mb-2">Changes</p>
                                    <ul class="list-disc list-inside text-indigo-800 text-sm space-y-1">
                                        @foreach($activity->properties['attributes'] as $key => $value)
                                            @php
                                                $oldValue = $activity->properties['old'][$key] ?? 'N/A';
                                            @endphp
                                            <li>
                                                <span class="font-medium">{{ ucfirst(str_replace('_', ' ', $key)) }}:</span>
                                                <span class="line-through text-red-400 mr-1">{{ $oldValue }}</span>
                                                <span class="text-green-600 font-semibold">{{ $value }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
@endsection
