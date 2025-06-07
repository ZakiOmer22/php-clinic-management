<?php
include '../includes/data.php';
?>
<?php include '../includes/sidebar.php'; ?>

<div class="ml-64 min-h-screen">
    <?php include '../includes/header.php'; ?>
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Add New Prescription</h2>

    <form action="../data/save_prescription.php" method="POST"
        class="bg-white shadow-md rounded-xl p-6 space-y-4 max-w-2xl">

        <div>
            <label for="patient_id" class="block text-gray-600 mb-1">Patient ID</label>
            <input type="number" name="patient_id" id="patient_id" required
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label for="medicine" class="block text-gray-600 mb-1">Medicine</label>
            <textarea name="medicine" id="medicine" rows="4" required
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="E.g. Paracetamol 500mg - twice daily for 5 days"></textarea>
        </div>

        <div>
            <label for="dosage" class="block text-gray-600 mb-1">Dosage</label>
            <input type="text" name="dosage" id="dosage"
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="E.g. 2 tablets per day">
        </div>

        <div>
            <label for="notes" class="block text-gray-600 mb-1">Additional Notes</label>
            <textarea name="notes" id="notes" rows="3"
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="E.g. Take after meals, monitor temperature, etc."></textarea>
        </div>

        <div>
            <label for="prescribed_at" class="block text-gray-600 mb-1">Prescribed Date</label>
            <input type="date" name="prescribed_at" id="prescribed_at" required
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="text-right">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-md transition">
                Save Prescription
            </button>
        </div>

    </form>

    <?php include '../includes/footer.php'; ?>
</div>

</body>

</html>