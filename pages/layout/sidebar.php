<aside class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0">
  <div class="py-4 text-gray-500 dark:text-gray-100">
    <a class="ml-6 text-lg font-bold text-yellow-400 dark:text-yellow-400" href="/ayambolobebek/pages">
      AYAM BOLO BEBEK
    </a>
    <ul class="mt-6">
      <li class="relative px-6 py-3">
        <!-- Active items have the snippet below -->
        <?php if($_SERVER['PHP_SELF'] == '/ayambolobebek/pages/dashboard/dashboard.php'){
                echo '<span
                  class="absolute inset-y-0 left-0 w-1 bg-yellow-400 rounded-tr-lg rounded-br-lg"
                  aria-hidden="true"
                ></span>';
               }
              ?>
        <!-- Add this classes to an active anchor (a tag) -->
        <!-- text-gray-800 dark:text-gray-100 -->
        <a class="<?php echo ($_SERVER['PHP_SELF'] == '/ayambolobebek/pages/dashboard/dashboard.php' ? 'text-gray-800 dark:text-yellow-400' : ''); ?> inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
          href="../dashboard/dashboard.php">
          <i class="fas fa-home"></i>
          <span class="ml-4">Dashboard</span>
        </a>
      </li>
      <hr>
      <?php if($_SESSION['role'] == 'admin'): ?>
      <li class="relative px-6 py-3">
        <!-- Active items have the snippet below -->
        <?php if($_SERVER['PHP_SELF'] == '/ayambolobebek/pages/meja/meja.php'){
                echo '<span
                  class="absolute inset-y-0 left-0 w-1 bg-yellow-400 rounded-tr-lg rounded-br-lg"
                  aria-hidden="true"
                ></span>';
               }
              ?>
        <!-- Add this classes to an active anchor (a tag) -->
        <!-- text-gray-800 dark:text-gray-100 -->
        <a class="<?php echo ($_SERVER['PHP_SELF'] == '/ayambolobebek/pages/meja/meja.php' ? 'text-gray-800 dark:text-yellow-400' : ''); ?> inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
          href="../meja/meja.php">
          <i class="fas fa-th-large"></i>
          <span class="ml-4">Data Meja</span>
        </a>
      </li>
      <li class="relative px-6 py-3">
        <!-- Active items have the snippet below -->
        <?php if($_SERVER['PHP_SELF'] == '/ayambolobebek/pages/menu/menu.php'){
                echo '<span
                  class="absolute inset-y-0 left-0 w-1 bg-yellow-400 rounded-tr-lg rounded-br-lg"
                  aria-hidden="true"
                ></span>';
               }
              ?>
        <!-- Add this classes to an active anchor (a tag) -->
        <!-- text-gray-800 dark:text-gray-100 -->
        <a class="<?php echo ($_SERVER['PHP_SELF'] == '/ayambolobebek/pages/menu/menu.php' ? 'text-gray-800 dark:text-yellow-400' : ''); ?> inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
          href="../menu/menu.php">
          <i class="fas fa-utensils"></i>
          <span class="ml-4">Data Menu</span>
        </a>
      </li>
      <?php endif; ?>
      <?php if($_SESSION['role'] == 'kasir'): ?>
        <li class="relative px-6 py-3">
          <!-- Active items have the snippet below -->
          <?php if($_SERVER['PHP_SELF'] == '/ayambolobebek/pages/pesanan/pesanan.php'){
            echo '<span
            class="absolute inset-y-0 left-0 w-1 bg-yellow-400 rounded-tr-lg rounded-br-lg"
            aria-hidden="true"
            ></span>';
            }
            ?>
        <!-- Add this classes to an active anchor (a tag) -->
        <!-- text-gray-800 dark:text-gray-100 -->
        <a class="<?php echo ($_SERVER['PHP_SELF'] == '/ayambolobebek/pages/pesanan/pesanan.php' ? 'text-gray-800 dark:text-yellow-400' : ''); ?> inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
        href="../pesanan/pesanan.php">
        <i class="fas fa-shopping-cart"></i>
        <span class="ml-4">Pesanan</span>
      </a>
      </li> 
      <?php endif; ?>
      <?php if($_SESSION['role'] == 'pelanggan'): ?>
      <hr>
      <li class="relative px-6 py-3">
        <!-- Active items have the snippet below -->
        <?php if($_SERVER['PHP_SELF'] == '/ayambolobebek/pages/reservasi/reservasi.php'){
                echo '<span
                  class="absolute inset-y-0 left-0 w-1 bg-yellow-400 rounded-tr-lg rounded-br-lg"
                  aria-hidden="true"
                ></span>';
               }
              ?>
        <!-- Add this classes to an active anchor (a tag) -->
        <!-- text-gray-800 dark:text-gray-100 -->
        <a class="<?php echo ($_SERVER['PHP_SELF'] == '/ayambolobebek/pages/reservasi/reservasi.php' ? 'text-gray-800 dark:text-yellow-400' : ''); ?> inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
          href="../reservasi/reservasi.php">
          <i class="fas fa-edit"></i>
          <span class="ml-4">Reservasi</span>
        </a>
      </li>
      <li class="relative px-6 py-3">
        <!-- Active items have the snippet below -->
        <?php if($_SERVER['PHP_SELF'] == '/ayambolobebek/pages/reservasi/reservasiSaya.php'){
                echo '<span
                  class="absolute inset-y-0 left-0 w-1 bg-yellow-400 rounded-tr-lg rounded-br-lg"
                  aria-hidden="true"
                ></span>';
               }
              ?>
        <!-- Add this classes to an active anchor (a tag) -->
        <!-- text-gray-800 dark:text-gray-100 -->
        <a class="<?php echo ($_SERVER['PHP_SELF'] == '/ayambolobebek/pages/reservasi/reservasiSaya.php' ? 'text-gray-800 dark:text-yellow-400' : ''); ?> inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
          href="../reservasi/reservasiSaya.php">
          <i class="fas fa-ticket-alt"></i>
          <span class="ml-4">Reservasi Saya</span>
        </a>
      </li>
      <?php endif; ?>
      <hr>
      <li class="relative px-6 py-3">
        <!-- Active items have the snippet below -->
        <?php if($_SERVER['PHP_SELF'] == '/ayambolobebek/pages/riwayat/riwayat.php'){
                echo '<span
                  class="absolute inset-y-0 left-0 w-1 bg-yellow-400 rounded-tr-lg rounded-br-lg"
                  aria-hidden="true"
                ></span>';
               }
              ?>
        <!-- Add this classes to an active anchor (a tag) -->
        <!-- text-gray-800 dark:text-gray-100 -->
        <a class="<?php echo ($_SERVER['PHP_SELF'] == '/ayambolobebek/pages/riwayat/riwayat.php' ? 'text-gray-800 dark:text-yellow-400' : ''); ?> inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
          href="../riwayat/riwayat.php">
          <i class="fas fa-history"></i>
          <span class="ml-4">Riwayat</span>
        </a>
      </li>
    </ul>
    <!-- <div class="px-6 my-6">
            <button
              class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
            >
              Create account
              <span class="ml-2" aria-hidden="true">+</span>
            </button>
          </div> -->
  </div>
</aside>