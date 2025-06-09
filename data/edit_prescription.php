<?php
include '../includes/db.php';

$prescription = [];
$patients = [];


$patientResult = mysqli_query($conn, "SELECT id, name FROM patients");
while ($row = mysqli_fetch_assoc($patientResult)) {
    $patients[] = $row;
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = mysqli_query($conn, "SELECT * FROM prescriptions WHERE id = $id");
    $prescription = mysqli_fetch_assoc($result);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $patient_id = intval($_POST['patient_id']);
    $medicine = mysqli_real_escape_string($conn, $_POST['medicine']);
    $dosage = mysqli_real_escape_string($conn, $_POST['dosage']);
    $notes = mysqli_real_escape_string($conn, $_POST['notes']);
    $prescribed_at = $_POST['prescribed_at'];

    $stmt = "
        UPDATE prescriptions SET
            patient_id = $patient_id,
            medicine = '$medicine',
            dosage = '$dosage',
            notes = '$notes',
            prescribed_at = '$prescribed_at'
        WHERE id = $id
    ";

    mysqli_query($conn, $stmt);
    header("Location: ../pages/prescriptions.php");
    exit();
}
?>

<?php include '../includes/sidebar.php'; ?>

<div class="ml-64 min-h-screen">
    <?php include '../includes/header.php'; ?>

    <main class="p-6 max-w-3xl mx-auto">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Prescription</h2>

        <form method="POST" class="bg-white shadow-md rounded-xl p-6 space-y-4">
            <input type="hidden" name="id" value="<?= htmlspecialchars($prescription['id']); ?>">

            <div>
                <label class="block text-sm font-medium text-gray-700">Patient</label>
                <select name="patient_id" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <?php foreach ($patients as $patient): ?>
                        <option value="<?= $patient['id']; ?>" <?= $prescription['patient_id'] == $patient['id'] ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($patient['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Medicine</label>
                <textarea name="medicine" rows="3" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"><?= htmlspecialchars($prescription['medicine']); ?></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Dosage</label>
                <input type="text" name="dosage" value="<?= htmlspecialchars($prescription['dosage']); ?>"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Notes</label>
                <textarea name="notes" rows="3"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"><?= htmlspecialchars($prescription['notes']); ?></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Prescribed Date</label>
                <input type="date" name="prescribed_at" value="<?= htmlspecialchars($prescription['prescribed_at']); ?>"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div class="flex justify-end space-x-2">
                <a href="prescriptions.php"
                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</a>
                <button type="submit"
                    class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Update</button>
            </div>
        </form>
    </main>

    <?php include '../includes/footer.php'; ?>
</div>