<?php
include('../controllers/authCheck.php');
include('../config/koneksi.php');

$role = $_SESSION['role'];
$id_login = $_SESSION['id'];
// Data reservasi secara desending
if($role == 'admin'){
    $sql = "SELECT r.*, u.nama_lengkap AS nama_pelanggan, m.nama_meja, p.total, p.bayar, k.nama_lengkap AS nama_kasir
            FROM tbl_reservasi r
            JOIN tbl_user u ON r.id_pelanggan = u.id
            JOIN tbl_meja m ON r.id_meja = m.id
            LEFT JOIN tbl_pembayaran p ON r.id = p.id_reservasi
            LEFT JOIN tbl_user k ON p.id_kasir = k.id
            WHERE p.bayar >= p.total
            ORDER BY r.id DESC";
}elseif($role == 'pelanggan'){
    $sql = "SELECT r.*, u.nama_lengkap AS nama_pelanggan, m.nama_meja, p.total, p.bayar, k.nama_lengkap AS nama_kasir 
            FROM tbl_reservasi r
            JOIN tbl_user u ON r.id_pelanggan = u.id
            JOIN tbl_meja m ON r.id_meja = m.id
            LEFT JOIN tbl_pembayaran p ON r.id = p.id_reservasi
            JOIN tbl_user k ON p.id_kasir = k.id
            WHERE r.id_pelanggan = '$id_login'
            ORDER BY r.id DESC";
}elseif($role == 'kasir'){
    $sql = "SELECT r.*, u.nama_lengkap AS nama_pelanggan, m.nama_meja, p.total, p.bayar, k.nama_lengkap AS nama_kasir
            FROM tbl_reservasi r
            JOIN tbl_user u ON r.id_pelanggan = u.id
            JOIN tbl_meja m ON r.id_meja = m.id
            LEFT JOIN tbl_pembayaran p ON r.id = p.id_reservasi
            LEFT JOIN tbl_user k ON p.id_kasir = k.id
            WHERE p.id_kasir = '$id_login'
            ORDER BY r.id DESC";
}
$result = $conn->query($sql);

$title = 'Riwayat Reservasi';
include('../layout/index.php');
?>

<main class="h-full pb-16 overflow-y-auto">
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-yellow-400">
            Data Seluruh Reservasi
        </h2>

        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">Pelanggan / Kode</th>
                            <th class="px-4 py-3">Meja / Waktu</th>
                            <th class="px-4 py-3">Pembayaran (DP)</th>
                            <th class="px-4 py-3">Bukti</th>
                            <th class="px-4 py-3">Kasir</th>
                            <th class="px-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        <?php while($row = $result->fetch_assoc()): ?>
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <div>
                                        <p class="font-semibold"><?php echo $row['nama_pelanggan']; ?></p>
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
                            <?php if (($row['total'] <= $row['bayar'])): ?>
                            <td class="px-4 py-3 text-sm">
                                <p class="text-xs text-green-600 font-bold"><?php echo $row['nama_kasir']; ?></p>
                            </td>
                            <?php else: ?>
                            <td class="px-4 py-3 text-sm">
                                <p class="text-xs text-green-600 font-bold">Pembayaran <br> DP(Online)</p>
                            </td>
                            <?php endif; ?>
                            <td class="px-4 py-3 text-sm">
                                <a href="../pesanan/detail_pesanan.php?id=<?php echo $row['id']; ?>" 
                                   class="px-3 py-1 mr-2 text-xs font-medium text-white bg-yellow-400 rounded-md">
                                    Cek Order
                                </a>
                                <?php if (($row['total'] - $row['bayar']) > 0): ?>
                                    <span class="px-3 py-1 text-xs text-white bg-yellow-300 rounded-md">Belum Lunas</span>
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