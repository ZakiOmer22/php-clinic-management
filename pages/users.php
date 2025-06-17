<?php
include '../includes/data.php';
include '../includes/db.php';

$stmt = "SELECT * FROM users";
$result = mysqli_query($conn, $stmt);
?>

<!-- Sidebar -->
<?php include '../includes/sidebar.php'; ?>

<!-- Main Content -->
<div class="ml-64 min-h-screen">
    <?php include '../includes/header.php'; ?>

    <main class="p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Users Management</h2>

        <!-- Two Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
            <!-- Total Users -->
            <div class="bg-white shadow-md p-6 rounded-xl hover:shadow-lg transition flex justify-between items-center">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Users</p>
                    <p class="text-3xl font-bold text-blue-700"><?= getTotalUsers($conn); ?></p>
                </div>
                <div class="text-blue-600 text-5xl select-none">👥</div>
            </div>

            <div class="bg-white shadow-md p-6 rounded-xl hover:shadow-lg transition flex justify-between items-center">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Admins</p>
                    <p class="text-3xl font-bold text-indigo-700"><?= getTotalAdmins($conn); ?></p>
                </div>
                <div class="text-indigo-600 text-5xl select-none">🛡️</div>
            </div>
        </div>

        <!-- Buttons Above Table -->
        <div class="flex justify-end space-x-3 mb-4">
            <a href="add_user.php"
                class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition shadow-md">
                Add User
            </a>
        </div>

        <!-- Users Table -->
        <div class="bg-white shadow-md rounded-xl overflow-hidden w-full">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-700">Registered Users</h3>
            </div>
            <div class="overflow-x-auto">
                <form method="POST" action="delete_users.php">
                    <table class="w-full text-sm text-left text-gray-600">
                        <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                            <tr>
                                <th class="px-6 py-3">#</th>
                                <th class="px-6 py-3">Username</th>
                                <th class="px-6 py-3">Role</th>
                                <th class="px-6 py-3">Created At</th>
                                <th class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-3 font-medium"><?= htmlspecialchars($row['id']); ?></td>
                                    <td class="px-6 py-3"><?= htmlspecialchars($row['username'] ?? 'Unknown'); ?></td>
                                    <td class="px-6 py-3 capitalize"><?= htmlspecialchars($row['role'] ?? 'user'); ?></td>
                                    <td class="px-6 py-3"><?= date('Y-m-d', strtotime($row['created_at'] ?? '')); ?></td>
                                    <td class="px-6 py-3 space-x-2">
                                        <a href="../data/edit_user.php?id=<?= urlencode($row['id']); ?>"
                                            class="px-3 py-1 text-sm text-white bg-blue-600 rounded hover:bg-blue-700 transition">
                                            Edit
                                        </a>
                                        <a href="../data/delete_user.php?id=<?= urlencode($row['id']); ?>"
                                            onclick="return confirm('Are you sure you want to delete this user?');"
                                            class="px-3 py-1 text-sm text-white bg-red-600 rounded hover:bg-red-700 transition">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </main>

    <?php include '../includes/footer.php'; ?>
</div>
