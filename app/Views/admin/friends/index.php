<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Liste des amitiés</h3>
            </div>
            <div class="card-body">
                <table id="friendsTable" class="table table-sm table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID User 1</th>
                        <th>ID User 2</th>
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
        var table = $('#friendsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?= base_url('datatable/searchdatatable') ?>',
                type: 'POST',
                data: {
                    model: 'FriendsModel'
                }
            },
            columns: [
                { data: 'id_user_1' },
                { data: 'id_user_2' },
                {
                    data: null,
                    orderable: false,
                    render: function(data, type, row) {
                        return `
                            <div class="btn-group" role="group">
                                <span class="btn btn-sm btn-danger" title="Supprimer" onclick="deleteFriends(${row.id_user_1}, ${row.id_user_2})">
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

    function deleteFriends(user1, user2) {
        Swal.fire({
            title: `Êtes-vous sûr ?`,
            text: `Voulez-vous vraiment supprimer cette amitié ?`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: "#6c757d",
            confirmButtonText: `Oui, supprimé !`,
            cancelButtonText: "Annuler",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= base_url('admin/friends/delete') ?>",
                    type: 'POST',
                    data: { id_user_1: user1, id_user_2: user2 },
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
