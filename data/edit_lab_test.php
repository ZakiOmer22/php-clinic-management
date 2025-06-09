<?php
include '../includes/db.php';

$labTest = [];
$patients = [];

// Fetch patients for dropdown
$patientResult = mysqli_query($conn, "SELECT id, name FROM patients");
while ($row = mysqli_fetch_assoc($patientResult)) {
    $patients[] = $row;
}

// Fetch lab test
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = mysqli_query($conn, "SELECT * FROM lab_tests WHERE id = $id");
    $labTest = mysqli_fetch_assoc($result);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $patient_id = intval($_POST['patient_id']);
    $test_type = mysqli_real_escape_string($conn, $_POST['test_type']);
    $results = mysqli_real_escape_string($conn, $_POST['results']);
    $status = $_POST['status'];
    $test_date = $_POST['test_date'];

    $stmt = "
        UPDATE lab_tests SET 
            patient_id = $patient_id, 
            test_type = '$test_type', 
            results = '$results', 
            status = '$status', 
            test_date = '$test_date' 
        WHERE id = $id
    ";

    mysqli_query($conn, $stmt);
    header("Location: ../pages/labtests.php");
    exit();
}
?>

<?php include '../includes/sidebar.php'; ?>

<div class="ml-64 min-h-screen">
    <?php include '../includes/header.php'; ?>

    <main class="p-6 max-w-3xl mx-auto">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Lab Test</h2>

        <form method="POST" class="bg-white shadow-md rounded-xl p-6 space-y-4">
            <input type="hidden" name="id" value="<?= htmlspecialchars($labTest['id']); ?>">

            <div>
                <label class="block text-sm font-medium text-gray-700">Patient</label>
                <select name="patient_id" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <?php foreach ($patients as $patient): ?>
                        <option value="<?= $patient['id']; ?>" <?= $labTest['patient_id'] == $patient['id'] ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($patient['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Test Type</label>
                <input type="text" name="test_type" value="<?= htmlspecialchars($labTest['test_type']); ?>"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Results</label>
                <textarea name="results" rows="4"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                    required><?= htmlspecialchars($labTest['results']); ?></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <?php
                    $statuses = ['Pending', 'Completed'];
                    foreach ($statuses as $statusOption):
                    ?>
                        <option value="<?= $statusOption; ?>" <?= $labTest['status'] === $statusOption ? 'selected' : ''; ?>>
                            <?= $statusOption; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Test Date</label>
                <input type="date" name="test_date" value="<?= htmlspecialchars($labTest['test_date']); ?>"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div class="flex justify-end space-x-2">
                <a href="lab_tests.php"
                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</a>
                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
            </div>
        </form>
    </main>

    <?php include '../includes/footer.php'; ?>
</div>