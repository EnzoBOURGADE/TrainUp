<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Liste des catégories de programme</h3>
                <a href="<?= base_url('/admin/category-program/new') ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Nouvelle catégorie de programme
                </a>
            </div>
            <div class="card-body">
                <table id="categoryProgramTable" class="table table-sm table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Utilisation</th>
                        <th>Nom</th>
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
        var table = $('#categoryProgramTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?= base_url('datatable/searchdatatable') ?>',
                type: 'POST',
                data: {
                    model: 'CategoryProgramModel'
                }
            },
            columns: [
                { data: 'id' },
                {
                    data: 'count_usage',
                    className: 'text-center',
                    render: function(data) {
                        return data > 0
                            ? `<span class="badge bg-success">${data}</span>`
                            : `<span class="badge bg-secondary">0</span>`;
                    }
                },
                { data: 'name' },
                {
                    data: null,
                    orderable: false,
                    render: function(data, type, row) {
                        return `
                            <div class="btn-group" role="group">
                                <a href="<?= base_url('/admin/category-program/') ?>${row.id}" class="btn btn-sm btn-warning" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <span class="btn btn-sm btn-danger" title="Supprimer" onclick="deleteCategoryProgram(${row.id})">
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

    function deleteCategoryProgram(id) {
        Swal.fire({
            title: `Êtes-vous sûr ?`,
            text: `Voulez-vous vraiment supprimer cette catégorie de programme ?`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: "#6c757d",
            confirmButtonText: `Oui, supprimé !`,
            cancelButtonText: "Annuler",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= base_url('admin/category-program/delete') ?>",
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
