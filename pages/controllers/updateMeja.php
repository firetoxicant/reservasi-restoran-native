<?php
session_start();
include('../config/koneksi.php');

if(isset($_POST)){
    $id = $_POST['id'];
    $nama_meja = $_POST['nama_meja'];
    $kapasitas_meja = $_POST['kapasitas_meja'];
    $status = $_POST['status'];

    if($nama_meja !== ""){
        $sql = "UPDATE tbl_meja SET nama_meja='$nama_meja', kapasitas_meja=$kapasitas_meja, status='$status' WHERE id=$id";
        if($conn->query($sql)){
            $_SESSION['success'] = "Berhasil update data meja.";
        }else{
            $_SESSION['error'] = "Gagal update data meja";
        }
    }else{
        $_SESSION['error'] = "Nama meja tidak boleh kosong.";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    header('Location: ../meja/meja.php');
    exit;
}else{
    $_SESSION['error'] = "Data tidak lengkap";
    header('Location: ../meja/meja.php');
    exit;
}
?>