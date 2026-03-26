<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h1 class="h3">
                    <?php if (isset($permissions['id'])) : ?>
                        Modification d’une permission
                    <?php else: ?>
                        Création d’une permission
                    <?php endif; ?>
                </h1>
            </div>
            <?= form_open('admin/user-permission/save') ?>
            <?php if (isset($permissions['id'])) : ?>
                <input type="hidden" name="id" value="<?= $permissions['id'] ?>">
            <?php endif; ?>
            <div class="card-body">
                <div class="row">
                    <div class="mb-3 form-floating">
                        <input type="text" class="form-control" name="name"
                               value="<?= $permissions['name'] ?? '' ?>"
                               placeholder="Nom de la permission" required>
                        <label for="name">Nom de la permission</label>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <a class="text-light btn btn-danger" href="./admin/user-permission">
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
