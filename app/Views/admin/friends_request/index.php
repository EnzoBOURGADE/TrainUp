<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Liste des demandes d'amitiés</h3>
                <a href="<?= base_url('/admin/friends_request/new') ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Nouvelle demande d'amitié
                </a>
            </div>
            <div class="card-body">
                <table id="FriendsRequestTable" class="table table-sm table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID Demandeur</th>
                        <th>ID Recepteur</th>
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
        var table = $('#FriendsRequestTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?= base_url('datatable/searchdatatable') ?>',
                type: 'POST',
                data: {
                    model: 'FriendsRequestModel'
                }
            },
            columns: [
                { data: 'requester_id' },
                { data: 'receiver_id'  },
                {
                    data: null,
                    orderable: false,
                    render: function(data, type, row) {
                        return `
                            <div class="btn-group" role="group">
                                <a href="<?= base_url('/admin/friends_request/') ?>${row.id}" class="btn btn-sm btn-warning" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <span class="btn btn-sm btn-danger" title="Supprimer" onclick="deleteFriendsRequest(${row.id})">
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

        // Fonction pour actualiser la table
        window.refreshTable = function() {
            table.ajax.reload(null, false); // false pour garder la pagination
        };
    });

    function deleteFriendsRequest(id) {
        Swal.fire({
            title: `Êtes-vous sûr ?`,
            text: `Voulez-vous vraiment supprimer cette demande d'amitié ?`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: "#6c757d",
            confirmButtonText: `Oui, supprimé !`,
            cancelButtonText: "Annuler",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= base_url('admin/friends_request/delete') ?>",
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
