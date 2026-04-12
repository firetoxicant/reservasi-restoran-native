<?php
session_start();
include('../config/koneksi.php');

    if (isset($_POST)) {
        $id = $_POST['id'];
        $nama_menu = $_POST['nama_menu'];
        $harga = $_POST['harga'];
        $deskripsi = $_POST['deskripsi'];
        $stok = $_POST['stok'];
        $kategori = $_POST['kategori'];
        $status = $_POST['status'];
        
        
        if($_FILES['gambar']['name'] != ''){
            $nama_gambar = $_FILES['gambar']['name'];
            $tmp_name = $_FILES['gambar']['tmp_name'];//iki lokasi gambar sementara
            $direktori = '../../uploads/imgMenu/';

            if (move_uploaded_file($tmp_name, $direktori . $nama_gambar)) {//pindah file gambar dari penyimpanan sementara ke penyimpanan direktori
                $sql = "UPDATE tbl_menu SET nama_menu='$nama_menu', harga=$harga, deskripsi='$deskripsi', stok=$stok, kategori='$kategori', gambar='$nama_gambar', status='$status' WHERE id=$id";
                if($conn->query($sql)){
                    $_SESSION['success'] = "Update data menu berhasil";
                }else{
                    $_SESSION['error'] = "Terjadi kesalahan: " .$sql->error;
                }
            } else {
                $_SESSION['error'] = "Terjadi kesalahan saat memindahkan gambar";
            }
        }else{
            $sql = "UPDATE tbl_menu SET nama_menu='$nama_menu', harga=$harga, deskripsi='$deskripsi', stok=$stok, kategori='$kategori', status='$status' WHERE id=$id";
            if($conn->query($sql)){
                $_SESSION['success'] = "Update data menu berhasil";
            }else{
                $_SESSION['error'] = "Terjadi kesalahan: " .$sql->error;
            }
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