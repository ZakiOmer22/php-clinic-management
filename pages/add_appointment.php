<?php
include '../includes/data.php';
?>
<?php include '../includes/sidebar.php'; ?>
<div class="ml-64 min-h-screen">
    <?php include '../includes/header.php'; ?>
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Add New Appointment</h2>

        <form action="../data/save_appointment.php" method="POST"
            class="bg-white shadow-md rounded-xl p-6 space-y-4 max-w-2xl">

            <div>
                <label for="patient_id" class="block text-gray-600 mb-1">Patient ID</label>
                <input type="number" name="patient_id" id="patient_id" required
                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="doctor_name" class="block text-gray-600 mb-1">Doctor Name</label>
                <input type="text" name="doctor_name" id="doctor_name" required
                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="appointment_date" class="block text-gray-600 mb-1">Appointment Date</label>
                <input type="date" name="appointment_date" id="appointment_date" required
                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="status" class="block text-gray-600 mb-1">Status</label>
                <select name="status" id="status" required
                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="Pending">Pending</option>
                    <option value="Completed">Completed</option>
                    <option value="Cancelled">Cancelled</option>
                    <option value="In Progress">In Progress</option>
                </select>
            </div>

            <div class="text-right">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-md transition">
                    Save Appointment
                </button>
            </div>

        </form>

    <?php include '../includes/footer.php'; ?>
</div>

</body>

</html>