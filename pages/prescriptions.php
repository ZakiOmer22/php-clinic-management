<?php
// prescriptions.php

// Include your database connection and helper functions
include '../includes/data.php';
include '../includes/db.php';
?>
<!-- Sidebar -->
<?php include '../includes/sidebar.php'; ?>

<!-- Main Content -->
<div class="ml-64 min-h-screen">
    <?php include '../includes/header.php'; ?>

    <main class="p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Prescriptions Overview</h2>

        <!-- Cards Section -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
            <!-- Total Prescriptions Card -->
            <div class="bg-white shadow-md p-6 rounded-xl hover:shadow-lg transition flex justify-between items-center">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Prescriptions</p>
                    <p class="text-3xl font-bold text-indigo-700"><?= getTotalPrescriptions($conn); ?></p>
                </div>
                <div class="text-indigo-600 text-5xl select-none">💊</div>
            </div>

            <!-- Prescriptions This Month Card -->
            <div class="bg-white shadow-md p-6 rounded-xl hover:shadow-lg transition flex justify-between items-center">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Prescriptions This Month</p>
                    <?php
                    $sqlMonth = "SELECT COUNT(*) as monthly FROM prescriptions WHERE MONTH(prescribed_at) = MONTH(CURRENT_DATE()) AND YEAR(prescribed_at) = YEAR(CURRENT_DATE())";
                    $resultMonth = mysqli_query($conn, $sqlMonth);
                    $rowMonth = mysqli_fetch_assoc($resultMonth);
                    $monthlyCount = $rowMonth['monthly'] ?? 0;
                    ?>
                    <p class="text-3xl font-bold text-purple-700"><?= $monthlyCount; ?></p>
                </div>
                <div class="text-purple-600 text-5xl select-none">📅</div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end space-x-3 mb-4">
            <a href="add_prescription.php" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition shadow-md">Add</a>
        </div>

        <!-- Prescriptions Table -->
        <div class="bg-white shadow-md rounded-xl overflow-hidden w-full">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-700">Recent Prescriptions</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-600">
                    <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                        <tr>
                            <th class="px-6 py-3">Id</th>
                            <th class="px-6 py-3">Patient Id</th>
                            <th class="px-6 py-3">Medicine</th>
                            <th class="px-6 py-3">Dosage</th>
                            <th class="px-6 py-3">Notes</th>
                            <th class="px-6 py-3">Prescribed at</th>
                            <th class="px-6 py-3">Select</th>
                            <th class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php
                        $stmt = "
                            SELECT * from prescriptions";

                        $result = mysqli_query($conn, $stmt);

                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = htmlspecialchars($row['id']);
                            $patient_id = htmlspecialchars($row['id']);
                            $medicine = htmlspecialchars($row['medicine'] ?? 'Unknown');
                            $dosage = htmlspecialchars($row['dosage'] ?? 'Unknown');
                            $notes = htmlspecialchars($row['notes'] ?? 'Unknown');
                            $prescribed_at = htmlspecialchars(date("Y-m-d", strtotime($row['prescribed_at'])));
                        ?>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-3 font-medium"><?= $id; ?></td>
                                <td class="px-6 py-3"><?= $patient_id; ?></td>
                                <td class="px-6 py-3"><?= $medicine; ?></td>
                                <td class="px-6 py-3"><?= $dosage; ?></td>
                                <td class="px-6 py-3"><?= $notes; ?></td>
                                <td class="px-6 py-3"><?= $prescribed_at; ?></td>
                                <td class="px-6 py-3">
                                    <input type="checkbox" name="appointment_ids[]" value="<?= htmlspecialchars($row['id']); ?>" class="form-checkbox" />
                                </td>
                                <td class="px-6 py-3 space-x-2">
                                    <a href="edit_lab_test.php?id=<?= $id ?>"
                                        class="px-3 py-1 text-sm text-white bg-blue-600 rounded hover:bg-blue-700 transition">
                                        Edit
                                    </a>
                                    <a href="delete_prescription.php?id=<?= urlencode($row['id']); ?>"
                                        onclick="return confirm('Are you sure you want to delete this prescription?');"
                                        class="px-3 py-1 text-sm text-white bg-red-600 rounded hover:bg-red-700 transition">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <?php include '../includes/footer.php'; ?>
</div>