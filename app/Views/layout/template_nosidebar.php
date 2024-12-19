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
  <?= $this->renderSection('north'); ?>
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>/adminlte/dist/css/adminlte.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?= base_url() ?>/adminlte/plugins/toastr/toastr.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <link rel="stylesheet" href="<?= base_url() ?>/adminlte/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  
  <style>
  /*  .main-sidebar {
      width: 300px;
    }*/
    .blink {
      animation: blinker 1s linear infinite;
    }
    @keyframes blinker {
      50% {
        opacity: 0;
      }
    }
    .content-wrapper {
      margin-left: 0px !important;
    }
  </style>
  <script type="text/javascript">
    // Set timeout variables.
    var timoutNow = 1800000; // Timeout of 30 mins - time in ms
    var logoutUrl = "<?= base_url('/logout'); ?>"; // URL to logout page.

    var timeoutTimer;

    // Start timer
    function StartTimers() {
      timeoutTimer = setTimeout("IdleTimeout()", timoutNow);
    }

    // Reset timer
    function ResetTimers() {
      clearTimeout(timeoutTimer);
      StartTimers();
    }

    // Logout user
    function IdleTimeout() {
      window.location = logoutUrl;
    }
  </script>

</head>
<body class="text-sm" onload="StartTimers();" onmousemove="ResetTimers();">

<div class="wrapper">
 
  <!-- /.navbar -->

 
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1></h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
              
              </ol>
            </div>
          </div>
        </div>
      </section>
  <?= $this->renderSection('content'); ?>

</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
  <div class="float-right d-none d-sm-block">
    <b>SITAMBANG</b> 1.0.0 <?php $closed = date("Y-m-d H:i:s");  echo $closed; ?>
  </div>
  <strong>Copyright &copy; 2024 <a href="#"><?= SITE_NAME ?></a>. </strong> All rights
  reserved.
</footer>
</div>
<!-- ./wrapper -->
</body>
</html>

<!-- jQuery -->
<script src="<?= base_url() ?>/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url() ?>/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="<?= base_url() ?>/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<!-- <script src="<?= base_url() ?>/adminlte/plugins/sweetalert2/sweetalert2.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
<!-- Toastr -->
<script src="<?= base_url() ?>/adminlte/plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>/adminlte/dist/js/adminlte.min.js"></script>
<!-- Table2excel -->
<script src="<?= base_url() ?>/table2excel/jquery.table2excel.js"></script>

<script src="<?= base_url() ?>/adminlte/plugins/select2/js/select2.full.min.js"></script>

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
<script type="text/javascript">
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
</script>
<?php endif;?>

<?= $this->renderSection('south'); ?>
