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
            <a href="add_prescription.php" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition shadow-md">Add Prescription</a>
            <a href="delete_multiple_prescriptions.php" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition shadow-md">Delete Selected</a>
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
                            <th class="px-6 py-3">Patient Name</th>
                            <th class="px-6 py-3">Doctor</th>
                            <th class="px-6 py-3">Medication</th>
                            <th class="px-6 py-3">Dosage</th>
                            <th class="px-6 py-3">Prescribed Date</th>
                            <th class="px-6 py-3">Notes</th>
                            <th class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php
                        // Updated query: get doctor_name from appointments (matching patient_id and nearest prescribed_at date)
                        // We'll LEFT JOIN patients as before
                        // For doctor name, join appointments on patient_id and pick the appointment closest to the prescription date (simple approach: max prescribed_at <= prescription date)

                        // Because MySQL doesn't support direct join with closest date easily, we'll do a subquery to pick the doctor's name for each prescription

                        $sql = "
                            SELECT
                                p.id,
                                p.patient_id,
                                pat.name AS patient_name,
                                p.medicine,
                                p.dosage,
                                p.notes,
                                p.prescribed_at,
                                (
                                    SELECT a.doctor_name
                                    FROM appointments a
                                    WHERE a.patient_id = p.patient_id
                                      AND a.appointment_date <= p.prescribed_at
                                    ORDER BY a.appointment_date DESC
                                    LIMIT 1
                                ) AS doctor_name
                            FROM prescriptions p
                            LEFT JOIN patients pat ON p.patient_id = pat.id
                            ORDER BY p.prescribed_at ASC
                            LIMIT 50
                        ";

                        $result = mysqli_query($conn, $sql);

                        if (!$result) {
                            echo '<tr><td colspan="9" class="text-center text-red-500 py-4">Failed to retrieve prescriptions data.</td></tr>';
                        } else {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $id = htmlspecialchars($row['id'] ?? '');
                                $patient_id = htmlspecialchars($row['patient_id'] ?? '');
                                $patient_name = htmlspecialchars($row['patient_name'] ?? 'Unknown Patient');
                                $doctor_name = htmlspecialchars($row['doctor_name'] ?? 'Unknown Doctor');
                                $medication = htmlspecialchars($row['medicine'] ?? '');
                                $dosage = htmlspecialchars($row['dosage'] ?? '');
                                $prescribed_date = !empty($row['prescribed_at']) ? htmlspecialchars(date("Y-m-d", strtotime($row['prescribed_at']))) : 'N/A';
                                $notes = htmlspecialchars($row['notes'] ?? '');

                                echo "<tr class='hover:bg-gray-50 transition'>";
                                echo "<td class='px-6 py-3 font-medium'>{$id}</td>";
                                echo "<td class='px-6 py-3'>{$patient_id}</td>";
                                echo "<td class='px-6 py-3'>{$patient_name}</td>";
                                echo "<td class='px-6 py-3'>{$doctor_name}</td>";
                                echo "<td class='px-6 py-3'>{$medication}</td>";
                                echo "<td class='px-6 py-3'>{$dosage}</td>";
                                echo "<td class='px-6 py-3'>{$prescribed_date}</td>";
                                echo "<td class='px-6 py-3'>{$notes}</td>";
                                echo "<td class='px-6 py-3 space-x-2'>
                                        <a href='edit_prescription.php?id={$id}' class='px-3 py-1 text-sm text-white bg-blue-600 rounded hover:bg-blue-700 transition'>Edit</a>
                                      </td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <?php include '../includes/footer.php'; ?>
</div>