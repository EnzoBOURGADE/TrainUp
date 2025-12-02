<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h1 class="h3">
                    <?php if (isset($program['id'])) : ?>
                        Modification d'un programme
                    <?php else: ?>
                        Création d'un programme
                    <?php endif; ?>
                </h1>
            </div>
            <?= form_open('admin/program/save') ?>
            <?php if (isset($program['id'])) : ?>
                <input type="hidden" name="id" value="<?= $program['id'] ?>">
            <?php endif; ?>
            <div class="card-body">
                <div class="mb-3 form-floating">
                    <input type="text" class="form-control" name="name" value="<?= $program['name'] ?? '' ?>" placeholder="Nom du programme" required>
                    <label for="nom">Nom du programme</label>
                </div>

                <div class="mb-3">
                    <label for="id_user">Utilisateur : </label>
                    <select class="form-select" name="id_user" id="id_user" required>
                        <option value="">-- Sélectionner un utilisateur --</option>
                        <?php foreach ($users as $us): ?>
                            <option value="<?= $us->id ?>"
                                <?= isset($selectedUserId) && $selectedUserId == $us->id ? 'selected' : '' ?>>
                                <?= esc($us->username) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="id_cat">Catégorie : </label>
                    <select class="form-select" name="id_cat" id="id_cat" required>
                        <option value="">-- Sélectionner une catégorie --</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= $cat['id'] ?>"
                                <?= isset($selectedCategoryId) && $selectedCategoryId == $cat['id'] ? 'selected' : '' ?>>
                                <?= esc($cat['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
