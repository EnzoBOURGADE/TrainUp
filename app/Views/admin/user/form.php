<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h1 class="h3">
                    <?php if (isset($users -> id)) : ?>
                        Modification d’un utilisateur
                    <?php else: ?>
                        Création d’un utilisateur
                    <?php endif; ?>
                </h1>
            </div>
            <?= form_open('admin/user/save') ?>
            <?php if (isset($users -> id)) : ?>
                <input type="hidden" name="id" value="<?= $users -> id ?>">
            <?php endif; ?>
            <div class="card-body">
                <div class="row g-3 mb-3">
                    <div class="col-md-4 form-floating">
                        <input type="text" class="form-control" id="name" name="name" value="<?= $users -> first_name ?? '' ?>" placeholder="Prenom de l’utilisateur" required>
                        <label for="name">Prenom de l’utilisateur</label>
                    </div>

                    <div class="col-md-4 form-floating">
                        <input type="text" class="form-control" name="surname" value="<?= $users -> last_name ?? '' ?>" placeholder="Nom de l’utilisateur" required>
                        <label for="name">Nom de l’utilisateur</label>
                    </div>

                    <div class="col-md-4 form-floating">
                        <input type="text" class="form-control" name="username" value="<?= $users -> username ?? '' ?>" placeholder="username" required>
                        <label for="name">Nom utilisateur</label>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6 form-floating">
                        <input type="email" class="form-control" name="email" value="<?= $users -> email ?? '' ?>" placeholder="Email" required>
                        <label for="email">Email</label>
                    </div>

                    <div class="col-md-6 form-floating">
                        <select class="form-select" name="id_permission" id="id_permission" required>
                            <option value="">-- Sélectionner une permission --</option>
                            <?php foreach ($permissions as $perm): ?>
                                <option value="<?= $perm['id'] ?>"
                                    <?= isset($selectedPermissionId) && $selectedPermissionId == $perm['id'] ? 'selected' : '' ?>>
                                    <?= esc($perm['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <label for="id_perm">Permission</label>
                    </div>
                </div>
            </div>

            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
