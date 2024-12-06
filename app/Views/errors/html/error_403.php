<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SITAMBANG</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="<?php echo base_url() ?>/assets/images/favicon.gif" type="image/x-icon" />
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>/adminlte/dist/css/adminlte.min.css">
  <style>
       body{
            background-color: #ffffff !important;
        }
    </style>

</head>
<body class="hold-transition">
<section class="content">
    <div class="container-fluid" style="margin-top: 100px;">
        <div class="row">
            <div class="col-md-12">
                <div class="error-page">
                    <h2 class="headline text-warning"> 403</h2>
                    <div class="error-content">
                        <h3><i class="fas fa-exclamation-triangle text-warning"></i> Tidak Ada Hak Akses.</h3>
                        <p>Maaf, Anda tidak memiliki izin untuk mengakses halaman ini.</p>
                        <p>Silakan kembali ke halaman sebelumnya atau hubungi administrator jika diperlukan.</p>
                        <a href="<?= previous_url() ?>">Kembali</a>
                    </div>
                    <!-- /.error-content -->
                </div>
                <!-- /.error-page -->
            </div>
        </div>
    </div>
</section>

<!-- jQuery -->
<script src="<?= base_url() ?>/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url() ?>/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>/adminlte/dist/js/adminlte.min.js"></script>

</body>
</html>
