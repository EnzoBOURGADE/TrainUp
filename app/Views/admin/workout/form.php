<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h1 class="h3">
                    <?php if (isset($workout['id'])) : ?>
                        Modification d’une séance
                    <?php else: ?>
                        Création d’une séance
                    <?php endif; ?>
                </h1>
            </div>

            <?= form_open('admin/workout/save') ?>

            <input type="hidden" name="id_program" value="<?= $id_program ?>">

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
                        <input type="date" class="form-control" name="date" value="<?= $workout['date'] ?? '' ?>" required>
                        <label for="date">Date</label>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div id="exercisesContainer"></div>

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
                <a class="text-light btn btn-danger" href="./admin/program">
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

        $('#addExercise').on('click', function () {
            let nb = $('.rowExercise').length;

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

            $('#exercisesContainer').append(row);

            initAjaxSelect2('#exercisesContainer .rowExercise:last-child .selectExercise', {
                url: base_url + '/admin/exercices/search',
                placeholder: 'Rechercher un exercice ...',
                searchFields: 'name',
                delay: 250
            });
        });

        $('#exercisesContainer').on('click', '.btnRemoveExercise', function () {
            $(this).closest('.rowExercise').remove();
        });

        $('#exercisesContainer').on('select2:select', '.selectExercise', function () {
            const id = parseInt($(this).val());
            const rowExercise = $(this).closest('.rowExercise');
            const rowInfo = rowExercise.find('.rowInfoExercise');
            const nb = rowExercise.data('nb');

            $.ajax({
                type: 'GET',
                url: base_url + 'admin/exercices/info/' + id,
                success: function (data) {
                    if (!data.error) {
                        rowInfo.empty();
                        rowInfo.append(`<input type="hidden" name="exercices[${nb}][id_exercices]" value="${id}">`);
                        for (let i = 0; i < data.nber_series; i++) {
                            const seriesRow = createSeriesRow(nb, i, data.reps, data.weight ?? 0);
                            rowInfo.append(seriesRow);
                        }
                        const addBtn = `<div class="text-center mt-2">
                                    <button type="button" class="btn btn-sm btn-success btnAddSeries">+ Ajouter une série</button>
                                </div>`;
                        rowInfo.append(addBtn);
                    }
                }
            });
        });
        function createSeriesRow(nb, i, reps = 0, weight = 0) {
            return `
    <div class="row mb-2 seriesRow">
        <div class="col-md-6">
            <div class="form-floating">
                <input type="number" class="form-control"
                       name="exercices[${nb}][series][${i}][reps]"
                       value="${reps}" required>
                <label>Répétitions</label>
            </div>
        </div>
        <div class="col-md-6 d-flex">
            <div class="form-floating flex-grow-1">
                <input type="number" class="form-control"
                       name="exercices[${nb}][series][${i}][weight]"
                       value="${weight}" required>
                <label>Poids</label>
            </div>
           <div class="d-flex align-items-center">
                <button type="button" class="btn btn-danger btn-sm px-2 py-2 m-2 btnRemoveSeries">
                <i class="nav-icon fa-solid fa-trash-can"></i>
                </button>
            </div>
        </div>
    </div>`;
        }
        $('#exercisesContainer').on('click', '.btnAddSeries', function() {
            const rowInfo = $(this).closest('#exercisesContainer .rowInfoExercise');
            const rowExercise = $(this).closest('.rowExercise');
            const nb = rowExercise.data('nb');
            const index = rowExercise.find('.seriesRow').length;

            const newRow = createSeriesRow(nb, index, 0, 0);
            $(this).parent().before(newRow);
        });
        $('#exercisesContainer').on('click', '.btnRemoveSeries', function() {
            const rowExercise = $(this).closest('.rowExercise');
            if (rowExercise.find('.seriesRow').length > 1) {
                $(this).closest('.seriesRow').remove();
            }
        });


    });
</script>