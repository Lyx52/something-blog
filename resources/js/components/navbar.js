const mobileMenuButton = document.getElementById('open-menu-button');
const closeMenuButton = document.getElementById('close-menu-button');
const mobileMenu = document.getElementById('mobile-menu');
const blurBackdrop = document.getElementById('blur-backdrop');

function openMobileMenu() {
    mobileMenu.classList.remove('-translate-x-full');
    blurBackdrop.classList.remove('hidden');
}

function closeMobileMenu() {
    mobileMenu.classList.add('-translate-x-full');
    blurBackdrop.classList.add('hidden');
}

mobileMenuButton.addEventListener('click', (event) => {
    event.stopPropagation();
    openMobileMenu();
});

closeMenuButton.addEventListener('click', () => {
    closeMobileMenu();
});

mobileMenu.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', () => {
        closeMobileMenu();
    });
});

document.addEventListener('click', (event) => {
    // Close menu when clicked outside of mobile menu
    if (!mobileMenu.contains(event.target) && !mobileMenuButton.contains(event.target)) {
        closeMobileMenu();
    }
});
