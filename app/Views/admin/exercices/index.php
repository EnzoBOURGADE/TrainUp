<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Liste des exercices</h3>
                <a href="<?= base_url('/admin/exercice/new') ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Nouvel exercice
                </a>
            </div>
            <div class="card-body">
                <table id="exercicesTable" class="table table-sm table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Temps de repos</th>
                        <th>Répétition</th>
                        <th>Nombre de séries</th>
                        <th>Temps de la série</th>
                        <th>Catégorie</th>
                        <th>Muscle</th>
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
        var table = $('#exercicesTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?= base_url('datatable/searchdatatable') ?>',
                type: 'POST',
                data: {
                    model: 'ExerciceModel'
                }
            },
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'description' },
                { data: 'rest_time' },
                { data: 'reps' },
                { data: 'nber_series' },
                { data: 'time_series' },
                { data: 'name_cat' },
                { data: 'name_muscle' },
                {
                    data: null,
                    orderable: false,
                    render: function(data, type, row) {
                        return `
                            <div class="btn-group" role="group">
                                <a href="<?= base_url('/admin/exercices/') ?>${row.id}" class="btn btn-sm btn-warning" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <span class="btn btn-sm btn-danger" title="Supprimer" onclick="deleteExercice(${row.id})">
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

    function deleteExercice(id) {
        Swal.fire({
            title: `Êtes-vous sûr ?`,
            text: `Voulez-vous vraiment supprimer cet exercice ?`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: "#6c757d",
            confirmButtonText: `Oui, supprimé !`,
            cancelButtonText: "Annuler",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= base_url('admin/exercice/delete') ?>",
                    type: 'POST',
                    data: { id: id },
                    success: function(response) {
                        if(response.success) {
                            refreshTable();
                            Swal.fire({
                                icon : 'success',
                                title : 'Supprimé',
                                text: response.message,
                                timer: 1500,
                                showConfirmButton: false,
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Erreur :', error);
                    }
                });
            }
        });
    }
</script>
