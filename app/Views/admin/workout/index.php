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
                        <th>Actions</th>
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
                { data: 'order' },
                {
                    data: null,
                    orderable: false,
                    render: function(data, type, row) {
                        return `
                            <div class="btn-group" role="group">
                                <a href="<?= base_url('/admin/workout/') ?>${row.id}" class="btn btn-sm btn-warning" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <span class="btn btn-sm btn-danger" title="Supprimer" onclick="deleteWorkout(${row.id})">
                                    <i class="fas fa-trash"></i>
                                </span>
                            </div>
    `;
                    }
                }
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

    function deleteWorkout(id) {
        Swal.fire({
            title: 'Êtes-vous sûr ?',
            text: 'Voulez-vous vraiment supprimer ce workout ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Oui, supprimé !',
            cancelButtonText: 'Annuler',
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: "<?= base_url('admin/workout/delete') ?>",
                    type: 'POST',
                    data: { id: id },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            refreshTable();

                            Swal.fire({
                                icon: 'success',
                                title: 'Supprimé',
                                text: response.message,
                                timer: 1500,
                                showConfirmButton: false,
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Erreur',
                                text: response.message,
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Erreur AJAX :', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Erreur',
                            text: 'Une erreur est survenue lors de la suppression.',
                        });
                    }
                });
            }
        });
    }
</script>
