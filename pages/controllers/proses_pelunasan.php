<?php
session_start();
include('../config/koneksi.php');

if (isset($_POST['simpan_pelunasan'])) {
    $id_res = $_POST['id_reservasi'];
    $sisa = $_POST['sisa_tagihan'];
    $total_awal = $_POST['total_awal'];
    $jumlah_bayar = $_POST['jumlah_bayar']; // Uang tunai dari pelanggan
    $id_kasir = $_SESSION['id']; // ID Kasir yang menangani

    // Hitung kembalian jika uang lebih
    $kembali = $jumlah_bayar - $sisa;

    // Update tbl_pembayaran: 
    // Kolom 'bayar' menjadi Full (Total), 'kembali' diisi, 'id_kasir' diisi
    $sql = "UPDATE tbl_pembayaran SET 
            bayar = '$total_awal', 
            kembali = '$kembali', 
            id_kasir = '$id_kasir' 
            WHERE id_reservasi = '$id_res'";

    if ($conn->query($sql)) {
        $_SESSION['success'] = "Pelunasan berhasil.";
        header("Location: ../pesanan/pesanan.php");
    } else {
        echo "Error: " . $conn->error;
    }
}