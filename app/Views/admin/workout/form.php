<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h1 class="h3">
                    <?php if (!empty($workout['date'])) : ?>
                        Modification d’une séance
                    <?php else: ?>
                        Création d’une séance
                    <?php endif; ?>
                </h1>
            </div>

            <?= form_open('admin/workout/save') ?>

            <input type="hidden" name="id_program" value="<?= $program['id'] ?>">

            <div class="card-body">
                <div class="row g-3 mb-3">
                    <div class="col-md-13 form-floating">
                        <input type="text"
                               class="form-control"
                               value="<?= esc($program['name']) ?>"
                               readonly>
                        <label for="program">Programme</label>
                    </div>

                    <div class="col-md-13 form-floating">
                        <input type="date" class="form-control" name="date" value="<?= !empty($workout['date']) ? date('Y-m-d', strtotime($workout['date'])) : '' ?>" required>
                        <label for="date">Date</label>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div id="exercicesContainer"></div>

                    <div class="row justify-content-center mb-3">
                        <div class="col-auto">
                            <button type="button" id="addExercise" class="btn btn-sm btn-primary">
                                <i class="fas fa-plus"></i> Ajouter un exercice
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer d-flex justify-content-between">
                <a class="text-light btn btn-danger" href=<?= "./admin/program/" . $program['id'] ?>>
                    <i class="fa-solid fa-left-long"></i>
                    Retour
                </a>
                <button type="reset" class="btn btn-secondary btn-reinitialiser" id="reinitialiser">
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

        const urlParts = window.location.pathname.split('/').filter(Boolean);
        const dateParam = urlParts[3] ? decodeURIComponent(urlParts[3]) : null;
        const isEdit = !!dateParam;

        const workout = <?= isset($workout['exercices']) ? json_encode($workout['exercices']) : 'null' ?>;

        let exerciseIndex = 0;

        function createExerciseRow(exercise = null, index = null) {

            const nb = index ?? exerciseIndex++;

            const row = `
        <div class="row rowExercise mb-3" data-nb="${nb}">
            <div class="col">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <select class="form-select selectExercise"></select>

                            <button type="button" class="btn btn-danger btn-sm ms-2 btnRemoveExercise">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>

                        <div class="rowInfoExercise mt-3"></div>

                    </div>
                </div>
            </div>
        </div>`;

            $('#exercicesContainer').append(row);

            const select = $('#exercicesContainer .rowExercise:last-child .selectExercise');

            initAjaxSelect2(select, {
                url: base_url + '/admin/exercices/search',
                placeholder: 'Rechercher un exercice ...',
                delay: 250
            });

            if (exercise) {
                hydrateExercise(select, exercise, nb);
            }
        }

        function hydrateExercise(select, exercise, nb) {

            select.append(new Option(exercise.name ?? '', exercise.id_exercices, true, true)).trigger('change');

            const rowExercise = select.closest('.rowExercise');
            const rowInfo = rowExercise.find('.rowInfoExercise');

            rowInfo.empty();

            rowInfo.append(`<input type="hidden" name="exercices[${nb}][id_exercices]" value="${exercise.id_exercices}">`);

            rowInfo.append(`
            <div class="text-center mt-2">
                <button type="button" class="btn btn-sm btn-success btnAddSeries">
                    + Ajouter une série
                </button>
            </div>
        `);

            if (exercise.series && exercise.series.length) {
                exercise.series.forEach((s, i) => {
                    rowInfo.append(createSeriesRow(nb, i, s.reps, s.weight));
                });
            }
        }

        function createSeriesRow(nb, i, reps = 0, weight = 0) {
            return `
        <div class="row mb-2 seriesRow">
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="number" class="form-control" name="exercices[${nb}][series][${i}][reps]" value="${reps}" required>
                    <label>Répétitions</label>
                </div>
            </div>

            <div class="col-md-6 d-flex">
                <div class="form-floating flex-grow-1">
                    <input type="number" class="form-control" name="exercices[${nb}][series][${i}][weight]" value="${weight}" required>
                    <label>Poids</label>
                </div>

                <div class="d-flex align-items-center">
                    <button type="button" class="btn btn-danger btn-sm px-2 py-2 m-2 btnRemoveSeries">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>`;
        }

        $('#addExercise').on('click', function () {
            createExerciseRow();
        });

        $('#exercicesContainer').on('click', '.btnRemoveExercise', function () {
            $(this).closest('.rowExercise').remove();
        });

        $('#exercicesContainer').on('select2:select', '.selectExercise', function () {

            const id = $(this).val();
            const rowExercise = $(this).closest('.rowExercise');
            const rowInfo = rowExercise.find('.rowInfoExercise');
            const nb = rowExercise.data('nb');

            rowInfo.html('<div class="text-muted">Chargement...</div>');

            $.ajax({
                type: 'GET',
                url: base_url + 'admin/exercices/info/' + id,
                success: function (data) {

                    if (!data || data.error) {
                        rowInfo.html('<div class="text-danger">Erreur exercice</div>');
                        return;
                    }

                    rowInfo.empty();

                    rowInfo.append(`<input type="hidden" name="exercices[${nb}][id_exercices]" value="${id}">`);

                    rowInfo.append(`
                    <div class="text-center mt-2">
                        <button type="button" class="btn btn-sm btn-success btnAddSeries">
                            + Ajouter une série
                        </button>
                    </div>
                `);

                    const seriesCount = data.series ?? data.nber_series ?? 1;

                    for (let i = 0; i < seriesCount; i++) {
                        rowInfo.append(createSeriesRow(nb, i, data.reps ?? 0, data.weight ?? 0));
                    }
                }
            });
        });

        $('#exercicesContainer').on('click', '.btnAddSeries', function () {

            const rowExercise = $(this).closest('.rowExercise');
            const nb = rowExercise.data('nb');
            const index = rowExercise.find('.seriesRow').length;

            $(this).closest('.rowInfoExercise').append(createSeriesRow(nb, index, 0, 0));
        });

        $('#exercicesContainer').on('click', '.btnRemoveSeries', function () {

            const rowExercise = $(this).closest('.rowExercise');

            if (rowExercise.find('.seriesRow').length > 1) {
                $(this).closest('.seriesRow').remove();
            }
        });

        if (isEdit && workout) {
            workout.forEach((exercise, index) => {
                createExerciseRow(exercise, index);
            });
        }

    });
</script>