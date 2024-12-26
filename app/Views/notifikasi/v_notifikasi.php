<?= $this->extend('layout/template'); ?>

<?= $this->section('north'); ?>

<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url() ?>/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url() ?>/adminlte/plugins/datatables-bs4/css/custom.dataTables.css">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <input type="hidden" id="csrfHash" value="<?= csrf_hash() ?>">
                <input type="hidden" id="csrfToken" value="<?= csrf_token() ?>">
                <div class="card-header">
                    <h3 class="card-title">Daftar Notifikasi</h3>
                    <div class="card-tools">
                        <!-- <button type="button" class="btn btn-xs btn-info" id="tandaiSemuaDibaca">
                            Tandai Semua Dibaca
                        </button> -->
                    </div>
                </div>
                <div class="card-body">
                <table class="table table-bordered table-condensed table-sm">
                    <thead>
                        <tr class="table-info">
                            <th>No</th>
                            <th>Label</th>
                            <th>Isi</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($notifikasi as $key => $notif): ?>
                            <tr>
                                <td><?= $key+1; ?></td>
                                <td><?= $notif['label'] ?></td>
                                <td><?= $notif['isi'] ?></td>
                                <td><?= tanggal_hari_indo(date('Y-m-d', strtotime($notif['created_at']))) ?></td>
                                <td class="notifclass" id="notif-<?= $notif['id'] ?>">
                                    <?php if($notif['status'] == 0): ?>
                                        <button type="button" class="btn btn-xs btn-info tandaiDibaca" data-id="<?= $notif['id'] ?>">
                                            <i class="fa fa-envelope"></i>
                                        </button>
                                    <?php else: ?>
                                        <button type="button" class="btn btn-xs btn-info">
                                            <i class="fa fa-envelope-open"></i>
                                        </button>
                                    <?php endif; ?>
                                    <a href="<?= $notif['url'] ?>" class="btn btn-xs btn-info">
                                        <i class="fa fa-arrow-right"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
<?= $this->section('south'); ?>

<script>
$(function () {
  var table = $('.table').DataTable({
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
    "autoWidth": false,
    "language": {
      "url": "<?= base_url() ?>/adminlte/plugins/datatables/Indonesian.json"
    }
  });
});
</script>
<script>
$(document).ready(function() {
    // Tandai satu notifikasi dibaca
    $('.tandaiDibaca').click(function() {
        let id = $(this).data('id');
        let csrfName = $('#csrfToken').val();
        let csrfHash = $('#csrfHash').val();
        
        $.ajax({
            url: '<?= base_url('notifikasi/tandai_dibaca') ?>',
            type: 'POST',
            data: {
                id: id,
                [csrfName]: csrfHash
            },
            dataType: 'json',
            success: function(response) {
                if(response.status == 'success') {
                    $(`#notif-${id}`).html('<button type="button" class="btn btn-xs btn-info"><i class="fa fa-envelope-open"></i></button>');
                    // Update CSRF hash
                    $('#csrfToken').val(response.csrfToken);
                    $('#csrfHash').val(response.csrfHash);
                    Swal.fire('Berhasil', response.message, 'success');
                }
            },
                error: function(xhr) {
                    $('#csrfToken').val(xhr.responseJSON.csrfToken);
                    $('#csrfHash').val(xhr.responseJSON.csrfHash);
                    Swal.fire('Error', xhr.responseJSON.message, 'error');
            }
        });
    });

    // Tandai semua notifikasi dibaca
    $('#tandaiSemuaDibaca').click(function() {
        let csrfName = $('#csrfToken').val();
        let csrfHash = $('#csrfHash').val();
        
        $.ajax({
            url: '<?= base_url('notifikasi/tandai_semua_dibaca') ?>',
            type: 'POST',
            data: {
                [csrfName]: csrfHash
            },
            dataType: 'json',
            success: function(response) {
                if(response.status == 'success') {
                    $('.notifclass').html('<button type="button" class="btn btn-xs btn-info"><i class="fa fa-envelope-open"></i></button>');
                    // Update CSRF hash
                    $('#csrfToken').val(response.csrfToken);
                    $('#csrfHash').val(response.csrfHash);
                    Swal.fire('Berhasil', response.message, 'success');
                }
            },
            error: function(xhr) {
                $('#csrfToken').val(xhr.responseJSON.csrfToken);
                $('#csrfHash').val(xhr.responseJSON.csrfHash);
                Swal.fire('Error', xhr.responseJSON.message, 'error');
            }
        });
    });
});
</script>
<?= $this->endSection(); ?> 