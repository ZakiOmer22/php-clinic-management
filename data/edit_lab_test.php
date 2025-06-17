<?php
include '../includes/db.php';

$patients = mysqli_query($conn, "SELECT id, name FROM patients");
$labTest = [];

if ($_GET['id']) {
    $id = $_GET['id'];
    $labTest = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM lab_tests WHERE id = $id"));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $pid = $_POST['patient_id'];
    $type = $_POST['test_type'];
    $res = $_POST['results'];
    $status = $_POST['status'];
    $date = $_POST['test_date'];

    mysqli_query($conn, "UPDATE lab_tests SET patient_id=$pid, test_type='$type', results='$res', status='$status', test_date='$date' WHERE id=$id");
    header("Location: ../pages/labtests.php");
    exit;
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