@include('Layouts.navbar')
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="relative min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8 bg-gray-500 bg-no-repeat bg-cover relative items-center"
	style="background-image: url(https://images.unsplash.com/photo-1621243804936-775306a8f2e3?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80);">
	<div class="absolute bg-black opacity-60 inset-0 z-0"></div>
	<div class="sm:max-w-lg w-full p-10 bg-white rounded-xl z-10">
		<div class="text-center">
			<h2 class="mt-5 text-3xl font-bold text-gray-900">
				Create Account
			</h2>
			<p class="mt-2 text-sm text-gray-400">Create TaskFlow Account</p>
		</div>
        <form class="mt-8 space-y-3" action="{{ route('storeAccount', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 space-y-2">
                <label class="text-sm font-bold text-gray-500 tracking-wide"></label>
                <input class="text-base p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"
                       type="text" value="{{ Auth::user()->name ?? null }}"
                       name="username" placeholder="Username">
            </div>
            <div class="grid grid-cols-1 space-y-2">
                <label class="text-sm font-bold text-gray-500 tracking-wide">Upload Image</label>
                <div class="flex items-center justify-center w-full">
                    <label class="flex flex-col rounded-lg border-4 border-dashed w-full h-60 p-10 group text-center cursor-pointer">
                        <div class="h-full w-full text-center flex flex-col items-center justify-center">
                            <!-- 👇 Updated img tag with id for preview -->
                            <img id="imagePreview" class="has-mask h-36 object-center"
                                 src="{{ $user->image ?? asset('images/profile.png') }}" alt="Profile Image">

                            <p class="pointer-none text-gray-500">
                                <span class="text-sm">Drag and drop</span> files here <br /> or
                                <span class="text-blue-600 hover:underline">select a file</span> from your computer
                            </p>
                        </div>
                        <input type="file" name="image" id="fileInput" class="hidden" accept="image/*">
                    </label>
                </div>
            </div>
            <p class="text-sm text-gray-300">
                <span>File type: types of images</span>
            </p>

            <div>
                <button type="submit" class="my-5 w-full flex justify-center bg-blue-500 text-gray-100 p-4 rounded-full tracking-wide
                        font-semibold focus:outline-none focus:shadow-outline hover:bg-blue-600 shadow-lg cursor-pointer transition ease-in duration-300">
                    Create Account
                </button>
            </div>
        </form>
	</div>
</div>

<style>
	.has-mask {
		position: absolute;
		clip: rect(10px, 150px, 130px, 10px);
	}
</style>

<script>
    document.getElementById("fileInput").addEventListener("change", function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById("imagePreview").src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
