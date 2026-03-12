<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h1 class="h3">
                    <?php if (isset($category['id'])) : ?>
                        Modification d’une catégorie
                    <?php else: ?>
                        Création d’une catégorie
                    <?php endif; ?>
                </h1>
            </div>
            <?= form_open('admin/category/save') ?>
            <?php if (isset($category['id'])) : ?>
                <input type="hidden" name="id" value="<?= $category['id'] ?>">
            <?php endif; ?>
            <div class="card-body">
                <div class="mb-3 form-floating">
                    <input type="text" class="form-control" name="name" value="<?= $category['name'] ?? '' ?>" placeholder="Nom de la catégorie" required>
                    <label for="name">Nom de la catégorie</label>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <a class="text-light btn btn-danger" href="./admin/category">
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
