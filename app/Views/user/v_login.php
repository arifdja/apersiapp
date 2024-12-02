
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
                        <!-- <div class="ribbon bg-primary" style="background-color: #35B5FE important; ">
                          OMNIBUS
                        </div> -->
                      </div>
    
    <div class="card-body login-card-body text-center" style="border-radius:15px">
      <div class="register-logo">
        <a href="#"><b>SI</b>MAYA</a>
      </div>
      <?= form_open('validateuser','autocomplete="off"'); ?>
      <?= csrf_field() ?>
        <div class="input-group mb-3"> 
        <input autofocus autocomplete="off" type="text" name="username" value="<?= set_value('username')?>" class="form-control <?= $validation->hasError('username') ? 'is-invalid' : ''; ?>" placeholder="Username">
          <div class="input-group-append input-group-sm">
            <div class="input-group-text input-group-sm">
              <span class="fas fa-user"></span>
            </div>
          </div>
          <div class="invalid-feedback">
            <?= $validation->getError('username'); ?>
          </div>
        </div>
        <div class="input-group mb-3">
          <input  autocomplete="off" id="password" name="password" value="<?= set_value('password')?>" type="password" class="form-control <?= $validation->hasError('password') ? 'is-invalid' : ''; ?>" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          <div class="invalid-feedback">
            <?= $validation->getError('password'); ?>
          </div>
        </div>
        <div class="form-check" style="margin-bottom:1rem">
          <input type="checkbox" class="form-check-input" id="check">
          <label class="form-check-label" for="exampleCheck2">Tampilkan Password</label>
        </div>
        <p>
            <!-- Google reCAPTCHA Widget -->
            <div class="g-recaptcha" data-sitekey="6LdGWZAqAAAAAF-815CNbkjzW2g3R3I6L6H_cWg4"></div>
        </p>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block" style="background-color: #35B5FE !important; border:none">Login</button>
            <a href="<?= base_url('form_register') ?>" class="btn btn-primary btn-block" style="background-color: #35B5FE !important; border:none">Register</a>
          
          </div>
          <!-- /.col -->
          
        </div>
      <?= form_close() ?>
   
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
