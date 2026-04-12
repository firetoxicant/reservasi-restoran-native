<?php
include('../controllers/authCheck.php');
include('../config/koneksi.php');

$id_res = $_GET['id'];

// Query Data Reservasi & Pembayaran
$query_res = $conn->query("SELECT r.*, p.*, m.nama_meja, u.nama_lengkap
                          FROM tbl_reservasi r 
                          JOIN tbl_pembayaran p ON r.id = p.id_reservasi 
                          JOIN tbl_meja m ON r.id_meja = m.id
                          JOIN tbl_user u ON r.id_pelanggan = u.id
                          WHERE r.id = '$id_res'");
$data = $query_res->fetch_assoc();

// Query List Menu yang diorder
$order_items = $conn->query("SELECT o.jumlah, o.sub_total, mn.nama_menu, mn.harga 
                            FROM tbl_order o 
                            JOIN tbl_menu mn ON o.id_menu = mn.id 
                            WHERE o.id_reservasi = '$id_res'");

$title = 'Detail Reservasi';
include('../layout/index.php');
?>

<main class="h-full pb-16 overflow-y-auto">
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-yellow-400">
            Detail: <?php echo $data['kode_reservasi']; ?>
        </h2>

        <div class="grid gap-6 md:grid-cols-2">
            <div class="p-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">Item Pesanan</h4>
                <ul class="space-y-3">
                    <?php while($item = $order_items->fetch_assoc()): ?>
                    <li class="flex justify-between text-sm text-gray-600 dark:text-gray-400 border-b pb-2">
                        <span><?php echo $item['nama_menu']; ?> (x<?php echo $item['jumlah']; ?>)</span>
                        <span class="font-bold">Rp <?php echo number_format($item['sub_total']); ?></span>
                    </li>
                    <?php endwhile; ?>
                </ul>
            </div>

            <div class="p-4 bg-white rounded-lg shadow-md dark:bg-gray-800 border-t-4 border-green-500">
                <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">Status Keuangan</h4>
                <div class="text-sm space-y-2">
                    <div class="flex justify-between">
                        <span>Total Tagihan:</span>
                        <span class="font-bold text-gray-700 dark:text-gray-200">Rp <?php echo number_format($data['total']); ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span>DP Masuk (Bayar):</span>
                        <span class="font-bold text-green-600">Rp <?php echo number_format($data['bayar']); ?></span>
                    </div>
                    <hr class="my-2">
                    <div class="flex justify-between text-lg font-bold">
                        <span>Sisa Pelunasan:</span>
                        <span class="text-red-600">Rp <?php echo number_format($data['total'] - $data['bayar']); ?></span>
                    </div>
                </div>
                
                <div class="mt-6">
                    <p class="text-xs text-gray-500 mb-2">Bukti Transfer Pelanggan:</p>
                    <img src="../../uploads/downpayment/<?php echo $data['bukti']; ?>" class="w-full rounded-lg shadow-sm border">
                </div>
            </div>
        </div>
    </div>
</main>