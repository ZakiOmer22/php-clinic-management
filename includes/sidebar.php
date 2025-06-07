<?php
$currentPage = basename($_SERVER['PHP_SELF']);
function isActive($page)
{
    global $currentPage;
    return $currentPage === $page ? 'bg-blue-700 text-white' : 'text-blue-100 hover:bg-blue-600 hover:text-white';
}
?>
<aside class="bg-blue-800 text-white w-64 min-h-screen fixed">
    <div class="p-4 text-center font-bold text-xl border-b border-blue-700">Clinic Admin</div>
    <nav class="mt-4 space-y-1">

        <!-- Dashboard -->
        <a href="dashboard.php" class="block px-6 py-3 <?= isActive('dashboard.php') ?>">🏠 Dashboard</a>

        <!-- Patients Dropdown -->
        <details class="group" <?= strpos($currentPage, 'patient') !== false ? 'open' : '' ?>>
            <summary class="px-6 py-3 cursor-pointer flex justify-between items-center <?= strpos($currentPage, 'patient') !== false ? 'bg-blue-700 text-white' : 'text-blue-100 hover:bg-blue-600 hover:text-white' ?>">
                👨‍⚕️ Patients
                <span class="transform group-open:rotate-180 transition-transform">▼</span>
            </summary>
            <div class="ml-4">
                <a href="add_patient.php" class="block px-6 py-2 <?= isActive('add_patient.php') ?>">➕ Add</a>
                <a href="patients.php" class="block px-6 py-2 <?= isActive('patients.php') ?>">📋 Manage</a>
            </div>
        </details>

        <!-- Appointments Dropdown -->
        <details class="group" <?= strpos($currentPage, 'appointment') !== false ? 'open' : '' ?>>
            <summary class="px-6 py-3 cursor-pointer flex justify-between items-center <?= strpos($currentPage, 'appointment') !== false ? 'bg-blue-700 text-white' : 'text-blue-100 hover:bg-blue-600 hover:text-white' ?>">
                📅 Appointments
                <span class="transform group-open:rotate-180 transition-transform">▼</span>
            </summary>
            <div class="ml-4">
                <a href="add_appointment.php" class="block px-6 py-2 <?= isActive('add_appointment.php') ?>">➕ Add</a>
                <a href="appointments.php" class="block px-6 py-2 <?= isActive('appointments.php') ?>">📋 Manage</a>
            </div>
        </details>

        <!-- Lab Tests Dropdown -->
        <details class="group" <?= strpos($currentPage, 'labtest') !== false ? 'open' : '' ?>>
            <summary class="px-6 py-3 cursor-pointer flex justify-between items-center <?= strpos($currentPage, 'labtest') !== false ? 'bg-blue-700 text-white' : 'text-blue-100 hover:bg-blue-600 hover:text-white' ?>">
                🧪 Lab Tests
                <span class="transform group-open:rotate-180 transition-transform">▼</span>
            </summary>
            <div class="ml-4">
                <a href="add_labtest.php" class="block px-6 py-2 <?= isActive('add_labtest.php') ?>">➕ Add</a>
                <a href="labtests.php" class="block px-6 py-2 <?= isActive('labtests.php') ?>">📋 Manage</a>
            </div>
        </details>

        <!-- Prescriptions Dropdown -->
        <details class="group" <?= strpos($currentPage, 'prescription') !== false ? 'open' : '' ?>>
            <summary class="px-6 py-3 cursor-pointer flex justify-between items-center <?= strpos($currentPage, 'prescription') !== false ? 'bg-blue-700 text-white' : 'text-blue-100 hover:bg-blue-600 hover:text-white' ?>">
                💊 Prescriptions
                <span class="transform group-open:rotate-180 transition-transform">▼</span>
            </summary>
            <div class="ml-4">
                <a href="add_prescription.php" class="block px-6 py-2 <?= isActive('add_prescription.php') ?>">➕ Add</a>
                <a href="prescriptions.php" class="block px-6 py-2 <?= isActive('prescriptions.php') ?>">📋 Manage</a>
            </div>
        </details>

    </nav>
</aside>