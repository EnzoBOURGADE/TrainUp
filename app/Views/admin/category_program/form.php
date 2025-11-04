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
            <?= form_open('admin/exercice/save') ?>
            <?php if (isset($exercice['id'])) : ?>
                <input type="hidden" name="id" value="<?= $exercice['id'] ?>">
            <?php endif; ?>
            <div class="card-body">
                <div class="mb-3 form-floating">
                    <input type="text" class="form-control" name="name" value="<?= $exercice['name'] ?? '' ?>" placeholder="Nom de l’exercice" required>
                    <label for="name">Nom de l’exercice</label>
                </div>
                <div class="mb-3 form-floating">
                    <textarea class="form-control" name="description" placeholder="Description"><?= $exercice['description'] ?? '' ?></textarea>
                    <label for="description">Description</label>
                </div>
                <div class="mb-3 form-floating">
                    <input type="number" class="form-control" name="id_muscle" value="<?= $exercice['id_muscle'] ?? '' ?>" placeholder="ID Muscle">
                    <label for="id_muscle">ID Muscle</label>
                </div>
            </div>
            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
