<?= $this->extend('layout/template_nosidebar'); ?>

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
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Pendaftaran Developer</h3>
              </div>
              <!-- /.card-header -->
              
              <div class="card-body">
                <?= form_open('register','class="form-horizontal"'); ?>
                <?= csrf_field() ?>
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputFile">Kartu Tanda Anggota (KTA)</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <input name="nama" type="text" class="form-control <?= ((session()->getFlashdata('validation')) && session('validation')->hasError('nama')) ? 'is-invalid' : ''; ?>" 
                        id="nama" value="<?= old('nama') ?>" placeholder="Nama" required>
                      <?php if (session()->getFlashdata('validation')): ?>
                        <span style="color: red;"><?= session('validation')->getError('nama') ?></span>
                      <?php endif; ?>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-sm-12">
                      <input name="telp" type="number" class="form-control <?= ((session()->getFlashdata('validation')) && session('validation')->hasError('telp')) ? 'is-invalid' : ''; ?>"
                        id="telp" value="<?= old('telp') ?>" placeholder="Telepon" required>
                      <?php if (session()->getFlashdata('validation')): ?>
                        <span style="color: red;"><?= session('validation')->getError('telp') ?></span>
                      <?php endif; ?>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-sm-12">
                      <input name="email" type="email" class="form-control <?= ((session()->getFlashdata('validation')) && session('validation')->hasError('email')) ? 'is-invalid' : ''; ?>"
                        id="email" value="<?= old('email') ?>" placeholder="Email" required>
                      <?php if (session()->getFlashdata('validation')): ?>
                        <span style="color: red;"><?= session('validation')->getError('email') ?></span>
                      <?php endif; ?>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-sm-12">
                      <input name="pbru" type="password" class="form-control password <?= ((session()->getFlashdata('validation')) && session('validation')->hasError('pbru')) ? 'is-invalid' : ''; ?>"
                        id="inputPassword2" placeholder="Password" required>
                      <?php if (session()->getFlashdata('validation')): ?>
                        <span style="color: red;"><?= session('validation')->getError('pbru') ?></span>
                      <?php endif; ?>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-sm-12">
                      <input name="pbru2" type="password" class="form-control password <?= ((session()->getFlashdata('validation')) && session('validation')->hasError('pbru2')) ? 'is-invalid' : ''; ?>"
                        id="inputPassword3" placeholder="Ulangi Password" required>
                      <?php if (session()->getFlashdata('validation')): ?>
                        <span style="color: red;"><?= session('validation')->getError('pbru2') ?></span>
                      <?php endif; ?>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-sm-12">
                      <input type="checkbox" class="" id="check">
                      <label class="form-check-label" for="exampleCheck2">Tampilkan Password</label>
                    </div>
                  </div>

                  <p>
                    <!-- Google reCAPTCHA Widget -->
                    <div class="g-recaptcha" data-sitekey="6LdGWZAqAAAAAF-815CNbkjzW2g3R3I6L6H_cWg4"></div>
                  </p>

                  <div class="form-group row">
                    <div class="col-sm-12">
                      <button type="submit" class="btn btn-primary btn-block" style="background-color: #35B5FE !important; border:none">Daftar</button>
                    </div>
                  </div>

                </div>
                <!-- /.card-body -->
                </form>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
              </div>
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