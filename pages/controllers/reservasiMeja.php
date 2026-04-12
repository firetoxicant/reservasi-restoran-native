<?php
session_start();
include('../config/koneksi.php');

$id_meja = $_POST['id_meja'];
$jam_mulai = $_POST['jam_mulai'];
$jam_selesai = $_POST['jam_selesai'];
$tanggal = $_POST['tanggal'];

$_SESSION['reservasi_meja_baru'] = [
    'id_meja' => $id_meja,
    'jam_mulai' => $jam_mulai,
    'jam_selesai' => $jam_selesai,
    'tanggal' => $tanggal
];

header("Location: ../reservasi/pilihMenu.php");
?>