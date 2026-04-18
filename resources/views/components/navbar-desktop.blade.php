@props(['active' => '', 'menuItems' => []])

<header id="navbar"
    class="fixed top-0 left-0 w-full z-50 transition-all duration-300 ease-in-out bg-transparent -translate-y-0 hidden md:block">
    <nav class="max-w-7xl mx-auto flex items-center justify-between px-4 md:px-6 py-3 md:py-4">
        <!-- Logo dan Teks -->
        <div class="flex items-center gap-4">
            <img id="navbarLogo" src="/img/Logov2.png" class="h-auto w-32 md:w-44 ml-2 md:ml-5">
        </div>

        <!-- Desktop Menu -->
        <div id="desktopMenu" class="flex items-center gap-8">
            @foreach ($menuItems as $key => $item)
                @if ($key === 'tentang')
                    <a href="{{ route($item['route']) }}"
                        class="text-white text-1xl md:text-1xl
        hover:text-blue-200 transition-colors duration-300 nav-link
        {{ $active === $key ? 'border-b-2' : '' }}
        js-nav-link">
                        {{ $item['label'] }}
                    </a>
                @else
                    <a href="{{ route($item['route']) }}"
                        class="text-white text-1xl hover:text-blue-200 transition-colors duration-300 nav-link
                        {{ $active === $key ? 'border-b-2 border-white' : '' }}">
                        {{ $item['label'] }}
                    </a>
                @endif
            @endforeach
            <form method="POST" action="{{ route('logout') }}" class="inline" id="logoutFormDesktop">
                @csrf
                <button type="button" id="logoutBtnDesktop"
                    class="text-white text-1xl hover:text-red-500 transition-colors duration-300 bg-transparent border-none p-0 cursor-pointer nav-link">
                    Keluar
                </button>
            </form>
        </div>
    </nav>
</header>

@push('scripts')
    <script>
        // Desktop Navbar Script
        (function() {
            let lastScrollTop = 0;
            let isNavbarHidden = false;
            const navbar = document.getElementById('navbar');
            const logo = document.getElementById('navbarLogo');

            if (!navbar) return;

            document.addEventListener('DOMContentLoaded', function() {
                const navLinks = document.querySelectorAll('.nav-link');

                function updateNavbarAppearance(scrollTop) {
                    const isAtTop = scrollTop <= 10;
                    // Definisi activeLinks harus ada di sini
                    const activeLinks = document.querySelectorAll('.border-b-2');

                    if (isAtTop) {
                        navbar.classList.remove('bg-white', 'shadow-md');
                        navbar.classList.add('bg-transparent');
                        if (logo) logo.src = '/img/Logov2.png';
                        navLinks.forEach(link => {
                            link.classList.remove('text-gray-800', 'text-black');
                            link.classList.add('text-white');
                        });
                        activeLinks.forEach(link => {
                            link.classList.remove('border-gray-800');
                            link.classList.add('border-white');
                        });
                    } else {
                        navbar.classList.remove('bg-transparent');
                        navbar.classList.add('bg-white', 'shadow-md');
                        if (logo) logo.src = '/img/Logov1.png';
                        navLinks.forEach(link => {
                            link.classList.remove('text-white');
                            link.classList.add('text-gray-800');
                        });
                        activeLinks.forEach(link => {
                            link.classList.remove('border-white');
                            link.classList.add('border-gray-800');
                        });
                    }
                }

                window.addEventListener('scroll', () => {
                    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

                    if (scrollTop > lastScrollTop && scrollTop > 50) {
                        if (!isNavbarHidden) {
                            navbar.style.transform = 'translateY(-100%)';
                            isNavbarHidden = true;
                        }
                    } else {
                        if (isNavbarHidden) {
                            navbar.style.transform = 'translateY(0)';
                            isNavbarHidden = false;
                        }
                    }

                    updateNavbarAppearance(scrollTop);
                    lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
                });

                // Panggil sekali untuk inisialisasi
                updateNavbarAppearance(window.pageYOffset || document.documentElement.scrollTop);
            });
        })();

        // Logout confirmation for desktop
        document.addEventListener('DOMContentLoaded', function() {
            const logoutBtnDesktop = document.getElementById('logoutBtnDesktop');

            function handleLogout(form) {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Anda akan keluar dari sistem!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, Logout!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                } else {
                    form.submit();
                }
            }

            if (logoutBtnDesktop) {
                logoutBtnDesktop.addEventListener('click', function() {
                    handleLogout(document.getElementById('logoutFormDesktop'));
                });
            }
        });
    </script>
@endpush
