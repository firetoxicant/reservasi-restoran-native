<?php
include('../controllers/authCheck.php');
$title = 'Data Meja';
include('../layout/index.php');
$data_meja = include('../controllers/selectMeja.php');
?>

<main class="h-full pb-16 overflow-y-auto">
    <!-- Remove everything INSIDE this div to a really blank page -->
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-yellow-400">
            Data Meja
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
        <button @click="openModal" class="px-4 py-2 text-sm text-center font-medium leading-5 w-32 ml-auto mb-2 text-white transition-colors duration-150 bg-green-400 border border-transparent rounded-lg active:bg-green-600 hover:bg-green-700 focus:outline-none focus:shadow-outline-green">
                <i class="fas fa-plus-square"></i> Tambah
              </button>
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-100 uppercase border-b dark:border-gray-700 bg-yellow-300 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">No</th>
                            <th class="px-4 py-3">Nama</th>
                            <th class="px-4 py-3">Kapasitas</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        <?php
                        if ($data_meja->num_rows > 0) {       
                            $nomor = 1;                 
                            while($row = $data_meja->fetch_assoc()) {
                                echo "<tr class=' dark:text-gray-200 hover:bg-yellow-100 dark:hover:text-gray-800'>";
                                echo "<td class='border px-4 py-2'>" . $nomor . "</td>";
                                echo "<td class='border px-4 py-2'>" . $row['nama_meja'] . "</td>";
                                echo "<td class='border px-4 py-2'>" . $row['kapasitas_meja'] . " Orang</td>";
                                if($row['status'] == "tersedia"){
                                    echo "<td class='border px-4 py-2'><span class='px-2 py-1 font-semibold leading-tight <?php  ?> text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100'>". $row['status'] ."</span></td>";
                                }
                                else if($row['status'] == "dipesan"){
                                    echo "<td class='border px-4 py-2'><span class='px-2 py-1 font-semibold leading-tight <?php  ?> text-yellow-700 bg-yellow-100 rounded-full dark:bg-yellow-700 dark:text-yellow-100'>". $row['status'] ."</span></td>";
                                }
                                else{
                                    echo "<td class='border px-4 py-2'><span class='px-2 py-1 font-semibold leading-tight <?php  ?> text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100'>". $row['status'] ."</span></td>";
                                }
                                echo "<td class='border px-4 py-2'>
                                <a href='formEdit.php?id=" . $row['id'] . "'><i class='fas fa-edit text-yellow-400 mr-2'></i></a>
                                <a href='../controllers/hapusMeja.php?id=" . $row['id'] . "'><i class='fas fa-trash-alt text-red-600'></i></a>
                                </td>";
                                echo "</tr>";
                                $nomor++;
                            }
                        } else {
                            echo "<tr><td colspan='6' class='border px-4 py-2 text-center text-gray-700 dark:text-gray-400'>Tidak ada data meja</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<?php 
include('formTambah.php'); 
include('../layout/footer.php'); 
?>