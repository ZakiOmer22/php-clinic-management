<?php include '../includes/data.php'; ?>
<!DOCTYPE html>
<html lang="en">

<body class="bg-gray-100 font-sans">

  <!-- Sidebar -->
  <?php include '../includes/sidebar.php'; ?>

  <!-- Main Content -->
  <div class="ml-64">
    <?php include '../includes/header.php'; ?>

    <main class="pt-20 px-6">
      <h2 class="text-2xl font-bold text-gray-800 mb-6">Overview</h2>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <!-- Card: Patients -->
        <div class="bg-white shadow-md p-5 rounded-xl hover:shadow-lg transition">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-gray-500">Patients</p>
              <p class="text-3xl font-bold text-blue-700"><?= getTotalPatients(); ?></p>
            </div>
            <div class="text-blue-600 text-4xl">👨‍⚕️</div>
          </div>
        </div>

        <!-- Card: Appointments -->
        <div class="bg-white shadow-md p-5 rounded-xl hover:shadow-lg transition">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-gray-500">Appointments</p>
              <p class="text-3xl font-bold text-purple-700"><?= getTotalAppointments(); ?></p>
            </div>
            <div class="text-purple-600 text-4xl">📅</div>
          </div>
        </div>

        <!-- Card: Prescriptions -->
        <div class="bg-white shadow-md p-5 rounded-xl hover:shadow-lg transition">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-gray-500">Prescriptions</p>
              <p class="text-3xl font-bold text-green-700"><?= getTotalPrescriptions(); ?></p>
            </div>
            <div class="text-green-600 text-4xl">💊</div>
          </div>
        </div>

        <!-- Card: Lab Tests -->
        <div class="bg-white shadow-md p-5 rounded-xl hover:shadow-lg transition">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-gray-500">Lab Tests</p>
              <p class="text-3xl font-bold text-red-700"><?= getTotalLabTests(); ?></p>
            </div>
            <div class="text-red-600 text-4xl">🧪</div>
          </div>
        </div>
      </div>

      <!-- Data Table -->
      <?php include '../components/sample-table.php'; ?>

    </main>

    <?php include '../includes/footer.php'; ?>
  </div>

</body>

</html>