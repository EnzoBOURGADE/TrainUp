<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h1 class="h3">
                    <?php if (isset($workout['id'])) : ?>
                        Modification d’un workout
                    <?php else: ?>
                        Création d’un workout
                    <?php endif; ?>
                </h1>
            </div>
            <?= form_open('admin/workout/save') ?>
            <?php if (isset($workout['id'])) : ?>
                <input type="hidden" name="id" value="<?= $workout['id'] ?>">
            <?php endif; ?>
            <div class="card-body">
                <div class="row g-3 mb-3">
                    <div class="col-md-6 form-floating">
                        <select class="form-select" name="id_exercices" id="id_exercices" required>
                            <option value="">-- Sélectionner un exercice --</option>
                            <?php foreach ($exercices as $ex): ?>
                                <option value="<?= $ex['id'] ?>"
                                    <?= isset($selectedExerciceId) && $selectedExerciceId == $ex['id'] ? 'selected' : '' ?>>
                                    <?= esc($ex['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <label for="id_muscle">Exercice</label>
                    </div>

                    <div class="col-md-6 form-floating">
                        <select class="form-select" name="id_program" id="id_program" required>
                            <option value="">-- Sélectionner un programme --</option>
                            <?php foreach ($program as $p): ?>
                                <option value="<?= $p['id'] ?>"
                                    <?= isset($selectedProgramId) && $selectedProgramId == $p['id'] ? 'selected' : '' ?>>
                                    <?= esc($p['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <label for="id_muscle">Programme</label>
                    </div>

                </div>

                <div class="row g-3 mb-3">

                    <div class="col-md-4 form-floating">
                        <input type="datetime-local" class="form-control" name="date" value="<?= $workout['date'] ?? '' ?>" placeholder="Date" required>
                        <label for="date">Date</label>
                    </div>

                    <div class="col-md-4 form-floating">
                        <input type="time" class="form-control" name="rest_time" value="<?= $workout['rest_time'] ?? '' ?>" placeholder="Temps de repos" required>
                        <label for="rest_time">Temps de repos</label>
                    </div>



                    <div class="col-md-4 form-floating">
                        <input type="number" class="form-control" name="order" value="<?= $workout['order'] ?? '' ?>" placeholder="Ordre" required>
                        <label for="order">Ordre</label>
                    </div>
                </div>
            </div>

            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
