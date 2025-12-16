<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h1 class="h3">
                    <?php if (isset($program['id'])) : ?>
                        Modification d'un programme
                    <?php else: ?>
                        Création d'un programme
                    <?php endif; ?>
                </h1>
            </div>
            <?= form_open('admin/program/save') ?>
            <?php if (isset($program['id'])) : ?>
                <input type="hidden" name="id" value="<?= $program['id'] ?>">
            <?php endif; ?>
            <div class="card-body">
                <div class="mb-3 form-floating">
                    <input type="text" class="form-control" name="name" value="<?= $program['name'] ?? '' ?>" placeholder="Nom du programme" required>
                    <label for="nom">Nom du programme</label>
                </div>

                <div class="mb-3">
                    <label for="id_user">Utilisateur : </label>
                    <select class="form-select" name="id_user" id="id_user" required>
                        <option value="">-- Sélectionner un utilisateur --</option>
                        <?php foreach ($users as $us): ?>
                            <option value="<?= $us->id ?>"
                                <?= isset($selectedUserId) && $selectedUserId == $us->id ? 'selected' : '' ?>>
                                <?= esc($us->username) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="id_cat">Catégorie : </label>
                    <select class="form-select" name="id_cat" id="id_cat" required>
                        <option value="">-- Sélectionner une catégorie --</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= $cat['id'] ?>"
                                <?= isset($selectedCategoryId) && $selectedCategoryId == $cat['id'] ? 'selected' : '' ?>>
                                <?= esc($cat['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="row justify-content-center">
                    <div id="workoutContainer"></div>

                    <div class="row justify-content-center mb-3">
                        <div class="col-auto">
                            <button type="button" id="addWorkout" class="btn btn-sm btn-primary">
                                <i class="fas fa-plus"></i> Ajouter une séance
                            </button>
                        </div>
                    </div>
                </div>
            </div>



            <div class="card-footer d-flex justify-content-between">
                <a class="text-light btn btn-danger" href="./admin/program">
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


<script>
    $(document).ready(function () {

        $('#addWorkout').on('click', function () {
            let nb = $('.rowWorkout').length;

            const row = `
        <div class="row rowWorkout mb-3" data-nb="${nb}">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <select class="form-select selectExercise"></select>
                            <button type="button" class="btn btn-danger btn-sm ms-2 btnRemoveWorkout">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                        <div class="rowInfoWorkout mt-3"></div>
                    </div>
                </div>
            </div>
        </div>`;

            $('#workoutContainer').append(row);

            initAjaxSelect2('#workoutContainer .rowWorkout:last-child .selectWorkout', {
                url: base_url + '/admin/workout/search',
                placeholder: 'Rechercher une séance ...',
                searchFields: 'name',
                delay: 250
            });
        });

        $('#workoutContainer').on('click', '.btnRemoveExercise', function () {
            $(this).closest('.rowExercise').remove();
        });

        $('#workoutContainer').on('select2:select', '.selectExercise', function () {
            const id = parseInt($(this).val());
            const rowExercise = $(this).closest('.rowWorkout');
            const rowInfo = rowExercise.find('.rowInfoExercise');
            const nb = rowExercise.data('nb');

            $.ajax({
                type: 'GET',
                url: base_url + 'admin/exercices/info/' + id,
                success: function (data) {
                    if (!data.error) {
                        const row = `
                    <div class="row">
                        <input type="hidden" name="exercices[${nb}][id_exercices]" value="${id}">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="number" class="form-control" name="exercices[${nb}][reps]" value="${data.reps}" required>
                                <label>Répétitions</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="number" class="form-control" name="exercices[${nb}][nber_series]" value="${data.nber_series}" required>
                                <label>Séries</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="number" class="form-control" name="exercices[${nb}][rest_time]" value="${data.rest_time}" required>
                                <label>Temps de repos (s)</label>
                            </div>
                        </div>
                    </div>`;
                        rowInfo.html(row);
                    }
                }
            });
        });

    });
</script>
