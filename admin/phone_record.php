<?php
include "../admin/page/library/protect-route.php";
include('../admin/page/library/users_lib.php');
include('../admin/page/library/phoneRecords_lib.php');
protectRouteAccess();

$playerObj = new phoneRecords();

// ✅ Handle delete request
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    if ($playerObj->deleteById($id)) {
        $message = "Phone record deleted successfully!";
        $messageType = "success";
    } else {
        $message = "Failed to delete record.";
        $messageType = "error";
    }
}

$players = $playerObj->getAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="./page/assets/css/styles.css">
    <link href="/dist/output.css" rel="stylesheet">
</head>

<body>
    <!-- Header -->
    <?php include '../admin/page/include/header.php' ?>
    <!-- Sidebar -->
    <?php include '../admin/page/include/sidebars.php' ?>

    <main class="main-content" id="mainContent">
        <div id="dynamicContent">
            <div class="container mx-auto lg:p-10">
                <div class="page-header">
                    <h1 class="page-title">Dashboard Overview</h1>
                    <p class="page-subtitle">Welcome back! Here's what's happening with your platform today.</p>
                </div>

                <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-8">
                    <h2 class="text-3xl font-extrabold text-gray-900 mb-4 md:mb-0">List Phone Records</h2>
                    <a href="export_excel.php"
                        class="bg-indigo-600 text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:bg-indigo-700 transition duration-300 ease-in-out text-center">
                        Export Excel
                    </a>
                </div>

                <?php if (isset($message)): ?>
                    <div class="mb-4 px-4 py-3 rounded-lg 
                        <?= $messageType === 'success' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                        <?= htmlspecialchars($message) ?>
                    </div>
                <?php endif; ?>

                <div class="bg-white rounded-xl shadow-lg overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                            <tr>
                                <th class="px-6 py-3">ID</th>
                                <th class="px-6 py-3">Phone Number</th>
                                <th class="px-6 py-3">Created At</th>
                                <th class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($players && count($players) > 0): ?>
                                <?php foreach ($players as $item): ?>
                                    <tr class="bg-white border-b hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 font-medium text-gray-900"><?= $item['id'] ?></td>
                                        <td class="px-6 py-4"><?= htmlspecialchars($item['phone']) ?></td>
                                        <td class="px-6 py-4">
                                            <?php
                                            $createdAt = $item['created_at'] ?? '';
                                            echo $createdAt ? date('Y/m/d H:i:s', strtotime($createdAt)) : '—';
                                            ?>

                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="?delete_id=<?= $item['id'] ?>"
                                                onclick="return confirm('Are you sure you want to delete this record?');"
                                                class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-gray-500 text-lg">
                                        No data found.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</body>

</html>