<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h1 class="h3">
                    <?php if (isset($difficulty['id'])) : ?>
                        Modification d’une difficulté
                    <?php else: ?>
                        Création d’une difficulté
                    <?php endif; ?>
                </h1>
            </div>
            <?= form_open('admin/difficulty/save') ?>
            <?php if (isset($difficulty['id'])) : ?>
                <input type="hidden" name="id" value="<?= $difficulty['id'] ?>">
            <?php endif; ?>
            <div class="card-body">
                <div class="mb-3 form-floating">
                    <input type="text" class="form-control" name="name" value="<?= $difficulty['libelle'] ?? '' ?>" placeholder="Nom de la Difficulté" required>
                    <label for="name">Nom de la difficulté</label>
                </div>
                <div class="mb-3 form-floating">
                    <input type="color" class="form-control" name="name" value="<?= $difficulty['color_hex'] ?? '' ?>" placeholder="Couleur de la Difficulté" required>
                    <label for="name">Couleur de la difficulté</label>
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
