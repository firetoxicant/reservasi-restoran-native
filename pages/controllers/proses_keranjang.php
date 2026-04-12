<?php
session_start();

if (isset($_POST['order_menu'])) {
    $id_menu = $_POST['id_menu'];
    $porsi = $_POST['porsi'];

    if (!isset($_SESSION['keranjang'])) {
        $_SESSION['keranjang'] = [];
    }

    if (isset($_SESSION['keranjang'][$id_menu])) {
        $_SESSION['keranjang'][$id_menu] += $porsi;
    } else {
        $_SESSION['keranjang'][$id_menu] = $porsi;
    }

    header("Location: ../reservasi/pilihMenu.php?status=sukses");
    exit();
}