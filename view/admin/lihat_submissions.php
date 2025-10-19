<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengumpulan Tugas - Admin</title>
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
            <a href="index.php?action=showUploadTugasForm" class="flex items-center space-x-3 hover:bg-slate-700 rounded-lg p-3">
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
        <div class="mb-6">
            <a href="index.php?action=listTugasAdmin" class="text-violet-600 hover:text-violet-800 flex items-center space-x-1 w-fit">
                <ion-icon name="arrow-back-outline"></ion-icon>
                <span>Kembali ke Daftar Tugas</span>
            </a>
        </div>
        
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Pengumpulan Tugas</h1>
        <p class="text-xl text-gray-600 mb-8">Untuk: <span class="font-semibold"><?php echo htmlspecialchars($tugas['judul']); ?></span></p>

        <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Mahasiswa</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Waktu Kumpul</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">File</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (empty($daftar_submissions)): ?>
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada mahasiswa yang mengumpulkan tugas ini.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($daftar_submissions as $sub): ?>
                            <tr>
                                <td class="px-6 py-4 font-medium text-gray-900"><?php echo htmlspecialchars($sub['nama_mahasiswa']); ?></td>
                                <td class="px-6 py-4 text-gray-700"><?php echo htmlspecialchars($sub['email_mahasiswa']); ?></td>
                                <td class="px-6 py-4 text-gray-700"><?php echo date('d M Y, H:i', strtotime($sub['submitted_at'])); ?></td>
                                <td class="px-6 py-4 text-right">
                                    <a href="<?php echo htmlspecialchars($sub['path_file']); ?>" 
                                       class="px-3 py-1 bg-blue-100 text-blue-700 font-semibold rounded-md text-xs hover:bg-blue-200" 
                                       download="<?php echo htmlspecialchars($sub['nama_file']); ?>">
                                       Download
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