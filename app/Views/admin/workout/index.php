<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Liste des séances</h3>
                <a href="<?= base_url('/admin/workout/new') ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Nouvelle séance
                </a>
            </div>
            <div class="card-body">
                <table id="workoutTable" class="table table-sm table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Nom de l'exercice</th>
                        <th>Nom du programme</th>
                        <th>Date</th>
                        <th>Temps repos</th>
                        <th>Ordre</th>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- Les données seront chargées via AJAX -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var baseUrl = "<?= base_url(); ?>";
        var table = $('#workoutTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?= base_url('datatable/searchdatatable') ?>',
                type: 'POST',
                data: {
                    model: 'WorkoutModel'
                }
            },
            columns: [
                { data: 'name_exercice' },
                { data: 'name_program' },
                { data: 'date' },
                { data: 'rest_time' },
                { data: 'order' }
            ],
            order: [[0, 'desc']],
            pageLength: 10,
            language: {
                url: baseUrl + 'js/datatable/datatable-2.1.4-fr-FR.json',
            }
        });

        window.refreshTable = function() {
            table.ajax.reload(null, false);
        };
    });
</script>
