<?php
$db = \Config\Database::connect();

$users = $db->table('user')->countAllResults();
$exercices = $db->table('exercices')->countAllResults();
$programmes = $db->table('program')->countAllResults();
$amities = $db->table('friends')->countAllResults();
$muscles = $db->table('muscles')->countAllResults();
$permissions = $db->table('user_permission')->countAllResults();
?>

<div class="container mt-4">
    <div class="row g-3">
        <div class="col-4">
            <div class="card border border-success border-5">
                <div class="card-body d-flex flex-column justify-content-center align-items-center text-success" style="aspect-ratio: 1.4;">
                    <h3><?= $users ?></h3>
                    <p>Utilisateurs</p>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card border border-warning border-5">
                <div class="card-body d-flex flex-column justify-content-center align-items-center text-warning" style="aspect-ratio: 1.4;">
                    <h3><?= $exercices ?></h3>
                    <p>Exercices</p>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card border border-primary border-5">
                <div class="card-body d-flex flex-column justify-content-center align-items-center text-primary" style="aspect-ratio: 1.4;">
                    <h3><?= $programmes ?></h3>
                    <p>Programmes</p>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card border border-danger border-5">
                <div class="card-body d-flex flex-column justify-content-center align-items-center text-danger" style="aspect-ratio: 1.4;">
                    <h3><?= $amities ?></h3>
                    <p>Amitiés</p>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card border border-secondary border-5">
                <div class="card-body d-flex flex-column justify-content-center align-items-center text-secondary" style="aspect-ratio: 1.4;">
                    <h3><?= $muscles ?></h3>
                    <p>Muscles</p>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card border border-danger border-5">
                <div class="card-body d-flex flex-column justify-content-center align-items-center text-danger" style="aspect-ratio: 1.4;">
                    <h3><?= $permissions ?></h3>
                    <p>Permissions</p>
                </div>
            </div>
        </div>

    </div>
</div>
