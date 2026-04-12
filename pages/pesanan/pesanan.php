<?php
include('../controllers/authCheck.php');
include('../config/koneksi.php');

// Data reservasi secara desending
$sql = "SELECT r.*, u.nama_lengkap, m.nama_meja, p.total, p.bayar 
        FROM tbl_reservasi r
        JOIN tbl_user u ON r.id_pelanggan = u.id
        JOIN tbl_meja m ON r.id_meja = m.id
        LEFT JOIN tbl_pembayaran p ON r.id = p.id_reservasi
        ORDER BY r.id DESC";
$result = $conn->query($sql);

$title = 'Kelola Reservasi';
include('../layout/index.php');
?>

<main class="h-full pb-16 overflow-y-auto">
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-yellow-400">
            Daftar Seluruh Reservasi
        </h2>
        <?php if(isset($_SESSION['success'])): ?>
            <div class="px-4 py-3 mb-8 bg-green-300 rounded-lg shadow-md dark:bg-green-300">
              <p class="text-sm font-semibold text-white dark:text-white">
                <?= $_SESSION['success']; unset($_SESSION['success'])?>
              </p>
            </div>
        <?php endif; ?>
        <?php if(isset($_SESSION['error'])): ?>
            <div class="px-4 py-3 mb-8 bg-red-400 rounded-lg shadow-md dark:bg-red-400">
              <p class="text-sm font-semibold text-white dark:text-white">
                <?= $_SESSION['error']; unset($_SESSION['error'])?>
              </p>
            </div>
        <?php endif; ?>

        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">Pelanggan / Kode</th>
                            <th class="px-4 py-3">Meja / Waktu</th>
                            <th class="px-4 py-3">Pembayaran (DP)</th>
                            <th class="px-4 py-3">Bukti</th>
                            <th class="px-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        <?php while($row = $result->fetch_assoc()): ?>
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <div>
                                        <p class="font-semibold"><?php echo $row['nama_lengkap']; ?></p>
                                        <p class="text-xs text-gray-600 dark:text-gray-400"><?php echo $row['kode_reservasi']; ?></p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <p><?php echo $row['nama_meja']; ?></p>
                                <p class="text-xs"><?php echo date('d/m/y', strtotime($row['tanggal_reservasi'])); ?> | <?php echo $row['jam_mulai']; ?></p>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <p>Total: Rp <?php echo number_format($row['total']); ?></p>
                                <p class="text-xs text-green-600 font-bold">DP: Rp <?php echo number_format($row['bayar']); ?></p>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <a href="../../uploads/downpayment/<?php echo $row['bukti']; ?>" target="_blank" class="text-blue-500 underline">Lihat Bukti</a>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <a href="detail_pesanan.php?id=<?php echo $row['id']; ?>" 
                                   class="px-3 py-1 text-xs font-medium text-white bg-yellow-400 rounded-md">
                                    Cek Order
                                </a>
                                <?php if (($row['total'] - $row['bayar']) > 0): ?>
                                    <a href="pelunasan_reservasi.php?id=<?php echo $row['id']; ?>" class="px-3 py-1 text-xs text-white bg-blue-500 rounded-md">Pelunasan</a>
                                <?php else: ?>
                                    <span class="px-3 py-1 text-xs text-white bg-green-500 rounded-md">Lunas</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<?php include('../layout/footer.php'); ?>