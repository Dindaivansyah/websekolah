<?php

require_once "../config.php";

if (!isset($_POST['Simpan'])) {
    $nis   = $_POST['nis'];
    $nama  = htmlspecialchars($_POST['nama']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $kelas = $_POST['kelas'];
    $jurusan = $_POST['jurusan'];
    $foto = htmlspecialchars($_FILES['image']['name']);

    if ($foto != null) {
        $url = "add-siswa.php";
        $foto = uploadimg($url);

    } else {
        $foto = 'default.png';
    }

    mysqli_query($koneksi, "INSERT INTO tbl_siswa VALUES('$nis','$nama','$alamat','$kelas','$jurusan','$foto')");

    echo "<script>
                alert('Data Siswa Berhasil Disimpan');
                document.location.href = 'add-siswa.php';
        </script>";
    return;
}

?>