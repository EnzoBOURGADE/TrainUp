<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h1 class="h3">
                    <?php if (isset($cat_prgrm['id'])) : ?>
                        Modification d’une catégorie de programme
                    <?php else: ?>
                        Création d’une catégorie de programme
                    <?php endif; ?>
                </h1>
            </div>
            <?= form_open('admin/category-program/save') ?>
            <?php if (isset($cat_prgrm['id'])) : ?>
                <input type="hidden" name="id" value="<?= $cat_prgrm['id'] ?>">
            <?php endif; ?>
            <div class="card-body">
                <div class="mb-3 form-floating">
                    <input type="text" class="form-control" name="name" value="<?= $cat_prgrm['name'] ?? '' ?>" placeholder="Nom de la catégorie de programme" required>
                    <label for="name">Nom de la catégorie de programme</label>
                </div>
            </div>

            <div class="card-footer d-flex justify-content-between">
                <a class="text-light btn btn-danger" href="./admin/category-program">
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
