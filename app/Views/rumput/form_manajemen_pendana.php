<!-- Tambahkan ini di bagian bawah file sebelum endSection -->
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
                <div class="card-header">
                    <h3 class="card-title">Daftar Pendana</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#modal-tambah">
                            <i class="fas fa-plus"></i> Tambah Pendana
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>UUID</th>
                                <th>Nama Pendana</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach($result as $row): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $row['uuid']; ?></td>
                                <td><?= $row['nama']; ?></td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" onclick="edit('<?= $row['uuid'] ?>')">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="hapus('<?= $row['uuid'] ?>')">
                                        <i class="fas fa-trash"></i>
                                    </button>
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

<!-- Modal Tambah -->
<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Pendana</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('rumput/save_pendana') ?>" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Pendana</label>
                        <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" 
                               name="nama" placeholder="Masukkan nama pendana">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama'); ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modal-edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Pendana</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-edit">
                <?= csrf_field(); ?>
                <input type="hidden" name="uuid" id="edit-uuid">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Pendana</label>
                        <input type="text" class="form-control" name="nama" id="edit-nama" placeholder="Masukkan nama pendana">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('south'); ?>
<script>
// Tambahkan fungsi untuk refresh CSRF token
function refreshToken() {
    $.ajax({
        url: '<?= base_url('rumput/getCSRF') ?>',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            $('input[name="<?= csrf_token() ?>"]').val(response.token);
        }
    });
}

function edit(uuid) {
    $.ajax({
        url: '<?= base_url('rumput/get_pendana') ?>',
        type: 'POST',
        data: {
            uuid: uuid,
            <?= csrf_token() ?>: $('input[name="<?= csrf_token() ?>"]').val()
        },
        dataType: 'json',
        success: function(response) {
            $('#edit-uuid').val(response.uuid);
            $('#edit-nama').val(response.nama);
            $('#modal-edit').modal('show');
            refreshToken();
        }
    });
}

$('#form-edit').submit(function(e) {
    e.preventDefault();
    $.ajax({
        url: '<?= base_url('rumput/update_pendana') ?>',
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(response) {
            if(response.status) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: response.message,
                }).then((result) => {
                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: response.message,
                });
            }
            refreshToken();
        }
    });
});

function hapus(uuid) {
    Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '<?= base_url('rumput/delete_pendana') ?>',
                type: 'POST',
                data: {
                    uuid: uuid,
                    <?= csrf_token() ?>: $('input[name="<?= csrf_token() ?>"]').val()
                },
                dataType: 'json',
                success: function(response) {
                    if(response.status) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message,
                        }).then((result) => {
                            location.reload();
                        });
                    }
                    refreshToken();
                }
            });
        }
    });
}
</script>
<?= $this->endSection(); ?> 