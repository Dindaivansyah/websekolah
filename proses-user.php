<?php



require_once "../config.php";

if (isset($_POST['simpan'])) {
    $username = trim(htmlspecialchars($_POST['username']));
    $nama     = trim(htmlspecialchars($_POST['nama']));
    $jabatan  = $_POST['jabatan'];
    $alamat   = trim(htmlspecialchars($_POST['alamat']));
    $gambar   = trim(htmlspecialchars($_FILES['image']['name']));
    $password = 1234;
    $pass     = password_hash($password, PASSWORD_DEFAULT);

    // Cek username di database
    $cekUsername = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE username = '$username'");
    
    if (mysqli_num_rows($cekUsername) > 0) {
        header("location:add-user.php?msg=cancel");
        return;
    }

    // Jika gambar diunggah, panggil fungsi upload
    if ($gambar != null) {
        $url = 'add-user.php';
        $gambar = uploadimg($url);
    } else {
        $gambar = 'default.png';
    }

    // Perbaiki format query INSERT INTO
    $query = "INSERT INTO tbl_user (username, password, nama, alamat, jabatan, gambar) 
              VALUES ('$username', '$pass', '$nama', '$alamat', '$jabatan', '$gambar')";
    
    if (mysqli_query($koneksi, $query)) {
        header("location:add-user.php?msg=added");
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>
