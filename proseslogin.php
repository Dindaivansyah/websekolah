<?php

require_once "../config.php";




if (isset($_POST['login'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    $result = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE username = '$username'");


    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            header("location:../index.php");
            exit;
    
        } else {
            echo "<script> 
            alert('password salah..);
            document.location.href= 'login.php';
            </script>";
        }
    } else {
        echo "<script>
        alert('username tidak terdaftar..');
        document.location.href= 'login.php';
        </script>";
    }
}

?>

