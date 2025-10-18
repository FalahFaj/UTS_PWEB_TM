<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - ēCoursie</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>

<body class="bg-gray-100 font-sans">

    <div class="flex min-h-screen">
        <aside class="w-64 flex flex-col bg-[#1e293b] text-white p-4">
            <div class="text-2xl font-bold mb-10">ēCoursie</div>
            <nav class="flex flex-col space-y-2">
                <a href="#" class="flex items-center space-x-3 bg-violet-600 rounded-lg p-3">
                    <ion-icon name="grid-outline" class="text-2xl"></ion-icon>
                    <span class="font-semibold">Dashboard</span>
                </a>
                <a href="index.php?action=showUploadTugasForm"
                    class="flex items-center space-x-3 hover:bg-slate-700 rounded-lg p-3">
                    <ion-icon name="cloud-upload-outline" class="text-2xl"></ion-icon>
                    <span>Upload Tugas</span>
                </a>
                <a href="#" class="flex items-center space-x-3 hover:bg-slate-700 rounded-lg p-3">
                    <ion-icon name="book-outline" class="text-2xl"></ion-icon>
                    <span>Kelola Materi</span>
                </a>
                <a href="#" class="flex items-center space-x-3 hover:bg-slate-700 rounded-lg p-3">
                    <ion-icon name="people-outline" class="text-2xl"></ion-icon>
                    <span>Kelola User</span>
                </a>
                <a href="#" class="flex items-center space-x-3 hover:bg-slate-700 rounded-lg p-3">
                    <ion-icon name="settings-outline" class="text-2xl"></ion-icon>
                    <span>Settings</span>
                </a>
            </nav>
            <div class="mt-auto">
                <a href="index.php?action=logout" class="flex items-center space-x-3 hover:bg-slate-700 rounded-lg p-3">
                    <ion-icon name="log-out-outline" class="text-2xl"></ion-icon>
                    <span>Logout</span>
                </a>
            </div>
        </aside>

        <main class="flex-1 p-8 overflow-y-auto">
            <div class="flex justify-between items-center mb-8">
                <div class="flex items-center space-x-4">
                    <ion-icon name="search-outline" class="text-2xl text-gray-500"></ion-icon>
                    <input type="text" placeholder="Search..."
                        class="bg-white rounded-lg px-4 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex items-center space-x-6">
                    <span class="text-gray-600 font-medium">Today, <?php echo date('D, d M'); ?></span>
                    <ion-icon name="notifications-outline" class="text-2xl text-gray-500 cursor-pointer"></ion-icon>
                    <div class="flex items-center space-x-2">
                        <?php
                            $avatar_path = (!empty($_SESSION['user_foto']) && file_exists($_SESSION['user_foto']))
                                ? $_SESSION['user_foto']
                                : 'https://i.pravatar.cc/150?u=admin' . $_SESSION['user_id'];
                        ?>
                        <img src="<?php echo htmlspecialchars($avatar_path); ?>" alt="Admin Avatar" class="w-10 h-10 rounded-full object-cover">
                        <span class="font-medium text-gray-800"><?php echo htmlspecialchars($nama_admin); ?></span>
                        <ion-icon name="chevron-down-outline" class="text-gray-500"></ion-icon>
                    </div>
                </div>
            </div>

            <div class="mb-8 bg-gradient-to-r from-blue-500 to-violet-600 text-white p-6 rounded-xl shadow-lg">
                <h1 class="text-4xl font-bold mb-2">Hello, <?php echo htmlspecialchars($nama_admin); ?>! 👋</h1>
                <p class="text-blue-100">Ini adalah ringkasan aktivitas di platform Anda bulan ini.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-700">Total Materi</h3>
                        <ion-icon name="library-outline" class="text-2xl text-violet-500"></ion-icon>
                    </div>
                    <p class="text-4xl font-bold text-gray-900"><?php echo $statistik_admin['total_materi']; ?></p>
                    <p class="text-sm text-gray-500 mt-1">Materi yang telah diunggah</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-700">Total Tugas</h3>
                        <ion-icon name="document-text-outline" class="text-2xl text-blue-500"></ion-icon>
                    </div>
                    <p class="text-4xl font-bold text-gray-900"><?php echo $statistik_admin['total_tugas']; ?></p>
                    <p class="text-sm text-gray-500 mt-1">Tugas yang telah dibuat</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-700">Total Admin</h3>
                        <ion-icon name="person-circle-outline" class="text-2xl text-green-500"></ion-icon>
                    </div>
                    <p class="text-4xl font-bold text-gray-900"><?php echo $statistik_admin['total_admin']; ?></p>
                    <p class="text-sm text-gray-500 mt-1">Pengguna dengan role admin</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-700">Total Mahasiswa</h3>
                        <ion-icon name="people-outline" class="text-2xl text-red-500"></ion-icon>
                    </div>
                    <p class="text-4xl font-bold text-gray-900"><?php echo $statistik_admin['total_mahasiswa']; ?></p>
                    <p class="text-sm text-gray-500 mt-1">Total mahasiswa terdaftar</p>
                </div>
            </div>

            <h2 class="text-2xl font-bold text-gray-800 mb-6">Daftar Mata Kuliah</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($daftar_matakuliah_admin as $matkul): ?>
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 flex flex-col justify-between">
                        <div>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">
                                <?php echo htmlspecialchars($matkul['judul']); ?></h3>
                            <p class="text-gray-600 text-sm mb-4"><?php echo htmlspecialchars($matkul['deskripsi']); ?></p>
                        </div>
                        <div class="flex justify-between items-center text-gray-500 text-sm">
                            <span>Dosen: <span
                                    class="font-medium"><?php echo htmlspecialchars($matkul['dosen']); ?></span></span>
                            <a href="#" class="text-violet-600 hover:text-violet-800">Detail &rarr;</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </main>
    </div>

</body>

</html>