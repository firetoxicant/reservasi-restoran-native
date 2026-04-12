<?php
include('../controllers/authCheck.php');
include('../config/koneksi.php');

//ambil id user login
$id_user = $_SESSION['id']; 
$tanggal = date('Y-m-d');

$sql =  "SELECT r.*, u.nama_lengkap, m.nama_meja, m.kapasitas_meja, p.total, p.bayar 
        FROM tbl_reservasi r
        INNER JOIN tbl_user u ON r.id_pelanggan = u.id
        INNER JOIN tbl_meja m ON r.id_meja = m.id
        INNER JOIN tbl_pembayaran p ON p.id_reservasi = r.id
        WHERE r.id_pelanggan = '$id_user' AND tanggal_reservasi >= '$tanggal'
        ORDER BY r.id DESC";

$result = $conn->query($sql);

$title = 'Reservasi Saya';
include('../layout/index.php');
?>

<main class="h-full pb-16 overflow-y-auto">
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-yellow-400">
            Reservasi Saya
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

        <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-2">
            <?php if ($result->num_rows > 0): ?>
                <?php while($res = $result->fetch_assoc()): ?>
                    <div class="p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 border-l-4 border-yellow-400">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <p class="text-xs font-bold text-gray-500 uppercase dark:text-gray-400">Kode Reservasi</p>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200"><?php echo $res['kode_reservasi']; ?></p>
                            </div>
                            <?php if ($res['total'] == $res['bayar']): ?>
                                <span class="px-2 py-1 text-xs font-medium leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                    Lunas
                                </span>
                            <?php else: ?>
                                <span class="px-2 py-1 text-xs font-medium leading-tight text-yellow-700 bg-yellow-100 rounded-full dark:bg-yellow-700 dark:text-yellow-100">
                                    Belum Lunas
                                </span>
                            <?php endif; ?>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-4 text-sm">
                            <div>
                                <p class="text-gray-500 dark:text-gray-400">Meja:</p>
                                <p class="font-medium text-gray-700 dark:text-gray-200"><?php echo $res['nama_meja']; ?> (<?php echo $res['kapasitas_meja']; ?> Orang)</p>
                            </div>
                            <div>
                                <p class="text-gray-500 dark:text-gray-400">Tanggal:</p>
                                <p class="font-medium text-gray-700 dark:text-gray-200"><?php echo date('d M Y', strtotime($res['tanggal_reservasi'])); ?></p>
                            </div>
                            <div>
                                <p class="text-gray-500 dark:text-gray-400">Waktu:</p>
                                <p class="font-medium text-gray-700 dark:text-gray-200"><?php echo $res['jam_mulai']; ?> - <?php echo $res['jam_selesai']; ?></p>
                            </div>
                            <div>
                                <p class="text-gray-500 dark:text-gray-400">Bukti Bayar:</p>
                                <a href="../../uploads/downpayment/<?php echo $res['bukti']; ?>" target="_blank" class="text-blue-500 hover:underline">Lihat Gambar</a>
                            </div>
                        </div>

                        <div class="border-t pt-4 dark:border-gray-700">
                            <p class="text-xs font-bold text-gray-500 uppercase mb-2">Menu yang Dipesan:</p>
                            <ul class="text-sm text-gray-600 dark:text-gray-400 space-y-1">
                                <?php 
                                $id_res = $res['id'];
                                $q_menu = $conn->query("SELECT o.jumlah, m.nama_menu FROM tbl_order o JOIN tbl_menu m ON o.id_menu = m.id WHERE o.id_reservasi = '$id_res'");
                                while($menu = $q_menu->fetch_assoc()):
                                ?>
                                    <li class="flex justify-between">
                                        <span><?php echo $menu['nama_menu']; ?></span>
                                        <span class="font-semibold">x<?php echo $menu['jumlah']; ?></span>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-span-full text-center py-10">
                    <p class="text-gray-500 dark:text-gray-400">Anda belum memiliki reservasi.</p>
                    <a href="reservasiMeja.php" class="mt-4 inline-block text-yellow-500 hover:underline">Pesan Meja Sekarang</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php include('../layout/footer.php'); ?>