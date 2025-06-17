<?php
include '../includes/db.php';

$patient = [];

if ($_GET['id']) {
    $id = $_GET['id'];
    $patient = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM patients WHERE id = $id"));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    mysqli_query($conn, "UPDATE patients SET name='$name', gender='$gender', phone='$phone', email='$email' WHERE id=$id");
    header("Location: ../pages/patients.php");
    exit;
}
?>

<?php include '../includes/sidebar.php'; ?>

<!-- Main Content -->
<div class="ml-64 min-h-screen">
    <?php include '../includes/header.php'; ?>

    <main class="p-6 max-w-3xl mx-auto">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Patient</h2>

        <form method="POST" class="bg-white shadow-md rounded-xl p-6 space-y-4">
            <input type="hidden" name="id" value="<?= htmlspecialchars($patient['id']); ?>">

            <div>
                <label class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" value="<?= htmlspecialchars($patient['name']); ?>"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Gender</label>
                <select name="gender" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="male" <?= $patient['gender'] === 'male' ? 'selected' : ''; ?>>Male</option>
                    <option value="female" <?= $patient['gender'] === 'female' ? 'selected' : ''; ?>>Female</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Phone</label>
                <input type="text" name="phone" value="<?= htmlspecialchars($patient['phone']); ?>"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" value="<?= htmlspecialchars($patient['email']); ?>"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div class="flex justify-end space-x-2">
                <a href="patients.php"
                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</a>
                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
            </div>
        </form>
    </main>

    <?php include '../includes/footer.php'; ?>
</div>