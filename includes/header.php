<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Simple Clinic Management System</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-100 text-gray-800">
  <!-- Header Bar -->
  <header class="bg-white shadow fixed left-64 right-0 top-0 z-10 h-16 flex items-center justify-between px-6">
    <h1 class="text-xl font-semibold text-blue-800">Dashboard</h1>
    <div class="flex items-center gap-3">
      <span class="text-lg text-gray-600">Welcome, <span class="text-lg text-blue-600 uppercase"><strong><?php echo htmlspecialchars($_SESSION['username'] ?? 'Guest'); ?></strong></span></span>
      <form action="../components/logout.php" method="POST" style="display:inline;">
        <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 text-sm">Logout</button>
      </form>
    </div>
  </header>
  <main class="pt-20 px-6">
