<?php 
include('../config/koneksi.php');
$sql = "SELECT id, nama_meja, kapasitas_meja, status FROM tbl_meja";
return $conn->query($sql);
exit;
?>