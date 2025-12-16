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
                    <div class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-user"></i>
                        <p class="mb-0 lh-1">Utilisateurs</p>
                    </div>
                    <br>
                    <h3><?= $users ?></h3>
                    <br>
                    <a href="admin/user"
                       class="text-success border border-2 border-success rounded px-4 py-2 text-decoration-none">
                        Voir +
                    </a>

                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card border border-warning border-5">
                <div class="card-body d-flex flex-column justify-content-center align-items-center text-warning" style="aspect-ratio: 1.4;">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-person-walking"></i>
                        <p class="mb-0 lh-1">Exercices</p>
                    </div>
                    <br>
                    <h3><?= $exercices ?></h3>
                    <br>
                    <a href="admin/exercices"
                       class="text-warning border border-2 border-warning rounded px-4 py-2 text-decoration-none">
                        Voir +
                    </a>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card border border-primary border-5">
                <div class="card-body d-flex flex-column justify-content-center align-items-center text-primary" style="aspect-ratio: 1.4;">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-list-check"></i>
                        <p class="mb-0 lh-1">Programmes</p>
                    </div>
                    <br>
                    <h3><?= $programmes ?></h3>
                    <br>
                    <a href="admin/program"
                       class="text-primary border border-2 border-primary rounded px-4 py-2 text-decoration-none">
                        Voir +
                    </a>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card border border-danger border-5">
                <div class="card-body d-flex flex-column justify-content-center align-items-center text-danger" style="aspect-ratio: 1.4;">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-face-smile"></i>
                        <p class="mb-0 lh-1">Amitiés</p>
                    </div>
                    <br>
                    <h3><?= $amities ?></h3>
                    <br>
                    <a href="admin/friends"
                       class="text-danger border border-2 border-danger rounded px-4 py-2 text-decoration-none">
                        Voir +
                    </a>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card border border-secondary border-5">
                <div class="card-body d-flex flex-column justify-content-center align-items-center text-secondary" style="aspect-ratio: 1.4;">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-hand-fist"></i>
                        <p class="mb-0 lh-1">Muscles</p>
                    </div>
                    <br>
                    <h3><?= $muscles ?></h3>
                    <br>
                    <a href="admin/muscles"
                       class="text-secondary border border-2 border-secondary rounded px-4 py-2 text-decoration-none">
                        Voir +
                    </a>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card border border-info border-5">
                <div class="text-info card-body d-flex flex-column justify-content-center align-items-center text-start" style="aspect-ratio: 1.4;">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-user-gear"></i>
                        <p class="mb-0 lh-1">Permissions</p>
                    </div>
                    <br>
                    <h3><?= $permissions ?></h3>
                    <br>
                    <a href="admin/user-permission"
                       class="text-info border border-2 border-info rounded px-4 py-2 text-decoration-none">
                        Voir +
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
