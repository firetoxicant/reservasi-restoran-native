<?php
include('../controllers/authCheck.php');
include('../config/koneksi.php');

$id = $_GET['id'];
$sql = "SELECT nama_meja, kapasitas_meja, status FROM tbl_meja WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data_meja = $result->fetch_assoc();
} else {
    echo "Data meja tidak ditemukan!";
    exit;
}
include('../layout/index.php');
?>

<main class="h-full pb-16 overflow-y-auto">
    <!-- Remove everything INSIDE this div to a really blank page -->
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-yellow-400">
            Edit Data Meja
        </h2>
        <?php if(isset($_SESSION['error'])): ?>
            <div class="px-4 py-3 mb-8 bg-red-400 rounded-lg shadow-md dark:bg-red-400">
              <p class="text-sm font-semibold text-white dark:text-white">
                <?= $_SESSION['error']; unset($_SESSION['error'])?>
              </p>
            </div>
        <?php endif; ?>
        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <form action="../controllers/updateMeja.php" method="post">
                <input type="hidden" name="id" value=<?php echo $id ?>>
                <label class="block text-sm mb-2">
                    <span class="text-gray-700 dark:text-gray-400">
                        Nama Meja
                    </span>
                    <input name="nama_meja" value="<?php echo $data_meja['nama_meja'] ?>"
                        class="block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-yellow-400 focus:outline-none focus:shadow-outline-yellow form-input"
                        placeholder="Contoh: Meja 1">
                </label>
                <label class="block text-sm mb-2">
                    <span class="text-gray-700 dark:text-gray-400">
                        Kapasitas
                    </span>
                    <input name="kapasitas_meja" type="number" step="1" min="1" value="<?php echo $data_meja['kapasitas_meja'] ?>"
                        class="block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-yellow-400 focus:outline-none focus:shadow-outline-yellow form-input"
                        placeholder="Contoh: 1 / 2 / 3">
                </label>
                <label class="block text-sm mb-2">
                    <span class="text-gray-700 dark:text-gray-400">
                        Status
                    </span>
                    <select
                        class="block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-yellow-400 focus:outline-none focus:shadow-outline-yellow form-input"
                        name="status" id="status">
                        <option value="" disabled selected>Pilih Status...</option>
                        <option value="tersedia" <?php echo ($data_meja['status'] == "tersedia") ? "selected" : "" ?>>Tersedia</option>
                        <option value="tidak tersedia" <?php echo ($data_meja['status'] == "tidak tersedia") ? "selected" : "" ?>>Tidak Tersedia</option>
                    </select>
                </label>
                <footer class="mt-5 bg-gray-50 dark:bg-gray-800">
                    <a href="meja.php" class="mr-4 w-full px-5 py-3 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-yellow-300 rounded-lg dark:text-white sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:text-white hover:border-yellow-500 focus:border-yellow-500 active:text-yellow-500 hover:bg-yellow-400 focus:outline-none focus:shadow-outline-yellow">
                        Kembali
                    </a>
                    <button type="submit" value="tambahMeja"
                        class="ml-auto px-5 py-3 text-sm font-medium leading-5 transition-colors duration-150 text-white bg-blue-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
                        Simpan
                    </button>
                </footer>
            </form>
        </div>
    </div>
</main>
<?php  
include('../layout/footer.php'); 
?>