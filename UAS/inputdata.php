<?php
// Start session untuk menyimpan data sementara
session_start();

// Inisialisasi data jika belum ada
if (!isset($_SESSION['inventaris'])) {
    $_SESSION['inventaris'] = [];
}

// Proses Simpan Data
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['simpan'])) {
    $id = htmlspecialchars($_POST['id']);
    $nama = htmlspecialchars($_POST['nama']);
    $nik = htmlspecialchars($_POST['nik']);
    $tanggallahir = htmlspecialchars($_POST['tanggallahir']);
    $jeniskelamin = htmlspecialchars($_POST['jeniskelamin']);
    $nohandphone = htmlspecialchars($_POST['nohandphone']);
    $email = htmlspecialchars($_POST['email']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $foto = htmlspecialchars($_POST['foto']);

    // Simpan ke sesi (database sementara)
    $_SESSION['inventaris'][] = [
        'id' => $kodeBarang,
        'namaBarang' => $id,
        'asalBarang' => $asalBarang,
        'jumlah' => $jumlah,
        'satuan' => $satuan,
        'tanggalDiterima' => $tanggalDiterima
    ];

    $successMessage = "Data berhasil disimpan!";
}

// Proses Reset Data
if (isset($_POST['reset'])) {
    session_unset();
    session_destroy();
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            padding: 20px;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }
        h2 {
            text-align: center;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            padding: 10px;
            border: none;
            border-radius: 4px;
            color: white;
            cursor: pointer;
            font-weight: bold;
        }
        .simpan {
            background-color: #007bff;
        }
        .reset {
            background-color: #e74c3c;
            float: right;
        }
        .success {
            color: green;
            text-align: center;
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Form Input Data</h2>
        
        <?php if (isset($successMessage)): ?>
            <div class="success"><?php echo $successMessage; ?></div>
        <?php endif; ?>

        <!-- Form Input Data -->
        <form method="post">
            <label for="id">Id</label>
            <input type="text" id="id" name="id" value="001" readonly>

            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" placeholder="Masukkan Nama" required>

            <label for="nik">NIK</label>
            <input type="number" id="nik" name="nik" placeholder="Masukkan Nik" required>

            <label for="tanggallahir">Tanggal Lahir</label>
            <input type="date" id="tanggallahir" name="tanggallahir" required>

            <label for="jeniskelamin">Jenis Kelamin</label>
            <select id="jeniskelamin" name="jeniskelamin" required>
                <option value="" disabled selected>Pilih</option>
                <option value="Laki-Laki">Laki-Laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>

            <label for="nohandphone">No Handphone</label>
            <input type="number" id="nohandphone" name="nohandphone" placeholder="Masukkan Nomor" required>
            
            <label for="email">Email</label>
            <input type="text" id="email" name="email" placeholder="Masukkan Email" required>

            <label for="alamat">Alamat</label>
            <input type="text" id="alamat" name="alamat" placeholder="Masukkan Alamat" required>

            <label for="foto">Foto</label>
            <input type="img" id="foto" name="foto" placeholder="Masukkan Foto" required>


            
            <button type="submit" name="simpan" class="simpan"><a href="data.php">Simpan</a></button>
            <button type="submit" name="reset" class="reset">Kosongkan</button>
        </form>

        <!-- Tabel Menampilkan Data -->
        <?php if (!empty($_SESSION['inventaris'])): ?>
            <h3>Data Inventaris Tersimpan</h3>
            <table>
                <tr>
                    <th>Id</th>
                    <th>Nama</th>
                    <th>NIK</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>No Handphone</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Foto</th>
                </tr>
                <?php foreach ($_SESSION['inventaris'] as $item): ?>
                    <tr>
                        <td><?php echo $item['id']; ?></td>
                        <td><?php echo $item['nama']; ?></td>
                        <td><?php echo $item['nik']; ?></td>
                        <td><?php echo $item['tanggallahir']; ?></td>
                        <td><?php echo $item['jeniskelamin']; ?></td>
                        <td><?php echo $item['nohandphone']; ?></td>
                        <td><?php echo $item['email']; ?></td>
                        <td><?php echo $item['alamat']; ?></td>
                        <td><?php echo $item['foto']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>
