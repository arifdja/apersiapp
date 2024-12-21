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
                  </div>
                <div class="card-title" style="margin-left: 5px;">
                  
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-2">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr class="table-info">
                      <th>No.</th>
                      <th>UUID</th>
                      <th>Email</th>
                      <th>Kewenangan</th>
                      <th>Nama</th>
                      <th>Telepon</th>
                      <th>Status Validator</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; foreach ($result as $p) { ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $p['uuid'] ?></td>
                      <td><?= $p['email'] ?></td>
                      <td><?= $p['kdgrpuser'] ?></td>
                      <td><?= $p['nama'] ?></td>
                      <td><?= $p['notelp'] ?></td>
                      <td><?= ($p['statusvalidator'] == '1') ? '<span class="badge bg-success">Aktif</span>' : '<span class="badge bg-danger">Tidak Aktif</span>' ?></td>
                      <td>
                        <button id="reset<?= $p['uuid'] ?>" class="btn btn-info btn-xs">Reset Password</button>
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
<?= $this->endSection(); ?>