<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Tabungan Siswa</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">TS</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Home</li>
            <li>
                <a class="nav-link" href="/tabungan-siswa-web/">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <?php if (in_array($_SESSION['user']['role'], ['admin', 'staff'])) : ?>
                <li class="menu-header">Management</li>
                <li>
                    <a class="nav-link" href="/tabungan-siswa-web/website/users/index.php">
                        <i class="fas fa-user"></i>
                        <span>Users</span>
                    </a>
                </li>
                <li class="menu-header">Datamaster</li>
                <li>
                    <a class="nav-link" href="/tabungan-siswa-web/website/student/index.php">
                        <i class="fas fa-user-graduate"></i>
                        <span>Siswa</span>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="/tabungan-siswa-web/website/saving-accounts/index.php">
                        <i class="fas fa-money-bill"></i>
                        <span>Tabungan</span>
                    </a>
                </li>
                <li class="menu-header">Reports</li>
                <li>
                    <a class="nav-link" href="/tabungan-siswa-web/website/reports/index.php">
                        <i class="fas fa-chart-line"></i>
                        <span>Reports</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </aside>
</div>