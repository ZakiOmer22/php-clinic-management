<?php
include('db.php')
$sampleData = [
    ['id' => 1, 'name' => 'John Doe', 'date' => '2025-06-01', 'status' => 'Completed'],
    ['id' => 2, 'name' => 'Jane Smith', 'date' => '2025-06-02', 'status' => 'Pending'],
    ['id' => 3, 'name' => 'Mike Johnson', 'date' => '2025-06-03', 'status' => 'Cancelled'],
    ['id' => 4, 'name' => 'Emily Brown', 'date' => '2025-06-04', 'status' => 'In Progress'],
    ['id' => 1, 'name' => 'John Doe', 'date' => '2025-06-01', 'status' => 'Completed'],
    ['id' => 2, 'name' => 'Jane Smith', 'date' => '2025-06-02', 'status' => 'Pending'],
    ['id' => 3, 'name' => 'Mike Johnson', 'date' => '2025-06-03', 'status' => 'Cancelled'],
    ['id' => 4, 'name' => 'Emily Brown', 'date' => '2025-06-04', 'status' => 'In Progress'],
    ['id' => 1, 'name' => 'John Doe', 'date' => '2025-06-01', 'status' => 'Completed'],
    ['id' => 2, 'name' => 'Jane Smith', 'date' => '2025-06-02', 'status' => 'Pending'],
    ['id' => 3, 'name' => 'Mike Johnson', 'date' => '2025-06-03', 'status' => 'Cancelled'],
    ['id' => 4, 'name' => 'Emily Brown', 'date' => '2025-06-04', 'status' => 'In Progress'],
];
?>

<div class="w-full px-2">
    <div class="mt-6 bg-white shadow-md rounded-xl overflow-hidden w-full">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-700">Recent Appointments</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-600">
                <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-3">#</th>
                        <th class="px-6 py-3">Patient Name</th>
                        <th class="px-6 py-3">Date</th>
                        <th class="px-6 py-3">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php
                $stmt = "SELECT * FROM Appointment";
                $result = mysqli_query($conn, $qry);
                $res = mysqli_fetch_array($res);
                while ($res) {
                    // 
                 ?>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-3 font-medium"><?= $row['id'] ?></td>
                            <td class="px-6 py-3"><?= $row['name'] ?></td>
                            <td class="px-6 py-3"><?= $row['date'] ?></td>
                            <td class="px-6 py-3">
                                <?php
                                }
                                ?>
                                <span class="inline-block px-2 py-1 rounded-full text-xs font-semibold 
                  <?php
                        switch ($row['status']) {
                            case 'Completed':
                                echo 'bg-green-100 text-green-800';
                                break;
                            case 'Pending':
                                echo 'bg-yellow-100 text-yellow-800';
                                break;
                            case 'Cancelled':
                                echo 'bg-red-100 text-red-800';
                                break;
                            default:
                                echo 'bg-blue-100 text-blue-800';
                                break;
                        }
                    ?>">
                                    <?= $row['status'] ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>