

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
    <a href="<?php echo $baseURL; ?>/admin/page/user/profile.php">
    <?php if (!empty($user['profile'])): ?>
        <img src="<?php echo $baseURL; ?>/admin/page/user/user_image/<?php echo htmlspecialchars($user['profile']); ?>"
             alt="Avatar"
             />
    <?php else: ?>
        <div class="">
            <svg class="" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
            </svg>
        </div>
    <?php endif; ?>
    
    <div>
        <h6 class="text-sm font-semibold text-white">
            <?php echo htmlspecialchars($_SESSION['username'] ?? 'User'); ?>
        </h6>
    </div>
</a>
            </div>

            
        </div>
    </header>