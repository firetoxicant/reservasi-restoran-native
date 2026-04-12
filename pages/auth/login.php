<?php 
session_start(); 
if(isset($_SESSION['id'])){
  header('Location: ../dashboard/dashboard.php');
  exit;
}
?>
<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - AYAM Bolo Bebek SDA</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../../assets/css/tailwind.output.css" />
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
      defer
    ></script>
    <script src="../../assets/js/init-alpine.js"></script>
  </head>
  <body>
    <?php if(isset($_SESSION['success'])): ?>
      <div class="justify-items-center">
        <div class="absolute content-center px-4 py-3 mb-8 bg-green-300 rounded-lg shadow-md dark:bg-green-300">
          <p class="text-sm font-semibold text-white dark:text-white">
            <?= $_SESSION['success']; unset($_SESSION['success'])?>
          </p>
        </div>
      </div>
    <?php endif; ?>
    <?php if(isset($_SESSION['error'])): ?>
      <div class="justify-items-center">
        <div class="absolute content-center px-4 py-3 mb-8 bg-red-400 rounded-lg shadow-md dark:bg-red-400">
          <p class="text-sm font-semibold text-white dark:text-white">
            <?= $_SESSION['error']; unset($_SESSION['error'])?>
          </p>
        </div>
      </div>
    <?php endif; ?>
    <div class="flex items-center min-h-screen p-6 bg-yellow-200 dark:bg-gray-900">
      <div
        class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800"
      >
        <div class="flex flex-col overflow-y-auto md:flex-row">
          <div class="h-32 md:h-auto md:w-1/2">
            <img
              aria-hidden="true"
              class="object-cover w-full h-full dark:hidden"
              src="../../assets/img/abb.png"
              alt="Office"
            />
            <img
              aria-hidden="true"
              class="hidden object-cover w-full h-full dark:block"
              src="../../assets/img/abb.png"
              alt="Office"
            />
          </div>
          <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
            <div class="w-full">
              <h1
                class="mb-4 text-xl font-semibold text-yellow-700 dark:text-yellow-200"
              >
                Login
              </h1>
              <form action="../controllers/login.php" method="post">
                <label class="block text-sm">
                  <span class="text-gray-700 dark:text-gray-400">Email</span>
                  <input name="email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ""; unset($_SESSION['email']);?>"
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    placeholder="RaihanLapindo@gmail.com"
                  />
                </label>
                <label class="block mt-4 text-sm">
                  <span class="text-gray-700 dark:text-gray-400">Password</span>
                  <input name="password"
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    placeholder="***************"
                    type="password"
                  />
                </label>
  
                <!-- You should use a button here, as the anchor is only used for the example  -->
                <button type="submit" class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-yellow-300 border border-transparent rounded-lg active:bg-yellow-600 hover:bg-yellow-500 focus:outline-none focus:shadow-outline-yellow">
                  Log in</button>
              </form>

              <hr class="my-8" />
              
              <p class="mt-1">
                <a
                  class="text-sm font-medium text-yellow-600 dark:text-yellow-400 hover:underline"
                  href="register.php"
                >
                  Daftar akun
                </a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
