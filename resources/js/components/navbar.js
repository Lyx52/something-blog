const mobileMenuButton = document.getElementById('open-menu-button');
const closeMenuButton = document.getElementById('close-menu-button');
const mobileMenu = document.getElementById('mobile-menu');
const blurBackdrop = document.getElementById('blur-backdrop');

function openMobileMenu() {
    mobileMenu.classList.remove('-translate-x-full');
    mobileMenu.classList.remove('opacity-0');
    blurBackdrop.classList.remove('hidden');
}

function closeMobileMenu() {
    mobileMenu.classList.add('-translate-x-full');
    mobileMenu.classList.add('opacity-0');
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
    if (!mobileMenu.contains(event.target) && !mobileMenuButton.contains(event.target)) {
        closeMobileMenu();
    }
});
