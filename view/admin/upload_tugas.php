<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Tugas Baru</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-2xl bg-white p-8 rounded-xl shadow-lg">
        <a href="index.php?action=adminDashboard" class="text-violet-600 hover:text-violet-800">&larr; Kembali ke Dashboard</a>
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6 mt-4">Buat Tugas Baru</h2>

        <?php if (isset($error)): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
                <span><?php echo htmlspecialchars($error); ?></span>
            </div>
        <?php endif; ?>
        <?php if (isset($success)): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4">
                <span><?php echo htmlspecialchars($success); ?></span>
            </div>
        <?php endif; ?>

        <form action="index.php?action=doUploadTugas" method="POST" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="judul" class="block text-gray-700 text-sm font-bold mb-2">Judul Tugas</label>
                <input type="text" id="judul" name="judul" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-violet-500" required>
            </div>
            
            <div class="mb-4">
                <label for="deskripsi" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" rows="4" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-violet-500"></textarea>
            </div>

            <div class="mb-4">
                <label for="deadline" class="block text-gray-700 text-sm font-bold mb-2">Deadline</label>
                <input type="datetime-local" id="deadline" name="deadline" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-violet-500" required>
            </div>

            <div class="mb-6">
                <label for="file_tugas" class="block text-gray-700 text-sm font-bold mb-2">File Lampiran (Opsional)</label>
                <input type="file" id="file_tugas" name="file_tugas" 
                       class="block w-full text-sm text-gray-500
                              file:mr-4 file:py-2 file:px-4
                              file:rounded-lg file:border-0
                              file:text-sm file:font-semibold
                              file:bg-violet-50 file:text-violet-700
                              hover:file:bg-violet-100"
                       accept=".pdf, .doc, .docx, .zip, .rar">
            </div>

            <button type="submit" class="w-full bg-violet-600 hover:bg-violet-700 text-white font-bold py-3 px-4 rounded-lg focus:outline-none focus:shadow-outline transition duration-200">
                Upload Tugas
            </button>
        </form>
    </div>

</body>
</html>