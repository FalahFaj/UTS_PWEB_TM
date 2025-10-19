<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Tugas - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>
<body class="bg-gray-100">

<div class="flex h-screen">
    <aside class="w-64 flex flex-col bg-[#1e293b] text-white p-4">
        <div class="text-2xl font-bold mb-10 pl-3">TUGasin</div>
        <nav class="flex flex-col space-y-2">
            <a href="index.php?action=adminDashboard" class="flex items-center space-x-3 hover:bg-slate-700 rounded-lg p-3">
                <ion-icon name="grid-outline" class="text-2xl"></ion-icon>
                <span class="font-semibold">Dashboard</span>
            </a>
            <a href="index.php?action=listTugasAdmin" class="flex items-center space-x-3 bg-violet-600 rounded-lg p-3">
                <ion-icon name="albums-outline" class="text-2xl"></ion-icon>
                <span>Kelola Tugas</span>
            </a>
            <a href="index.php?action=showUploadTugas" class="flex items-center space-x-3 hover:bg-slate-700 rounded-lg p-3">
                <ion-icon name="cloud-upload-outline" class="text-2xl"></ion-icon>
                <span>Upload Tugas</span>
            </a>
            </nav>
        <div class="mt-auto flex flex-col space-y-2">
             <a href="index.php?action=logout" class="flex items-center space-x-3 hover:bg-slate-700 rounded-lg p-3">
                <ion-icon name="log-out-outline" class="text-2xl"></ion-icon>
                <span>Logout</span>
            </a>
        </div>
    </aside>

    <main class="flex-1 p-8 overflow-y-auto">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Kelola Daftar Tugas</h1>
            <a href="index.php?action=showUploadTugasForm" class="px-5 py-2 bg-violet-600 text-white font-semibold rounded-lg hover:bg-violet-700 flex items-center space-x-2">
                <ion-icon name="add-outline" class="text-xl"></ion-icon>
                <span>Buat Tugas Baru</span>
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul Tugas</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Dibuat Oleh</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Deadline</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (empty($daftar_tugas)): ?>
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada tugas yang dibuat.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($daftar_tugas as $tugas): ?>
                            <tr>
                                <td class="px-6 py-4 font-medium text-gray-900"><?php echo htmlspecialchars($tugas['judul']); ?></td>
                                <td class="px-6 py-4 text-gray-700"><?php echo htmlspecialchars($tugas['nama_admin']); ?></td>
                                <td class="px-6 py-4 text-gray-700"><?php echo date('d M Y, H:i', strtotime($tugas['deadline'])); ?></td>
                                <td class="px-6 py-4 text-right">
                                    <a href="index.php?action=lihatSubmissions&tugas_id=<?php echo $tugas['id']; ?>" class="font-medium text-violet-600 hover:text-violet-900">
                                        Lihat Pengumpulan
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>
</div>

</body>
</html>