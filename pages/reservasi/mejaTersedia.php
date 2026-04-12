<?php
include('../controllers/authCheck.php');
include('../config/koneksi.php');

    $tanggal = $_POST['tanggal_reservasi'];
    $jam_mulai = $_POST['jam_reservasi'];
    $jam_selesai = date('H:i', strtotime($jam_mulai  . ' +90 minutes'));
    $kapasitas = $_POST['kapasitas'];

    // Query gacor gawe nggolek mejo
    $sql = "SELECT * FROM tbl_meja m
            WHERE kapasitas_meja >= $kapasitas 
            AND status = 'tersedia' 
            AND NOT EXISTS (
                SELECT 1 FROM tbl_reservasi r 
                WHERE r.id_meja = m.id
                AND r.tanggal_reservasi = '$tanggal'
                AND r.jam_mulai < '$jam_selesai' AND r.jam_selesai > '$jam_mulai'
            );";

    $meja_tersedia = $conn->query($sql);

$title = 'Reservasi';
include('../layout/index.php');
?>

<main class="h-full pb-16 overflow-y-auto">
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-yellow-400">
            Reservasi Meja (<?php echo $jam_mulai;?> - <?php echo $jam_selesai; ?>)
        </h2>
            <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-2 w-full">
                <?php if ($meja_tersedia && $meja_tersedia->num_rows > 0): ?>
                    <?php foreach($meja_tersedia as $meja): ?>
                        <div class="p-4 g-white rounded-lg shadow-md dark:bg-gray-800 border-t-4 border-yellow-300">
                            <div class="flex items-center justify-between">
                                <img src="../../uploads/meja/meja.jpg" alt="gambar meja" class="content-center mx-2 mb-5 w-6/12 h-auto block mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-yellow-400 focus:outline-none focus:shadow-outline-yellow form-input">
                                <div>
                                    <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-400">
                                        <?php echo $meja['nama_meja'] ?>
                                    </p>
                                    <p class="mb-2 text-lg font-medium text-gray-600 dark:text-gray-200">
                                        Kapasitas: <?php echo $meja['kapasitas_meja'] ?> Orang
                                    </p>
                                    <form action="../controllers/reservasiMeja.php" method="POST">
                                        <input type="text" value="<?php echo $meja['id'] ?>" name="id_meja" hidden>
                                        <input type="text" value="<?php echo $tanggal?>" name="tanggal" hidden>
                                        <input type="text" value="<?php echo $jam_mulai?>" name="jam_mulai" hidden>
                                        <input type="text" value="<?php echo $jam_selesai?>" name="jam_selesai" hidden>
                                        <button type="submit" 
                                            class="px-8 py-1 text-sm font-medium text-white bg-yellow-300 rounded-lg hover:bg-yellow-500">
                                                Pilih
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-gray-600 dark:text-gray-400 col-span-full text-center py-10">
                        Maaf, tidak ada meja tersedia untuk waktu dan kapasitas tersebut.
                    </p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>
<?php 
include('../layout/footer.php'); 
?>