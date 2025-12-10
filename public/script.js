// Minimal JS for welcome landing page menu toggle
document.addEventListener('DOMContentLoaded', function () {
    const menuBtn = document.getElementById('menu-button');
    const navLinks = document.getElementById('nav-links');
    const closeBtn = document.getElementById('close-menu');

    function openMenu() {
        if (navLinks) navLinks.classList.remove('-translate-x-full');
    }

    function closeMenu() {
        if (navLinks && !navLinks.classList.contains('-translate-x-full')) {
            navLinks.classList.add('-translate-x-full');
        }
    }

    if (menuBtn) menuBtn.addEventListener('click', openMenu);
    if (closeBtn) closeBtn.addEventListener('click', closeMenu);

    // close on ESC
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeMenu();
    });

    // close when a nav link is clicked
    if (navLinks) {
        navLinks.querySelectorAll('a').forEach((a) => {
            a.addEventListener('click', closeMenu);
        });
    }
});
