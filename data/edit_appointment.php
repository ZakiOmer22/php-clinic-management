<?php
include '../includes/db.php';

$appointment = [];
$patients = [];

// Fetch patients for dropdown
$patientResult = mysqli_query($conn, "SELECT id, name FROM patients");
while ($row = mysqli_fetch_assoc($patientResult)) {
    $patients[] = $row;
}

// Fetch appointment by ID
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = mysqli_query($conn, "SELECT * FROM appointments WHERE id = $id");
    $appointment = mysqli_fetch_assoc($result);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $patient_id = intval($_POST['patient_id']);
    $doctor_name = mysqli_real_escape_string($conn, $_POST['doctor_name']);
    $appointment_date = $_POST['appointment_date'];
    $status = $_POST['status'];

    $stmt = "UPDATE appointments SET 
        patient_id = $patient_id, 
        doctor_name = '$doctor_name',
        appointment_date = '$appointment_date',
        status = '$status'
        WHERE id = $id";

    mysqli_query($conn, $stmt);
    header("Location: ../pages/appointments.php");
    exit();
}
?>

<?php include '../includes/sidebar.php'; ?>

<div class="ml-64 min-h-screen">
    <?php include '../includes/header.php'; ?>

    <main class="p-6 max-w-3xl mx-auto">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Appointment</h2>

        <form method="POST" class="bg-white shadow-md rounded-xl p-6 space-y-4">
            <input type="hidden" name="id" value="<?= htmlspecialchars($appointment['id']); ?>">

            <div>
                <label class="block text-sm font-medium text-gray-700">Patient</label>
                <select name="patient_id" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <?php foreach ($patients as $patient): ?>
                        <option value="<?= $patient['id']; ?>" <?= $appointment['patient_id'] == $patient['id'] ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($patient['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Doctor Name</label>
                <input type="text" name="doctor_name" value="<?= htmlspecialchars($appointment['doctor_name']); ?>"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Appointment Date</label>
                <input type="date" name="appointment_date" value="<?= htmlspecialchars($appointment['appointment_date']); ?>"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <?php
                    $statuses = ['Pending', 'Completed', 'Cancelled', 'In Progress'];
                    foreach ($statuses as $statusOption):
                    ?>
                        <option value="<?= $statusOption; ?>" <?= $appointment['status'] === $statusOption ? 'selected' : ''; ?>>
                            <?= $statusOption; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="flex justify-end space-x-2">
                <a href="appointments.php"
                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</a>
                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
            </div>
        </form>
    </main>

    <?php include '../includes/footer.php'; ?>
</div>