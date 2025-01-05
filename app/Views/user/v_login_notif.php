<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= env('sitename') ?></title>
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
            background: url(<?php echo base_url('assets/images/background.jpg') ?>) repeat center center fixed !important;
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
<body class="hold-transition">
<div class="container-fluid">
  <div class="row">
    <!-- Kolom Login (Kiri) -->
    <div class="col-md-6 d-flex align-items-center justify-content-center" style="min-height: 100vh;">
      <div class="login-box">
        <div class="card">
          <div class="ribbon-wrapper">
            <div class="ribbon bg-primary" style="background-color: #35B5FE !important;">
              ⭐⭐⭐⭐⭐
            </div>
          </div>
          
          <div class="card-body login-card-body text-center" style="border-radius:15px">
            <div class="register-logo">
              <img src="<?= base_url('assets/images/logo.png') ?>" alt="Logo" style="height:150px; margin-right:10px; border-radius:50%">
              
            </div>
            <p style="font-size:18px; font-weight:bold">Sistem Informasi Bridging <br>Modal Pengembang</p>
            
            <?= form_open('validateuser','autocomplete="off"'); ?>
            <?= csrf_field() ?>
            <?php if(session()->getFlashdata('success')): ?>
              <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>
            <?php if(session()->getFlashdata('error')): ?>
              <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>
              <div class="input-group mb-3"> 
              <input autofocus autocomplete="off" type="email" name="username" value="<?= set_value('username')?>" class="form-control <?= $validation->hasError('username') ? 'is-invalid' : ''; ?>" placeholder="Username">
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
                  <button type="submit" class="btn btn-primary btn-block" style="background-color: #35B5FE !important; border:none">Masuk</button>
                  <a href="<?= base_url('form_register') ?>" class="btn btn-primary btn-block" style="background-color: #35B5FE !important; border:none">Pendaftaran</a>
                  <hr>
                  <a href="<?= base_url('form_lupa_password') ?>" class="btn btn-warning btn-sm btn-block">Lupa Password</a>
                
                </div>
                <!-- /.col -->
                
              </div>
            <?= form_close() ?>
         
          <p class="text-center" style="padding-top:10px;font-size:12px"><strong>Copyright &copy; 2024 <a style="color:#35B5FE" href="#"><?= SITE_NAME ?></a> </strong></p>
          

          </div>
        </div>
      </div>
    </div>

    <!-- Kolom Informasi Penting (Kanan) -->
    <div class="col-md-6 bg-light d-flex align-items-center" style="min-height: 100vh;">
      <div class="p-5">
        <h3 class="text-primary mb-4">Informasi Penting</h3>
        
        <!-- Tambahkan informasi penting di sini -->
        <div class="card mb-3">
          <div class="card-body">
            <h5 class="card-title">Pengumuman</h5>
            <p class="card-text">Silakan cek pengumuman terbaru tentang sistem bridging modal pengembang di sini.</p>
          </div>
        </div>

        <div class="card mb-3">
          <div class="card-body">
            <h5 class="card-title">Panduan Pengguna</h5>
            <p class="card-text">Unduh panduan pengguna sistem untuk informasi lebih lanjut.</p>
          </div>
        </div>

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Kontak Support</h5>
            <p class="card-text">Jika Anda mengalami kesulitan, silakan hubungi tim support kami:</p>
            <ul class="list-unstyled">
              <li><i class="fas fa-envelope mr-2"></i> support@example.com</li>
              <li><i class="fas fa-phone mr-2"></i> (021) 1234-5678</li>
            </ul>
          </div>
        </div>
        
      </div>
    </div>
  </div>
</div>

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
