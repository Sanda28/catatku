document.addEventListener('DOMContentLoaded', function () {
    const darkModeToggle = document.getElementById('dark-mode-toggle');
    const body = document.body;
    const navbar = document.getElementById('navbar');

    if (localStorage.getItem('dark-mode') === 'enabled') {
        enableDarkMode();
    }

    darkModeToggle.addEventListener('click', function () {
        if (body.classList.contains('dark-mode')) {
            disableDarkMode();
        } else {
            enableDarkMode();
        }
    });

    function enableDarkMode() {
        body.classList.add('dark-mode');
        navbar.classList.replace('navbar-light', 'navbar-dark');
        navbar.classList.replace('bg-light', 'bg-dark');
        localStorage.setItem('dark-mode', 'enabled');
    }

    function disableDarkMode() {
        body.classList.remove('dark-mode');
        navbar.classList.replace('navbar-dark', 'navbar-light');
        navbar.classList.replace('bg-dark', 'bg-light');
        localStorage.setItem('dark-mode', 'disabled');
    }
});
