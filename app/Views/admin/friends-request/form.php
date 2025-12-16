<div class="row justify-content-center">
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h1 class="h3">
                    <?php if (isset($friendsRequest['id'])) : ?>
                        Modification d’une demande d'amitié
                    <?php else: ?>
                        Création d’une demande d'amitié
                    <?php endif; ?>
                </h1>
            </div>
            <?= form_open('admin/friends-request/save') ?>
            <?php if (isset($exercice['id'])) : ?>
                <input type="hidden" name="id" value="<?= $friendsRequest['id'] ?>">
            <?php endif; ?>
            <div class="card-body">
                <div class="row g-3 mb-3">

                    <div class="col-md-6 form-floating">
                        <select class="form-select" name="requester_id" id="requester_id" required>
                            <option value="">-- Sélectionner un utilisateur --</option>
                            <?php foreach ($users as $u): ?>
                                <option value="<?= $u->id ?>">
                                    <?= esc($u->username) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <label for="requester_id">Demandeur</label>
                    </div>

                    <div class="col-md-6 form-floating">
                        <select class="form-select" name="receiver_id" id="receiver_id" required>
                            <option value="">-- Sélectionner un utilisateur --</option>
                            <?php foreach ($users as $u): ?>
                                <option value="<?= $u->id ?>">
                                    <?= esc($u->username) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <label for="receiver_id">Receveur</label>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <a class="text-light btn btn-danger" href="./admin/friends-request">
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
