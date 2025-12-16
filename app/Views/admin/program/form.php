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
                        <?php foreach ($categoriesProgram as $cat): ?>
                            <option value="<?= $cat['id'] ?>"
                                <?= isset($selectedCategoryProgramId) && $selectedCategoryProgramId == $cat['id'] ? 'selected' : '' ?>>
                                <?= esc($cat['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <br>
                <h4> Séances : </h4>
                <div class="row justify-content-center">
                    <div id="workoutContainer"></div>

                    <div class="row justify-content-center mb-3">
                        <div class="col-auto">
                            <?php if (isset($program['id'])) : ?>
                                <a id="addWorkout"
                                   class="btn btn-sm btn-primary"
                                   href="<?= base_url('admin/workout/new/' . $program['id']) ?>">
                                    <i class="fas fa-plus"></i> Ajouter une séance
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer d-flex justify-content-between">
                <a class="text-light btn btn-danger" href="./admin/program">
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
