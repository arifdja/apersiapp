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
        <div class="col-md-6">
        <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Profil</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form>
                <div class="card-body">

                <div class="form-group">
                    <label for="kta">Nama</label>
                    <input type="text" class="form-control" id="kta" placeholder="" value="<?= $result['nama'] ?>">
                  </div>


                <div class="form-group">
                    <label for="kta">Email</label>
                    <input disabled readonly type="text" class="form-control" id="kta" placeholder="" value="<?= $result['email'] ?>">
                  </div>


                <div class="form-group">
                    <label for="kta">Telp</label>
                    <input type="text" class="form-control" id="kta" placeholder="" value="<?= $result['notelp'] ?>">
                  </div>


                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                </div>
              </form>
            </div>
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
  $(document).ready(function () {
    $("#excel").click(function(){
      $(".table").table2excel({
        // exclude CSS class
        exclude: ".noExl",
        name: "Monitoring RVRO",
        filename: "<?= session('kddept'); ?>_<?= session('kdunit'); ?>_<?= session('kdsatker'); ?>_DataRO", //do not include extension
        fileext: ".xls" // file extension
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
      "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
      "autoWidth": false,
      "language": {
        "url": "<?= base_url() ?>/adminlte/plugins/datatables/Indonesian.json"
    }
    });

    //Initialize Select2 Elements
    $('.select2').select2();

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });

  });
</script>
<?= $this->endSection(); ?>