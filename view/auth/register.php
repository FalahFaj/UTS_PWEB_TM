<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - ēCoursie</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-lg">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Buat Akun Baru</h2>

        <?php if (isset($error)): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4" role="alert">
                <span class="block sm:inline"><?php echo htmlspecialchars($error); ?></span>
            </div>
        <?php endif; ?>

        <form action="index.php?action=doRegister" method="POST" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="nama" class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-violet-500" required>
            </div>

            <div class="mb-4">
                <label for="nim" class="block text-gray-700 text-sm font-bold mb-2">NIM</label>
                <input type="text" id="nim" name="nim" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-violet-500" required>
            </div>
            
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <input type="email" id="email" name="email" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-violet-500" required>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="password" id="password" name="password" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-violet-500" required>
            </div>

            <div class="mb-6">
                <label for="confirm_password" class="block text-gray-700 text-sm font-bold mb-2">Konfirmasi Password</label>
                <input type="password" id="confirm_password" name="confirm_password" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-violet-500" required>
            </div>

            <div class="mb-6">
                <label for="role" class="block text-gray-700 text-sm font-bold mb-2">Daftar sebagai:</label>
                <select id="role" name="role" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-violet-500">
                    <option value="mahasiswa">Mahasiswa</option>
                    <option value="dosen">Dosen</option>
                </select>
            </div>
            <div class="mb-6">
                <label for="foto" class="block text-gray-700 text-sm font-bold mb-2">Foto Profil (Opsional)</label>
                <input type="file" id="foto" name="foto" 
                       class="block w-full text-sm text-gray-500
                              file:mr-4 file:py-2 file:px-4
                              file:rounded-lg file:border-0
                              file:text-sm file:font-semibold
                              file:bg-violet-50 file:text-violet-700
                              hover:file:bg-violet-100"
                       accept="image/png, image/jpeg, image/jpg"> 
            </div>

            <button type="submit" class="w-full bg-violet-600 hover:bg-violet-700 text-white font-bold py-3 px-4 rounded-lg focus:outline-none focus:shadow-outline transition duration-200">
                Register
            </button>
        </form>

        <p class="text-center text-gray-600 text-sm mt-6">
            Sudah punya akun?
            <a href="index.php?action=login" class="font-bold text-violet-600 hover:text-violet-800">
                Login di sini
            </a>
        </p>
    </div>

</body>
</html>