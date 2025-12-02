<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h1 class="h3">
                    <?php if (isset($exercice['id'])) : ?>
                        Modification d’un exercice
                    <?php else: ?>
                        Création d’un exercice
                    <?php endif; ?>
                </h1>
            </div>
            <?= form_open('admin/exercices/save') ?>
            <?php if (isset($exercice['id'])) : ?>
                <input type="hidden" name="id" value="<?= $exercice['id'] ?>">
            <?php endif; ?>
            <div class="card-body">
                <div class="mb-3 form-floating">
                    <input type="text" class="form-control" name="name" value="<?= $exercice['name'] ?? '' ?>" placeholder="Nom de l’exercice" required>
                    <label for="name">Nom de l’exercice</label>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-md-4 form-floating">
                        <input type="number" class="form-control" name="rest_time" value="<?= $exercice['rest_time'] ?? '' ?>" placeholder="Temps de repos" required>
                        <label for="rest_time">Temps de repos</label>
                    </div>
                    <div class="col-md-4 form-floating">
                        <input type="number" class="form-control" name="reps" value="<?= $exercice['reps'] ?? '' ?>" placeholder="Répétitions" required>
                        <label for="reps">Répétitions</label>
                    </div>
                    <div class="col-md-4 form-floating">
                        <input type="number" class="form-control" name="nber_series" value="<?= $exercice['nber_series'] ?? '' ?>" placeholder="Nombre de séries" required>
                        <label for="nber_series">Nombre de séries</label>
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-md-4 form-floating">
                        <input type="time" class="form-control" name="time_series" value="<?= $exercice['time_series'] ?? '' ?>" placeholder="Temps de la série" required>
                        <label for="time_series">Temps de la série</label>
                    </div>
                    <div class="col-md-4 form-floating">
                        <select class="form-select" name="id_cat" id="id_cat" required>
                            <option value="">-- Sélectionner une catégorie --</option>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>"
                                    <?= isset($selectedCategoryId) && $selectedCategoryId == $cat['id'] ? 'selected' : '' ?>>
                                    <?= esc($cat['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <label for="id_cat">Catégorie</label>
                    </div>
                    <div class="col-md-4 form-floating">
                        <select class="form-select" name="id_muscle" id="id_muscle" required>
                            <option value="">-- Sélectionner un muscle --</option>
                            <?php foreach ($muscles as $muscle): ?>
                                <option value="<?= $muscle['id'] ?>"
                                    <?= isset($selectedMuscleId) && $selectedMuscleId == $muscle['id'] ? 'selected' : '' ?>>
                                    <?= esc($muscle['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <label for="id_muscle">Muscles</label>
                    </div>
                </div>
                <div class="mb-3 form-floating">
                    <textarea class="form-control" name="description" required placeholder="Description"><?= $exercice['description'] ?? '' ?></textarea>
                    <label for="description">Description</label>
                </div>
            </div>

            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
