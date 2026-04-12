<?php
    session_start();
    include('../config/koneksi.php');

    $id = $_GET['id'];

    $sql = "DELETE FROM tbl_meja WHERE id=$id";

    if($conn->query($sql)){
        $_SESSION['success'] = "Data meja berhasil dihapus.";
    }else{
        $_SESSION['error'] = "Data meja gagal dihapus.";
    }

    header('Location: ../meja/meja.php');
    exit;
?>