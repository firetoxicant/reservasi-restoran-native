<?php
session_start();

if (isset($_GET['id'])) {
    $id_menu = $_GET['id'];

    // Menghapus elemen array berdasarkan ID menu
    if (isset($_SESSION['keranjang'][$id_menu])) {
        unset($_SESSION['keranjang'][$id_menu]);
    }

    header("Location: ../reservasi/keranjang.php?pesan=dihapus");
    exit();
}