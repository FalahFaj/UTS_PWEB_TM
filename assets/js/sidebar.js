(function () {
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('sidebarToggle');
    const overlay = document.getElementById('sidebar-overlay');
    const main = document.getElementById('mainContent');
    const menuIcon = document.getElementById('menuIcon');
    const texts = document.querySelectorAll('.sidebar-text');

    let isCollapsed = false;

    function toggleSidebar() {
        isCollapsed = !isCollapsed;

        if (window.innerWidth >= 1024) {
            // Desktop mode: ubah lebar sidebar
            if (isCollapsed) {
                sidebar.classList.remove('w-64');
                sidebar.classList.add('w-20');
                main.classList.remove('ml-64');
                main.classList.add('ml-20');
                texts.forEach(t => t.classList.add('hidden'));
                menuIcon.setAttribute('name', 'menu-outline');
            } else {
                sidebar.classList.remove('w-20');
                sidebar.classList.add('w-64');
                main.classList.remove('ml-20');
                main.classList.add('ml-64');
                texts.forEach(t => t.classList.remove('hidden'));
                menuIcon.setAttribute('name', 'close-outline');
            }
        } else {
            // Mobile: tampilkan overlay
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
            menuIcon.setAttribute('name',
                sidebar.classList.contains('-translate-x-full') ? 'menu-outline' : 'close-outline');
        }
    }

    toggleBtn.addEventListener('click', toggleSidebar);
    overlay.addEventListener('click', toggleSidebar);

    // Responsif saat resize
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 1024) {
            overlay.classList.add('hidden');
            sidebar.classList.remove('-translate-x-full');
            if (isCollapsed) {
                sidebar.classList.add('w-20');
                main.classList.add('ml-20');
                texts.forEach(t => t.classList.add('hidden'));
            } else {
                sidebar.classList.add('w-64');
                main.classList.add('ml-64');
                texts.forEach(t => t.classList.remove('hidden'));
            }
        } else {
            sidebar.classList.add('-translate-x-full');
            main.classList.remove('ml-64', 'ml-20');
        }
    });
})();