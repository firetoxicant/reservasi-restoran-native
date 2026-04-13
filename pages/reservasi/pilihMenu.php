<?php
include('../controllers/authCheck.php');
include('../config/koneksi.php');

$sql = "SELECT * FROM tbl_menu WHERE status = 'tersedia'";
$result = $conn->query($sql);

$title = 'Pesan Menu';
include('../layout/index.php');

// Hitung total item di keranjang
$total_item = 0;
if (isset($_SESSION['keranjang'])) {
    $total_item = array_sum($_SESSION['keranjang']);
}
?>
<main class="h-full pb-16 overflow-y-auto">
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-yellow-400">
            Pilih Menu
        </h2>
        <div class="flex justify-between items-center">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-yellow-400">Pilih Menu</h2>
            <a href="keranjang.php" class="p-2 bg-yellow-300 text-white rounded-lg">
            <i class="fas fa-shopping-cart"></i> Keranjang (<?php echo $total_item; ?>)
            </a>
        </div>

        <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-3 w-full">
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while($menu = $result->fetch_assoc()): ?>
                    <div class="flex flex-col h-full p-4 bg-white rounded-lg shadow-md dark:bg-gray-800 border-t-4 border-yellow-300">
                    <img src="../../uploads/imgMenu/<?php echo $menu['gambar']?>" class="w-full h-48 object-cover rounded-lg">
                    
                    <div class="flex-grow mt-4">
                        <p class="text-lg font-bold text-yellow-700 dark:text-yellow-400"><?php echo $menu['nama_menu'] ?></p>
                        <p class="text-gray-600 dark:text-gray-200 text-sm mt-2"><?php echo $menu['deskripsi'] ?></p>
                    </div>

                    <div class="mt-auto pt-4">
                        <p class="mb-3 text-lg font-bold text-green-600">Rp. <?php echo number_format($menu['harga'], 0, ',', '.') ?></p>
                        
                        <form action="../controllers/proses_keranjang.php" method="POST" class="grid grid-cols-2 gap-2">
                            <input type="hidden" name="id_menu" value="<?php echo $menu['id'] ?>">
                            <input type="number" name="porsi" min="1" value="1" max="<?php echo $menu['stok'] ?>"
                                class="block w-full text-sm dark:bg-gray-700 form-input rounded-lg border-gray-300 dark:text-white">
                            <button type="submit" name="order_menu" 
                                    class="flex items-center justify-center text-sm font-medium text-white bg-green-400 rounded-lg hover:bg-green-500">
                                Tambah
                            </button>
                        </form>
                    </div>
                </div>
                <?php endwhile; ?>

            <?php else: ?>
                <p class="text-gray-600 dark:text-gray-400 col-span-full text-center py-10">
                    Maaf, tidak ada menu yang tersedia saat ini.
                </p>
            <?php endif; ?>
        </div> 
    </div>
</main>
<?php 
include('../layout/footer.php'); 
?>