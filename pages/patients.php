<?php
include '../includes/data.php';
include '../includes/db.php';

$stmt = "
    SELECT * from patients";
$result = mysqli_query($conn, $stmt);
?>

<!-- Sidebar -->
<?php include '../includes/sidebar.php'; ?>

<!-- Main Content -->
<div class="ml-64 min-h-screen">
    <?php include '../includes/header.php'; ?>

    <main class="p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Overview</h2>

        <!-- Two Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
            <!-- Patients Card -->
            <div class="bg-white shadow-md p-6 rounded-xl hover:shadow-lg transition flex justify-between items-center">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Patients</p>
                    <p class="text-3xl font-bold text-blue-700"><?= getTotalPatients($conn); ?></p>
                </div>
                <div class="text-blue-600 text-5xl select-none">👨‍⚕️</div>
            </div>

            <!-- Patients This Month Card -->
            <div class="bg-white shadow-md p-6 rounded-xl hover:shadow-lg transition flex justify-between items-center">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Patients This Month</p>
                    <p class="text-3xl font-bold text-indigo-700"><?= getPatientsThisMonth($conn); ?></p>
                </div>
                <div class="text-indigo-600 text-5xl select-none">📈</div>
            </div>
        </div>

        <!-- Buttons Above Table -->
        <div class="flex justify-end space-x-3 mb-4">
            <a href="add_appointment.php"
                class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition shadow-md">
                Add Appointment
            </a>
            <a href="delete_multiple.php"
                class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition shadow-md">
                Delete Selected
            </a>
            <!-- You can add more bulk action buttons here -->
        </div>

        <!-- Data Table -->
        <div class="bg-white shadow-md rounded-xl overflow-hidden w-full">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-700">Recent Appointments</h3>
            </div>
            <div class="overflow-x-auto">
                <form method="POST" action="delete_multiple.php">
                    <table class="w-full text-sm text-left text-gray-600">
                        <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                            <tr>
                                <th class="px-6 py-3">Id</th>
                                <th class="px-6 py-3">Patient Id</th>
                                <th class="px-6 py-3">Patient Name</th>
                                <th class="px-6 py-3">Gender</th>
                                <th class="px-6 py-3">Phone</th>
                                <th class="px-6 py-3">Email</th>
                                <th class="px-6 py-3">Select</th>
                                <th class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-3 font-medium"><?= htmlspecialchars($row['id']); ?></td>
                                    <td class="px-6 py-3"><?= htmlspecialchars($row['id']); ?></td>
                                    <td class="px-6 py-3"><?= htmlspecialchars($row['name'] ?? 'Unknown'); ?></td>
                                    <td class="px-6 py-3"><?= htmlspecialchars(ucfirst($row['gender'] ?? 'N/A')); ?></td>
                                    <td class="px-6 py-3"><?= htmlspecialchars($row['phone'] ?? 'N/A'); ?></td>
                                    <td class="px-6 py-3"><?= htmlspecialchars($row['email'] ?? 'N/A'); ?></td>
                                    <td class="px-6 py-3">
                                        <input type="checkbox" name="appointment_ids[]" value="<?= htmlspecialchars($row['id']); ?>" class="form-checkbox" />
                                    </td>
                                    <td class="px-6 py-3 space-x-2">
                                        <a href="edit_appointment.php?id=<?= urlencode($row['id']); ?>"
                                            class="px-3 py-1 text-sm text-white bg-blue-600 rounded hover:bg-blue-700 transition">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </main>

    <?php include '../includes/footer.php'; ?>
</div>