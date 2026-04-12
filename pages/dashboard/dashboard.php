<?php
include('../controllers/authCheck.php');
$title = 'Dashboard';
include('../layout/index.php');
?>

<main class="h-full pb-16 overflow-y-auto">
     <!-- Remove everything INSIDE this div to a really blank page -->
     <div class="container px-6 mx-auto grid">
         <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-yellow-400">
            Dashboard
          </h2>          
          <?php if(isset($_SESSION['success'])): ?>
            <div class="px-4 py-3 mb-8 bg-green-300 rounded-lg shadow-md dark:bg-green-300">
              <p class="text-sm font-semibold text-white dark:text-white">
                <?= $_SESSION['success']; unset($_SESSION['success'])?>. Selamat datang <?= $_SESSION['nama_lengkap'] ?>. Kamu log in sebagai <?= $_SESSION['role'] ?>.
              </p>
            </div>
        <?php endif; ?>
     </div>
 </main>
 <?php include('../layout/footer.php'); ?>