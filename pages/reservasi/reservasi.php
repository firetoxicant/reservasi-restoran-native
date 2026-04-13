<?php
include('../controllers/authCheck.php');
include('../config/koneksi.php');

echo "<pre>";
unset($_SESSION['reservasi_meja_baru']);
unset($_SESSION['keranjang']);
echo "</pre>";

$sql =  "SELECT MAX(kapasitas_meja) AS kapasitas FROM tbl_meja";
$result = $conn->query($sql);
$data = $result->fetch_assoc();
$max_kapasitas = $data['kapasitas'];

$title = 'Reservasi';
include('../layout/index.php');
?>

<main class="h-full pb-16 overflow-y-auto">
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-yellow-400">
            Reservasi Meja
        </h2>
        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <form action="mejaTersedia.php" method="post">
                <label class="w-w-full block text-sm mb-2 ml-3">
                    <span class="text-gray-700 dark:text-gray-400">
                        Tanggal reservasi
                    </span>
                    <input type="date" name="tanggal_reservasi" class="block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-yellow-400 focus:outline-none focus:shadow-outline-yellow form-input">
                </label>
                <label class="w-full block text-sm mb-2 ml-3">
                    <span class="text-gray-700 dark:text-gray-400">
                        Jam reservasi
                    </span>
                    <select name="jam_reservasi" class="block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-yellow-400 focus:outline-none focus:shadow-outline-yellow form-select">
                        <option value="" disabled selected>Pilih Jam...</option>
                        <?php
                        $start = new DateTime('10:00');
                        $end   = new DateTime('21:01');
                        $interval = new DateInterval('PT1H30M');
                        $period = new DatePeriod($start, $interval, $end);

                        foreach ($period as $waktu) {
                            $jam = $waktu->format("H:i");
                            echo "<option value='$jam'>$jam</option>";
                        }
                        ?>
                    </select>
                </label>
                <label class="w-full block text-sm mb-2 ml-3">
                    <span class="text-gray-700 dark:text-gray-400">Kapasitas</span>
                    <select name="kapasitas" class="block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-yellow-400 focus:outline-none focus:shadow-outline-yellow form-select">
                        <option value="" disabled selected>Pilih Kapasitas...</option>
                        <?php for($i = 1; $i <= $max_kapasitas; $i++): ?>
                            <option value="<?= $i ?>"><?= $i ?> Orang</option>
                        <?php endfor; ?>
                    </select>
                </label>        
                <button type="submit" value="tambahMeja" class="ml-auto mb-2 block w-full mt-1 px-5 py-3 text-sm font-medium transition-colors duration-150 text-white bg-green-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-green-600 hover:bg-green-700 focus:outline-none focus:shadow-outline-green">
                    <i class="fas fa-search"></i> Cari
                </button>
            </form> 
        </div>
    </div>
</main>
<?php include('../layout/footer.php'); ?>