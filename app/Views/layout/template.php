<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>

<div id="overlay"></div>

<div id="sidebar-wrapper">
    <div class="sidebar-heading d-flex justify-content-between align-items-center">
        <span>SIDE BAR</span>
        <button class="btn btn-sm text-white d-lg-none" id="close-sidebar"><i class="bi bi-x-lg"></i></button>
    </div>
    
    <?php 
        $uri = service('uri');
        $segment = $uri->getSegment(1); 
    ?>

    <div class="list-group list-group-flush mt-2">
        <a href="/dashboard" class="list-group-item <?= ($segment == 'dashboard') ? 'active' : '' ?>">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
        </a>
        <a href="/book" class="list-group-item <?= ($segment == 'book') ? 'active' : '' ?>">
            <i class="bi bi-book me-2"></i> Data Buku
        </a>
        <a href="/settings" class="list-group-item <?= ($segment == 'settings') ? 'active' : '' ?>">
            <i class="bi bi-person-circle me-2"></i> Pengaturan
        </a>
        <div class="mt-auto p-4">
            <a href="/logout" class="btn btn-outline-danger w-100 btn-sm">Logout</a>
        </div>
    </div>
</div>

<div id="page-content">
    
    <nav class="navbar navbar-dark bg-primary shadow-sm px-3 py-2">
        <button class="btn-toggle text-white" id="menu-toggle">
            <i class="bi bi-list"></i>
        </button>
        
        <span class="ms-3 fw-bold text-white"><?= $title ?? 'DASHBOARD' ?></span>

        <span class="ms-auto small text-white opacity-75">Hi, <?= session('user_name') ?></span>
    </nav>

    <div class="container-fluid p-4">
        <?= $this->renderSection('content') ?>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const sidebar = document.getElementById('sidebar-wrapper');
    const overlay = document.getElementById('overlay');
    const btnToggle = document.getElementById('menu-toggle');
    const btnClose = document.getElementById('close-sidebar');

    function toggleMenu() {
        sidebar.classList.toggle('active');
        overlay.classList.toggle('active');
    }

    if(btnToggle) btnToggle.onclick = toggleMenu;
    if(btnClose) btnClose.onclick = toggleMenu;
    if(overlay) overlay.onclick = toggleMenu;
</script>

</body>
</html>