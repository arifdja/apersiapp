<?= $this->extend('layout/template_nosidebar'); ?>

<?= $this->section('north'); ?>

<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url() ?>/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url() ?>/adminlte/plugins/datatables-bs4/css/custom.dataTables.css">
<!-- bs-custom-file-input -->
<script src="<?= base_url() ?>/adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
        .main-footer{
          margin-left: 0px !important;
        } 
        .content-wrapper{
          background-color: transparent !important;
        }

    </style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
 
  <section class="content">
      <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                      <div class="card">
                          <div class="card-header">
                                <h3 class="card-title">Pendaftaran Developer</h3>
                          </div>
                          <div class="card-body">
                                <?= form_open_multipart('register','class="form-horizontal"'); ?>
                                <input type="hidden" id="<?= csrf_token() ?>" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                                <div class="card-body">
                                    <div class="row">
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                    <label for="nama">Nama</label>
                                                    <input type="text" 
                                                          name="nama"
                                                          required 
                                                          class="form-control <?= ((session()->getFlashdata('validation')) && session('validation')->hasError('nama')) ? 'is-invalid' : ''; ?>"
                                                          id="nama" 
                                                          placeholder="Isi Nama Lengkap"
                                                          value="<?= old('nama') ?>">
                                                    <?php if (session()->getFlashdata('validation')): ?>
                                                        <span style="color: red;"><?= session('validation')->getError('nama') ?></span>
                                                    <?php endif; ?>
                                              </div>
                                              <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" 
                                                          name="email"
                                                          required 
                                                          class="form-control <?= ((session()->getFlashdata('validation')) && session('validation')->hasError('email')) ? 'is-invalid' : ''; ?>"
                                                          id="email" 
                                                          placeholder="Isi Email"
                                                          value="<?= old('email') ?>">
                                                    <?php if (session()->getFlashdata('validation')): ?>
                                                        <span style="color: red;"><?= session('validation')->getError('email') ?></span>
                                                    <?php endif; ?>
                                              </div>
                                              <div class="form-group">
                                                    <label for="telp">Telepon</label>
                                                    <input type="number" 
                                                          name="telp"
                                                          required 
                                                          class="form-control <?= ((session()->getFlashdata('validation')) && session('validation')->hasError('telp')) ? 'is-invalid' : ''; ?>"
                                                          id="telp" 
                                                          placeholder="Isi Telepon"
                                                          value="<?= old('telp') ?>">
                                                    <?php if (session()->getFlashdata('validation')): ?>
                                                        <span style="color: red;"><?= session('validation')->getError('telp') ?></span>
                                                    <?php endif; ?>
                                              </div>
                                              <div class="form-group">
                                                    <label for="provinsi">Provinsi</label>
                                                    <?= create_dropdown('provinsi', $dropdownprovinsi['provinsi'], old('provinsi'), ['class' => 'form-control', 'id' => 'provinsi','required' => 'required']); ?>
                                              </div>
                                              <div class="form-group">
                                                    <label for="kabupaten">Kabupaten</label>
                                                    <select id="kabupaten" class="form-control" required>
                                                        <option value="" selected disabled>Pilih Kabupaten</option>
                                                    </select>
                                              </div>
                                              <div class="form-group">
                                                    <label for="kota">Kota</label>
                                                    <select id="kota" class="form-control" required>
                                                        <option value="" selected disabled>Pilih Kota</option>
                                                    </select>
                                              </div>
                                              <div class="form-group">
                                                    <label for="kecamatan">Kecamatan</label>
                                                    <select id="kecamatan" name="lokasiref" class="form-control" required>
                                                        <option value="" selected disabled>Pilih Kecamatan</option>
                                                    </select>
                                              </div>
                                          </div>
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                    <label for="kode_pos">Kode Pos</label>
                                                    <input type="text" value="<?= old('kode_pos') ?>" id="kode_pos" name="kode_pos" class="form-control" placeholder="Masukkan Kode Pos" required>
                                              </div>
                                              <div class="form-group">
                                                    <label for="detail_alamat">Detail Alamat</label>
                                                    <textarea id="detail_alamat"  name="detail_alamat" class="form-control" rows="3" placeholder="Masukkan detail alamat seperti nama jalan, nomor rumah, RT/RW" required><?= old('detail_alamat') ?></textarea>
                                              </div>
                                              <div class="form-group">
                                                    <label for="exampleInputFile">Kartu Tanda Anggota (KTA)</label>
                                                    <input type="text" name="kta" 
                                                          required 
                                                          class="form-control <?= ((session()->getFlashdata('validation')) && session('validation')->hasError('kta')) ? 'is-invalid' : ''; ?>"
                                                          id="kta" 
                                                          placeholder="Isi KTA"
                                                          value="<?= old('kta') ?>">
                                                          <?php if (session()->getFlashdata('validation')): ?>
                                                              <span style="color: red;"><?= session('validation')->getError('kta') ?></span>
                                                          <?php endif; ?>
                                                    <div class="input-group" style="margin-top: 10px;">
                                                        <div class="custom-file">
                                                              <input type="file" class="custom-file-input" name="berkaskta" id="exampleInputFile" accept=".pdf" required>
                                                              <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                        </div>
                                                    </div>
                                                    <div class="text-muted">
                                                          <small>Format file yang diizinkan: PDF</small>,
                                                          <small>Maksimal ukuran file: 10 MB</small>
                                                    </div>
                                                    <?php if(session()->getFlashdata('validation')): ?>
                                                        <span style="color: red;"><?= session('validation')->getError('berkaskta') ?></span>
                                                    <?php endif; ?>
                                              </div>
                                              <div class="form-group">
                                                    <label for="pbru">Password</label>
                                                    <input type="password" 
                                                          name="pbru"
                                                          required 
                                                          class="form-control <?= ((session()->getFlashdata('validation')) && session('validation')->hasError('pbru')) ? 'is-invalid' : ''; ?>"
                                                          id="pbru" 
                                                          placeholder="Isi Password"
                                                          value="<?= old('pbru') ?>">
                                                    <?php if (session()->getFlashdata('validation')): ?>
                                                        <span style="color: red;"><?= session('validation')->getError('pbru') ?></span>
                                                    <?php endif; ?>
                                              </div>
                                              <div class="form-group">
                                                    <label for="pbru2">Ulangi Password</label>
                                                    <input type="password" 
                                                          name="pbru2"
                                                          required 
                                                          class="form-control <?= ((session()->getFlashdata('validation')) && session('validation')->hasError('pbru2')) ? 'is-invalid' : ''; ?>"
                                                          id="pbru2" 
                                                          placeholder="Isi Ulang Password"
                                                          value="<?= old('pbru2') ?>">
                                                    <?php if (session()->getFlashdata('validation')): ?>
                                                        <span style="color: red;"><?= session('validation')->getError('pbru2') ?></span>
                                                    <?php endif; ?>
                                              </div>
                                              <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="checkbox" class="" id="check">
                                                        <label class="form-check-label" for="exampleCheck2">Tampilkan Password</label>
                                                    </div>
                                              </div>
                                              <p>
                                                    <div class="g-recaptcha" data-sitekey="6LdGWZAqAAAAAF-815CNbkjzW2g3R3I6L6H_cWg4"></div>
                                              </p>
                                          </div>
                                    </div>
                                </div>
                                
                          </div>
                          <div class="card-footer">
                                <div class="form-group">
                                    <div class="col-sm-6">
                                          <a id="clear" href="#" class="btn btn-danger">Batal</a>
                                          <button type="submit" class="btn btn-primary" style="background-color: #35B5FE !important; border:none">Daftar</button>
                                    </div>
                                </div>
                          </div>
                      </div>
                </div>
            </div>
            </form>
      </div>
  </section>
    
<?= $this->endSection(); ?>

<?= $this->section('south'); ?>
<script>
    $(document).ready(function () {

        // Fungsi untuk membersihkan semua input
        $('#clear').click(function() {
            $('#nama').val('');
            $('#telp').val('');
            $('#email').val('');
            $('#pbru').val('');
            $('#kta').val('');
            $('#pbru2').val('');
            $('#provinsi').val('');
            $('#kabupaten').html('<option value="" selected disabled>Pilih Kabupaten</option>');
            $('#kota').html('<option value="" selected disabled>Pilih Kota</option>');
            $('#kecamatan').html('<option value="" selected disabled>Pilih Kecamatan</option>');
            grecaptcha.reset();
        });
      
        $('#provinsi').change(function () {

            let csrfName = '<?= csrf_token() ?>';
            let csrfHash = '<?= csrf_hash() ?>';
            let provinsiId = $(this).val();

            // Clear kabupaten_kota dropdown
            $('#kabupaten').html('<option value="" selected disabled>Loading...</option>');
            $('#kota').html('<option value="" selected disabled>Loading...</option>');
            $('#kecamatan').html('<option value="" selected disabled>Loading...</option>');
            // Fetch kabupaten/kota berdasarkan provinsi
            $.ajax({
                url: '<?= site_url('get_kabupaten'); ?>',
                type: 'POST',
                data: { provinsi_id: provinsiId, [csrfName]: csrfHash },
                success: function (response) {
                    let options = '<option value="" selected disabled>Pilih Kabupaten</option>';
                    response.kabupaten.forEach(function (item) {
                        options += `<option value="${item.id}">${item.namakabupaten}</option>`;
                    });
                    $('#kabupaten').html(options);
                    $('#<?= csrf_token() ?>').val(response.csrfHash);
                },
                error: function () {
                  Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Gagal memuat data kecamatan. Silakan coba lagi.'
                  });
                }
            });
        });

        $('#kabupaten').change(function () {
          
            let csrfName = '<?= csrf_token() ?>';
            let csrfHash = $('#<?= csrf_token() ?>').val();
            let kabupatenId = $(this).val();

            // Clear kabupaten_kota dropdown
            $('#kota').html('<option value="" selected disabled>Loading...</option>');
            $('#kecamatan').html('<option value="" selected disabled>Loading...</option>');
            // Fetch kota berdasarkan kabupaten
            $.ajax({ 
                url: '<?= site_url('get_kota'); ?>',
                type: 'POST',
                data: { kabupaten_id: kabupatenId, [csrfName]: csrfHash },
                success: function (response) {
                  let options = '<option value="" selected disabled>Pilih Kota</option>';
                  response.kota.forEach(function (item) {
                    options += `<option value="${item.id}">${item.namakota}</option>`;
                  });
                  $('#kota').html(options);
                  $('#<?= csrf_token() ?>').val(response.csrfHash);
                 
                },
                error: function () {
                  Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Gagal memuat data kecamatan. Silakan coba lagi.'
                  });
                }
            });
        });

        
        $('#kota').change(function () {

            let csrfName = '<?= csrf_token() ?>';
            let csrfHash = $('#<?= csrf_token() ?>').val();
            let kotaId = $(this).val();

            // Clear kabupaten_kota dropdown
            $('#kecamatan').html('<option value="" selected disabled>Loading...</option>');
            // Fetch kota berdasarkan kabupaten
            $.ajax({ 
                url: '<?= site_url('get_kecamatan'); ?>',
                type: 'POST',
                data: { kota_id: kotaId, [csrfName]: csrfHash },
                success: function (response) {
                  let options = '<option value="" selected disabled>Pilih Kecamatan</option>';
                  response.kecamatan.forEach(function (item) {
                    options += `<option value="${item.id}">${item.namakecamatan}</option>`;
                  });
                  $('#kecamatan').html(options);
                  $('#<?= csrf_token() ?>').val(response.csrfHash);
                },
                error: function () {
                  Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Gagal memuat data kecamatan. Silakan coba lagi.'
                  });
                }
            });
        });

    });
</script>

<script>
  $(document).ready(function () {
    $('#check').click(function(){
        $(this).is(':checked') ? $('#pbru').attr('type', 'text') : $('#pbru').attr('type', 'password');
        $(this).is(':checked') ? $('#pbru2').attr('type', 'text') : $('#pbru2').attr('type', 'password');
    });
  });
</script>
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
<?= $this->endSection(); ?>