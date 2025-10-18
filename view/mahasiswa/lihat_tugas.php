<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tugas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>

<body class="bg-gray-100">

    <div class="flex h-screen">
        <aside class="w-64 flex flex-col bg-[#1e293b] text-white p-4">
            <div class="text-2xl font-bold mb-10">TUGasin</div>
            <nav class="flex flex-col space-y-2">
                <a href="index.php?action=mahasiswaDashboard"
                    class="flex items-center space-x-3 hover:bg-slate-700 rounded-lg p-3">
                    <ion-icon name="grid-outline" class="text-2xl"></ion-icon>
                    <span class="font-semibold">Dashboard</span>
                </a>
                <a href="index.php?action=lihatTugas" class="flex items-center space-x-3 bg-violet-600 rounded-lg p-3">
                    <ion-icon name="albums-outline" class="text-2xl"></ion-icon>
                    <span>Daftar Tugas</span>
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
            <h1 class="text-3xl font-bold text-gray-800 mb-8">Daftar Tugas</h1>

            <div class="space-y-6">

                <?php if (empty($daftar_tugas)): ?>
                    <div class="bg-white p-6 rounded-2xl shadow-sm text-center text-gray-500">
                        <ion-icon name="checkmark-done-circle-outline" class="text-5xl text-green-500"></ion-icon>
                        <h3 class="font-semibold text-lg mt-2">Belum Ada Tugas</h3>
                        <p>Semua tugas sudah selesai atau belum ada tugas baru.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($daftar_tugas as $tugas): ?>
                        <div
                            class="bg-white p-6 rounded-2xl shadow-sm flex flex-col md:flex-row items-start md:items-center justify-between">
                            <div class="flex items-start space-x-5">
                                <div class="p-3 bg-violet-100 rounded-xl">
                                    <ion-icon name="document-text-outline" class="text-3xl text-violet-600"></ion-icon>
                                </div>
                                <div>
                                    <h3 class="font-bold text-lg text-gray-800"><?php echo htmlspecialchars($tugas['judul']); ?>
                                    </h3>
                                    <p class="text-gray-600 text-sm mt-1"><?php echo htmlspecialchars($tugas['deskripsi']); ?>
                                    </p>
                                    <div class="flex items-center space-x-4 mt-2 text-sm text-gray-500">
                                        <span>
                                            <ion-icon name="person-outline" class="mr-1"></ion-icon>
                                            <?php echo htmlspecialchars($tugas['nama_admin']); ?>
                                        </span>
                                        <span
                                            class="font-medium <?php echo (strtotime($tugas['deadline']) < time()) ? 'text-red-500' : 'text-green-600'; ?>">
                                            <ion-icon name="calendar-outline" class="mr-1"></ion-icon>
                                            Deadline: <?php echo date('d M Y, H:i', strtotime($tugas['deadline'])); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex space-x-3 mt-4 md:mt-0 md:ml-6 flex-shrink-0">
                                <?php if ($tugas['path_file']): ?>
                                    <a href="<?php echo htmlspecialchars($tugas['path_file']); ?>"
                                        class="px-4 py-2 bg-blue-100 text-blue-700 font-semibold rounded-lg text-sm hover:bg-blue-200"
                                        download>
                                        Download
                                    </a>
                                <?php endif; ?>
                                <a href="#"
                                    class="px-4 py-2 bg-violet-600 text-white font-semibold rounded-lg text-sm hover:bg-violet-700">
                                    Kumpulkan
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>
        </main>
    </div>

</body>

</html>