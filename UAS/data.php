<?php
$servername = "localhost";
$database = "dbreservasihotel";
$username = "root";
$password = "";
 
$conn = mysqli_connect($servername, $username, $password,$database);

if (!$conn) {
    die("koneksi gagal : " .mysqli_connect_error());
} else {
    echo "koneksi berhasil";
    mysqli_set_charset($conn, "utf8");
}

// Start session untuk menyimpan data sementara
session_start();

// Inisialisasi data jika belum ada
if (!isset($_SESSION['dataPerson'])) {
    $_SESSION['dataPerson'] = [
        ['id' => 1, 'nama' => 'Ahmad', 'nik' => '1234567890', 'tgl_lahir' => '1990-01-01', 'jenis_kelamin' => 'Laki-Laki', 'no_hp' => '081234567890', 'email' => 'ahmad@example.com', 'alamat' => 'Jakarta', 'foto' => 'foto1.jpg'],
        ['id' => 2, 'nama' => 'Siti', 'nik' => '0987654321', 'tgl_lahir' => '1995-05-15', 'jenis_kelamin' => 'Perempuan', 'no_hp' => '081987654321', 'email' => 'siti@example.com', 'alamat' => 'Bandung', 'foto' => 'foto2.jpg']
    ];
}


// Hapus Data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    unset($_SESSION['dataPerson'][$id]);
    $_SESSION['dataPerson'] = array_values($_SESSION['dataPerson']); // Reindex array
}


$dataPerson = $_SESSION['dataPerson'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Person</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table, th, td { border: 1px solid #ddd; text-align: center; }
        th, td { padding: 10px; }
        th { background-color: #007bff; color: white; }
        .btn { padding: 5px 10px; text-decoration: none; color: white; border-radius: 4px; }
        .btn-edit { background-color: #f1c40f; }
        .btn-hapus { background-color: #e74c3c; }
        input, button { padding: 5px; }
        form { margin: 10px 0; }
        img { width: 50px; height: 50px; border-radius: 50%; }
    </style>
</head>
<body>
    <h2>Data Person</h2>

    <!-- Form Pencarian -->
    <form method="GET">
        <input type="text" name="cari" placeholder="Masukkan kata kunci..." value="<?php echo htmlspecialchars($search); ?>">
        <button type="submit" class="btn btn-cari">Cari</button>
        <a href="?"><button type="button" class="btn btn-hapus">Reset</button></a>
    </form>

    
    <!-- Tabel Data -->
    <table>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>NIK</th>
            <th>Tanggal Lahir</th>
            <th>Jenis Kelamin</th>
            <th>No Handphone</th>
            <th>Email</th>
            <th>Alamat</th>
            <th>Foto</th>
            <th>Aksi</th>
        </tr>
        <?php if (count($dataPerson) > 0): ?>
            <?php foreach ($dataPerson as $index => $item): ?>
                <tr>
                    <td><?php echo $item['id']; ?></td>
                    <td><?php echo htmlspecialchars($item['nama']); ?></td>
                    <td><?php echo htmlspecialchars($item['nik']); ?></td>
                    <td><?php echo htmlspecialchars($item['tgl_lahir']); ?></td>
                    <td><?php echo htmlspecialchars($item['jenis_kelamin']); ?></td>
                    <td><?php echo htmlspecialchars($item['no_hp']); ?></td>
                    <td><?php echo htmlspecialchars($item['email']); ?></td>
                    <td><?php echo htmlspecialchars($item['alamat']); ?></td>
                    <td><img src="fitri.jpg"<?php echo htmlspecialchars($item['foto']); ?> alt="Fitri"></td>
                    <td>
                        <a href="inputdata.php" class="btn btn-edit">Edit</a>
                        <a href="?hapus=<?php echo $index; ?>" onclick="return confirm('Yakin ingin menghapus?')" class="btn btn-hapus">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="10">Tidak ada data.</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>
