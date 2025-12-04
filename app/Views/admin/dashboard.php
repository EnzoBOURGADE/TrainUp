<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <div class="row g-4">
        <!-- Ligne 1 -->
        <div class="col-md-4">
            <div class="card border-success text-center">
                <div class="card-body">
                    <h3 class="text-success"><?= $users ?></h3>
                    <p class="text-success">Utilisateurs</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-warning text-center">
                <div class="card-body">
                    <h3 class="text-warning"><?= $exercices ?></h3>
                    <p class="text-warning">Exercices</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-primary text-center">
                <div class="card-body">
                    <h3 class="text-primary"><?= $programmes ?></h3>
                    <p class="text-primary">Programmes</p>
                </div>
            </div>
        </div>

        <!-- Ligne 2 -->
        <div class="col-md-4">
            <div class="card border-danger text-center">
                <div class="card-body">
                    <h3 class="text-danger"><?= $amities ?></h3>
                    <p class="text-danger">Amitiés</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center" style="border: 2px solid #b5651d;">
                <div class="card-body">
                    <h3 style="color: #b5651d;"><?= $muscles ?></h3>
                    <p style="color: #b5651d;">Muscles</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center" style="border: 2px solid #6b2fb6;">
                <div class="card-body">
                    <h3 style="color: #6b2fb6;"><?= $permissions ?></h3>
                    <p style="color: #6b2fb6;">Permissions</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
