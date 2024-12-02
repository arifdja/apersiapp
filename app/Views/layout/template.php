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
  <?= $this->renderSection('north'); ?>
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>/adminlte/dist/css/adminlte.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?= base_url() ?>/adminlte/plugins/toastr/toastr.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <link rel="stylesheet" href="<?= base_url() ?>/adminlte/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  
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

<!--psa-->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-CEEQVWPQY1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-CEEQVWPQY1');
</script>

</head>
<body class="hold-transition sidebar-mini text-sm sidebar-collapse" onload="StartTimers();" onmousemove="ResetTimers();">

<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <span class="nav-link"></span>
      </li>
      <!--
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      
      
       <li class="nav-item">
        <a class="nav-link" href="/logout">
          Logout
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <!-- <img src="<?= base_url() ?>/adminlte/dist/img/logomonev.png"
           alt="AdminLTE Logo"
           class="brand-image img-rounded"
           > -->SIMAYA 
      <span class="brand-text font-weight-light"> </span>
    </a>

 <!-- Sidebar -->
 <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image" style="padding-top:15px">
          <?php if (session('kdgrpuser')=='developer' 
          || session('kdgrpuser')=='admin' 
          || session('kdgrpuser')=='dpd' 
          )  : ?>
          <img src="<?= base_url() ?>/adminlte\dist\img\avatar5.png" class="img-circle elevation-2" alt="User Image">
          <?php else : ?>
          <img src="<?= base_url() ?>/assets/profile/<?= session('kdgrpuser') ?>.png" class="img-circle elevation-2" alt="User Image">
          <?php endif ?>
        </div>
        <div class="info" style="white-space:normal !important;padding-top:0px">
          <a href="/profil" class="d-block"><?php echo ucwords(session('nama')); ?> <br><?php echo session('email'); ?> <br>(<?php echo ucfirst(session('kdgrpuser')); ?>)</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
        <?= $stringmenu; ?>
          
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  
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
    <b>SIMAYA</b> 1.0.0 <?php $closed = date("Y-m-d H:i:s");  echo $closed; ?>
  </div>
  <strong>Copyright &copy; 2024 <a href="#">SIMAYA</a>. </strong> All rights
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

<script src="<?= base_url() ?>/adminlte/plugins/sweetalert2/sweetalert2.min.js"></script>
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
