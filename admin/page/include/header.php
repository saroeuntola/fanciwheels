

<?php 
include $_SERVER['DOCUMENT_ROOT'] . 'config/baseURL.php';
?>
<?php
$userLib = new User();
$userId = $_SESSION['user_id'] ?? null;
if (!$userId) {
    header("Location: login");
    exit;
}
$user = $userLib->getUser($userId);
?>
<header class="header">
        <div class="header-left">
            <button class="sidebar-toggle" onclick="toggleSidebar()">☰</button>
            <div class="logo">
                <span style="font-size: 28px;">⚡</span>
                Admin
            </div>
        </div>
        
        <div class="header-right">
            <div class="search-bar">
                <input type="text" placeholder="Search...">
                <span class="search-icon">🔍</span>
            </div>
     
            <div class="user-menu">
                  <a href="<?php echo $baseURL; ?>/admin/page/user/profile.php" class="flex flex-col items-center bg-white p-4 rounded-2xl shadow-md mb-4">
        <?php if (!empty($user['profile'])): ?>
            <img src="<?php echo $baseURL; ?>/admin/page/user/user_image/<?php echo htmlspecialchars($user['profile']); ?>"
                 alt="User Avatar"
                 class="w-20 h-20 rounded-full object-cover shadow" />
        <?php else: ?>
            <div class="w-20 h-20 flex items-center justify-center rounded-full bg-gray-100 shadow">
                <i class="la la-user text-3xl text-gray-400"></i>
            </div>
        <?php endif; ?>

        <div class="mt-3 text-center">
            <h6 class="text-lg font-semibold text-gray-800">
                <?php echo htmlspecialchars($_SESSION['username'] ?? 'User'); ?>
            </h6>
        </div>
    </a>
            </div>

            
        </div>
    </header>