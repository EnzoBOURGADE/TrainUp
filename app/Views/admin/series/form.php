<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h1 class="h3">
                    <?php if (isset($series['id'])) : ?>
                        Modification d’une série
                    <?php else: ?>
                        Création d’une série
                    <?php endif; ?>
                </h1>
            </div>
            <?= form_open('admin/series/save') ?>
            <?php if (isset($series['id'])) : ?>
                <input type="hidden" name="id" value="<?= $series['id'] ?>">
            <?php endif; ?>
            <div class="card-body">
                <div class="mb-3 form-floating">
                    <input type="date" class="form-control" name="date" value="<?= $exercice['date'] ?? '' ?>" placeholder="Date de la série" required>
                    <label for="date">Date de la série</label>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-md-6 form-floating">
                        <select class="form-select" name="id_program" id="name_program" required>
                            <option value="">-- Sélectionner un programme --</option>
                            <?php foreach ($program as $pro): ?>
                                <option value="<?= $pro['id'] ?>"
                                    <?= isset($selectedProgramId) && $selectedProgramId == $pro['id'] ? 'selected' : '' ?>>
                                    <?= esc($pro['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <label for="id_program">Catégorie</label>
                    </div>
                    <div class="col-md-6 form-floating">
                        <select class="form-select" name="id_exercices" id="name_exercices" required>
                            <option value="">-- Sélectionner un exercice --</option>
                            <?php foreach ($exercices as $exe): ?>
                                <option value="<?= $exe['id'] ?>"
                                    <?= isset($selectedExerciceId) && $selectedExerciceId == $exe['id'] ? 'selected' : '' ?>>
                                    <?= esc($exe['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <label for="id_exercices">Muscles</label>
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-md-6 form-floating">
                        <input type="number" class="form-control" name="reps" value="<?= $series['reps'] ?? '' ?>" placeholder="Nombre de répétition" required>
                        <label for="reps">Nombre de répétition</label>
                    </div>
                    <div class="col-md-6 form-floating">
                        <input type="number" step="0.1" class="form-control" name="weight" value="<?= $series['weight'] ?? '' ?>" placeholder="Poids" required>
                        <label for="time_series">Poids</label>
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
