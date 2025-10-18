<!DOCTYPE html>
<html lang="id">
<head>
    <title>Dashboard Admin</title>
    <style>body { font-family: sans-serif; padding: 20px; }</style>
</head>
<body>

    <h1>Selamat Datang, <?php echo htmlspecialchars($nama_admin); ?>! 👋</h1>
    <p>Anda telah berhasil login sebagai **Admin**.</p>
    
    <p>Menu (akan dibuat nanti):</p>
    <ul>
        <li>Upload Materi</li>
        <li>Buat Tugas</li>
        <li>Lihat Pengumpulan Tugas</li>
    </ul>

    <br>
    <a href="index.php?action=logout">Logout</a>

</body>
</html>