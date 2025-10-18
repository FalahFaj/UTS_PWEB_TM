<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>

<body class="bg-gray-100">

    <div class="flex h-screen">
        <button id="sidebarToggle" aria-expanded="false"
            class="fixed top-4 left-4 z-[60] p-2 rounded-md bg-white text-gray-800 shadow-lg lg:hidden transition">
            <ion-icon id="menuIcon" name="menu-outline" class="text-2xl"></ion-icon>
        </button>

        <!-- Overlay gelap -->
        <div id="sidebar-overlay" class="hidden fixed inset-0 bg-black bg-opacity-40 z-30 lg:hidden"></div>

        <!-- Sidebar -->
        <aside id="sidebar"
            class="fixed inset-y-0 left-0 z-40 w-64 transform -translate-x-full lg:translate-x-0 lg:static lg:inset-auto lg:transform-none transition-transform bg-[#1e293b] text-white p-4 flex flex-col">

            <div class="flex items-start justify-between">
                <div class="text-2xl font-bold mb-10">TUGasin</div>

                <!-- Tombol close khusus mobile -->
                <button id="sidebarClose" class="lg:hidden p-2 rounded-md bg-[#0f172a] ml-2">
                    <ion-icon name="close-outline" class="text-xl"></ion-icon>
                </button>
            </div>

            <nav class="flex flex-col space-y-2 mt-2">
                <a href="#" class="flex items-center space-x-3 bg-violet-600 rounded-lg p-3">
                    <ion-icon name="grid-outline" class="text-2xl"></ion-icon>
                    <span class="font-semibold">Dashboard</span>
                </a>
                <a href="#" class="flex items-center space-x-3 hover:bg-slate-700 rounded-lg p-3">
                    <ion-icon name="albums-outline" class="text-2xl"></ion-icon>
                    <span>All Courses</span>
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

        <!-- Main content (card besar) -->
        <main
            class="flex-1 bg-gray-50 relative z-10 p-10 lg:p-12 lg:rounded-l-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.05)] lg:-ml-12 overflow-y-auto">

            <div class="flex">
                <!-- Bagian kiri -->
                <div class="pl-8 w-full lg:w-2/3 pr-8">
                    <div class="flex justify-between items-center mb-8">
                        <h1 class="text-3xl font-bold text-[#1E1E2D]">My Courses</h1>
                        <div class="flex items-center space-x-4 text-gray-500">
                            <ion-icon name="search-outline"
                                class="text-2xl cursor-pointer hover:text-gray-700 transition"></ion-icon>
                            <ion-icon name="notifications-outline"
                                class="text-2xl cursor-pointer hover:text-gray-700 transition"></ion-icon>
                        </div>
                    </div>

                    <!-- Filter buttons -->
                    <div class="flex space-x-4 mb-10">
                        <button
                            class="bg-white px-5 py-2.5 rounded-xl shadow-md hover:shadow-lg text-gray-700 text-sm font-medium border border-gray-100 transition">Time</button>
                        <button
                            class="bg-white px-5 py-2.5 rounded-xl shadow-md hover:shadow-lg text-gray-700 text-sm font-medium border border-gray-100 transition">Level</button>
                        <button
                            class="bg-white px-5 py-2.5 rounded-xl shadow-md hover:shadow-lg text-gray-700 text-sm font-medium border border-gray-100 transition">Language</button>
                    </div>

                    <!-- Course cards -->
                    <div class="space-y-8">
                        <?php foreach ($daftar_matakuliah as $matkul): ?>
                            <div
                                class="<?php echo $matkul['bg_color']; ?> p-6 rounded-3xl flex items-center justify-between shadow-[0_10px_25px_rgba(0,0,0,0.08)] hover:shadow-[0_15px_40px_rgba(0,0,0,0.12)] transition-all duration-300 transform hover:-translate-y-1">

                                <div class="flex items-center space-x-6">
                                    <div class="p-4 bg-white rounded-2xl shadow-sm">
                                        <ion-icon name="desktop-outline"
                                            class="text-4xl <?php echo $matkul['icon_color']; ?>"></ion-icon>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-lg text-gray-800">
                                            <?php echo htmlspecialchars($matkul['nama_matkul']); ?>
                                        </h3>
                                        <p class="text-gray-600 text-sm">
                                            <?php echo htmlspecialchars($matkul['deskripsi']); ?>
                                        </p>
                                        <p class="text-gray-500 text-xs mt-2">Created by
                                            <span
                                                class="font-medium text-gray-700"><?php echo htmlspecialchars($matkul['nama_dosen']); ?></span>
                                        </p>
                                    </div>
                                </div>

                                <a href="#"
                                    class="p-4 bg-white rounded-full text-gray-600 shadow-md hover:bg-gray-100 transition">
                                    <ion-icon name="chevron-forward-outline" class="text-xl"></ion-icon>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Bagian kanan -->
                <div class="hidden lg:block w-1/3 pl-10 border-l border-gray-200">
                    <div class="flex items-center justify-end mb-10">
                        <div class="text-right">
                            <div class="font-semibold text-gray-800"><?php echo htmlspecialchars($user['nama']); ?>
                            </div>
                            <div class="text-sm text-gray-500"><?php echo htmlspecialchars($user['nim']); ?></div>
                        </div>
                        <?php
                            $avatar_path = (!empty($user['foto_path']) && file_exists($user['foto_path']))
                                ? $user['foto_path']
                                : 'https://i.pravatar.cc/150?u=' . htmlspecialchars($user['nim']);
                        ?>
                        <img src="<?php echo htmlspecialchars($avatar_path); ?>" alt="Avatar" class="w-12 h-12 rounded-full object-cover ml-4 shadow-md">
                    </div>
                    <div class="bg-white p-5 rounded-2xl shadow-[0_10px_25px_rgba(0,0,0,0.05)] mb-8">
                        <h3 class="text-gray-700 font-semibold mb-3">Kalender</h3>
                        <div id="calendar" class="text-center"></div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="assets/js/kalender.js"></script>
    <script src="assets/js/sidebar.js"></script>
</body>

</html>