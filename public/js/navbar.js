// Navbar functionality
let lastScrollTop = 0;
const navbar = document.getElementById('navbar');
const logo = document.getElementById('navbarLogo');
const hamburgerMenu = document.getElementById('hamburgerMenu');
const hamburgerLines = hamburgerMenu?.querySelectorAll('span') || [];
const mobileMenu = document.getElementById('mobileMenu');
const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
const closeMobileMenu = document.getElementById('closeMobileMenu');

// Select all desktop menu links
const desktopMenuLinks = document.querySelectorAll('#desktopMenu .desktop-menu-link');

// Toggle Mobile Menu
if (hamburgerMenu) {
    hamburgerMenu.addEventListener('click', () => {
        mobileMenu.classList.toggle('translate-x-full');
        mobileMenuOverlay.classList.toggle('hidden');
        hamburgerMenu.classList.toggle('active');

        // Animate hamburger lines
        hamburgerLines.forEach((line, index) => {
            if (hamburgerMenu.classList.contains('active')) {
                if (index === 0) {
                    line.style.transform = 'rotate(45deg) translate(6px, 6px)';
                } else if (index === 1) {
                    line.style.opacity = '0';
                } else if (index === 2) {
                    line.style.transform = 'rotate(-45deg) translate(7px, -6px)';
                }
            } else {
                line.style.transform = '';
                line.style.opacity = '';
            }
        });
    });
}

// Close Mobile Menu
if (closeMobileMenu) {
    closeMobileMenu.addEventListener('click', closeMenu);
}

if (mobileMenuOverlay) {
    mobileMenuOverlay.addEventListener('click', closeMenu);
}

function closeMenu() {
    mobileMenu.classList.add('translate-x-full');
    mobileMenuOverlay.classList.add('hidden');
    hamburgerMenu.classList.remove('active');

    // Reset hamburger animation
    hamburgerLines.forEach(line => {
        line.style.transform = '';
        line.style.opacity = '';
    });
}

// Scroll behavior for navbar
window.addEventListener('scroll', () => {
    let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    // Don't hide navbar if mobile menu is open
    if (!mobileMenu.classList.contains('translate-x-full')) {
        return;
    }

    // TOP
    if (scrollTop <= 10) {
        navbar.classList.remove('bg-white', 'shadow-md', '-translate-y-full');
        navbar.classList.add('bg-transparent');
        logo.src = '/img/logov2.png';

        // HAMBURGER MENU → WHITE
        hamburgerLines.forEach(line => {
            line.classList.remove('bg-black');
            line.classList.add('bg-white');
        });

        // DESKTOP MENU TEXT → WHITE
        desktopMenuLinks.forEach(link => {
            link.classList.remove('text-gray-800', 'hover:text-blue-600');
            link.classList.add('text-white', 'hover:text-blue-200');

            if (link.tagName === 'BUTTON' && link.textContent.includes('Logout')) {
                link.classList.remove('hover:text-red-600');
                link.classList.add('hover:text-red-400');
            }
        });
    }
    // SCROLL DOWN → HIDE NAVBAR
    else if (scrollTop > lastScrollTop && scrollTop > 100) {
        navbar.classList.add('-translate-y-full');
    }
    // SCROLL UP → WHITE NAVBAR
    else if (scrollTop < lastScrollTop) {
        navbar.classList.remove('-translate-y-full', 'bg-transparent');
        navbar.classList.add('bg-white', 'shadow-md');
        logo.src = '/img/logov1.png';

        // HAMBURGER MENU → BLACK
        hamburgerLines.forEach(line => {
            line.classList.remove('bg-white');
            line.classList.add('bg-black');
        });

        // DESKTOP MENU TEXT → BLACK
        desktopMenuLinks.forEach(link => {
            link.classList.remove('text-white', 'hover:text-blue-200');
            link.classList.add('text-gray-800', 'hover:text-blue-600');

            if (link.tagName === 'BUTTON' && link.textContent.includes('Logout')) {
                link.classList.remove('hover:text-red-400');
                link.classList.add('hover:text-red-500');
            }
        });
    }

    lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
});

// Close mobile menu on link click
document.querySelectorAll('#mobileMenu a, #mobileMenu button[type="submit"]').forEach(element => {
    element.addEventListener('click', (e) => {
        if (e.target.closest('form[action*="logout"]')) {
            return;
        }
        closeMenu();
    });
});