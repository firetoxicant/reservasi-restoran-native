<?php
include('../controllers/authCheck.php');
include('../config/koneksi.php');

// Hitung Total dari Keranjang
$total_akhir = 0;
if (isset($_SESSION['keranjang'])) {
    foreach ($_SESSION['keranjang'] as $id_menu => $porsi) {
        $q = $conn->query("SELECT harga FROM tbl_menu WHERE id = '$id_menu'");
        $m = $q->fetch_assoc();
        $total_akhir += ($m['harga'] * $porsi);
    }
}
$dp_pembayaran = $total_akhir * 0.5; // Contoh DP 50%

$title = 'Konfirmasi Pembayaran';
include('../layout/index.php');
?>

<main class="h-full pb-16 overflow-y-auto">
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-yellow-400">Pembayaran DP</h2>

        <div class="grid gap-6 mb-8 md:grid-cols-2">
            <div class="p-4 bg-white rounded-lg shadow-md dark:bg-gray-800 border-l-4 border-yellow-400">
                <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">Informasi Transfer</h4>
                <p class="text-sm text-gray-600 dark:text-gray-400">Silakan transfer DP sebesar:</p>
                <p class="text-2xl font-bold text-green-600 mb-4">Rp <?php echo number_format($dp_pembayaran); ?></p>
                <ul class="text-sm text-gray-600 dark:text-gray-400 space-y-2">
                    <li><strong>Bank BCA:</strong> 123-456-7890 (A/N Resto Ayam Bolo Bebek)</li>
                </ul>
            </div>

            <div class="p-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <form action="../controllers/proses_pembayaran.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="total_bayar" value="<?php echo $total_akhir; ?>">
                    <input type="hidden" name="dp" value="<?php echo $dp_pembayaran; ?>">
                    
                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Upload Bukti Transfer</span>
                        <input type="file" name="bukti" required
                            class="block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 form-input border p-2 rounded-lg">
                    </label>

                    <button type="submit" name="bayar" 
                        class="w-full mt-6 px-4 py-2 text-sm font-medium text-white bg-yellow-300 rounded-lg hover:bg-yellow-400">
                        Konfirmasi & Selesaikan Reservasi
                    </button>
                </form>
            </div>
        </div>
    </div>
</main>