@extends('Layouts.app')
@section('content')
<section class="bg-white py-8 dark:bg-gray-900">
    <div class="mx-auto max-w-screen-lg px-4">
        <nav class="mb-6">
            <ol class="inline-flex items-center space-x-2 rtl:space-x-reverse text-sm font-medium text-gray-600 dark:text-gray-400">
                <li>
                    <a href="#" class="hover:text-primary-600 dark:hover:text-white">My account</a>
                </li>
                <li aria-current="page" class="text-primary-600 dark:text-white">Account</li>
            </ol>
        </nav>
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
                <span class="text-3xl font-bold text-gray-900 dark:text-white">0</span>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">in month</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md dark:bg-gray-800 text-center">
                <i class="fa-solid fa-circle-exclamation text-gray-400 dark:text-gray-500 text-4xl mb-3"></i>
                <h3 class="text-lg font-semibold text-gray-600 dark:text-gray-400">Missing Tasks</h3>
                <span class="text-3xl font-bold text-gray-900 dark:text-white">0</span>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">in month</p>
            </div>
        </div>
        <div class="mt-8 grid sm:grid-cols-2 gap-8">
            <!-- Profile Info -->
            <div class="space-y-4">
                <div class="flex items-center space-x-4">
                    <img id="profileImage" class="h-16 w-16 rounded-full cursor-pointer" src="{{asset('profile-pic/'. $account->image)}}" alt="{{$account->username}} avatar" />
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

            <div class="flex items-center justify-center">
                <button type="button" data-modal-target="accountInformationModal2" data-modal-toggle="accountInformationModal2"
                    class="inline-flex items-center justify-center rounded-lg bg-red-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-red-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    <svg class="h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"></path>
                    </svg>
                    Edit Your Data
                </button>
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

        </div>
    </div>
</section>

@endsection

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
</script>
