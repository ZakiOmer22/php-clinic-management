<?php
include '../includes/data.php';
?>
<?php include '../includes/sidebar.php'; ?>

<div class="ml-64 min-h-screen">
    <?php include '../includes/header.php'; ?>
    <h2 class="text-2xl font-bold text-gray-800 mb-6 px-6">Add New User</h2>

    <form action="../data/save_user.php" method="POST"
        class="bg-white shadow-md rounded-xl p-6 space-y-4 max-w-2xl mx-6">

        <!-- Username -->
        <div>
            <label for="username" class="block text-gray-600 mb-1">Username</label>
            <input type="text" name="username" id="username" required
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="e.g. johndoe">
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-gray-600 mb-1">Email Address</label>
            <input type="email" name="email" id="email" required
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="e.g. johndoe@example.com">
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-gray-600 mb-1">Password</label>
            <input type="password" name="password" id="password" required
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Enter a secure password">
        </div>

        <!-- Role -->
        <div>
            <label for="role" class="block text-gray-600 mb-1">Role</label>
            <select name="role" id="role" required
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">-- Select Role --</option>
                <option value="admin">admin</option>
                <option value="staff">doctor</option>
                <option value="doctor">receptionist</option>
            </select>
        </div>

        <!-- Submit -->
        <div class="text-right">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-md transition">
                Save User
            </button>
        </div>

    </form>

    <?php include '../includes/footer.php'; ?>
</div>

</body>
</html>
