(function(){
        var toggleBtn = document.getElementById('sidebarToggle');
        var closeBtn = document.getElementById('sidebarClose');
        var sidebar = document.getElementById('sidebar');
        var overlay = document.getElementById('sidebar-overlay');

        function openSidebar() {
            sidebar.classList.add('translate-x-0');
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
            toggleBtn.setAttribute('aria-expanded','true');
        }
        function closeSidebar() {
            sidebar.classList.remove('translate-x-0');
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
            toggleBtn.setAttribute('aria-expanded','false');
        }
        toggleBtn.addEventListener('click', function(e){
            e.stopPropagation();
            if (sidebar.classList.contains('translate-x-0')) closeSidebar();
            else openSidebar();
        });
        closeBtn && closeBtn.addEventListener('click', function(){ closeSidebar(); });
        overlay.addEventListener('click', function(){ closeSidebar(); });

        // ensure overlay hidden when resizing to md+
        window.addEventListener('resize', function(){
            if (window.innerWidth >= 768) {
                overlay.classList.add('hidden');
                toggleBtn.setAttribute('aria-expanded','false');
            } else {
                // if sidebar not translated, ensure it's hidden by default on small screens
                if (!sidebar.classList.contains('translate-x-0')) {
                    sidebar.classList.add('-translate-x-full');
                }
            }
        });
    })();