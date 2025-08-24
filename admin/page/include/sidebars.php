    <?php 
       include $_SERVER['DOCUMENT_ROOT'] . 'config/baseURL.php';
    ?>
    
    <nav class="sidebar" id="sidebar">
        <ul class="sidebar-menu">
            <li class="menu-item">
                <a href="<?php echo $baseURL; ?>/admin" class="active">
                    <span class="menu-icon">📊</span>
                    <span>Dashboard</span>
                </a>
            </li>
            
            <div class="menu-section">User Management</div>
                <li class="menu-item">
                <a href="<?php echo $baseURL; ?>/admin/players_record">
                    <span class="menu-icon">👥</span>
                    <span>Resigter Records</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="<?php echo $baseURL; ?>/admin/page/user">
                    <span class="menu-icon">👥</span>
                    <span>Users</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="#roles">
                    <span class="menu-icon">🔐</span>
                    <span>Roles & Permissions</span>
                </a>
            </li>
            
            <div class="menu-section">Content</div>
            <li class="menu-item">
                <a href="<?php echo $baseURL; ?>/admin/page/game">
                    <span class="menu-icon">📝</span>
                    <span>Posts</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="<?php echo $baseURL; ?>/admin/page/category">
                    <span class="menu-icon">📄</span>
                    <span>Category</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="<?php echo $baseURL; ?>/admin/page/banner">
                    <span class="menu-icon">💬</span>
                    <span>Banner</span>
                </a>
            </li>
                 <li class="menu-item">
                <a href="<?php echo $baseURL; ?>/admin/page/announcement">
                    <span class="menu-icon">💬</span>
                    <span>Announcement</span>
                </a>
            </li>
                <li class="menu-item">
                <a href="<?php echo $baseURL; ?>/admin/page/brand">
                    <span class="menu-icon">💬</span>
                    <span>Brand</span>
                </a>
            </li>
            
            <div class="menu-section">System</div>
            <li class="menu-item">
                <a href="<?php echo $baseURL; ?>/admin/visitor_logs" target="_blank" >
                    <span class="menu-icon">📄</span>
                    <span>Visitor Logs</span>
                </a>
            </li>
             <li class="menu-item">
                <a href="<?php echo $baseURL; ?>/admin/page/rank-crawl" target="_blank" >
                    <span class="menu-icon">📊</span>
                    <span>Keyword Crawl</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="<?php echo $baseURL; ?>/logout">
                    <span class="menu-icon">🚪</span>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </nav>