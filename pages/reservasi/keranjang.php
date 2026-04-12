<?php
include('../controllers/authCheck.php');
include('../config/koneksi.php');

$title = 'Isi Keranjang';
include('../layout/index.php');
?>

<main class="h-full pb-16 overflow-y-auto">
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-yellow-400">Keranjang Pesanan</h2>

        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">Menu</th>
                            <th class="px-4 py-3">Harga</th>
                            <th class="px-4 py-3">Porsi</th>
                            <th class="px-4 py-3">Subtotal</th>
                            <th class="px-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        <?php 
                        $total_bayar = 0;
                        if (isset($_SESSION['keranjang']) && !empty($_SESSION['keranjang'])): 
                            foreach ($_SESSION['keranjang'] as $id_menu => $porsi): 
                                // Ambil data menu dari DB berdasarkan ID di session
                                $query = $conn->query("SELECT * FROM tbl_menu WHERE id = '$id_menu'");
                                $menu = $query->fetch_assoc();
                                $subtotal = $menu['harga'] * $porsi;
                                $total_bayar += $subtotal;
                        ?>
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3 text-sm"><?php echo $menu['nama_menu']; ?></td>
                            <td class="px-4 py-3 text-sm">Rp <?php echo number_format($menu['harga']); ?></td>
                            <td class="px-4 py-3 text-sm"><?php echo $porsi; ?></td>
                            <td class="px-4 py-3 text-sm">Rp <?php echo number_format($subtotal); ?></td>
                            <td class="px-4 py-3">
                                <a href="../controllers/hapus_item.php?id=<?php echo $id_menu; ?>" class="text-red-600 hover:text-red-900">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <tr class="font-bold bg-gray-50 dark:bg-gray-700">
                            <td colspan="3" class="px-4 py-3 text-right">Total Keseluruhan:</td>
                            <td colspan="2" class="px-4 py-3 text-green-500">Rp <?php echo number_format($total_bayar); ?></td>
                        </tr>
                        <?php else: ?>
                        <tr>
                            <td colspan="5" class="px-4 py-3 text-center">Keranjang masih kosong.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <?php if (!empty($_SESSION['keranjang'])): ?>
        <div class="mt-6">
            <a href="pilihMenu.php" class="px-4 py-2 text-sm font-medium text-gray-600 bg-white border rounded-lg">Tambah Menu Lain</a>
            <a href="pembayaran.php" class="px-4 py-2 text-sm font-medium text-white bg-yellow-300 hover:bg-yellow-400 rounded-lg">Lanjut Pembayaran DP</a>
        </div>
        <?php endif; ?>
    </div>
</main>

<?php include('../layout/footer.php'); ?>