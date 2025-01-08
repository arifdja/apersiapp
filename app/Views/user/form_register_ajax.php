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
                                <p style="font-size:18px; font-weight:bold; padding:0px; margin:0px">Pendaftaran Developer</p> 
                          </div>
                          <div class="card-body">
                                <?= form_open('register_ajax',['id' => 'formregister', 'class' => 'form-horizontal']); ?>
                                <input type="hidden" id="<?= csrf_token() ?>" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                                <div class="card-body">
                                    <div class="row">
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                    <label for="nama">Nama</label>
                                                    <input type="text" 
                                                          name="nama"
                                                          required 
                                                          class="form-control"
                                                          id="nama" 
                                                          placeholder="Isi Nama Lengkap"
                                                          value="<?= old('nama') ?>">
                                                          <span id="spannama" style="color: red;"></span>
                                              </div>
                                              <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" 
                                                          name="email"
                                                          required 
                                                          class="form-control"
                                                          id="email" 
                                                          placeholder="Isi Email"
                                                          value="<?= old('email') ?>">
                                                          <span id="spanemail" style="color: red;"></span>
                                              </div>
                                              <div class="form-group">
                                                    <label for="telp">Telepon</label>
                                                    <input type="number" 
                                                          name="telp"
                                                          required 
                                                          class="form-control"
                                                          id="telp" 
                                                          placeholder="Isi Telepon"
                                                          value="<?= old('telp') ?>">
                                                          <span id="spantelp" style="color: red;"></span>
                                              </div>
                                              <div class="form-group">
                                                    <label for="provinsi">Provinsi</label>
                                                    <?= create_dropdown('provinsi', $dropdownprovinsi['provinsi'], old('provinsi'), ['class' => 'form-control', 'id' => 'provinsi','required' => 'required']); ?>
                                              </div>
                                              <div class="form-group">
                                                    <label for="kabupaten">Kabupaten/Kota</label>
                                                    <select id="kabupaten" name="kabupaten" class="form-control" required>
                                                        <option value="" selected disabled>Pilih Kabupaten/Kota</option>
                                                    </select>
                                                    <span id="spankabupaten" style="color: red;"></span>
                                              </div>
                                              <div class="form-group">
                                                    <label for="kota">Kecamatan</label>
                                                    <select id="kota" name="kota" class="form-control" required>
                                                        <option value="" selected disabled>Pilih Kecamatan</option>
                                                    </select>
                                                    <span id="spankota" style="color: red;"></span>
                                              </div>
                                              <div class="form-group">
                                                    <label for="kecamatan">Kelurahan</label>
                                                    <select id="kecamatan" name="lokasiref" class="form-control" required>
                                                        <option value="" selected disabled>Pilih Kelurahan</option>
                                                    </select>
                                              </div>
                                              
                                              <div class="form-group">
                                                    <label for="kode_pos">Kode Pos</label>
                                                    <input type="text" value="<?= old('kode_pos') ?>" id="kode_pos" name="kode_pos" class="form-control" placeholder="Masukkan Kode Pos" required>
                                                    <span id="spankode_pos" style="color: red;"></span>
                                              </div>
                                              
                                              <div class="form-group">
                                                    <label for="detail_alamat">Detail Alamat Developer</label>
                                                    <textarea id="detail_alamat"  name="detail_alamat" class="form-control" rows="3" placeholder="Masukkan detail alamat seperti nama jalan, nomor rumah, RT/RW" required><?= old('detail_alamat') ?></textarea>
                                                    <span id="spanalamat" style="color: red;"></span>
                                              </div>
                                              
                                          </div>
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                    <label for="exampleInputFile">Kartu Tanda Anggota (KTA)</label>
                                                    <input type="text" name="kta" 
                                                          required 
                                                          class="form-control"
                                                          id="kta" 
                                                          placeholder="Isi Nomor KTA"
                                                          value="<?= old('kta') ?>">
                                                          <span id="spankta" style="color: red;"></span>
                                                    <div class="input-group" style="margin-top: 10px;">
                                                        <div class="custom-file">
                                                              <input type="file" class="custom-file-input" name="berkaskta" id="berkaskta" accept=".pdf" required>
                                                              <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                        </div>
                                                    </div>
                                                    <div class="text-muted">
                                                          <small>Format file yang diizinkan: PDF</small>,
                                                          <small>Maksimal ukuran file: 10 MB</small>
                                                    </div>
                                                    <span id="spanberkaskta" style="color: red;"></span>
                                              </div>

                                              

                                                <div class="form-group">
                                                <label for="dropdowndpd">Pilih DPD/DPP/Korwil</label>  
                                                <?= create_dropdown('dpd', $dropdowndpd['dpd'], old('dropdowndpd'), ['class' => 'form-control', 'id' => 'dropdowndpd', 'required' => 'required']); ?>
                                                <span id="spandropdowndpd" style="color: red;"></span>
                                                </div>

                                              <div class="form-group">
                                                    <label for="pbru">Password</label>
                                                    <input type="password" 
                                                          name="pbru"
                                                          required 
                                                          class="form-control"
                                                          id="pbru" 
                                                          placeholder="Isi Password"
                                                          value="<?= old('pbru') ?>">
                                                          <span id="spanpbru" style="color: red;"></span>
                                                          
                                                    <div class="text-muted">
                                                          <small>Password minimal 8 karakter, Minimal satu huruf besar, Minimal satu huruf kecil, Minimal satu angka, dan Minimal satu simbol @$#!%*?&</small>
                                                    </div>
                                              </div>
                                              
                                              <div class="form-group">
                                                    <label for="pbru2">Ulangi Password</label>
                                                    <input type="password" 
                                                          name="pbru2"
                                                          required 
                                                          class="form-control"
                                                          id="pbru2" 
                                                          placeholder="Isi Ulang Password"
                                                          value="<?= old('pbru2') ?>">
                                                          <span id="spanpbru2" style="color: red;"></span>
                                                    
                                              </div>
                                              <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="checkbox" class="" id="check">
                                                        <label class="form-check-label" for="exampleCheck2">Tampilkan Password</label>
                                                    </div>
                                              </div>
                                              

                                              <div id="divberkas" class="form-group">
                                                    <div class="col-sm-12">
                                                        <div class="h6 text-bold">
                                                            Download template form kredit disini agar dicetak menggunakan kop surat perusahaan dan ditandatangani direktur utama di atas materai.
                                                        </div>
                                                    </div>
                                                    <ul>
                                                        <li><a href="<?= base_url('form_pengajuan_kredit/danai_id') ?>" style="font-size: 1.2em">Template Form Kredit Danai.id</a></li>
                                                        <li><a href="<?= base_url('form_pengajuan_kredit/kb_bank') ?>" style="font-size: 1.2em">Template Form Kredit KB Bank</a></li>
                                                    </ul>
                                                </div>
                                              <p>
                                                    <div class="g-recaptcha" data-sitekey="6LdGWZAqAAAAAF-815CNbkjzW2g3R3I6L6H_cWg4"></div>
                                              </p>
                                              <div class="form-group">
                                                <div class="col-sm-6">
                                                      <a id="clear" href="#" class="btn btn-danger">Hapus isian</a>
                                                      <button type="submit" class="btn btn-primary" style="background-color: #35B5FE !important; border:none">Proses Pendaftaran</button>
                                                </div>
                                              </div>

                                                
                                               

                                          </div>
                                    </div>
                                </div>
                                
                          </div>
                          <div class="card-footer">
                            
                           
                          <div class="form-group">
                            <div class="col-sm-6">
                             <a href="<?= site_url('login') ?>" class="btn btn-info" style="background-color: #35B5FE !important; border:none">Kembali ke Halaman Login</a>
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
    // Handle form submission
    $('#formregister').on('submit', function (e) {
        e.preventDefault();

        // Show loading indicator
        Swal.fire({
            title: 'Loading...',
            text: 'Sedang memproses pendaftaran',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false,
            showConfirmButton: false,
            backdrop: true,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        // Create FormData object
        var formData = new FormData(this);

        // Send AJAX request
        $.ajax({
            url: "<?= site_url('register_ajax') ?>",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                Swal.close();

                if(response.status == 'success'){
                    Swal.fire({
                        icon: 'success', 
                        title: 'Konfirmasi',
                        text: 'Silahkan cek email anda untuk melakukan verifikasi',
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        allowOutsideClick: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '<?= site_url('login') ?>';
                        }
                    });
                }
            },
            error: function (xhr, status, error) {
                $('span[id^="span"]').text('');
                $('.is-invalid').removeClass('is-invalid');
                Swal.close();
                
                if(xhr.responseJSON.status == 'error'){
                    const messages = xhr.responseJSON.message;
                    
                    // Handle validation errors
                    const fields = ['pbru', 'pbru2', 'nama', 'email', 'telp', 'provinsi', 
                                  'kabupaten', 'kota', 'kecamatan', 'kode_pos', 'detail_alamat',
                                  'kta', 'berkaskta'];
                                  
                    fields.forEach(field => {
                        if(messages[field]){
                            $(`#${field}`).addClass('is-invalid');
                            $(`#span${field}`).html(messages[field]);
                        }
                    });

                    // Handle special error cases
                    if(messages.captcha){
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Invalid CAPTCHA. Please try again.'
                        });
                    }
                    
                    if(messages.simpan){
                        Swal.fire({
                            icon: 'error',
                            title: 'Error', 
                            text: 'Gagal menyimpan data'
                        });
                    }
                }
            }
        });
    });

    // Clear form inputs
    $('#clear').click(function() {
        const fields = ['nama', 'telp', 'email', 'pbru', 'kta', 'pbru2', 'provinsi'];
        fields.forEach(field => $(`#${field}`).val(''));

        // Reset dropdowns
        $('#kabupaten').html('<option value="" selected disabled>Pilih Kabupaten</option>');
        $('#kota').html('<option value="" selected disabled>Pilih Kota</option>');
        $('#kecamatan').html('<option value="" selected disabled>Pilih Kecamatan</option>');
        
        grecaptcha.reset();
    });

    // Store old selections
    var oldKabupatenSelection = $('#kabupaten').val();
    var oldKotaSelection = $('#kota').val(); 
    var oldKecamatanSelection = $('#kecamatan').val();

    // Handle province change
    $('#provinsi').change(function () {
        let csrfName = '<?= csrf_token() ?>';
        let csrfHash = $('#<?= csrf_token() ?>').val();
        let provinsiId = $(this).val();

        // Reset dropdowns
        ['kabupaten', 'kota', 'kecamatan'].forEach(field => {
            $(`#${field}`).html('<option value="" selected disabled>Loading...</option>');
        });

        Swal.fire({
            title: 'Mohon Tunggu',
            html: 'Sedang memproses data...',
            allowOutsideClick: false,
            showConfirmButton: false,
            willOpen: () => {
                Swal.showLoading()
            },
        });

        // Fetch kabupaten/kota
        $.ajax({
            url: '<?= site_url('get_kabupaten'); ?>',
            type: 'POST',
            data: { provinsi_id: provinsiId, [csrfName]: csrfHash },
            success: function (response) {
                let options = '<option value="" selected disabled>Pilih Kabupaten/Kota</option>';
                response.kabupaten.forEach(function (item) {
                    options += `<option value="${item.id}">${item.namakabupaten}</option>`;
                });
                $('#kabupaten').html(options);
                $('#<?= csrf_token() ?>').val(response.csrfHash);
                Swal.close();
            },
            error: function (xhr) {
                $('#<?= csrf_token() ?>').val(xhr.responseJSON.csrfHash);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Gagal memuat data kabupaten/kota. Silakan coba lagi.'
                });
            }
        });
    });

    // Handle kabupaten change  
    $('#kabupaten').change(function () {
        let csrfName = '<?= csrf_token() ?>';
        let csrfHash = $('#<?= csrf_token() ?>').val();
        let kabupatenId = $(this).val();

        // Reset dropdowns
        ['kota', 'kecamatan'].forEach(field => {
            $(`#${field}`).html('<option value="" selected disabled>Loading...</option>');
        });

        Swal.fire({
            title: 'Mohon Tunggu',
            html: 'Sedang memproses data...',
            allowOutsideClick: false,
            showConfirmButton: false,
            willOpen: () => {
                Swal.showLoading()
            },
        });

        // Fetch kota
        $.ajax({
            url: '<?= site_url('get_kota'); ?>',
            type: 'POST', 
            data: { kabupaten_id: kabupatenId, [csrfName]: csrfHash },
            success: function (response) {
                let options = '<option value="" selected disabled>Pilih Kecamatan</option>';
                response.kota.forEach(function (item) {
                    options += `<option value="${item.id}">${item.namakota}</option>`;
                });
                $('#kota').html(options);
                $('#<?= csrf_token() ?>').val(response.csrfHash);
                Swal.close();
            },
            error: function (xhr) {
                $('#<?= csrf_token() ?>').val(xhr.responseJSON.csrfHash);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Gagal memuat data kelurahan. Silakan coba lagi.'
                });
            }
        });
    });

    // Handle kota change
    $('#kota').change(function () {
        let csrfName = '<?= csrf_token() ?>';
        let csrfHash = $('#<?= csrf_token() ?>').val();
        let kotaId = $(this).val();

        $('#kecamatan').html('<option value="" selected disabled>Loading...</option>');

        Swal.fire({
            title: 'Mohon Tunggu',
            html: 'Sedang memproses data...',
            allowOutsideClick: false,
            showConfirmButton: false,
            willOpen: () => {
                Swal.showLoading()
            },
        });

        // Fetch kecamatan
        $.ajax({
            url: '<?= site_url('get_kecamatan'); ?>',
            type: 'POST',
            data: { kota_id: kotaId, [csrfName]: csrfHash },
            success: function (response) {
                let options = '<option value="" selected disabled>Pilih Kelurahan</option>';
                response.kecamatan.forEach(function (item) {
                    options += `<option value="${item.id}">${item.namakecamatan}</option>`;
                });
                $('#kecamatan').html(options);
                $('#<?= csrf_token() ?>').val(response.csrfHash);
                Swal.close();
            },
            error: function (xhr) {
                $('#<?= csrf_token() ?>').val(xhr.responseJSON.csrfHash);
                $('#kabupaten').val(oldKabupatenSelection);
                $('#kota').val(oldKotaSelection);
                $('#kecamatan').val(oldKecamatanSelection);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Gagal memuat data kelurahan. Silakan coba lagi.'
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