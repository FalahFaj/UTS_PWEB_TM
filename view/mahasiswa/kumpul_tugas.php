<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kumpul Tugas - ēCoursie</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>

<body class="bg-gray-100">

    <div class="flex h-screen">
        <aside class="w-64 flex flex-col bg-[#1e293b] text-white p-4">
            <div class="text-2xl font-bold mb-10">ēCoursie</div>
            <nav class="flex flex-col space-y-2">
                <a href="index.php?action=mahasiswaDashboard"
                    class="flex items-center space-x-3 hover:bg-slate-700 rounded-lg p-3">
                    <ion-icon name="grid-outline" class="text-2xl"></ion-icon>
                    <span>Dashboard</span>
                </a>
                <a href="index.php?action=lihatTugas" class="flex items-center space-x-3 bg-violet-600 rounded-lg p-3">
                    <ion-icon name="albums-outline" class="text-2xl"></ion-icon>
                    <span class="font-semibold">Daftar Tugas</span>
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
                <a href="index.php?action=lihatTugas"
                    class="text-violet-600 hover:text-violet-800 flex items-center space-x-1 w-fit">
                    <ion-icon name="arrow-back-outline"></ion-icon>
                    <span>Kembali ke Daftar Tugas</span>
                </a>
            </div>

            <div class="max-w-3xl mx-auto bg-white p-8 rounded-2xl shadow-sm">
                <h1 class="text-3xl font-bold text-gray-800 mb-2"><?php echo htmlspecialchars($tugas['judul']); ?></h1>
                <div class="font-medium text-red-600 mb-4">
                    <ion-icon name="calendar-outline" class="mr-1"></ion-icon>
                    Deadline: <?php echo date('d M Y, H:i', strtotime($tugas['deadline'])); ?>
                </div>
                <p class="text-gray-700 mb-6"><?php echo nl2br(htmlspecialchars($tugas['deskripsi'])); ?></p>

                <?php if ($tugas['path_file']): ?>
                    <a href="<?php echo htmlspecialchars($tugas['path_file']); ?>"
                        class="inline-flex items-center space-x-2 px-4 py-2 bg-blue-100 text-blue-700 font-semibold rounded-lg text-sm hover:bg-blue-200 mb-8"
                        download>
                        <ion-icon name="download-outline"></ion-icon>
                        <span>Download File Tugas</span>
                    </a>
                <?php endif; ?>

                <hr class="my-6">

                <div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Pengumpulan Anda</h2>

                    <?php if (isset($error)): ?>
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
                            <span><?php echo htmlspecialchars($error); ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if ($sudah_mengumpulkan): ?>
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                            <ion-icon name="checkmark-circle-outline" class="text-xl"></ion-icon>
                            <span class="font-semibold">Anda sudah mengumpulkan tugas ini.</span>
                        </div>
                    <?php else: ?>
                        <form action="index.php?action=doKumpulTugas" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="tugas_id" value="<?php echo $tugas['id']; ?>">

                            <div class="mb-4">
                                <label for="file_kumpulan" class="block text-gray-700 text-sm font-bold mb-2">Upload File
                                    Jawaban Anda:</label>
                                <input type="file" id="file_kumpulan" name="file_kumpulan" class="block w-full text-sm text-gray-500
                                          file:mr-4 file:py-2 file:px-4
                                          file:rounded-lg file:border-0
                                          file:text-sm file:font-semibold
                                          file:bg-violet-50 file:text-violet-700
                                          hover:file:bg-violet-100" accept=".pdf, .doc, .docx, .zip, .rar, .jpg, .png"
                                    required>
                            </div>

                            <button type="submit"
                                class="w-full bg-violet-600 hover:bg-violet-700 text-white font-bold py-3 px-4 rounded-lg focus:outline-none focus:shadow-outline transition duration-200">
                                Kumpulkan Tugas
                            </button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>

</body>

</html>