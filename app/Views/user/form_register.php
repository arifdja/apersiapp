<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SIMAYA</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="<?php echo base_url() ?>/assets/images/favicon.gif" type="image/x-icon" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>/adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url() ?>/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>/adminlte/dist/css/adminlte.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?= base_url() ?>/adminlte/plugins/toastr/toastr.min.css">
  <style>
       body{
            background: url(<?php echo base_url('assets/images/background.jpg') ?>) no-repeat center center fixed !important;
            background-color: #498BC6 !important;
            -webkit-background-size: auto;
            -moz-background-size: auto;
            -o-background-size: auto;
            background-size: auto !important;
        }
        .modal-header, .modal-body, .modal-footer{
            padding :0.5rem;
        }
        .modal-body p {
          margin-bottom : 0px;
        }
    </style>
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body class="hold-transition login-page">
<div class="login-box">

 
  <div class="card">
  <div class="ribbon-wrapper">
                      </div>
    
    <div class="card-body login-card-body text-center" style="border-radius:15px">
    <p class="login-box-msg">
      <!-- <img src="<?php echo base_url('assets/images/logomonev.png') ?>" alt="" style="width:100%"> -->
<h4>  PENDAFTARAN</h4>
      </p>
                        <?= form_open('register','class="form-horizontal"'); ?>
                        <?= csrf_field() ?>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <input
                                        name="nama"
                                        type="text"
                                        class="form-control <?= ((session()->getFlashdata('validation')) && session('validation')->hasError('nama')) ? 'is-invalid' : ''; ?>"
                                        id="nama"
                                        value="<?= old('nama') ?>"
                                        placeholder="Nama" required>
                                        <?php if (session()->getFlashdata('validation')): ?>
                                            <span style="color: red;"><?= session('validation')->getError('nama') ?></span>
                                        <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <input
                                        name="telp"
                                        type="number"
                                        class="form-control <?= ((session()->getFlashdata('validation')) && session('validation')->hasError('telp')) ? 'is-invalid' : ''; ?>"
                                        id="telp"
                                        value="<?= old('telp') ?>"
                                        placeholder="Telepon" required>
                                        <?php if (session()->getFlashdata('validation')): ?>
                                            <span style="color: red;"><?= session('validation')->getError('telp') ?></span>
                                        <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <input
                                        name="email"
                                        type="email"
                                        class="form-control <?= ((session()->getFlashdata('validation')) && session('validation')->hasError('email')) ? 'is-invalid' : ''; ?>"
                                        id="email"
                                        value="<?= old('email') ?>"
                                        placeholder="Email" required>
                                        <?php if (session()->getFlashdata('validation')): ?>
                                            <span style="color: red;"><?= session('validation')->getError('email') ?></span>
                                        <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <input
                                        name="pbru"
                                        type="password"
                                        class="form-control password <?= ((session()->getFlashdata('validation')) && session('validation')->hasError('pbru')) ? 'is-invalid' : ''; ?>"
                                        id="inputPassword2"
                                        placeholder="Password" required>
                                        <?php if (session()->getFlashdata('validation')): ?>
                                            <span style="color: red;"><?= session('validation')->getError('pbru') ?></span>
                                        <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <input
                                        name="pbru2"
                                        type="password"
                                        class="form-control password <?= ((session()->getFlashdata('validation')) && session('validation')->hasError('pbru2')) ? 'is-invalid' : ''; ?>"
                                        id="inputPassword3"
                                        placeholder="Ulangi Password" required>
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
               
    <p class="text-center" style="padding-top:10px;font-size:12px"><strong>Copyright &copy; 2024 <a style="color:#35B5FE" href="#">SIMAYA</a> </strong></p>
    

    </div>
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?= base_url() ?>/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url() ?>/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Toastr -->
<script src="<?= base_url() ?>/adminlte/plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>/adminlte/dist/js/adminlte.min.js"></script>

<script>
  $(document).ready(function () {
    // $('#modal-lg').modal('hide');
    // $('#password').autocomplete("disable");
    $('#check').click(function(){
        $(this).is(':checked') ? $('#password').attr('type', 'text') : $('#password').attr('type', 'password');
    });
  });
</script>

<?php if(session()->getFlashdata('msg')):?>
  <script>
  $(document).ready(function () {
    toastr.options = {
      "closeButton": false,
      "debug": false,
      "newestOnTop": false,
      "progressBar": false,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "3000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
    <?php if(session()->getFlashdata('type') == "Success" ):?>
      toastr.success('<?= session()->getFlashdata('msg') ?>');
    <?php elseif(session()->getFlashdata('type') == "Warning" ):?>
      toastr.warning('<?= session()->getFlashdata('msg') ?>');
    <?php endif;?>
  });
</script>
<?php endif;?>
</body>
</html>

<script>
$(document).ready(function () {
// $('#textinfo').modal();
$('#check').click(function () {
    $(this).is(':checked')
        ? $('.password').attr('type', 'text')
        : $('.password').attr('type', 'password');
});
});
</script>