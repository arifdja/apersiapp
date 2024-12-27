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
                <div style="margin-bottom: 10px;">
                    <strong>Keterangan Status:</strong><br>
                    <span class="badge badge-success">Masih Aman</span>: SP3K masih berlaku<br>
                    <span class="badge badge-danger">Segera Perbaharui</span>: SP3K sudah mendekati masa kadaluarsa<br>
                </div>
              <div class="card-tools" style="margin: 0px;"><button class="btn btn-xs btn-success" id="excel"><i class="fas fa-excel"></i>Download Excel</button></div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-2">  
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr class="table-info">
                      <th>No.</th>
                      <th>PT</th>
                      <th>Sertifikat</th>
                      <th>PBG/IMB</th>
                      <th>PBB</th>
                      <th>Debitur</th>
                      <th>SP3K</th>
                      <th>Tanggal<br>SP3K</th>
                      <th>Harga<br> SP3K</th>
                      <th>Dana<br> Talangan</th>
                      <th>Total<br>Pinjaman</th>
                      <th>Pinjaman<br> KPL</th>
                      <th>Pinjaman<br> KYG</th>
                      <th>Pinjaman<br> Lain</th>
                      <th>Status<br> SP3K</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; foreach ($pengajuanDetail as $p) { ?>
                    <tr>
                      <input type="hidden" name="uuid" value="<?= $p['uuid'] ?>">
                      <td><?= $no++ ?></td>
                      <td><?= $p['namapt'] ?></td>
                      <td><a href="<?= base_url() ?>/download/sertifikat/<?= $p['berkassertifikat'] ?>" target="_blank"><?= $p['sertifikat'] ?></a></td>
                      <td><a href="<?= base_url() ?>/download/pbgimb/<?= $p['berkaspbgimb'] ?>" target="_blank">Lihat</a></td>
                      <td><a href="<?= base_url() ?>/download/pbb/<?= $p['berkaspbb'] ?>" target="_blank"><?= $p['pbb'] ?></a></td>
                      <td><a href="<?= base_url() ?>/download/ktp_debitur/<?= $p['berkasktpdebitur'] ?>" target="_blank"><?= $p['namadebitur'] ?></a></td>
                      <td><a href="<?= base_url() ?>/download/sp3k/<?= $p['berkassp3k'] ?>" target="_blank"><?= $p['nomordokumensp3k'] ?></a></td>
                      <td align="right"><?= tanggal_indo($p['tanggalsp3k']) ?></td>
                      <td align="right"><?= number_format($p['harga'],0,',','.') ?></td>
                      <td align="right"><?= number_format($p['nilaikredit'],0,',','.') ?></td>
                      <td align="right"><?= number_format($p['pinjamankpl']+$p['pinjamankyg']+$p['pinjamanlain'],0,',','.') ?></td>
                      <td align="right"><?= number_format($p['pinjamankpl'],0,',','.') ?></td>
                      <td align="right"><?= number_format($p['pinjamankyg'],0,',','.') ?></td>
                      <td align="right"><?= number_format($p['pinjamanlain'],0,',','.') ?></td>
                      <td>
                        <?= view('general/v_td_status_sp3k', ['p' => $p]) ?>
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