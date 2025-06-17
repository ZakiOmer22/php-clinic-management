<?php
$currentPage = basename($_SERVER['PHP_SELF']);

function isActive($page)
{
    global $currentPage;
    return $currentPage === $page ? 'bg-blue-700 text-white' : 'text-blue-100 hover:bg-blue-600 hover:text-white';
}
?>

<aside class="bg-blue-800 text-white w-64 min-h-screen fixed">
    <div class="p-4 text-center font-bold text-xl border-b border-blue-700">PHP Project</div>
    <nav class="mt-4 space-y-1">

        <!-- Dashboard -->
        <a href="dashboard.php" class="block px-6 py-3 <?= isActive('dashboard.php') ?>">🏠 Dashboard</a>

        <!-- Manage Patients -->
        <a href="patients.php" class="block px-6 py-3 <?= isActive('patients.php') ?>">👨‍⚕️ Patients</a>

        <!-- Manage Appointments -->
        <a href="appointments.php" class="block px-6 py-3 <?= isActive('appointments.php') ?>">📅 Appointments</a>

        <!-- Manage Lab Tests -->
        <a href="labtests.php" class="block px-6 py-3 <?= isActive('labtests.php') ?>">🧪 Lab Test</a>

        <!-- Manage Prescriptions -->
        <a href="prescriptions.php" class="block px-6 py-3 <?= isActive('prescriptions.php') ?>">💊 Prescriptions</a>


        <!-- Manage Users -->
        <a href="users.php" class="block px-6 py-3 <?= isActive('users.php') ?>">🛡️ Users</a>

    </nav>
</aside>