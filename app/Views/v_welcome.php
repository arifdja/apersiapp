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
            <div class="row">
              <div class="col-md-4 text-center">
                <img src="<?= base_url() ?>/assets/images/rumahsubsidi.jpg" class="img-fluid mx-auto d-block" style="max-width: 100%; height: auto; object-fit: cover;" alt="SIMAYA">
              </div>
              <div class="col-md-4 text-center">
                <img src="<?= base_url() ?>/assets/images/rumahsubsidi2.jpg" class="img-fluid mx-auto d-block" style="max-width: 100%; height: auto; object-fit: cover;" alt="SIMAYA">
              </div>
              <div class="col-md-4 text-center">
                <img src="<?= base_url() ?>/assets/images/rumahsubsidi3.jpg" class="img-fluid mx-auto d-block" style="max-width: 100%; height: auto; object-fit: cover;" alt="SIMAYA">
              </div>
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