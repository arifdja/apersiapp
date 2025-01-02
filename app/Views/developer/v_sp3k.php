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
                      <td><a href="#" onclick="showPDF('sertifikat', '<?= $p['berkassertifikat']; ?>')" data-toggle="modal" data-target="#pdfModal"><?= $p['sertifikat'] ?></a></td>
                      <td><a href="#" onclick="showPDF('pbgimb', '<?= $p['berkaspbgimb']; ?>')" data-toggle="modal" data-target="#pdfModal"><?= $p['pbgimb'] ?></a></td>
                      <td><a href="#" onclick="showPDF('pbb', '<?= $p['berkaspbb']; ?>')" data-toggle="modal" data-target="#pdfModal"><?= $p['pbb'] ?></a></td>
                      <td><a href="#" onclick="showPDF('ktp_debitur', '<?= $p['berkasktpdebitur']; ?>')" data-toggle="modal" data-target="#pdfModal"><?= $p['namadebitur'] ?></a></td>
                      <td><a href="#" onclick="showPDF('sp3k', '<?= $p['berkassp3k']; ?>')" data-toggle="modal" data-target="#pdfModal"><?= $p['nomordokumensp3k'] ?></a></td>
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
  <!-- Modal -->
  <div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="pdfModalLabel">Dokumen</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <iframe id="pdfViewer" style="width:100%; height:800px;" frameborder="0"></iframe>
          </div>
        </div>
      </div>
    </div>
    
  
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
    function showPDF(type, filename) {
      document.getElementById('pdfViewer').src = '<?= base_url() ?>/download/' + type + '/' + filename + '/pdf';
    }
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