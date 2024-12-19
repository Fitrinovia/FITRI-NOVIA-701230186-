<?php

if (isset($_POST['Daftar'])) {
    $id_mahasiswa = $_POST['id_mahasiswa'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jurusan = $_POST['jurusan'];
    
    // Handle multiple interests
    $minat = isset($_POST['minat']) ? implode(", ", $_POST['minat']) : "";
    
    // Handle file upload
    $gambar = "";
    if(isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $target_dir = "uploads/";
        $file_extension = pathinfo($_FILES["gambar"]["name"], PATHINFO_EXTENSION);
        $gambar = $id_mahasiswa . "." . $file_extension;
        $target_file = $target_dir . $gambar;
        
        move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);
    }
    
    // Insert data into database
    $sql = "INSERT INTO mahasiswa (id_mahasiswa, nama, alamat, jenis_kelamin, 
            tanggal_lahir, jurusan, minat, gambar) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssssss", 
        $id_mahasiswa, $nama, $alamat, $jenis_kelamin, 
        $tanggal_lahir, $jurusan, $minat, $gambar);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Data berhasil disimpan!');</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
    
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Formulir Pendaftaran</title>
    <style>
        .form-container {
            width: 500px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: inline-block;
            width: 120px;
        }
        .button-group {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Formulir Pendaftaran</h2>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label>Id Mahasiswa:</label>
                <input type="text" name="id_mahasiswa" required>
            </div>
            
            <div class="form-group">
                <label>Nama:</label>
                <input type="text" name="nama" required>
            </div>
            
            <div class="form-group">
                <label>Alamat:</label>
                <textarea name="alamat" rows="3"></textarea>
            </div>
            
            <div class="form-group">
                <label>Jenis Kelamin:</label>
                <input type="radio" name="jenis_kelamin" value="Pria" checked> Pria
                <input type="radio" name="jenis_kelamin" value="Wanita"> Wanita
            </div>
            
            <div class="form-group">
                <label>Tanggal Lahir:</label>
                <input type="date" name="tanggal_lahir" required>
            </div>
            
            <div class="form-group">
                <label>Jurusan:</label>
                <select name="jurusan">
                    <option value="Sistem Informasi">Sistem Informasi</option>
                    <option value="Teknik Informatika">Teknik Informatika</option>
                    <option value="Manajemen">Manajemen</option>
                </select>
            </div>
            
            <div class="form-group">
                <label>Minat:</label>
                <input type="checkbox" name="minat[]" value="Programming"> Programming
                <input type="checkbox" name="minat[]" value="Animasi"> Animasi
                <input type="checkbox" name="minat[]" value="Desain"> Desain
                <input type="checkbox" name="minat[]" value="Mapala"> Mapala
            </div>
            
            <div class="form-group">
                <label>Gambar:</label>
                <input type="file" name="gambar" accept="image/*">
            </div>
            
            <div class="button-group">
                <input type="submit" name="Daftar" value="Daftar">
                <input type="reset" name="Batal" value="Batal">
            </div>
        </form>
    </div>
</body>
</html>