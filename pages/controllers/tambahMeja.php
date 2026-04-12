<?php
    session_start();
    include('../config/koneksi.php');

    if (isset($_POST['nama_meja'], $_POST['kapasitas_meja'], $_POST['status'])) {
        $nama_meja = $_POST['nama_meja'];
        $kapasitas_meja = $_POST['kapasitas_meja'];
        $status = $_POST['status'];

        $sql = "INSERT INTO tbl_meja (nama_meja, kapasitas_meja, status) VALUES ('$nama_meja', '$kapasitas_meja', '$status')";

        if ($conn->query($sql)) {
            $_SESSION['success'] = "Tambah data meja berhasil";
        } else {
            $_SESSION['error'] = "Terjadi kesalahan: " . $sql->error;
        }
        
        $conn->close();
            
        header("Location: ../meja/meja.php");
        exit;
    } else {
        $_SESSION['error'] = 'Data tidak Lengkap';
        header("Location: ../meja/meja.php");
        exit;

    }
?>