<?php
include '../includes/data.php';
include '../includes/db.php';
?>

<!-- Sidebar -->
<?php include '../includes/sidebar.php'; ?>

<!-- Main Content -->
<div class="ml-64 min-h-screen">
    <?php include '../includes/header.php'; ?>

    <main class="p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Lab Tests Overview</h2>

        <!-- Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
            <!-- Total Lab Tests -->
            <div class="bg-white shadow-md p-6 rounded-xl hover:shadow-lg transition flex justify-between items-center">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Lab Tests</p>
                    <p class="text-3xl font-bold text-green-700"><?= getTotalLabTests($conn); ?></p>
                </div>
                <div class="text-green-600 text-5xl select-none">🧪</div>
            </div>

            <!-- Pending Tests -->
            <div class="bg-white shadow-md p-6 rounded-xl hover:shadow-lg transition flex justify-between items-center">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Pending Tests</p>
                    <?php
                    $sqlPending = "SELECT COUNT(*) as pending FROM lab_tests WHERE status = 'Pending'";
                    $resultPending = mysqli_query($conn, $sqlPending);
                    $rowPending = mysqli_fetch_assoc($resultPending);
                    $pendingCount = $rowPending['pending'] ?? 0;
                    ?>
                    <p class="text-3xl font-bold text-yellow-700"><?= $pendingCount; ?></p>
                </div>
                <div class="text-yellow-600 text-5xl select-none">⏳</div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end space-x-3 mb-4">
            <a href="add_labtest.php"
                class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition shadow-md">
                Add Lab Test
            </a>
            <a href="delete_multiple_lab_tests.php"
                class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition shadow-md">
                Delete Selected
            </a>
        </div>

        <!-- Lab Tests Table -->
        <div class="bg-white shadow-md rounded-xl overflow-hidden w-full">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-700">Recent Lab Tests</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-600">
                    <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                        <tr>
                            <th class="px-6 py-3">Id</th>
                            <th class="px-6 py-3">Patient Id</th>
                            <th class="px-6 py-3">Patient Name</th>
                            <th class="px-6 py-3">Test Name</th>
                            <th class="px-6 py-3">Test Date</th>
                            <th class="px-6 py-3">Status</th>
                            <th class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php
                        $stmt = "
                            SELECT
                                lab_tests.id,
                                lab_tests.patient_id,
                                patients.name AS patient_name,
                                lab_tests.test_type,
                                lab_tests.test_date,
                                lab_tests.status
                            FROM lab_tests
                            LEFT JOIN patients ON lab_tests.patient_id = patients.id
                            ORDER BY lab_tests.test_date ASC
                        ";

                        $result = mysqli_query($conn, $stmt);

                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = htmlspecialchars($row['id']);
                            $patient_id = htmlspecialchars($row['patient_id']);
                            $patient_name = htmlspecialchars($row['patient_name'] ?? 'Unknown');
                            $test_name = htmlspecialchars($row['test_type'] ?? 'Unknown');
                            $test_date = htmlspecialchars(date("Y-m-d", strtotime($row['test_date'])));
                            $status = htmlspecialchars($row['status']);
                        ?>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-3 font-medium"><?= $id; ?></td>
                                <td class="px-6 py-3"><?= $patient_id; ?></td>
                                <td class="px-6 py-3"><?= $patient_name; ?></td>
                                <td class="px-6 py-3"><?= $test_name; ?></td>
                                <td class="px-6 py-3"><?= $test_date; ?></td>
                                <td class="px-6 py-3">
                                    <?php if ($status === 'Pending'): ?>
                                        <span class="text-yellow-600 font-semibold"><?= $status; ?></span>
                                    <?php elseif ($status === 'Completed'): ?>
                                        <span class="text-green-600 font-semibold"><?= $status; ?></span>
                                    <?php else: ?>
                                        <span><?= $status; ?></span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-3 space-x-2">
                                    <a href="edit_lab_test.php?id=<?= $id ?>"
                                        class="px-3 py-1 text-sm text-white bg-blue-600 rounded hover:bg-blue-700 transition">
                                        Edit
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