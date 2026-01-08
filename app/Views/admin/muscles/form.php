<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h1 class="h3">
                    <?php if (isset($muscles['id'])) : ?>
                        Modification d’un muscle
                    <?php else: ?>
                        Création d’un muscle
                    <?php endif; ?>
                </h1>
            </div>
            <?= form_open('admin/muscles/save') ?>
            <?php if (isset($muscles['id'])) : ?>
                <input type="hidden" name="id" value="<?= $muscles['id'] ?>">
            <?php endif; ?>
            <div class="card-body">
                <div class="mb-3 form-floating">
                    <input type="text" class="form-control" name="name" value="<?= $muscles['name'] ?? '' ?>" placeholder="Nom du muscle" required>
                    <label for="name">Nom du muscle</label>
                </div>
            </div>

            <div class="card-footer d-flex justify-content-between">
                <a class="text-light btn btn-danger" href="./admin/muscles">
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
