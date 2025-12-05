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
                <input type="hidden" name="id_workout" value="<?= $workout['id'] ?>">
            <?php endif; ?>
            <div class="card-body">
                <div class="row g-3 mb-3">
                    <div class="col-md-8 form-floating">
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

                    <div class="col-md-4 form-floating">
                        <input type="date" class="form-control" name="date" value="<?= $workout['date'] ?? '' ?>" placeholder="Date" required>
                        <label for="date">Date</label>
                    </div>

                </div>

                <!-- <div class="row g-3 mb-3">
                    <div class="col-md-4 form-floating">
                        <input type="number" class="form-control" name="order" value="<?= $workout['order'] ?? '' ?>" placeholder="Ordre" required>
                        <label for="order">Ordre</label>
                    </div>
                </div>
            </div> -->


            <div class="row justify-content-center">
                <div id="exercisesContainer">

                </div>
                <div class="row justify-content-center mb-3">
                    <div class="col-auto">
                        <button type="button" id="addExercise" class="btn btn-sm btn-primary">
                            <i class="fas fa-plus"></i> Ajouter un exercice
                        </button>
                    </div>
                </div>
            </div>
        </div>
            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
            <?= form_close() ?>
    </div>
</div>




<script>
    $(document).ready(function(){
        $('#addExercise').on('click', function(){
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
        </div>
        `;
            $('#exercisesContainer').append(row);
            initAjaxSelect2('#exercisesContainer .rowExercise:last-child .selectExercise', {
                url: base_url + '/admin/exercices/search',
                placeholder: "Rechercher un exercice ...",
                searchFields : 'name',
                delay: 250,
            });
        });

        // Supprimer un exercice
        $('#exercisesContainer').on('click', '.btnRemoveExercise', function(){
            $(this).closest('.rowExercise').remove();
        });

        $('#exercisesContainer').on('select2:select','.selectExercise', function(e){
            const id = parseInt($(this).val());
            const rowInfo = $(this).closest('.rowExercise').find('.rowInfoExercise');
            const nb = $(this).closest('.rowExercise').data('nb');
            $.ajax({
                type : 'GET',
                url : base_url + 'admin/exercices/info/' + id,
                success : function(data){
                    if(!data.error) {
                        const row = `
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input value="${data.reps}" type="number" class="form-control" name="exercices[${nb}][reps]" placeholder="Répétitions" required>
                                <label>Répétitions</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input value="${data.nber_series}" type="number" class="form-control" name="exercices[${nb}][nber_series]" placeholder="Séries" required>
                                <label>Séries</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input value="${data.rest_time}" type="number" class="form-control" name="exercices[${nb}][rest_time]" placeholder="Temps de repos (s)" required>
                                <label>Temps de repos (s)</label>
                            </div>
                        </div>
                    </div>
                    `;
                        rowInfo.html(row);
                    }
                },
                error : function(err){
                    console.log(err);
                }
            });
        });
    });
</script>