<?php
session_start();
include('../config/koneksi.php');

if (isset($_POST['bayar'])) {
    $res = $_SESSION['reservasi_meja_baru'];
    $id_pelanggan = $_SESSION['id']; 
    
    //RSV-20260411-1645 (RSV-TANGGAL-DETIK)
    $tanggal_sekarang = date('Ymd');
    $nomor_acak = substr(time(), -4); // Mengambil 4 digit terakhir timestamp
    $kode_reservasi = "RSV-" . $tanggal_sekarang . "-" . $nomor_acak;

    $total_bayar = $_POST['total_bayar'];
    $dp = $_POST['dp'];

    // Proses Upload Gambar ke folder uploads/downpayment
    $nama_file = $_FILES['bukti']['name'];
    $tmp_name = $_FILES['bukti']['tmp_name'];
    $tujuan = "../../uploads/downpayment/" . $nama_file;

    if (move_uploaded_file($tmp_name, $tujuan)) {
        // 1. Simpan ke tbl_reservasi
        $sql_res = "INSERT INTO tbl_reservasi (kode_reservasi, id_pelanggan, id_meja, jam_mulai, jam_selesai, tanggal_reservasi, bukti) 
                    VALUES ('$kode_reservasi', '$id_pelanggan', '{$res['id_meja']}', '{$res['jam_mulai']}', '{$res['jam_selesai']}', '{$res['tanggal']}', '$nama_file')";
        
        if ($conn->query($sql_res)) {
            $id_reservasi_terbaru = $conn->insert_id;

            // 2. Simpan ke tbl_pembayaran
            $sql_pay = "INSERT INTO tbl_pembayaran (id_reservasi, total, bayar, kembali, id_kasir) 
                        VALUES ('$id_reservasi_terbaru', '$total_bayar', '$dp', '0', '$id_pelanggan')";
            $conn->query($sql_pay);

            // 3. Simpan Detail Pesanan Menu ke tbl_order
            if (isset($_SESSION['keranjang'])) {
                foreach ($_SESSION['keranjang'] as $id_menu => $porsi) {
                    $cek_harga = "SELECT harga, stok FROM tbl_menu WHERE id='$id_menu'";
                    $result = $conn->query($cek_harga);
                    $data_menu = $result->fetch_assoc();

                    //update stok
                    $stok = $data_menu['stok'];
                    $conn->query("UPDATE tbl_menu SET stok = $stok - $porsi WHERE id = '$id_menu'");

                    //insert tbl_order
                    $harga = $data_menu['harga'];
                    $sub_total = $harga * $porsi;
                    $conn->query("INSERT INTO tbl_order (id_reservasi, id_menu, jumlah, sub_total) VALUES ('$id_reservasi_terbaru', '$id_menu', '$porsi', '$sub_total')");
                }
            }

            // Bersihkan Session setelah sukses
            unset($_SESSION['keranjang']);
            unset($_SESSION['reservasi_meja_baru']);

            $_SESSION['success'] = "Resrvasi berhasil";
            header("Location: ../reservasi/reservasiSaya.php");
        } else {
            echo "Error Database: " . $conn->error;
        }
    } else {
        echo "Gagal mengupload bukti pembayaran.";
    }
}