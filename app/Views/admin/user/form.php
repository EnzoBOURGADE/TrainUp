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
            <?= form_open('admin/user/save', ['autocomplete' => 'off']) ?>
            <?php if (isset($users -> id)) : ?>
                <input type="hidden" name="id" value="<?= $users -> id ?>">
            <?php endif; ?>
            <div class="card-body">
                <div class="row g-3 mb-3">
                    <div class="col-md-4 form-floating">
                        <input type="text" class="form-control" id="first_name" name="first_name" value="<?= $users -> first_name ?? '' ?>" placeholder="Prenom de l’utilisateur" required>
                        <label for="first_name">Prenom de l’utilisateur</label>
                    </div>

                    <div class="col-md-4 form-floating">
                        <input type="text" class="form-control" name="last_name" value="<?= $users -> last_name ?? '' ?>" placeholder="Nom de l’utilisateur" required>
                        <label for="last_name">Nom de l’utilisateur</label>
                    </div>

                    <div class="col-md-4 form-floating">
                        <input type="text" class="form-control" name="username" value="<?= $users -> username ?? '' ?>" placeholder="username" required  autocomplete="new-username">
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

                <div class="row g-3 mb-3">
                    <div class="col-md-6 form-floating">
                        <input type="date" class="form-control" name="birthdate" value="<?= isset($users->birthdate) ? $users->birthdate->toDateString() : '' ?>" placeholder="Date Naissance" required>
                        <label for="birthdate">Date de Naissance</label>
                    </div>

                    <?php if (!isset($users->id)) : ?>
                        <div class="col-md-6">
                            <div class="input-group form-floating">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" required  autocomplete="new-password">
                                <label for="password">Mot de passe</label>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>

            <div class="card-footer d-flex justify-content-between">
                <a class="text-light btn btn-danger" href="./admin/user">
                    <i class="fa-solid fa-left-long"></i>
                    Retour
                </a>
                <button type="reset" class="btn btn-secondary">
                    <i class="fa-solid fa-rotate-left"></i>
                    Réinitialiser
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-floppy-disk"></i>
                    Enregistrer
                </button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
