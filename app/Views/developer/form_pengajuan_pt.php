<?= $this->extend('layout/template'); ?>

<?= $this->section('north'); ?>
<!-- bs-custom-file-input -->
<script src="<?= base_url() ?>/adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<section class="content">
<div class="container-fluid">
  <div class="row">
  <div class="col-md-6">
  <div class="card card-info">
        
          <div class="card-body">
            
          <?= form_open_multipart('developer/pengajuan_pt',['id' => 'formpengajuanpt', 'class' => 'form-horizontal']); ?>
          <input type="hidden" id="<?= csrf_token() ?>" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>"/>
          <div class="form-group">
              <label for="nama_pt">Nama PT</label>
              <input type="text" name="nama_pt" required class="form-control" id="nama_pt" placeholder="Nama PT">
              <span id="spannama_pt" style="color: red;"></span>
            </div>
            <div class="form-group">
              <label for="provinsi">Provinsi</label>  
              <?= create_dropdown('provinsi', $dropdownprovinsi['provinsi'], old('provinsi'), ['class' => 'form-control', 'id' => 'provinsi','required' => 'required']); ?>
              <span id="spanprovinsi" style="color: red;"></span>
            </div>
            <div class="form-group">
              <label for="kabupaten">Kabupaten</label>
              <select id="kabupaten" name="kabupaten" class="form-control" required>
                  <option value="" selected disabled>Pilih Kabupaten</option>
              </select>
              <span id="spankabupaten" style="color: red;"></span>
            </div>
            <div class="form-group">
              <label for="kota">Kota</label>
              <select id="kota" name="kota" class="form-control" required>
                  <option value="" selected disabled>Pilih Kota</option>
              </select>
              <span id="spankota" style="color: red;"></span>
            </div>
            <div class="form-group">
              <label for="kecamatan">Kecamatan</label>
              <select id="lokasiref" name="lokasiref" class="form-control" required>
                  <option value="" selected disabled>Pilih Kecamatan</option>
              </select>
              <span id="spanlokasiref" style="color: red;"></span>
            </div>
            <div class="form-group">
              <label for="detail_alamat">Detail Alamat</label>
              <textarea id="detail_alamat" name="detail_alamat" class="form-control" rows="3" placeholder="Masukkan detail alamat seperti nama jalan, nomor rumah, RT/RW" required><?= old('detail_alamat') ?></textarea>
              <span id="spanalamat" style="color: red;"></span>
            </div>
            <div class="form-group">
              <label for="npwp_pt">NPWP PT</label>
              <input type="text" name="npwp_pt" required class="form-control" id="npwp_pt" placeholder="Isi NPWP PT" value="<?= old('npwp_pt') ?>">
              <span id="spannpwp_pt" style="color: red;"></span>
              <div class="input-group" style="margin-top: 10px;">
                  <div class="custom-file">
                        <input type="file" class="custom-file-input" name="berkasnpwppt" id="berkasnpwppt" accept=".pdf" required>
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
              </div>
              <div class="text-muted">
                    <small>Format file yang diizinkan: PDF</small>,
                    <small>Maksimal ukuran file: 1 MB</small>
              </div>
              <span id="spanberkasnpwppt" style="color: red;"></span>
            </div>
            <div class="form-group">
              <label for="penanggung_jawab_pt">Penanggung Jawab PT</label>
              <input type="text" name="penanggung_jawab_pt" required class="form-control" id="penanggung_jawab_pt" placeholder="Nama Penanggung Jawab PT">
              <span id="spanpenanggung_jawab_pt" style="color: red;"></span>
            </div>
          <div class="form-group">
              <label for="ktp_penanggung_jawab">KTP Penanggung Jawab</label>
              <input type="text" name="ktp_penanggung_jawab" required class="form-control" id="ktp_penanggung_jawab" placeholder="Isi KTP Penanggung Jawab" value="<?= old('ktp_penanggung_jawab') ?>">
              <span id="spanktp_penanggung_jawab" style="color: red;"></span>
              <div class="input-group" style="margin-top: 10px;">
                  <div class="custom-file">
                        <input type="file" class="custom-file-input" name="berkasktp_penanggung_jawab" id="berkasktp_penanggung_jawab" accept=".pdf" required>
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
              </div>
              <div class="text-muted">
                    <small>Format file yang diizinkan: PDF</small>,
                    <small>Maksimal ukuran file: 1 MB</small>
              </div>
              <span id="spanberasktp_penanggung_jawab" style="color: red;"></span>
            </div>
          </div>
      </div>
    </div>
  <div class="col-md-6">
  <div class="card card-info">
       
          <div class="card-body">

          
          <div class="form-group">
              <label for="npwp_penanggung_jawab">NPWP Penanggung Jawab</label>
              <input type="text" name="npwp_penanggung_jawab" required class="form-control" id="npwp_penanggung_jawab" placeholder="Isi NPWP Penanggung Jawab" value="<?= old('npwp_penanggung_jawab') ?>">
              <span id="spannpwp_penanggung_jawab" style="color: red;"></span>
              <div class="input-group" style="margin-top: 10px;">
                  <div class="custom-file">
                        <input type="file" class="custom-file-input" name="berkasnpwp_penanggung_jawab" id="berkasnpwp_penanggung_jawab" accept=".pdf" required>
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
              </div>
              <div class="text-muted">
                    <small>Format file yang diizinkan: PDF</small>,
                    <small>Maksimal ukuran file: 1 MB</small>
              </div>
              <span id="spanberkasnpwp_penanggung_jawab" style="color: red;"></span>
            </div>

            
            <div class="form-group">
              <label for="pengurus_pt">Nama dan JabatanPengurus PT</label>
              <textarea name="pengurus_pt" id="pengurus_pt" class="form-control" rows="3" placeholder="Masukkan nama dan jabatan pengurus PT" required></textarea>
              <span id="spanpengurus_pt" style="color: red;"></span>
            </div>

            
          <div class="form-group">
              <label for="npwp_pengurus_pt">NPWP Pengurus PT</label>
              <span id="spannpwp_pengurus_pt" style="color: red;"></span>
              <div class="input-group" style="margin-top: 10px;">
                  <div class="custom-file">
                        <input type="file" class="custom-file-input" name="berkasnpwp_pengurus_pt" id="berkasnpwp_pengurus_pt" accept=".pdf" required>
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
              </div>
              <div class="text-muted">
                    <small>Format file yang diizinkan: PDF</small>,
                    <small>Maksimal ukuran file: 5 MB</small>
              </div>
              <span id="spanberkasnpwp_pengurus_pt" style="color: red;"></span>
            </div>

            
          <div class="form-group">
              <label for="ktp_pengurus_pt">KTP Pengurus PT</label>
              <span id="spanktp_pengurus_pt" style="color: red;"></span>
              <div class="input-group" style="margin-top: 10px;">
                  <div class="custom-file">
                        <input type="file" class="custom-file-input" name="berkasktp_pengurus_pt" id="berkasktp_pengurus_pt" accept=".pdf" required>
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
              </div>
              <div class="text-muted">
                    <small>Format file yang diizinkan: PDF</small>,
                    <small>Maksimal ukuran file: 5 MB</small>
              </div>
              <span id="spanberkasktp_pengurus_pt" style="color: red;"></span>
            </div>
            
            <div class="form-group">
              <label for="akta_pendirian">Akta Pendirian</label>
              <input type="text" name="akta_pendirian" required class="form-control" id="akta_pendirian" placeholder="Isi Akta Pendirian" value="<?= old('akta_pendirian') ?>">
              <span id="spanakta_pendirian" style="color: red;"></span>
              <div class="input-group" style="margin-top: 10px;">
                  <div class="custom-file">
                        <input type="file" class="custom-file-input" name="berkasakta_pendirian" id="berkasakta_pendirian" accept=".pdf" required>
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
              </div>
              <div class="text-muted">
                    <small>Format file yang diizinkan: PDF</small>,
                    <small>Maksimal ukuran file: 5 MB</small>
              </div>
              <span id="spanberkasakta_pendirian" style="color: red;"></span>
            </div>
            <div class="form-group">    
              <label for="bank">Bank</label>
              <?= create_dropdown('bank', $dropdownbank['bank'], old('bank'), ['class' => 'form-control', 'id' => 'bank','required' => 'required']); ?>
              <span id="spanbank" style="color: red;"></span>
            </div>
            <div class="form-group">
              <label for="rekening">Rekening</label>
              <input type="text" name="rekening" required class="form-control" id="rekening" placeholder="Isi Rekening" value="<?= old('rekening') ?>">
              <span id="spanrekening" style="color: red;"></span>
              <div class="input-group" style="margin-top: 10px;">
                  <div class="custom-file">
                        <input type="file" class="custom-file-input" name="berkasrekening" id="berkasrekening" accept=".pdf" required>
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
              </div>
              <div class="text-muted">
                    <small>Format file yang diizinkan: PDF</small>,
                    <small>Maksimal ukuran file: 1 MB</small>
              </div>
              <span id="spanberkasrekening" style="color: red;"></span>
            </div>
          </div>
          <div class="card-footer">
            <div class="form-group">
              <div class="col-sm-6">
                    <button type="submit" class="btn btn-primary" style="background-color: #35B5FE !important; border:none">Tambah PT</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</div>
<!-- /.container-fluid -->
</section>
    
  
<?= $this->endSection(); ?>

<?= $this->section('south'); ?>

<script>
    $(document).ready(function () {
        // Handle form submission
        $('#formpengajuanpt').on('submit', function (e) {
            e.preventDefault(); // Prevent the default form submission

            // Create FormData object
            var formData = new FormData(this);

            console.log(formData);

            // Send AJAX request
            $.ajax({
                url: "<?= site_url('developer/pengajuan_pt_ajax') ?>", // Controller method to handle the upload
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    // Handle success response
                    if(response.status == 'success'){
                      Swal.fire({
                          icon: 'success',
                          title: 'Berhasil!',
                          text: 'Pengajuan berhasil, silahkan tunggu konfirmasi',
                          showConfirmButton: false,
                          timer: 2000
                      }).then(() => {
                          window.location.href = '<?= site_url('developer/monitoring_pengajuan_pt') ?>';
                      });
                    }
                },
                error: function (xhr, status, error) {
                    // Handle error response
                    
                    $('#<?= csrf_token() ?>').val(xhr.responseJSON.csrfHash);
                    if(xhr.responseJSON.status == 'error'){
                      if(xhr.responseJSON.message.nama_pt){
                        $('#nama_pt').addClass('is-invalid');
                        $('#spannama_pt').html(xhr.responseJSON.message.nama_pt);
                      }
                      if(xhr.responseJSON.message.lokasiref){
                        $('#lokasiref').addClass('is-invalid');
                        $('#spanlokasiref').html(xhr.responseJSON.message.lokasiref);
                      }
                      if(xhr.responseJSON.message.detail_alamat){
                        $('#detail_alamat').addClass('is-invalid');
                        $('#spanalamat').html(xhr.responseJSON.message.detail_alamat);
                      }
                      if(xhr.responseJSON.message.npwp_pt){
                        $('#npwp_pt').addClass('is-invalid');
                        $('#spannpwp_pt').html(xhr.responseJSON.message.npwp_pt);
                      }
                      if(xhr.responseJSON.message.berkasnpwppt){
                        $('#berkasnpwppt').addClass('is-invalid');
                        $('#spanberkasnpwppt').html(xhr.responseJSON.message.berkasnpwppt);
                      }
                      if(xhr.responseJSON.message.penanggung_jawab_pt){
                        $('#penanggung_jawab_pt').addClass('is-invalid');
                        $('#spanpenanggung_jawab_pt').html(xhr.responseJSON.message.penanggung_jawab_pt);
                      }
                      if(xhr.responseJSON.message.ktp_penanggung_jawab){
                        $('#ktp_penanggung_jawab').addClass('is-invalid');
                        $('#spanktp_penanggung_jawab').html(xhr.responseJSON.message.ktp_penanggung_jawab);
                      }
                      if(xhr.responseJSON.message.berkasktp_penanggung_jawab){
                        $('#berkasktp_penanggung_jawab').addClass('is-invalid');
                        $('#spanberkasktp_penanggung_jawab').html(xhr.responseJSON.message.berkasktp_penanggung_jawab);
                      }
                      if(xhr.responseJSON.message.npwp_penanggung_jawab){
                        $('#npwp_penanggung_jawab').addClass('is-invalid');
                        $('#spannpwp_penanggung_jawab').html(xhr.responseJSON.message.npwp_penanggung_jawab);
                      }
                      if(xhr.responseJSON.message.berkasnpwp_penanggung_jawab){
                        $('#berkasnpwp_penanggung_jawab').addClass('is-invalid');
                        $('#spanberkasnpwp_penanggung_jawab').html(xhr.responseJSON.message.berkasnpwp_penanggung_jawab);
                      }
                      if(xhr.responseJSON.message.pengurus_pt){
                        $('#pengurus_pt').addClass('is-invalid');
                        $('#spanpengurus_pt').html(xhr.responseJSON.message.pengurus_pt);
                      }
                      if(xhr.responseJSON.message.jabatan_pengurus_pt){
                        $('#jabatan_pengurus_pt').addClass('is-invalid');
                        $('#spanjabatan_pengurus_pt').html(xhr.responseJSON.message.jabatan_pengurus_pt);
                      }
                      if(xhr.responseJSON.message.ktp_pengurus_pt){
                        $('#ktp_pengurus_pt').addClass('is-invalid');
                        $('#spanktp_pengurus_pt').html(xhr.responseJSON.message.ktp_pengurus_pt);
                      }
                      if(xhr.responseJSON.message.berkasktp_pengurus_pt){
                        $('#berkasktp_pengurus_pt').addClass('is-invalid');
                        $('#spanberkasktp_pengurus_pt').html(xhr.responseJSON.message.berkasktp_pengurus_pt);
                      }
                      if(xhr.responseJSON.message.npwp_pengurus_pt){
                        $('#npwp_pengurus_pt').addClass('is-invalid');
                        $('#spannpwp_pengurus_pt').html(xhr.responseJSON.message.npwp_pengurus_pt);
                      }
                      if(xhr.responseJSON.message.berkasnpwp_pengurus_pt){
                        $('#berkasnpwp_pengurus_pt').addClass('is-invalid');
                        $('#spanberkasnpwp_pengurus_pt').html(xhr.responseJSON.message.berkasnpwp_pengurus_pt);
                      }
                      if(xhr.responseJSON.message.akta_pendirian){
                        $('#akta_pendirian').addClass('is-invalid');
                        $('#spanakta_pendirian').html(xhr.responseJSON.message.akta_pendirian);
                      }
                      if(xhr.responseJSON.message.berkasakta_pendirian){
                        $('#berkasakta_pendirian').addClass('is-invalid');
                        $('#spanberkasakta_pendirian').html(xhr.responseJSON.message.berkasakta_pendirian);
                      }
                      if(xhr.responseJSON.message.bank){
                        $('#bank').addClass('is-invalid');
                        $('#spanbank').html(xhr.responseJSON.message.bank);
                      }
                      if(xhr.responseJSON.message.rekening){
                        $('#rekening').addClass('is-invalid');
                        $('#spanrekening').html(xhr.responseJSON.message.rekening);
                      }
                      if(xhr.responseJSON.message.berkasrekening){
                        $('#berkasrekening').addClass('is-invalid');
                        $('#spanberkasrekening').html(xhr.responseJSON.message.berkasrekening);
                      }
                    }
                    if(xhr.responseJSON.message.simpan){
                      Swal.fire({
                          icon: 'error',
                          title: 'Error',
                          text: 'Gagal menyimpan data'
                        });
                    }
                }
            });
        });
    });
</script>
<script>

    $(document).ready(function () {

        var oldKabupatenSelection = $('#kabupaten').val();
        var oldKotaSelection = $('#kota').val();
        var oldKecamatanSelection = $('#kecamatan').val();
      
        $('#provinsi').change(function () {

            let csrfName = '<?= csrf_token() ?>';
            let csrfHash = $('#<?= csrf_token() ?>').val();
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
                    text: 'Gagal memuat data kabupaten. Silakan coba lagi.'
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
                  $('#lokasiref').html(options);
                  $('#<?= csrf_token() ?>').val(response.csrfHash);
                },
                error: function () {
                  $('#kabupaten').val(oldKabupatenSelection);
                  $('#kota').val(oldKotaSelection);
                  $('#lokasiref').val(oldKecamatanSelection);
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
$(function () {
  bsCustomFileInput.init();
});
</script>
<?= $this->endSection(); ?>