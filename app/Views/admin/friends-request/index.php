<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Liste des demandes d'amitiés</h3>
                <a href="<?= base_url('/admin/friends-request/new') ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Nouvelle demande d'amitié
                </a>
            </div>
            <div class="card-body">
                <table id="FriendsRequestTable" class="table table-sm table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID Demandeur</th>
                        <th>ID Recepteur</th>
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
                { data: 'receiver_id'  }
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
