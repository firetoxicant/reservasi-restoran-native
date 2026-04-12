<?php
session_start();
include('../layout/index.php');
?>

<main class="h-full pb-16 overflow-y-auto">
    <!-- Remove everything INSIDE this div to a really blank page -->
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-yellow-400">
            Tambah Data Menu
        </h2>
        <?php if(isset($_SESSION['error'])): ?>
            <div class="px-4 py-3 mb-8 bg-red-400 rounded-lg shadow-md dark:bg-red-400">
              <p class="text-sm font-semibold text-white dark:text-white">
                <?= $_SESSION['error']; unset($_SESSION['error'])?>
              </p>
            </div>
        <?php endif; ?>
        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <form action="../controllers/tambahMenu.php" method="post" enctype="multipart/form-data">
                <label class="block text-sm m-2 justify-items-center">
                    <span class="text-gray-700 dark:text-gray-400">
                        Gambar Menu
                    </span>
                    <input name="gambar" type="file" class="block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-yellow-400 focus:outline-none focus:shadow-outline-yellow form-input">
                </label>    
                <div class="flex">
                    <label class="block text-sm m-2 w-1/2">
                        <span class="text-gray-700 dark:text-gray-400">
                            Nama Menu
                        </span>
                        <input name="nama_menu"
                            class="block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-yellow-400 focus:outline-none focus:shadow-outline-yellow form-input"
                            placeholder="Contoh: Bebek Goreng">
                    </label>    
                    <label class="block text-sm m-2 w-1/2">
                        <span class="text-gray-700 dark:text-gray-400">
                            Harga Menu
                        </span>
                        <input name="harga"
                            class="block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-yellow-400 focus:outline-none focus:shadow-outline-yellow form-input"
                            placeholder="Contoh: 15000">
                    </label>    
                </div>
                <div class="flex">
                    <label class="block text-sm m-2 w-2/3">
                        <span class="text-gray-700 dark:text-gray-400">
                            Deskripsi
                        </span>
                        <textarea  name="deskripsi" class="block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-yellow-400 focus:outline-none focus:shadow-outline-yellow form-input"></textarea>
                    </label>    
                    <label class="block text-sm m-2 w-1/3">
                        <span class="text-gray-700 dark:text-gray-400">
                            Stok
                        </span>
                        <input type="number" value="1" step="1" min="1" name="stok"
                            class="block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-yellow-400 focus:outline-none focus:shadow-outline-yellow form-input">
                    </label>    
                </div>
                <div class="flex">
                    <label class="block text-sm m-2 w-1/2">
                        <span class="text-gray-700 dark:text-gray-400">
                            Kategori
                        </span>
                        <select
                            class="block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-yellow-400 focus:outline-none focus:shadow-outline-yellow form-input"
                            name="kategori" id="kategori">
                            <option value="" disabled selected>Pilih Kategori...</option>
                            <option value="makanan">Makanan</option>
                            <option value="minuman">Minuman</option>
                        </select>
                    </label>
                    <label class="block text-sm m-2 w-1/2">
                        <span class="text-gray-700 dark:text-gray-400">
                            Status
                        </span>
                        <select
                            class="block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-yellow-400 focus:outline-none focus:shadow-outline-yellow form-input"
                            name="status" id="status">
                            <option value="" disabled selected>Pilih Status...</option>
                            <option value="tersedia">Tersedia</option>
                            <option value="tidak tersedia">Tidak Tersedia</option>
                        </select>
                    </label>
                </div>
                <footer class="mt-5 bg-gray-50 dark:bg-gray-800">
                    <a href="menu.php" class="mr-4 w-full px-5 py-3 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-yellow-300 rounded-lg dark:text-white sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:text-white hover:border-yellow-500 focus:border-yellow-500 active:text-yellow-500 hover:bg-yellow-400 focus:outline-none focus:shadow-outline-yellow">
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