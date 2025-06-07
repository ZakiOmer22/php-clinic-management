<?php
include '../includes/data.php';
?>

<?php include '../includes/sidebar.php'; ?>

<div class="ml-64 min-h-screen">
    <?php include '../includes/header.php'; ?>
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Add New Patient</h2>

    <form action="../data/save_patient.php" method="POST"
        class="bg-white shadow-md rounded-xl p-6 space-y-4 max-w-2xl">

        <div>
            <label for="name" class="block text-gray-600 mb-1">Full Name</label>
            <input type="text" name="name" id="name" required
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label for="gender" class="block text-gray-600 mb-1">Gender</label>
            <select name="gender" id="gender" required
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
        </div>

        <div>
            <label for="phone" class="block text-gray-600 mb-1">Phone Number</label>
            <input type="text" name="phone" id="phone"
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label for="email" class="block text-gray-600 mb-1">Email Address</label>
            <input type="email" name="email" id="email"
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="text-right">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-md transition">
                Save Patient
            </button>
        </div>

    </form>

    <?php include '../includes/footer.php'; ?>
</div>

</body>

</html>