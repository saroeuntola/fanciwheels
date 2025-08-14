<?php 
include "../admin/page/library/protect-route.php";
include('../admin/page/library/users_lib.php');
include('../admin/page/library/players_lib.php');
protectRouteAccess();  
$playerObj = new Player();
$players = $playerObj->getPlayers()

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="./page/assets/css/styles.css">
       <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
           <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <!-- Header -->
    
<?php 
  include '../admin/page/include/header.php'
?>
    <!-- Sidebar -->
<?php 
  include '../admin/page/include/sidebars.php'
?>

    <!-- Main Content -->
    <main class="main-content" id="mainContent">


        <div id="dynamicContent">


    <div class="container mx-auto lg:p-10">
     <div class="page-header">
            <h1 class="page-title">Dashboard Overview</h1>
            <p class="page-subtitle">Welcome back! Here's what's happening with your platform today.</p>
        </div>
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-8">
        <h2 class="text-3xl font-extrabold text-gray-900 mb-4 md:mb-0">Register Record</h2>
        <!-- <a href="export_excel" 
           class="bg-indigo-600 text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:bg-indigo-700 transition duration-300 ease-in-out text-center">
            Export Excel
        </a> -->
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-lg overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3">Phone</th>
                    <th scope="col" class="px-6 py-3">Email</th>
                     <th scope="col" class="px-6 py-3">CreateAt</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($players && count($players) > 0): ?>
                    <?php foreach ($players as $item): ?>
                        <tr class="bg-white border-b hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-medium text-gray-900">
                                <?php echo $item['id']; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo htmlspecialchars($item['name']); ?>
                            </td>
                           <td class="px-6 py-4">
                                <?php echo htmlspecialchars($item['phone']); ?>
                            </td>
                              <td class="px-6 py-4">
                                <?php echo htmlspecialchars($item['gmail']); ?>
                            </td>
                              <td class="px-6 py-4">
    <?php echo date('Y/m/d', strtotime($item['created_at'])); ?>
</td>

                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500 text-lg">
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

<script src="./page/assets/js/admin_script.js"></script>
</body>
</html>