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
                <button class="btn btn-info btn-xs" onclick="window.location.href='<?= site_url('developer/form_pengajuan_dana') ?>'">Tambah Pengajuan Dana</button>
              
                <button class="btn btn-xs btn-info toggle-alamat">
                          <i class="fas fa-eye"></i> Alamat
                        </button>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-2">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr class="table-info">
                      <th>No.</th>
                      <th>Detail<br>Unit</th>
                      <th>Nama<br> PT</th>
                      <th>Surat <br>Permohonan</th>
                      <th class="alamat-column" style="display:none">Alamat<br> Perumahan</th> 
                      <th class="alamat-column" style="display:none">Detail<br>Alamat</th>
                      <th>Site<br>Plan</th>
                      <th>Jumlah<br>Unit</th>
                      <th>Harga<br> SP3K</th>
                      <th>Dana<br> Talangan</th>
                      <th>Total<br>Pinjaman</th>
                      <th>Pinjaman<br> KPL</th>
                      <th>Pinjaman<br> KYG</th>
                      <th>Pinjaman<br> Lain</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                    <input type="hidden" class="csrf_hash" name="<?= csrf_hash() ?>" value="<?= csrf_hash() ?>" />
                    <input type="hidden" class="csrf_token" name="<?= csrf_token() ?>" value="<?= csrf_token() ?>" />
                  </thead>
                  <tbody>
                    <?php $no=1; foreach ($pengajuan as $p) { ?>
                    <tr>
                      <input type="hidden" name="uuid" value="<?= $p['uuid'] ?>">
                      <td><?= $no++ ?></td>
                      <td>
                        <a href="<?= site_url('developer/monitoring_detail_pengajuan_dana?uuid='.$p['uuid']) ?>" class="btn btn-xs btn-info" data-toggle="tooltip" title="Isi detail pengajuan dana"><i class="fa fa-eye"></i></a>
                      </td>
                      <td><?= $p['namapt'] ?></td>
                      <td><a href="<?= base_url() ?>/download/surat_permohonan/<?= $p['berkassuratpermohonan'] ?>" target="_blank">Lihat</a></td>
                      <td class="alamat-column" style="display:none"><?= $p['namaprovinsi'] ?> - <?= $p['namakabupaten'] ?> - <?= $p['namakecamatan'] ?></td>
                      <td class="alamat-column" style="display:none"><?= $p['alamatperumahaninput'] ?></td>
                      <td><a href="<?= base_url() ?>/download/site_plan/<?= $p['berkassiteplan'] ?>" target="_blank">Lihat</a></td>
                      <td id="jumlahunitinput<?= $p['uuid'] ?>"><?= $p['jumlahunitinput'] ?></td>
                      <td align="right"><?= number_format($p['totalhargasp3k'],0,',','.') ?></td>
                      <td align="right"><?= number_format($p['totaldanatalangan'],0,',','.') ?></td>
                      <td align="right"><?= number_format($p['totalpinjamankpl']+$p['totalpinjamankyg']+$p['totalpinjamanlain'],0,',','.') ?></td>
                      <td align="right"><?= number_format($p['totalpinjamankpl'],0,',','.') ?></td>
                      <td align="right"><?= number_format($p['totalpinjamankyg'],0,',','.') ?></td>
                      <td align="right"><?= number_format($p['totalpinjamanlain'],0,',','.') ?></td>
                      <td id="ajukan_dana<?= $p['uuid'] ?>">
                        <?php if($p['submited_status']=='' || $p['submited_status']==null) : ?>
                          <span class="badge badge-warning">Draft</span>
                        <?php elseif($p['submited_status']==1) : ?> 
                          <span class="badge badge-warning">Proses Pengecekan</span>
                        <?php elseif($p['submited_status']==2) : ?>
                          <span class="badge badge-danger">Dikembalikan</span>
                        <?php elseif($p['submited_status']==3) : ?>
                          <span class="badge badge-success">Proses Persetujuan</span>
                        <?php elseif($p['submited_status']==4) : ?>
                          <span class="badge badge-success">Disetujui</span>
                        <?php elseif($p['submited_status']==5) : ?>
                          <span class="badge badge-success">Terkirim ke Pendana</span>
                        <?php endif; ?>
                      </td>
                      <td id="aksi_ajukan_dana<?= $p['uuid'] ?>">
                        <?php if($p['submited_status'] == 0 || $p['submited_status'] == ''): ?>
                        <button class="btn btn-xs btn-info ajukan_dana">Ajukan</button>
                        <?php elseif($p['submited_status'] == 1): ?>
                        -
                        <?php elseif($p['submited_status'] == 2): ?>
                          <button class="btn btn-xs btn-info ajukan_dana">Ajukan</button>
                        <?php elseif($p['submited_status'] == 3): ?>
                        -
                        <?php elseif($p['submited_status'] == 4): ?>
                        -
                        <?php else: ?>
                          -
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
  $(document).ready(function() {
    $('.ajukan_dana').click(function(e) {
      e.preventDefault();
      var uuid = $(this).closest('tr').find('input[name="uuid"]').val();
      var csrfToken = $(".csrf_token").val();
      var csrfHash = $(".csrf_hash").val();
      var jumlahunit = parseInt($("#jumlahunitinput"+uuid).text().trim());

      if(jumlahunit == 0){
        Swal.fire({
          icon: 'error',
          title: 'Peringatan',
          text: 'Jumlah unit tidak boleh 0',
        });
        return false;
      }

      $.ajax({
        type: 'POST',
        headers: {'X-Requested-With': 'XMLHttpRequest'},
        url: '<?= site_url('developer/ajukan_dana_ajax') ?>',
        data: {uuid: uuid, jumlahunit: jumlahunit, [csrfToken]: csrfHash},
        dataType: 'json',
        success: function(response) {
          if(response.status == 'success') {
            $(".csrf_hash").val(response.csrfHash);
            $(".csrf_token").val(response.csrfToken);
            $("#ajukan_dana"+uuid).html('<span class="badge bg-success">Proses Pengecekan</span>');
            $("#aksi_ajukan_dana"+uuid).html('-');
            Swal.fire({ 
              icon: 'success',
              title: 'Berhasil',
              text: response.message,
            });
          }
        },
        error: function(xhr, status, error) {
          if(xhr.responseJSON) {
            $(".csrf_hash").val(xhr.responseJSON.csrfHash);
            $(".csrf_token").val(xhr.responseJSON.csrfToken);
          }
          Swal.fire({
            icon: 'error', 
            title: 'Gagal',
            text: 'Dana gagal di ajukan. Mohon coba lagi',
          });
        }
      });
    });
  });
</script>
<script>
  $(function () {
    $('.table').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "language": {
        "url": "<?= base_url() ?>/adminlte/plugins/datatables/Indonesian.json"
    }
    });
  });
</script>
<script>
$(document).ready(function() {
  // Status awal kolom tersembunyi
  let alamatVisible = false;
  
  // Handler untuk toggle button
  $('.toggle-alamat').click(function() {
    alamatVisible = !alamatVisible;
    
    if(alamatVisible) {
      $('.alamat-column').show();
      $(this).html('<i class="fas fa-eye-slash"></i> Alamat');
    } else {
      $('.alamat-column').hide(); 
      $(this).html('<i class="fas fa-eye"></i> Alamat');
    }
  });
});
</script>
<?= $this->endSection(); ?>