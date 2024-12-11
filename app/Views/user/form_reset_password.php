
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= SITE_NAME ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="<?php echo base_url() ?>/assets/favicon/favicon.ico" type="image/x-icon" />

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
                        <div class="ribbon bg-primary" style="background-color: #35B5FE important; ">
                        ⭐⭐⭐⭐⭐
                        </div>
                      </div>
    
    <div class="card-body login-card-body text-center" style="border-radius:15px">
      <div class="register-logo">
        <img src="<?= base_url('assets/images/logo.png') ?>" alt="Logo" style="height:150px; margin-right:10px; border-radius:50%">
        
      </div>
      <p style="font-size:16px;">Masukkan password baru</p>
      
      <?php if(session()->getFlashdata('validation')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('validation')->getError('password') ?>  <?= session()->getFlashdata('validation')->getError('password_confirm') ?></div>
      <?php endif; ?>

      <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
      <?php endif; ?>
      
      <?= form_open('proses_reset_password','autocomplete="off"'); ?>
      <input type="hidden" name="token" value="<?= $token ?>">

        <div class="input-group mb-3">
        <input autofocus autocomplete="off" required type="password" name="password" class="form-control" placeholder="Password">
        
      
          <div class="input-group-append input-group-sm">
            <div class="input-group-text input-group-sm">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
        <input autofocus autocomplete="off" required type="password" name="password_confirm" class="form-control" placeholder="Konfirmasi Password">
        
        <div class="input-group-append input-group-sm">
            <div class="input-group-text input-group-sm">
            <span class="fas fa-lock"></span>
            </div>
          </div>
          
      
        </div>

        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-warning btn-block">Reset Password</button>
           
          </div>
          <!-- /.col -->
          
        </div>
      <?= form_close() ?>
   
    <p class="text-center" style="padding-top:10px;font-size:12px"><strong>Copyright &copy; 2024 <a style="color:#35B5FE" href="#"><?= SITE_NAME ?></a> </strong></p>
    

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

</body>
</html>
