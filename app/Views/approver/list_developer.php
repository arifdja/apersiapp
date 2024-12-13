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
                <div class="card-tools" style="margin: 0px;"><button class="btn btn-xs btn-success" id="excel"><i class="fas fa-excel"></i>Download Excel</button></div>
                <div class="card-title">
                    <label><input type="checkbox" class="toggle-column" data-column="2" checked> Email</label>
                    <label><input type="checkbox" class="toggle-column" data-column="3" checked> No Telp</label>
                    <label><input type="checkbox" class="toggle-column" data-column="4" checked> Alamat</label>
                    <label><input type="checkbox" class="toggle-column" data-column="5" checked> KTA</label>
                </div>
              </div> 
              
               

              <!-- /.card-header -->
              <div class="card-body">
             
                <div class="table-responsive">
                  <table class="table table-bordered table-hover table-condensed">
                    <thead>
                      <tr>
                        <th style="width: 10px">No.</th>
                        <th>Nama Developer</th>
                        <th>Email</th>
                        <th>No Telp</th>
                        <th>Alamat</th>
                        <th>KTA</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($result as $key => $value) : ?>
                      <tr class="baris" style="cursor: pointer;" data-uuid="<?= $value['uuid']; ?>">
                        <td><?= $key+1; ?>.</td>
                        <td><?= $value['nama']; ?></td>
                        <td><?= $value['email']; ?></td>
                        <td><?= $value['notelp']; ?></td>
                        <td><?= $value['alamatinput']; ?>, <?= $value['kecamatan']; ?>, <?= $value['kota']; ?>, <?= $value['kabupaten']; ?>, <?= $value['provinsi']; ?>, kodepos <?= $value['kodepos']; ?></td>
                        <td><a href="<?= base_url() ?>/download/kta/<?= $value['berkaskta']; ?>" target="_blank"><?= $value['kta']; ?></a></td>
                      </tr>
                    <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>

            </div>
            <!-- /.card -->

          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    
  
<?= $this->endSection(); ?>

<?= $this->section('south'); ?>
<script>
$(document).ready(function() {
  // Export to Excel
  $("#excel").click(function() {
    $(".table").table2excel({
      exclude: ".noExl",
      name: "Pendaftaran Developer", 
      filename: "DataDeveloper",
      fileext: ".xls"
    });
  });
});
</script>

<script>
$(function() {
  // Initialize DataTable
  var table = $('.table').DataTable({
    paging: true,
    lengthChange: true, 
    searching: true,
    ordering: true,
    info: true,
    lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
    autoWidth: false,
    language: {
      url: "<?= base_url() ?>/adminlte/plugins/datatables/Indonesian.json"
    }
  });

  // Toggle column visibility
  $('.toggle-column').on('change', function() {
    var column = table.column($(this).attr('data-column'));
    column.visible(!column.visible());
  });

  // Menangani klik pada baris tabel
  $('.baris').on('click', function(e) {
    // Mencegah event click pada link KTA
    if ($(e.target).is('a')) return;
    
    var uuid = $(this).data('uuid');
    window.location.href = '<?= base_url() ?>operator/approval_dana/' + uuid;
  });
});
</script>


<?= $this->endSection(); ?>