<x-layout>
    @section('title', 'Login - Sipras')

    @section('content')
        <div class="hero h-screen relative"
            style="background-image: url({{ asset('img/bg_Login.png') }}); background-size: cover; background-position: center;">

            <div class="flex items-center justify-center md:justify-end h-full w-full px-4">

                <!-- LOGIN BOX -->
                <div class="w-full max-w-md mx-auto md:mr-20 md:ml-auto px-4">

                    <div class="bg-white md:bg-transparent p-6 md:p-0 rounded-xl md:rounded-none shadow-lg md:shadow-none">

                        <h1 class="text-black md:text-black text-3xl md:text-5xl font-bold mb-6 text-center">
                            LOGIN
                        </h1>

                        <!-- form -->

                        <!-- Success Message -->
                        @if (session('success'))
                            <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded-md">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Error Messages -->
                        @if ($errors->any())
                            <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded-md">
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif

                        <!-- Tab Navigation -->
                        <div class="flex mb-6 border-b border-gray-200">
                            <button type="button" id="userTabBtn"
                                class="flex-1 py-2 text-center font-semibold text-blue-600 border-b-2 border-blue-600 transition">
                                SISWA
                            </button>
                            <button type="button" id="adminTabBtn"
                                class="flex-1 py-2 text-center font-semibold text-gray-500 border-b-2 border-transparent hover:text-blue-600 transition">
                                ADMIN
                            </button>
                        </div>

                        <!-- Login Form User (SISWA) -->
                        <form id="userForm" method="POST" action="{{ route('login.submit') }}">
                            @csrf

                            <div class="mb-3">
                                <label class="block text-black text-lg mb-1">Username</label>
                                <input type="text" name="nisn" value="{{ old('nisn') }}"
                                    class="w-full border text-black border-black rounded-md px-4 py-2"
                                    placeholder="Masukkan 10 digit NISN" maxlength="10">
                            </div>

                            <div class="mb-6">
                                <label class="block text-black text-lg mb-1">
                                    Password
                                    <span class="text-sm text-gray-500">(Masukkan tanggal lahir)</span>
                                </label>

                                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                                    class="w-full border text-black border-black rounded-md px-4 py-2">
                            </div>

                            <button type="submit"
                                class="block w-full bg-blue-400 text-white py-2 rounded-md font-semibold hover:bg-blue-500">
                                LOGIN
                            </button>
                        </form>

                        <!-- Login Form Admin -->
                        <form id="adminForm" method="POST" action="{{ route('login.submit') }}" style="display: none;">
                            @csrf

                            <div class="mb-3">
                                <label class="block text-black text-lg mb-1">Username</label>
                                <input type="text" name="username" value="{{ old('username') }}"
                                    class="w-full border text-black border-black rounded-md px-4 py-2"
                                    placeholder="Masukkan username">
                            </div>

                            <div class="mb-6" x-data="{ show: false }">
                                <label class="block text-black text-lg mb-1">Password</label>

                                <div class="relative">
                                    <input :type="show ? 'text' : 'password'" name="password"
                                        class="w-full border text-black border-black rounded-md px-4 py-2 pr-10"
                                        placeholder="Masukkan password">

                                    <!-- Icon Mata -->
                                    <button type="button" @click="show = !show"
                                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-600">
                                        <!-- Mata terbuka -->
                                        <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5
                           c4.477 0 8.268 2.943 9.542 7
                           -1.274 4.057-5.065 7-9.542 7
                           -4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>

                                        <!-- Mata tertutup -->
                                        <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19
                           c-4.478 0-8.268-2.943-9.542-7
                           a9.956 9.956 0 012.042-3.368M6.223 6.223
                           A9.956 9.956 0 0112 5c4.478 0 8.268 2.943
                           9.542 7a9.956 9.956 0 01-4.293 5.042M6.223
                           6.223L3 3m3.223 3.223l12.554
                           12.554" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <button type="submit"
                                class="block w-full bg-blue-400 text-white py-2 rounded-md font-semibold hover:bg-blue-500">
                                LOGIN
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <script>
                // Tab switching functionality
                const userTabBtn = document.getElementById('userTabBtn');
                const adminTabBtn = document.getElementById('adminTabBtn');
                const userForm = document.getElementById('userForm');
                const adminForm = document.getElementById('adminForm');

                userTabBtn.addEventListener('click', function() {
                    // Update tab styles
                    userTabBtn.classList.add('text-blue-600', 'border-blue-600');
                    userTabBtn.classList.remove('text-gray-500', 'border-transparent');
                    adminTabBtn.classList.remove('text-blue-600', 'border-blue-600');
                    adminTabBtn.classList.add('text-gray-500', 'border-transparent');

                    // Show/hide forms
                    userForm.style.display = 'block';
                    adminForm.style.display = 'none';
                });

                adminTabBtn.addEventListener('click', function() {
                    // Update tab styles
                    adminTabBtn.classList.add('text-blue-600', 'border-blue-600');
                    adminTabBtn.classList.remove('text-gray-500', 'border-transparent');
                    userTabBtn.classList.remove('text-blue-600', 'border-blue-600');
                    userTabBtn.classList.add('text-gray-500', 'border-transparent');

                    // Show/hide forms
                    userForm.style.display = 'none';
                    adminForm.style.display = 'block';
                });

                // Check for old input to determine which tab to show
                @if (old('username'))
                    adminTabBtn.click();
                @elseif (old('nisn'))
                    userTabBtn.click();
                @endif
            </script>
        @endsection
</x-layout>
