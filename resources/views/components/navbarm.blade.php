@props(['active' => '', 'menuItems' => []])

<!-- Mobile Navbar Header -->
<header id="navbarMobile"
    class="fixed top-0 left-0 w-full z-50 transition-all duration-300 ease-in-out bg-transparent md:hidden">
    <nav class="w-full flex items-center justify-between px-4 py-3">
        <!-- Logo -->
        <div class="flex items-center">
            <img id="navbarLogoMobile" src="/img/logov2.png" class="h-auto w-32">
        </div>

        <!-- Hamburger Menu Button -->
        <button id="hamburgerMenu" class="flex flex-col gap-1.5 p-2 relative z-50" aria-label="Menu">
            <span class="w-7 h-0.5 bg-white transition-all duration-300"></span>
            <span class="w-7 h-0.5 bg-white transition-all duration-300"></span>
            <span class="w-7 h-0.5 bg-white transition-all duration-300"></span>
        </button>
    </nav>
</header>

<!-- Mobile Menu Overlay with Blur Effect -->
<div id="mobileMenuOverlay"
    class="fixed inset-0 z-40 opacity-0 pointer-events-none bg-black/30 backdrop-blur-md transition-all duration-300">
</div>

<!-- Mobile Menu -->
<div id="mobileMenu"
    class="fixed top-0 right-0 h-full w-64 bg-white shadow-lg z-50 transform translate-x-full transition-transform duration-300 ease-in-out md:hidden">
    <div class="p-4">
        <!-- Close Button -->
        <button id="closeMobileMenu" class="absolute top-4 right-4 text-gray-600 hover:text-gray-900">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <!-- Menu Items -->
        <div class="mt-8 space-y-4">
            @foreach ($menuItems as $key => $item)
                @if ($key === 'tentang')
                    <a href="{{ route($item['route']) }}"
                        class="block py-2 text-gray-800 text-lg hover:text-blue-600 transition-colors duration-300 mobile-nav-link
                        {{ $active === $key ? 'border-l-4 border-blue-500 pl-2' : '' }}">
                        <div class="flex items-center gap-3">
                            {!! $item['icon'] !!}
                            {{ $item['label'] }}
                        </div>
                    </a>
                @else
                    <a href="{{ route($item['route']) }}"
                        class="block py-2 text-gray-800 text-lg hover:text-blue-600 transition-colors duration-300 mobile-nav-link
                        {{ $active === $key ? 'border-l-4 border-blue-500 pl-2' : '' }}">
                        <div class="flex items-center gap-3">
                            {!! $item['icon'] !!}
                            {{ $item['label'] }}
                        </div>
                    </a>
                @endif
            @endforeach

            <!-- Logout Button for Mobile -->
            <form method="POST" action="{{ route('logout') }}" id="logoutFormMobile">
                @csrf
                <button type="button" id="logoutBtnMobile"
                    class="w-full text-left py-2 text-gray-800 text-lg hover:text-red-600 transition-colors duration-300 mobile-nav-link">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Keluar
                    </div>
                </button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        // Mobile Navbar Script
        (function() {
            let lastScrollTop = 0;
            let isNavbarHidden = false;
            let scrollPosition = 0;

            document.addEventListener('DOMContentLoaded', function() {
                const navbar = document.getElementById('navbarMobile');
                const logo = document.getElementById('navbarLogoMobile');
                const hamburgerMenu = document.getElementById('hamburgerMenu');
                const mobileMenu = document.getElementById('mobileMenu');
                const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
                const closeMobileMenuBtn = document.getElementById('closeMobileMenu');
                const hamburgerLines = hamburgerMenu.querySelectorAll('span');

                if (!navbar || !hamburgerMenu || !mobileMenu) {
                    console.error('Mobile menu elements not found!');
                    return;
                }

                // Function to update navbar appearance based on scroll
                function updateMobileNavbarAppearance(scrollTop) {
                    const isAtTop = scrollTop <= 10;

                    if (isAtTop) {
                        // At the very top - transparent background
                        navbar.classList.remove('bg-white', 'shadow-md');
                        navbar.classList.add('bg-transparent');
                        if (logo) logo.src = '/img/logov2.png';
                        hamburgerLines.forEach(line => {
                            line.classList.remove('bg-black');
                            line.classList.add('bg-white');
                        });
                    } else {
                        // Scrolled - white background
                        navbar.classList.remove('bg-transparent');
                        navbar.classList.add('bg-white', 'shadow-md');
                        if (logo) logo.src = '/img/logov1.png';
                        hamburgerLines.forEach(line => {
                            line.classList.remove('bg-white');
                            line.classList.add('bg-black');
                        });
                    }
                }

                // Function to disable scroll
                function disableScroll() {
                    document.body.classList.add('no-scroll');
                }

                function enableScroll() {
                    document.body.classList.remove('no-scroll');
                }

                // Mobile menu functions
                function openMobileMenu() {
                    mobileMenu.classList.remove('translate-x-full');
                    mobileMenu.classList.add('translate-x-0');

                    if (mobileMenuOverlay) {
                        mobileMenuOverlay.classList.remove('opacity-0', 'pointer-events-none');
                        mobileMenuOverlay.classList.add('opacity-100');
                    }

                    disableScroll();
                }

                function closeMobileMenu() {
                    mobileMenu.classList.remove('translate-x-0');
                    mobileMenu.classList.add('translate-x-full');

                    if (mobileMenuOverlay) {
                        mobileMenuOverlay.classList.remove('opacity-100');
                        mobileMenuOverlay.classList.add('opacity-0', 'pointer-events-none');
                    }

                    enableScroll();
                }

                // Set initial state
                if (mobileMenuOverlay) {
                    mobileMenuOverlay.classList.add('hidden');
                }

                // Scroll behavior with hide/show
                window.addEventListener('scroll', () => {
                    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

                    // Only apply hide/show if menu is closed
                    if (mobileMenu.classList.contains('translate-x-full')) {
                        // Hide navbar on scroll down, show on scroll up
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
                    }

                    // Update appearance based on scroll position
                    updateMobileNavbarAppearance(scrollTop);
                    lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
                });

                // Event listeners for mobile menu
                hamburgerMenu.addEventListener('click', function(e) {
                    e.stopPropagation();
                    if (mobileMenu.classList.contains('translate-x-full')) {
                        openMobileMenu();
                    } else {
                        closeMobileMenu();
                    }
                });

                if (closeMobileMenuBtn) {
                    closeMobileMenuBtn.addEventListener('click', closeMobileMenu);
                }

                if (mobileMenuOverlay) {
                    mobileMenuOverlay.addEventListener('click', closeMobileMenu);
                }

                // Close mobile menu on link click (except logout)
                document.querySelectorAll('.mobile-nav-link').forEach(element => {
                    element.addEventListener('click', (e) => {
                        if (e.target.closest('form[action*="logout"]')) {
                            return;
                        }
                        closeMobileMenu();
                    });
                });

                // Close on escape key
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape' && !mobileMenu.classList.contains('translate-x-full')) {
                        closeMobileMenu();
                    }
                });

                // Initial update
                updateMobileNavbarAppearance(window.pageYOffset || document.documentElement.scrollTop);
            });
        })();

        // Logout confirmation for mobile
        document.addEventListener('DOMContentLoaded', function() {
            const logoutBtnMobile = document.getElementById('logoutBtnMobile');

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

            if (logoutBtnMobile) {
                logoutBtnMobile.addEventListener('click', function() {
                    handleLogout(document.getElementById('logoutFormMobile'));
                });
            }
        });
    </script>
@endpush
