@extends('Layouts.app')
@section('content')
<<<<<<< HEAD
<section class="bg-white py-8 dark:bg-gray-900">
    <div class="mx-auto max-w-screen-lg px-4">
        <nav class="mb-6">
            <ol class="inline-flex items-center space-x-2 rtl:space-x-reverse text-sm font-medium text-gray-600 dark:text-gray-400">
                <li>
                    <a href="#" class="hover:text-primary-600 dark:hover:text-white">My account</a>
=======
<section class="bg-gradient-to-br from-gray-50 to-gray-100 py-8 min-h-screen dark:bg-gray-900">
    <div class="mx-auto max-w-screen-lg px-4">
        <!-- Breadcrumbs -->
        <nav class="mb-6">
            <ol class="inline-flex items-center space-x-2 rtl:space-x-reverse text-sm font-medium text-gray-600 dark:text-gray-400">
                <li>
                    <a href="#" class="hover:text-primary-600 dark:hover:text-white transition-colors">My account</a>
                </li>
                <li>
                    <svg class="w-3 h-3 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
>>>>>>> b0762e7 (Updated)
                </li>
                <li aria-current="page" class="text-primary-600 dark:text-white">Account</li>
            </ol>
        </nav>
<<<<<<< HEAD
        <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-8">General Overview</h2>
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:gap-16">
            <div class="bg-white p-6 rounded-lg shadow-md dark:bg-gray-800 text-center">
                <i class="fa-solid fa-list-check text-gray-400 dark:text-gray-500 text-4xl mb-3"></i>
                <h3 class="text-lg font-semibold text-gray-600 dark:text-gray-400">Tasks Made</h3>
                <span class="text-3xl font-bold text-gray-900 dark:text-white">{{$user->tasks->count()}}</span>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">in month</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md dark:bg-gray-800 text-center">
                <i class="fa-solid fa-check-circle text-gray-400 dark:text-gray-500 text-4xl mb-3"></i>
                <h3 class="text-lg font-semibold text-gray-600 dark:text-gray-400">Completed Tasks</h3>
                <span class="text-3xl font-bold text-gray-900 dark:text-white">{{$completedTask}}</span>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">in month</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md dark:bg-gray-800 text-center">
                <i class="fa-solid fa-circle-exclamation text-gray-400 dark:text-gray-500 text-4xl mb-3"></i>
                <h3 class="text-lg font-semibold text-gray-600 dark:text-gray-400">Missing Tasks</h3>
                <span class="text-3xl font-bold text-gray-900 dark:text-white">{{$missingTask}}</span>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">in month</p>
            </div>
        </div>
        <div class="mt-8 grid sm:grid-cols-2 gap-8">
            <!-- Profile Info -->
            <div class="space-y-4">
                <div class="flex items-center space-x-4">
                    @if(!empty($account->image))
                    <img id="profileImage" class="h-16 w-16 rounded-full cursor-pointer" src="{{asset('profile-pic/'. $account->image)}}" alt="{{$account->username}} avatar" />
                    @else
                    <img id="profileImage" class="h-16 w-16 rounded-full cursor-pointer" src="{{asset(Auth::user()->image)}}" alt="{{$account->username}} avatar" />
                    @endif
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">{{$account->username}}</h2>
                        <span class="inline-block rounded bg-primary-100 px-2.5 py-0.5 text-xs font-medium text-primary-800 dark:bg-primary-900 dark:text-primary-300">User</span>
                    </div>
                </div>
                <dl>
                    <dt class="font-semibold text-gray-900 dark:text-white">Email Address</dt>
                    <dd class="text-gray-500 dark:text-gray-400">{{Auth::user()->email}}</dd>
                </dl>
            </div>

            <div class="flex flex-col items-center space-y-4">
                <!-- Edit Button -->
                <button type="button" onclick="openEditModal()"
                    class="inline-flex items-center justify-center rounded-lg bg-red-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-red-800">
                    <svg class="h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z">
                        </path>
                    </svg>
                    Edit Your Data
                </button>

                @if(!empty($user->password))
                <!-- Change Password Button -->
                <button type="button" onclick="openPasswordModal()"
                    class="inline-flex items-center justify-center rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800">
                    <svg class="h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v1m-6-4V9a6 6 0 1 1 12 0v3m-6 6h.01M4 12h16">
                        </path>
                    </svg>
                    Change Password
                </button>
                @else
                <button type="button" onclick="openAddPasswordModal()"
                    class="inline-flex items-center justify-center rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800">
                    <svg class="h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v1m-6-4V9a6 6 0 1 1 12 0v3m-6 6h.01M4 12h16">
                        </path>
                    </svg>
                    Add Password
                </button>
                @endif
                <form action="{{ route('deleteAccount', ['id' => $user->id]) }}" method="POST" id="delete-form-{{ $user->id }}">
                    @csrf
                    @method('DELETE')
                    <button type="button"
                        onclick="confirmButton(event, {{ $user->id }})"
                        class="inline-flex items-center justify-center rounded-lg bg-red-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-red-800">
                        <svg class="h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 6h18M8 6v-2a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2m1 0v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6h12Z">
                            </path>
                        </svg>
                        <span>Delete Account</span>
                    </button>
                </form>
            </div>



            <div id="imageModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden justify-center items-center z-50">
                <div class="bg-transparent p-4 rounded-lg shadow-lg flex justify-center items-center w-full h-full">
                    <div class="relative w-full max-w-4xl h-auto flex justify-center items-center">
                        <button onclick="closeImageModal()" class="absolute top-2 right-2 text-gray-600 bg-white p-2 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                        <img id="modalImage" class="max-w-full max-h-screen rounded" src="" alt="Profile Image">
                    </div>
                </div>
            </div>

            <div id="editAccountModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
                <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                    <h2 class="text-xl font-bold mb-4">Edit Account Details</h2>

                    <form id="editAccountForm" action="{{route('updateAccount', ['id' => $user->id])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Profile Image Preview -->
                        @auth
                        <div class="mb-4 text-center">
                            <label class="block text-sm font-medium text-gray-700">Profile Image</label>
                            <div class="flex flex-col items-center">
                                @if(!empty($account->image))
                                    <img id="imagePreview" class="h-20 w-20 rounded-full border"
                                         src="{{ asset('profile-pic/' . $account->image) }}"
                                         alt="Profile Image">
                                @else
                                    <img id="imagePreview" class="h-20 w-20 rounded-full border"
                                         src="{{ Auth::user()->image ?? asset('default-avatar.png') }}"
                                         alt="Profile Image">
                                @endif
                                <input type="file" id="profileImage" name="image" class="mt-2 text-sm">
                            </div>
                        </div>
                        @endauth

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Username</label>
                            <input type="text" id="editUserName" name="username" value="{{$account->username}}" class="w-full px-3 py-2 border rounded-lg">
                        </div>
                        <div class="flex justify-end space-x-2">
                            <button type="button" class="bg-gray-500 text-white px-3 py-1 rounded-lg hover:bg-gray-600" onclick="closeEditModal()">
                                Cancel
                            </button>
                            <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-600">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div id="editPasswordModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
                <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                    <h2 class="text-xl font-bold mb-4">Edit Account Details</h2>

                    <form id="editAccountForm" action="{{route('updatePassword', ['id' => $user->id])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Current Password</label>
                            <input type="password" id="editPassword" name="password"  class="w-full px-3 py-2 border rounded-lg">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">New Password</label>
                            <input type="password" id="editPassword" name="new_password"  class="w-full px-3 py-2 border rounded-lg">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Confirm Password</label>
                            <input type="password" id="editPassword" name="new_password_confirmation"  class="w-full px-3 py-2 border rounded-lg">
                        </div>
                        <div class="flex justify-end space-x-2">
                            <button type="button" class="bg-gray-500 text-white px-3 py-1 rounded-lg hover:bg-gray-600" onclick="closeEditPassModal()">
                                Cancel
                            </button>
                            <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-600">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div id="AddPasswordModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
                <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                    <h2 class="text-xl font-bold mb-4">Edit Account Details</h2>

                    <form id="editAccountForm" action="{{route('addPassword', ['id' => $user->id])}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">New Password</label>
                            <input type="password" id="editPassword" name="new_password"  class="w-full px-3 py-2 border rounded-lg">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Confirm Password</label>
                            <input type="password" id="editPassword" name="new_password_confirmation"  class="w-full px-3 py-2 border rounded-lg">
                        </div>

                        <div class="flex justify-end space-x-2">
                            <button type="button" class="bg-gray-500 text-white px-3 py-1 rounded-lg hover:bg-gray-600" onclick="closeAddPassModal()">
                                Cancel
                            </button>
                            <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-600">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>

=======
        
        <!-- Profile Header -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-primary-600 to-secondary-600 h-32 w-full"></div>
            <div class="flex flex-col sm:flex-row items-center px-6 -mt-16 pb-6">
                <div class="relative">
                    @if(!empty($account->image))
                    <img id="profileImage" class="h-24 w-24 rounded-full border-4 border-white cursor-pointer object-cover" 
                         src="{{asset('profile-pic/'. $account->image)}}" alt="{{$account->username}} avatar" />
                    @else
                    <img id="profileImage" class="h-24 w-24 rounded-full border-4 border-white cursor-pointer object-cover" 
                         src="{{asset(Auth::user()->image)}}" alt="{{$account->username}} avatar" />
                    @endif
                    <div class="absolute bottom-0 right-0 h-5 w-5 bg-green-500 rounded-full border-2 border-white"></div>
                </div>
                <div class="mt-6 sm:mt-0 sm:ml-6 text-center sm:text-left">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{$account->username}}</h1>
                    <p class="text-gray-600 dark:text-gray-400">{{Auth::user()->email}}</p>
                    <span class="inline-block mt-2 px-3 py-1 rounded-full text-xs font-medium bg-primary-100 text-primary-800 dark:bg-primary-900 dark:text-primary-300">
                        User
                    </span>
                </div>
            </div>
        </div>

        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
            <svg class="w-6 h-6 mr-2 text-primary-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
            Activity Overview
        </h2>
        
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 mb-10">
            <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow dark:bg-gray-800 border-t-4 border-primary-500">
                <div class="flex items-center mb-4">
                    <div class="p-3 rounded-lg bg-primary-100 dark:bg-primary-900/50">
                        <svg class="w-8 h-8 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                    </div>
                </div>
                <h3 class="text-lg font-semibold text-gray-600 dark:text-gray-300 mb-1">Tasks Created</h3>
                <div class="flex items-end">
                    <span class="text-4xl font-bold text-gray-900 dark:text-white">{{$user->tasks->count()}}</span>
                    <span class="ml-2 text-sm text-gray-500 dark:text-gray-400 pb-1">this month</span>
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow dark:bg-gray-800 border-t-4 border-green-500">
                <div class="flex items-center mb-4">
                    <div class="p-3 rounded-lg bg-green-100 dark:bg-green-900/50">
                        <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                </div>
                <h3 class="text-lg font-semibold text-gray-600 dark:text-gray-300 mb-1">Completed Tasks</h3>
                <div class="flex items-end">
                    <span class="text-4xl font-bold text-gray-900 dark:text-white">{{$completedTask}}</span>
                    <span class="ml-2 text-sm text-gray-500 dark:text-gray-400 pb-1">this month</span>
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow dark:bg-gray-800 border-t-4 border-red-500">
                <div class="flex items-center mb-4">
                    <div class="p-3 rounded-lg bg-red-100 dark:bg-red-900/50">
                        <svg class="w-8 h-8 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <h3 class="text-lg font-semibold text-gray-600 dark:text-gray-300 mb-1">Missing Tasks</h3>
                <div class="flex items-end">
                    <span class="text-4xl font-bold text-gray-900 dark:text-white">{{$missingTask}}</span>
                    <span class="ml-2 text-sm text-gray-500 dark:text-gray-400 pb-1">this month</span>
                </div>
            </div>
        </div>

        <!-- Account Management -->
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
            <svg class="w-6 h-6 mr-2 text-primary-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            Account Management
        </h2>
        
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden">
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Account Information -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Account Information</h3>
                        <div class="space-y-4">
                            <div class="bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg">
                                <div class="text-sm text-gray-500 dark:text-gray-400">Username</div>
                                <div class="text-gray-900 dark:text-white font-medium mt-1">{{$account->username}}</div>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg">
                                <div class="text-sm text-gray-500 dark:text-gray-400">Email Address</div>
                                <div class="text-gray-900 dark:text-white font-medium mt-1">{{Auth::user()->email}}</div>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg">
                                <div class="text-sm text-gray-500 dark:text-gray-400">Account Type</div>
                                <div class="text-gray-900 dark:text-white font-medium mt-1">Standard User</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Account Actions -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Account Actions</h3>
                        <div class="space-y-4">
                            <!-- Edit Button -->
                            <button type="button" onclick="openEditModal()" class="w-full flex items-center justify-center p-4 rounded-lg bg-gradient-to-r from-primary-600 to-primary-700 text-white hover:from-primary-700 hover:to-primary-800 transition-all">
                                <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit Your Data
                            </button>

                            @if(!empty($user->password))
                            <!-- Change Password Button -->
                            <button type="button" onclick="openPasswordModal()" class="w-full flex items-center justify-center p-4 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition-all">
                                <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v1m0 0v1m0-1h1m-1 0h-1M8 12h.01M12 12h.01M16 12h.01M7 8h10M5 4h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2z" />
                                </svg>
                                Change Password
                            </button>
                            @else
                            <button type="button" onclick="openAddPasswordModal()" class="w-full flex items-center justify-center p-4 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition-all">
                                <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v1m0 0v1m0-1h1m-1 0h-1M8 12h.01M12 12h.01M16 12h.01M7 8h10M5 4h14a2 2 0 012 2v12a2 2 0 01-2-2H5a2 2 0 01-2-2V6a2 2 0 012-2z" />
                                </svg>
                                Add Password
                            </button>
                            @endif
                            
                            <form action="{{ route('deleteAccount', ['id' => $user->id]) }}" method="POST" id="delete-form-{{ $user->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirmButton(event, {{ $user->id }})"
                                    class="w-full flex items-center justify-center p-4 rounded-lg bg-red-600 text-white hover:bg-red-700 transition-all">
                                    <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Delete Account
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 hidden justify-center items-center z-50 backdrop-blur-sm transition-opacity">
        <div class="relative w-full max-w-4xl mx-auto p-4">
            <button onclick="closeImageModal()" class="absolute top-2 right-2 text-white bg-black bg-opacity-50 p-2 rounded-full hover:bg-opacity-70 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <img id="modalImage" class="max-w-full max-h-[80vh] mx-auto rounded-lg shadow-2xl" src="" alt="Profile Image">
        </div>
    </div>

    <!-- Edit Account Modal -->
    <div id="editAccountModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 backdrop-blur-sm">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg w-full max-w-md mx-4 transform transition-all">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Edit Account Details</h2>

            <form id="editAccountForm" action="{{route('updateAccount', ['id' => $user->id])}}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Profile Image Preview -->
                @auth
                <div class="text-center">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Profile Image</label>
                    <div class="flex flex-col items-center">
                        @if(!empty($account->image))
                            <img id="imagePreview" class="h-24 w-24 rounded-full border object-cover mb-3"
                                 src="{{ asset('profile-pic/' . $account->image) }}"
                                 alt="Profile Image">
                        @else
                            <img id="imagePreview" class="h-24 w-24 rounded-full border object-cover mb-3"
                                 src="{{ Auth::user()->image ?? asset('default-avatar.png') }}"
                                 alt="Profile Image">
                        @endif
                        <label for="profileImageInput" class="cursor-pointer px-4 py-2 text-sm font-medium text-white bg-primary-600 rounded-lg hover:bg-primary-700 focus:ring-4 focus:ring-primary-300">
                            Choose Image
                        </label>
                        <input type="file" id="profileImageInput" name="image" class="hidden">
                    </div>
                </div>
                @endauth

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Username</label>
                    <input type="text" id="editUserName" name="username" value="{{$account->username}}" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>
                
                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 dark:text-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600" onclick="closeEditModal()">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-primary-600 rounded-lg hover:bg-primary-700 focus:ring-4 focus:ring-primary-300">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Change Password Modal -->
    <div id="editPasswordModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 backdrop-blur-sm">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg w-full max-w-md mx-4 transform transition-all">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Change Password</h2>

            <form id="editPasswordForm" action="{{route('updatePassword', ['id' => $user->id])}}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Current Password</label>
                    <input type="password" id="currentPassword" name="password" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">New Password</label>
                    <input type="password" id="newPassword" name="new_password" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Confirm Password</label>
                    <input type="password" id="confirmPassword" name="new_password_confirmation" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>
                
                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 dark:text-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600" onclick="closeEditPassModal()">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-primary-600 rounded-lg hover:bg-primary-700 focus:ring-4 focus:ring-primary-300">
                        Update Password
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Password Modal -->
    <div id="AddPasswordModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 backdrop-blur-sm">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg w-full max-w-md mx-4 transform transition-all">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Add Password</h2>

            <form id="addPasswordForm" action="{{route('addPassword', ['id' => $user->id])}}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">New Password</label>
                    <input type="password" id="addNewPassword" name="new_password" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Confirm Password</label>
                    <input type="password" id="addConfirmPassword" name="new_password_confirmation" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>
                
                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 dark:text-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600" onclick="closeAddPassModal()">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-primary-600 rounded-lg hover:bg-primary-700 focus:ring-4 focus:ring-primary-300">
                        Set Password
                    </button>
                </div>
            </form>
>>>>>>> b0762e7 (Updated)
        </div>
    </div>
</section>

@endsection
<<<<<<< HEAD
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {

    document.getElementById("profileImage").addEventListener("click", function() {
        var imageUrl = this.src;
        document.getElementById("modalImage").src = imageUrl;
        document.getElementById("imageModal").classList.remove("hidden");
    });

    window.closeImageModal = function() {
        document.getElementById("imageModal").classList.add("hidden");
    }
});

document.addEventListener("DOMContentLoaded", function () {
        const profileImageInput = document.getElementById("profileImage");
        const imagePreview = document.getElementById("imagePreview");

        profileImageInput.addEventListener("change", function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
=======

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const profileImage = document.getElementById("profileImage");
    const imageModal = document.getElementById("imageModal");
    const modalImage = document.getElementById("modalImage");
    
    if (profileImage) {
        profileImage.addEventListener("click", function() {
            modalImage.src = this.src;
            imageModal.classList.remove("hidden");
            imageModal.classList.add("flex");
        });
    }

    window.closeImageModal = function() {
        imageModal.classList.remove("flex");
        imageModal.classList.add("hidden");
    }
    
    // Image preview on file selection
    const profileImageInput = document.getElementById("profileImageInput");
    const imagePreview = document.getElementById("imagePreview");
    
    if (profileImageInput && imagePreview) {
        profileImageInput.addEventListener("change", function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
>>>>>>> b0762e7 (Updated)
                    imagePreview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
<<<<<<< HEAD
    });

    function closeEditModal() {
        document.getElementById("editAccountModal").classList.add("hidden");
    }

    function openEditModal() {
        document.getElementById('editAccountModal').classList.remove("hidden");
    }

    function closeEditPassModal() {
        document.getElementById('editPasswordModal').classList.add("hidden");
    }

    function openPasswordModal() {
        document.getElementById('editPasswordModal').classList.remove("hidden");
    }

    function openAddPasswordModal() {
        document.getElementById('AddPasswordModal').classList.remove("hidden");
    }

    function closeAddPassModal() {
        document.getElementById('AddPasswordModal').classList.add("hidden");
    }



    document.addEventListener("DOMContentLoaded", function() {
        @if(session('success'))
            Swal.fire({
                title: 'Success!',
                text: "{{ session('success') }}",
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

    function confirmButton(event, userId) {
        event.preventDefault();

        Swal.fire({
            title: "Delete",
            text: "Are you sure you want to delete your Account?",
=======
    }

    // Modal functions
    window.closeEditModal = function() {
        document.getElementById("editAccountModal").classList.add("hidden");
    }

    window.openEditModal = function() {
        document.getElementById('editAccountModal').classList.remove("hidden");
        document.getElementById('editAccountModal').classList.add("flex");
    }

    window.closeEditPassModal = function() {
        document.getElementById('editPasswordModal').classList.add("hidden");
    }

    window.openPasswordModal = function() {
        document.getElementById('editPasswordModal').classList.remove("hidden");
        document.getElementById('editPasswordModal').classList.add("flex");
    }

    window.openAddPasswordModal = function() {
        document.getElementById('AddPasswordModal').classList.remove("hidden");
        document.getElementById('AddPasswordModal').classList.add("flex");
    }

    window.closeAddPassModal = function() {
        document.getElementById('AddPasswordModal').classList.add("hidden");
    }

    // Delete confirmation
    window.confirmButton = function(event, userId) {
        event.preventDefault();
        Swal.fire({
            title: "Delete Account",
            text: "Are you sure you want to delete your account? This action cannot be undone.",
>>>>>>> b0762e7 (Updated)
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: 'Yes, Delete it!',
            cancelButtonText: 'No, Cancel',
<<<<<<< HEAD
            iconColor: "#d9534f"
=======
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            iconColor: "#ef4444"
>>>>>>> b0762e7 (Updated)
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + userId).submit();
            }
        });
    }
<<<<<<< HEAD

</script>
=======
});
</script>
@if(session('success'))
<script>
    Swal.fire({
        title: 'Success!',
        text: "{{ session('success') }}",
        icon: 'success',
        confirmButtonText: 'OK',
        confirmButtonColor: '#0ea5e9'
    });
</script>
@endif
@if ($errors->any())
<script>
    Swal.fire({
        title: "Validation Error!",
        html: `{!! implode('<br>', $errors->all()) !!}`,
        icon: "error",
        confirmButtonColor: '#0ea5e9'
    });
</script>
@endif
>>>>>>> b0762e7 (Updated)
