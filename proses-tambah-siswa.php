<?php
session_start();
require_once "../config.php";

if (!isset($_SESSION["ssLogin"])) {
    header("Location: ../auth/login.php");
    exit;
}

// Ambil data dari form
$nis = $_POST['nis'];
$nama = $_POST['nama'];
$kelas = $_POST['kelas'];
$jurusan = $_POST['jurusan'];
$alamat = $_POST['alamat'];

// Proses upload foto
$foto = $_FILES['foto']['name'];
$target_dir = "../uploads/";
$target_file = $target_dir . basename($foto);

if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
    // Jika upload berhasil, simpan data ke database
    $query = "INSERT INTO siswa (nis, nama, kelas, jurusan, alamat, foto) 
              VALUES ('$nis', '$nama', '$kelas', '$jurusan', '$alamat', '$foto')";

    if (mysqli_query($koneksi, $query)) {
        header("Location: siswa.php?status=sukses");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
} else {
    echo "Gagal mengupload foto.";
}
?>
