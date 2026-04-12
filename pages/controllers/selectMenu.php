<?php 
include('../config/koneksi.php');
$sql = "SELECT id, nama_menu, harga, stok, kategori, status FROM tbl_menu";
return $conn->query($sql);
exit;
?>