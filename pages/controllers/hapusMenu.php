<?php
    session_start();
    include('../config/koneksi.php');

    $id = $_GET['id'];

    $sql = "DELETE FROM tbl_menu WHERE id=$id";

    if($conn->query($sql)){
        $_SESSION['success'] = "Data menu berhasil dihapus.";
    }else{
        $_SESSION['error'] = "Data menu gagal dihapus.";
    }

    header('Location: ../menu/menu.php');
    exit;
?>