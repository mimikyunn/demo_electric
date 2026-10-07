<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Admin | Puihaha Electric') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        rel="stylesheet">
    <link href="<?= base_url('assets/css/custom.css') ?>" rel="stylesheet">
    <style>
        :root { --primary-color: #1e40af; --secondary-color: #f59e0b; }
        .admin-navbar { min-height: 78px; border-bottom: 1px solid var(--primary-color); }
        .admin-navbar .navbar-brand { color: var(--primary-color) !important; font-size: 1.5rem; font-weight: 700; }
        .admin-navbar .navbar-brand .brand-mark { color: var(--secondary-color); margin-right: .55rem; }
        .admin-navbar .navbar-nav .nav-link { position: relative; margin: 0 10px; padding: 1.55rem 0 1.25rem; color: #555; font-size: 1rem; font-weight: 500; transition: color .2s ease; }
        .admin-navbar .navbar-nav .nav-link:hover, .admin-navbar .navbar-nav .nav-link.active { color: var(--primary-color) !important; }
        .admin-navbar .logout-link { border: 0; background: transparent; }
        @media (max-width: 991.98px) { .admin-navbar .navbar-nav .nav-link { padding: .7rem 0; } }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top admin-navbar">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('admin') ?>">
                <i class="fas fa-bolt brand-mark"></i>Puihaha Electric
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bstarget="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link <?= ($page ?? '') === 'dashboard' ? 'active' : '' ?>" href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link <?= ($page ?? '') === 'accounts' ? 'active' : '' ?>" href="<?= base_url('admin') ?>">Customers</a></li>
                    <li class="nav-item">
                        <form action="<?= base_url('logout') ?>" method="post" class="d-inline">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn btn-link nav-link logout-link">Log out</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Main Content -->
    <main>
        <?= $this->renderSection('content') ?>
    </main>
</body>

</html>
