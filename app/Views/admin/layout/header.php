<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title ?? 'Administration') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap & autres CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/fontawesome/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">

    <!-- jQuery, DataTables, SweetAlert -->
    <script src="<?= base_url('assets/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/datatables/datatables.min.js') ?>"></script>
    <script src="<?= base_url('assets/sweetalert2/sweetalert2.all.min.js') ?>"></script>

    <script>
        const base_url = "<?= base_url(); ?>";
    </script>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url('admin') ?>">Admin</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a href="<?= base_url('admin/program') ?>" class="nav-link">Programmes</a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('admin/user') ?>" class="nav-link">Utilisateurs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/exercices">Exercices</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">
