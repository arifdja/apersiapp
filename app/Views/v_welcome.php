<?= $this->extend('layout/template'); ?>
<?= $this->section('north'); ?>
<?= $this->endSection(); ?>
<?= $this->section('content'); ?>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <h1 class="text-center">Selamat Datang di Aplikasi <?= SITE_NAME ?></h1>
            <hr>
            <div class="text-center">
              <img src="<?= base_url() ?>/assets/images/alursimaya.jpg" class="img-fluid" alt="SIMAYA">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection(); ?>
<?= $this->section('south'); ?>
<?= $this->endSection(); ?>