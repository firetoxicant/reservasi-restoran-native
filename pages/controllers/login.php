<?php
session_start();
include('../config/koneksi.php');

if(isset($_POST['email']) && isset($_POST['password'])){
    $email = $_POST['email'];
    $password = $_POST['password'];     

    $sql = "SELECT id, nama_lengkap, username, password, role FROM tbl_user WHERE email='$email'";
    $result = $conn->query($sql);

    if($result->num_rows != 0){
        $user = $result->fetch_assoc();
        if(password_verify($password, $user['password'])){
            $_SESSION['id'] = $user['id'];
            $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['success'] = "Berhasil log in";
            header('Location: ../dashboard/dashboard.php');
        }else{
            $_SESSION['error'] = "Password salah!";
            $_SESSION['email'] = $email;
            header("Location: ../auth/login.php");
            exit;
        }
    }else{
        $_SESSION['error'] = "Akun dengan email " . $email . " tidak ditemukan.";
        header("Location: ../auth/login.php");
        exit;
        }
}else{
    $_SESSION['error'] = "Input tidak lengkap.";
    header("Location: ../auth/login.php");
}
?>