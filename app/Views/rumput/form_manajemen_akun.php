<?= $this->extend('layout/template'); ?>

<?= $this->section('north'); ?>
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url() ?>/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal-tambah">
                            Tambah User
                        </button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <?php if (session()->getFlashdata('pesan')) : ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?= session()->getFlashdata('pesan'); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Email</th>
                                    <th>Nama</th>
                                    <th>Grup User</th>
                                    <th>Status Validator</th>
                                    <th>Status Verifikasi Email</th>
                                    <th>Expired Token Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($result as $user) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $user['email']; ?></td>
                                        <td><?= $user['nama']; ?></td>
                                        <td><?= ucfirst($user['kdgrpuser']); ?></td>
                                        <td><?= $user['statusvalidator']; ?></td>
                                        <td><?= $user['is_email_verified']; ?></td>
                                        <td data-email_token_expired="<?= $user['email_token_expired']; ?>"><?= $user['email_token_expired']; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-xs btn-edit" 
                                                    data-uuid="<?= $user['uuid']; ?>">
                                                Edit
                                            </button>
                                            <button type="button" class="btn btn-danger btn-xs btn-delete" 
                                                    data-uuid="<?= $user['uuid']; ?>">
                                                Hapus
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
                    <h4 class="modal-title">Tambah User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= site_url('rumput/save_user') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="form-group">
                            <label>Grup User</label>
                            <select class="form-control" name="kdgrpuser" required>
                                <option value="">Pilih Grup User</option>
                                <option value="developer">Developer</option>
                                <option value="operator">Operator</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
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
                    <h4 class="modal-title">Edit User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-edit">
                    <?= csrf_field() ?>
                    <input type="hidden" name="uuid" id="edit-uuid">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" id="edit-email" readonly>
                        </div>
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="nama" id="edit-nama" required>
                        </div>
                        <div class="form-group">
                            <label>Password (Kosongkan jika tidak ingin mengubah)</label>
                            <input type="password" class="form-control" name="password" id="edit-password">
                        </div>
                        <div class="form-group">
                            <label>Grup User</label>
                            <select class="form-control" name="kdgrpuser" id="edit-kdgrpuser" required>
                                <option value="">Pilih Grup User</option>
                                <option value="developer">Developer</option>
                                <option value="operator">Operator</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>

<?= $this->section('south'); ?>
<script src="<?= base_url() ?>/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize DataTable
    $('.table').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true
    });

    // Function to refresh CSRF token
    function refreshToken() {
        $.get('<?= site_url('rumput/getCSRF') ?>', function(response) {
            let data = JSON.parse(response);
            $('input[name=<?= csrf_token() ?>]').val(data.token);
        });
    }

    // Handle Edit Button
    $('.btn-edit').click(function(e) {
        e.preventDefault();
        var uuid = $(this).data('uuid');
        $.ajax({
            url: '<?= site_url('rumput/get_user') ?>',
            type: 'POST',
            data: {
                uuid: uuid,
                <?= csrf_token() ?>: $('input[name=<?= csrf_token() ?>]').val()
            },
            dataType: 'json',
            success: function(response) {
                refreshToken();
                if(response) {
                    $('#edit-uuid').val(response.uuid);
                    $('#edit-email').val(response.email);
                    $('#edit-nama').val(response.nama);
                    $('#edit-kdgrpuser').val(response.kdgrpuser);
                    $('#modal-edit').modal('show');
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Data tidak ditemukan'
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error', 
                    title: 'Error',
                    text: 'Terjadi kesalahan saat mengambil data'
                });
            }
        });
    });

    // Handle Edit Form Submit
    $('#form-edit').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?= site_url('rumput/update_user') ?>',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                refreshToken();
                if (response.status) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.message
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: response.message
                    });
                }
            }
        });
    });

    // Handle Delete Button
    $('.btn-delete').click(function(e) {
        e.preventDefault();
        
        // Periksa waktu kedaluwarsa token email
        var currentTime = new Date().getTime();
        var tokenExpiry = new Date($(this).closest('tr').find('[data-email_token_expired]').text()).getTime();
        // var tokenExpiry = $(this).closest('tr').find('[data-email_token_expired]').text();
        // console.log(tokenExpiry);


        // alert(tokenExpiry);return false;
        
        if (currentTime < tokenExpiry) {
            Swal.fire({
                icon: 'error',
                title: 'Token Email Belum Kedaluwarsa',
                text: 'Token email belum kedaluwarsa.'
            });
            return;
        }
        
        Swal.fire({
            title: 'Apakah Anda yakin?', 
            text: "Data user akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33', 
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                var uuid = $(this).data('uuid');
                $.ajax({
                    url: '<?= site_url('rumput/delete_user') ?>',
                    type: 'POST',
                    data: {
                        uuid: uuid,
                        <?= csrf_token() ?>: $('input[name=<?= csrf_token() ?>]').val()
                    },
                    dataType: 'json',
                    success: function(response) {
                        refreshToken();
                        if (response.status) {
                            Swal.fire(
                                'Terhapus!',
                                response.message,
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        }
                    }
                });
            }
        });
    });
});
</script>
<?= $this->endSection(); ?>