<?php include '../includes/data.php';
include '../includes/db.php' ?>
<!DOCTYPE html>
<html lang="en">

<body class="bg-gray-100 font-sans">

  <!-- Sidebar -->
  <?php include '../includes/sidebar.php'; ?>

  <!-- Main Content -->
  <div class="ml-64">
    <?php include '../includes/header.php'; ?>
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Overview</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
      <!-- Card: Patients -->
      <div class="bg-white shadow-md p-5 rounded-xl hover:shadow-lg transition">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-500">Patients</p>
            <p class="text-3xl font-bold text-blue-700"><?= getTotalPatients($conn); ?></p>
          </div>
          <div class="text-blue-600 text-4xl">👨‍⚕️</div>
        </div>
      </div>

      <!-- Card: Appointments -->
      <div class="bg-white shadow-md p-5 rounded-xl hover:shadow-lg transition">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-500">Appointments</p>
            <p class="text-3xl font-bold text-purple-700"><?= getTotalAppointments($conn); ?></p>
          </div>
          <div class="text-purple-600 text-4xl">📅</div>
        </div>
      </div>

      <!-- Card: Prescriptions -->
      <div class="bg-white shadow-md p-5 rounded-xl hover:shadow-lg transition">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-500">Prescriptions</p>
            <p class="text-3xl font-bold text-green-700"><?= getTotalAppointments($conn); ?></p>
          </div>
          <div class="text-green-600 text-4xl">💊</div>
        </div>
      </div>

      <!-- Card: Lab Tests -->
      <div class="bg-white shadow-md p-5 rounded-xl hover:shadow-lg transition">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-500">Lab Tests</p>
            <p class="text-3xl font-bold text-red-700"><?= getTotalAppointments($conn); ?></p>
          </div>
          <div class="text-red-600 text-4xl">🧪</div>
        </div>
      </div>
    </div>

    <!-- Data Table -->
    <div class="w-full px-2">
      <div class="mt-6 bg-white shadow-md rounded-xl overflow-hidden w-full">
        <div class="px-6 py-4 border-b border-gray-200">
          <h3 class="text-lg font-semibold text-gray-700">Recent Appointments</h3>
        </div>
        <div class="overflow-x-auto">
          <table class="w-full text-sm text-left text-gray-600">
            <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
              <tr>
                <th class="px-6 py-3">ID</th>
                <th class="px-6 py-3">Patient ID</th>
                <th class="px-6 py-3">Doctor Name</th>
                <th class="px-6 py-3">Appointment Date</th>
                <th class="px-6 py-3">Status</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
              <?php
              // Join appointments with patients to get patient names
              $stmt = "
                                SELECT * from appointments";
              $result = mysqli_query($conn, $stmt);
              if (!$result) {
                echo '<tr><td colspan="8" class="px-6 py-3 text-red-600 font-bold">Error loading data</td></tr>';
              } else {
                while ($row = mysqli_fetch_assoc($result)) {
              ?>
                  <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-3 font-medium"><?= htmlspecialchars($row['id']); ?></td>
                    <td class="px-6 py-3"><?= htmlspecialchars($row['id']); ?></td>
                    <td class="px-6 py-3"><?= htmlspecialchars($row['doctor_name']); ?></td>
                    <td class="px-6 py-3"><?= htmlspecialchars($row['appointment_date']); ?></td>
                    <td class="px-6 py-3"><?= htmlspecialchars($row['status']); ?></td>
                  </tr>
              <?php
                }
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <?php include '../includes/footer.php'; ?>
  </div>

</body>

</html>