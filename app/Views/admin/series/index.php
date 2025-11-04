<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Liste des séries</h3>
                <a href="<?= base_url('/admin/series/new') ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Nouvelle série
                </a>
            </div>
            <div class="card-body">
                <table id="seriesTable" class="table table-sm table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID Programme</th>
                        <th>ID Exercice</th>
                        <th>Répétition</th>
                        <th>Poids</th>
                        <th>Date</th>
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
        var table = $('#seriesTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?= base_url('datatable/searchdatatable') ?>',
                type: 'POST',
                data: {
                    model: 'SeriesModel'
                }
            },
            columns: [
                { data: 'id_program' },
                { data: 'id_exercices' },
                { data: 'reps' },
                { data: 'weight' },
                { data: 'date' }
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
