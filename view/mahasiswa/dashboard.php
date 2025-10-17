<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <style>
    /* FullCalendar visual tweaks to match Tailwind look and avoid inner scrollbars */
    .fc {
        font-family: Inter, ui-sans-serif, system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
    }
    .fc .fc-toolbar-title { font-size: 1.125rem; font-weight: 600; color: #0f172a; }
    .fc .fc-button { border: none; padding: .35rem .6rem; border-radius: .5rem; background: #f1f5f9; color: #0f172a; }
    .fc .fc-button:hover { background: #eef2ff; }
    .fc .fc-button-primary { background: #7c3aed; color: #fff; }
    .fc .fc-button-primary:hover { background: #6d28d9; }
    .fc .fc-daygrid-day-number { font-weight: 600; color: #0f172a; }
    .fc .fc-daygrid-day-frame { padding: .25rem .25rem; }
    .fc .fc-daygrid-event { background-color: #7c3aed; border: none; color: #fff; padding: 2px 6px; border-radius: 6px; font-size: 0.75rem; }
    /* prevent internal calendar scrollbars and let it grow inside the card */
    .fc .fc-scrollgrid, .fc .fc-scroller { overflow: visible !important; max-height: none !important; }
    /* ensure calendar fits the card */
    #calendar { width: 100%; }
    /* custom pill / selected day styles like sample */
    .fc .fc-daygrid-day { position: relative; }
    .fc .fc-daygrid-day .fc-daygrid-day-number { z-index: 5; position: relative; }
    .fc .fc-daygrid-day.selected .fc-daygrid-day-number {
        background: #7c3aed; color: #fff; display: inline-block; width: 2rem; height: 2rem; line-height: 2rem; border-radius: 9999px; text-align: center; font-weight: 700;
    }
    .fc .fc-daygrid-day.today-custom .fc-daygrid-day-number {
        background: rgba(124,58,237,0.12); color: #0f172a; display: inline-block; width: 2rem; height: 2rem; line-height: 2rem; border-radius: 9999px; text-align: center; font-weight: 700;
    }
    .fc .fc-daygrid-day.inrange .fc-daygrid-day-number {
        background: rgba(124,58,237,0.22); color: #0f172a; display: inline-block; width: 2rem; height: 2rem; line-height: 2rem; border-radius: 9999px; text-align: center; font-weight: 700;
    }
    </style>
</head>
<body class="bg-gray-100">

<div class="flex h-screen">
    <aside class="w-64 flex flex-col bg-[#1e293b] text-white p-4">
        <div class="text-2xl font-bold mb-10">ēCoursie</div>
        <nav class="flex flex-col space-y-2">
            <a href="#" class="flex items-center space-x-3 bg-violet-600 rounded-lg p-3">
                <ion-icon name="grid-outline" class="text-2xl"></ion-icon>
                <span class="font-semibold">Dashboard</span>
            </a>
            <a href="#" class="flex items-center space-x-3 hover:bg-slate-700 rounded-lg p-3">
                <ion-icon name="albums-outline" class="text-2xl"></ion-icon>
                <span>All Courses</span>
            </a>
            <a href="#" class="flex items-center space-x-3 hover:bg-slate-700 rounded-lg p-3">
                <ion-icon name="chatbubble-ellipses-outline" class="text-2xl"></ion-icon>
                <span>Messages</span>
            </a>
            <a href="#" class="flex items-center space-x-3 hover:bg-slate-700 rounded-lg p-3">
                <ion-icon name="people-outline" class="text-2xl"></ion-icon>
                <span>Friends</span>
            </a>
            <a href="#" class="flex items-center space-x-3 hover:bg-slate-700 rounded-lg p-3">
                <ion-icon name="calendar-outline" class="text-2xl"></ion-icon>
                <span>Schedule</span>
            </a>
        </nav>
        <div class="mt-auto flex flex-col space-y-2">
             <a href="#" class="flex items-center space-x-3 hover:bg-slate-700 rounded-lg p-3">
                <ion-icon name="settings-outline" class="text-2xl"></ion-icon>
                <span>Settings</span>
            </a>
             <a href="index.php?action=logout" class="flex items-center space-x-3 hover:bg-slate-700 rounded-lg p-3">
                <ion-icon name="log-out-outline" class="text-2xl"></ion-icon>
                <span>Logout</span>
            </a>
        </div>
    </aside>

    <main class="flex-1 p-8 overflow-y-auto">
        <div class="flex">
            <div class="w-full lg:w-2/3 pr-8">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-3xl font-bold text-gray-800">My Courses</h1>
                    <div>
                        <ion-icon name="search-outline" class="text-2xl text-gray-500 mr-4"></ion-icon>
                        <ion-icon name="notifications-outline" class="text-2xl text-gray-500"></ion-icon>
                    </div>
                </div>

                <div class="flex space-x-4 mb-8">
                    <button class="bg-white px-4 py-2 rounded-lg border text-gray-600">Time</button>
                    <button class="bg-white px-4 py-2 rounded-lg border text-gray-600">Level</button>
                    <button class="bg-white px-4 py-2 rounded-lg border text-gray-600">Language</button>
                </div>
                
                <div class="space-y-6">
                    <?php foreach ($daftar_matakuliah as $matkul): ?>
                    <div class="<?php echo $matkul['bg_color']; ?> p-6 rounded-2xl flex items-center justify-between shadow-sm">
                        <div class="flex items-center space-x-6">
                            <div class="p-4 bg-white rounded-xl">
                                <ion-icon name="desktop-outline" class="text-4xl <?php echo $matkul['icon_color']; ?>"></ion-icon>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg text-gray-800"><?php echo htmlspecialchars($matkul['nama_matkul']); ?></h3>
                                <p class="text-gray-600 text-sm"><?php echo htmlspecialchars($matkul['deskripsi']); ?></p>
                                <p class="text-gray-500 text-xs mt-2">Created by <?php echo htmlspecialchars($matkul['nama_dosen']); ?></p>
                            </div>
                        </div>
                        <a href="#" class="p-3 bg-white rounded-full text-gray-600 hover:bg-gray-200">
                            <ion-icon name="chevron-forward-outline" class="text-xl"></ion-icon>
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="hidden lg:block w-1/3 pl-8 border-l border-gray-200">
                <div class="flex items-center justify-end mb-8">
                    <div class="text-right">
                        <div class="font-semibold text-gray-800"><?php echo htmlspecialchars($user['nama']); ?></div>
                        <div class="text-sm text-gray-500"><?php echo htmlspecialchars($user['nim']); ?></div>
                    </div>
                    <img src="https://i.pravatar.cc/150?u=<?php echo htmlspecialchars($user['nim']); ?>" alt="Avatar" class="w-12 h-12 rounded-full ml-4">
                </div>
                
                <!-- FullCalendar integration -->
                <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css' rel='stylesheet' />
                <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.19/index.global.min.js'></script>

                <div class="bg-white p-4 rounded-xl shadow-sm mb-8">
                    <div id="fc-root"></div>
                </div>

                <div>
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-semibold text-gray-800">Online Users</h3>
                        <a href="#" class="text-sm text-violet-600">See all</a>
                    </div>
                    <div class="space-y-4">
                        <?php foreach($online_users as $online_user): ?>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <img src="https://i.pravatar.cc/150?u=<?php echo htmlspecialchars($online_user['nim']); ?>" alt="User Avatar" class="w-10 h-10 rounded-full mr-3">
                                <div>
                                    <div class="font-semibold text-sm text-gray-700"><?php echo htmlspecialchars($online_user['nama']); ?></div>
                                    <div class="text-xs text-gray-500"><?php echo htmlspecialchars($online_user['nim']); ?></div>
                                </div>
                            </div>
                            <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

</body>
</html>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.createElement('div');
    calendarEl.id = 'calendar';
    calendarEl.style.minHeight = '350px';
    document.getElementById('fc-root').appendChild(calendarEl);

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        firstDay: 1, // Monday
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek'
        },
        events: 'index.php?action=events',
        height: 'auto',
        aspectRatio: 1.35,
        navLinks: true,
        dayMaxEventRows: 2,
        dateClick: function(info) {
            // mark selected date
            setSelectedDate(info.dateStr);
        },
        viewDidMount: function() {
            applyDecorations();
        },
        datesSet: function() {
            // called on navigation
            applyDecorations();
        },
        eventClick: function(info) {
            alert(info.event.title + '\n' + (info.event.extendedProps.description || ''));
        }
    });

    calendar.render();
    // manage selected date UI
    var selectedDate = null;
    function setSelectedDate(dateStr) {
        selectedDate = dateStr;
        applyDecorations();
    }

    function applyDecorations() {
        // clear previous
        document.querySelectorAll('.fc-daygrid-day').forEach(function(el){
            el.classList.remove('selected','today-custom','inrange');
        });

        // mark today
        var today = new Date();
        var todayStr = today.toISOString().slice(0,10);
        document.querySelectorAll('.fc-daygrid-day[data-date="'+todayStr+'"]').forEach(function(el){
            el.classList.add('today-custom');
        });

        // mark selected
        if (selectedDate) {
            document.querySelectorAll('.fc-daygrid-day[data-date="'+selectedDate+'"]').forEach(function(el){
                el.classList.add('selected');
            });
        }
    }
});
</script>