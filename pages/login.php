<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Login | Clinic Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

  <div class="w-full max-w-md p-8 bg-white rounded-xl shadow-md">
    <div class="mb-6 text-center">
      <h2 class="text-2xl font-bold text-blue-700">Clinic Admin Login</h2>
      <p class="text-gray-500 mt-1 text-sm">Welcome back! Please enter your credentials</p>
    </div>

    <?php if (isset($_SESSION['login_error'])): ?>
      <div class="mb-4 p-3 text-sm text-red-700 bg-red-100 rounded border border-red-400">
        <?php
        echo htmlspecialchars($_SESSION['login_error']);
        unset($_SESSION['login_error']); // Clear error after showing
        ?>
      </div>
    <?php endif; ?>

    <form action="../components/process_login.php" method="POST" class="space-y-5">
      <!-- Your form inputs -->
      <div>
        <label for="username" class="block text-sm text-gray-600 mb-1">Username or Email</label>
        <input type="text" name="username" id="username" required
          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>
      <div>
        <label for="password" class="block text-sm text-gray-600 mb-1">Password</label>
        <input type="password" name="password" id="password" required
          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>
      <div>
        <button type="submit"
          class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg font-semibold transition">
          Login
        </button>
      </div>
      <div class="text-sm text-center text-gray-500">
        <a href="#" class="hover:underline">Forgot your password?</a>
      </div>
    </form>
  </div>

</body>

</html>