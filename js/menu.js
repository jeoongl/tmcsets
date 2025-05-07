// Function to toggle the menu
function toggleMenu() {
    const menu = document.querySelector('.menu');
    menu.style.left = menu.style.left === '0px' ? '-200px' : '0px';
}

// Function to close menu when clicked outside
document.addEventListener('click', function(event) {
    const menu = document.querySelector('.menu');
    const menuIcon = document.querySelector('.menu-icon');
    const isClickInsideMenu = menu.contains(event.target) || menuIcon.contains(event.target);
    if (!isClickInsideMenu && menu.style.left === '0px') {
        menu.style.left = '-200px';
    }
});