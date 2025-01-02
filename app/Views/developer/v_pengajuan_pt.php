<?= $this->extend('layout/template'); ?>

<?= $this->section('north'); ?>
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url() ?>/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url() ?>/adminlte/plugins/datatables-bs4/css/custom.dataTables.css">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

     <!-- Main content -->
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <button class="btn btn-info btn-xs" onclick="window.location.href='<?= site_url('developer/form_pengajuan_pt') ?>'">Tambah PT</button>
              </div>
              <div class="card-body table-responsive p-2">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr class="table-info">
                      <th>No</th>
                      <th>Nama<br>PT</th>
                      <th>NPWP<br>PT</th>
                      <th>Penanggung<br>Jawab PT</th>
                      <th>NPWP <br>Penanggung Jawab</th>
                      <th>Pengurus<br>PT</th>
                      <th>Akta<br>Pendirian</th>
                      <th>SK<br>Kemenkumham</th>
                      <th>Laporan<br>Keuangan</th>
                      <th>Rekening<br>Operasional</th>
                      <th>Rekening<br>Escrow</th>
                      <th>Alamat</th>
                      <th>Status<br>Validator</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                     
                    <?php $no=1; foreach ($pengajuan as $p) { ?>
                    <tr>
                      <input type="hidden" class="csrf_token" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>"/>
                      <input type="hidden" name="uuid" value="<?= $p['uuid'] ?>">
                      <td><?= $no++ ?></td>
                      <td><?= $p['namapt'] ?></td>
                      <td><a href="<?= base_url() ?>/download/npwp_pt/<?= $p['berkasnpwp'] ?>" target="_blank"><?= $p['npwppt'] ?></a></td>
                      <td><a href="<?= base_url() ?>/download/ktp_penanggungjawab/<?= $p['berkasktppj'] ?>" target="_blank"><?= $p['namapj'] ?></a></td>
                      <td><a href="<?= base_url() ?>/download/npwp_penanggungjawab/<?= $p['berkasnpwppj'] ?>" target="_blank"><?= $p['npwppj'] ?></a></td>
                      <td>
                        <?= $p['penguruspt'] ?>
                        <a href="<?= base_url() ?>/download/ktp_pengurus/<?= $p['berkaspengurusptktp'] ?>" target="_blank">KTP</a>
                        <a href="<?= base_url() ?>/download/npwp_pengurus/<?= $p['berkaspengurusptnpwp'] ?>" target="_blank">NPWP</a>
                      </td>
                      <td><a href="<?= base_url() ?>/download/akta_pendirian/<?= $p['berkasaktapendirian'] ?>" target="_blank">Lihat</a></td>
                      <td><a href="<?= base_url() ?>/download/sk_kemenkumham/<?= $p['berkasskkemenkumham'] ?>" target="_blank">Lihat</a></td>
                      <td><a href="<?= base_url() ?>/download/laporan_keuangan/<?= $p['berkaslaporankeuangan'] ?>" target="_blank">Lihat</a></td>
                      <td><a href="<?= base_url() ?>/download/rekening/<?= $p['berkasrekening'] ?>" target="_blank"><?= $p['rekening'] ?></a> <?= $p['namabank'] ?></td>
                      <td><a href="<?= base_url() ?>/download/rekening_escrow/<?= $p['berkasrekeningescrow'] ?>" target="_blank"><?= $p['rekeningescrow'] ?></a> <?= $p['namabankescrow'] ?></td>
                      <td><?= $p['namaprovinsi'] ?> - <?= $p['namakabupaten'] ?> - <?= $p['namakecamatan'] ?> - <?= $p['alamatinput'] ?></td>
                      <td>
                        <?= ($p['statusvalidator'] == '0' || $p['statusvalidator'] == '') ? '<span class="badge bg-warning">Menunggu Validasi</span>' : '' ?>
                        <?= ($p['statusvalidator'] == '1') ? '<span class="badge bg-success">Disetujui</span>' : '' ?>
                        <?php if($p['statusvalidator'] == '2') : ?>
                          Ditolak karena : <?= $p['keteranganpenolakan'] ?><br>
                          <button onclick="window.location.href='<?= site_url('developer/form_edit_pt?uuid=' . $p['uuid']) ?>'" class="btn btn-warning btn-xs"><i class="fas fa-pencil-alt"></i></button> 
                          <button class="btn btn-danger btn-xs hapus"><i class="fas fa-trash"></i></button>
                        <?php endif; ?>
                       
                      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    
  
<?= $this->endSection(); ?>

<?= $this->section('south'); ?>
<script>
  $(function () {
    $('.table').DataTable({
      "columnDefs": [
            {
                "targets": 5, // Column index (1 = second column)
                "render": function(data, type, row) {
                    return '<div style="width: 300px; white-space: normal; word-wrap: break-word;">' + data + '</div>';
                }
            }
        ],
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "pageLength": 100,
      "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Semua"]],
      "language": {
        "url": "<?= base_url() ?>/adminlte/plugins/datatables/Indonesian.json"
    }
    });
  });
</script>

<script>
$(document).ready(function () {
  $('.hapus').click(function (e) {
    e.preventDefault();
    
    // Get UUID from class name
   let uuid = $(this).closest('tr').find('input[name="uuid"]').val();
   let csrfName = '<?= csrf_token() ?>';
   let csrfHash = $(this).closest('tr').find('input[name="<?= csrf_token() ?>"]').val();
  //  alert(uuid);
  //  return false;

    Swal.fire({
      title: 'Apakah anda yakin?', 
      text: "Data PT akan dihapus permanen!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, hapus!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        // alert(uuid);return false;

        $.ajax({
          url: '<?= site_url('developer/hapus_pt') ?>',
          type: 'POST',
          data: {
            uuid: uuid,
            [csrfName]: csrfHash
          },
          success: function(response) {
            if(response.status == 'success') {
              Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data PT berhasil dihapus',
                showConfirmButton: false,
                timer: 1500
              }).then(() => {
                location.reload();
              });
            } else {
              Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Gagal menghapus data PT'
              });
            }
            $('.csrf_token').val(response.csrfHash);
          },
          error: function(xhr, status, error) {
            $('.csrf_token').val(xhr.responseJSON.csrfHash);
            Swal.fire({
              icon: 'error', 
              title: 'Error!',
              text: 'Terjadi kesalahan saat menghapus data'
            });
          }
        });
      }
    });
  });
});
</script>
<?= $this->endSection(); ?>