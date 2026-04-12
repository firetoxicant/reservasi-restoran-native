<?php
    session_start();
    include('../config/koneksi.php');

    if (isset($_POST)) {
        $nama_menu = $_POST['nama_menu'];
        $harga = $_POST['harga'];
        $deskripsi = $_POST['deskripsi'];
        $stok = $_POST['stok'];
        $kategori = $_POST['kategori'];
        $status = $_POST['status'];
        
        $nama_gambar = $_FILES['gambar']['name'];
        $tmp_name = $_FILES['gambar']['tmp_name'];//iki lokasi gambar sementara
        $direktori = '../../uploads/imgMenu/' . $nama_gambar;

        
        if (move_uploaded_file($tmp_name, $direktori)) {//pindah file gambar dari penyimpanan sementara ke penyimpanan direktori
            $sql = "INSERT INTO tbl_menu (nama_menu, harga, deskripsi, stok, kategori, gambar, status) VALUES ('$nama_menu', '$harga', '$deskripsi', '$stok', '$kategori', '$nama_gambar', '$status')";
            if($conn->query($sql)){
                $_SESSION['success'] = "Tambah data menu berhasil";
            }else{
                $_SESSION['error'] = "Terjadi kesalahan: " .$sql->error;
            }
        } else {
            $_SESSION['error'] = "Terjadi kesalahan saat memindahkan gambar";
        }
        
        $conn->close();
            
        header("Location: ../menu/menu.php");
        exit;
    } else {
        $_SESSION['error'] = 'Data tidak Lengkap';
        header("Location: ../menu/menu.php");
        exit;

    }
?>