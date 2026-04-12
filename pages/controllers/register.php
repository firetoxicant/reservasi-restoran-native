<?php
session_start();
include('../config/koneksi.php');

if(isset($_POST)){
    $nama_lengkap = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $encrypt_password = password_hash($password, PASSWORD_BCRYPT);
    if(!$_POST['role']){//daftar pelanggan
        $sql = "INSERT INTO tbl_user (nama_lengkap, email, username, password, role) VALUES('$nama_lengkap', '$email', '$username', '$encrypt_password', 'pelanggan')";
        if($conn->query($sql)){
            $_SESSION['success'] = "Berhasil daftar user " . $nama_lengkap;
            header('Location: ../auth/login.php');
        }else{
            $_SESSION['error'] = "Gagal daftar " . $conn->error;
            header('Location: ../auth/register.php');
        }
    }else{
        $_SESSION['error'] = "Data tidak lengkap.";
    }
}
?>