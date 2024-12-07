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
        <div class="card-header">
          <h3 class="card-title">Pengajuan</h3>
        </div>
          <div class="card-body">
            
          <?= form_open('operator/pengajuan_pt',['id' => 'formpengajuanpt', 'class' => 'form-horizontal']); ?>
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
              <select id="kecamatan" name="lokasiref" class="form-control" required>
                  <option value="" selected disabled>Pilih Kecamatan</option>
              </select>
            </div>
            <div class="form-group">
              <label for="detail_alamat">Detail Alamat</label>
              <textarea id="detail_alamat" name="detail_alamat" class="form-control" rows="3" placeholder="Masukkan detail alamat seperti nama jalan, nomor rumah, RT/RW" required><?= old('detail_alamat') ?></textarea>
              <span id="spanalamat" style="color: red;"></span>
            </div>
            <div class="form-group">
              <label for="npwp_pt">NPWP PT</label>
              <input type="text" name="npwp_pt" required class="form-control" id="npwp_pt" placeholder="Isi NPWP PT" value="<?= old('npwp_pt') ?>" required>
              <span id="spannpwp_pt" style="color: red;"></span>
              <div class="input-group" style="margin-top: 10px;">
                  <div class="custom-file">
                        <input type="file" class="custom-file-input" name="berkasnpwppt" id="berkasnpwppt" accept=".pdf" required>
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
              </div>
              <div class="text-muted">
                    <small>Format file yang diizinkan: PDF</small>,
                    <small>Maksimal ukuran file: 10 MB</small>
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
              <input type="text" name="ktp_penanggung_jawab" required class="form-control" id="ktp_penanggung_jawab" placeholder="Isi KTP Penanggung Jawab" value="<?= old('ktp_penanggung_jawab') ?>" required>
              <span id="spanktp_penanggung_jawab" style="color: red;"></span>
              <div class="input-group" style="margin-top: 10px;">
                  <div class="custom-file">
                        <input type="file" class="custom-file-input" name="berkasktp_penanggung_jawab" id="berkasktp_penanggung_jawab" accept=".pdf" required>
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
              </div>
              <div class="text-muted">
                    <small>Format file yang diizinkan: PDF</small>,
                    <small>Maksimal ukuran file: 10 MB</small>
              </div>
              <span id="spanberasktp_penanggung_jawab" style="color: red;"></span>
            </div>
            <div class="form-group">
              <label for="npwp_penanggung_jawab">NPWP Penanggung Jawab</label>
              <input type="text" name="npwp_penanggung_jawab" required class="form-control" id="npwp_penanggung_jawab" placeholder="Isi NPWP Penanggung Jawab" value="<?= old('npwp_penanggung_jawab') ?>" required>
              <span id="spannpwp_penanggung_jawab" style="color: red;"></span>
              <div class="input-group" style="margin-top: 10px;">
                  <div class="custom-file">
                        <input type="file" class="custom-file-input" name="berkasnpwp_penanggung_jawab" id="berkasnpwp_penanggung_jawab" accept=".pdf" required>
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
              </div>
              <div class="text-muted">
                    <small>Format file yang diizinkan: PDF</small>,
                    <small>Maksimal ukuran file: 10 MB</small>
              </div>
              <span id="spanberkasnpwp_penanggung_jawab" style="color: red;"></span>
            </div>
          </div>
      </div>
    </div>
  <div class="col-md-6">
  <div class="card card-info">
        <div class="card-header">
          <h3 class="card-title">Pengajuan</h3>
        </div>
          <div class="card-body">
            <div class="form-group">
              <label for="akta_pendirian">Akta Pendirian</label>
              <input type="text" name="akta_pendirian" required class="form-control" id="akta_pendirian" placeholder="Isi Akta Pendirian" value="<?= old('akta_pendirian') ?>" required>
              <span id="spanakta_pendirian" style="color: red;"></span>
              <div class="input-group" style="margin-top: 10px;">
                  <div class="custom-file">
                        <input type="file" class="custom-file-input" name="berkasakta_pendirian" id="berkasakta_pendirian" accept=".pdf" required>
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
              </div>
              <div class="text-muted">
                    <small>Format file yang diizinkan: PDF</small>,
                    <small>Maksimal ukuran file: 10 MB</small>
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
              <input type="text" name="rekening" required class="form-control" id="rekening" placeholder="Isi Rekening" value="<?= old('rekening') ?>" required>
              <span id="spanrekening" style="color: red;"></span>
              <div class="input-group" style="margin-top: 10px;">
                  <div class="custom-file">
                        <input type="file" class="custom-file-input" name="berkasrekening" id="berkasrekening" accept=".pdf" required>
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
              </div>
              <div class="text-muted">
                    <small>Format file yang diizinkan: PDF</small>,
                    <small>Maksimal ukuran file: 10 MB</small>
              </div>
              <span id="spanberkasrekening" style="color: red;"></span>
            </div>
            <div class="form-group">
              <label for="pinjaman_kpl">Pinjaman KPL</label>
              <input type="number" name="pinjaman_kpl" required class="form-control" id="pinjaman_kpl" placeholder="Isi Pinjaman KPL" value="<?= old('pinjaman_kpl') ?>" required>
              <span id="spanpinjaman_kpl" style="color: red;"></span>
              <div class="input-group" style="margin-top: 10px;">
                  <div class="custom-file">
                        <input type="file" class="custom-file-input" name="berkaspinjaman_kpl" id="berkaspinjaman_kpl" accept=".pdf" required>
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
              </div>
              <div class="text-muted">
                    <small>Format file yang diizinkan: PDF</small>,
                    <small>Maksimal ukuran file: 10 MB</small>
              </div>
              <span id="spanberkaspinjaman_kpl" style="color: red;"></span>
            </div>
            <div class="form-group">
              <label for="pinjaman_kpg">Pinjaman KPG</label>
              <input type="number" name="pinjaman_kpg" required class="form-control" id="pinjaman_kpg" placeholder="Isi Pinjaman KPG" value="<?= old('pinjaman_kpg') ?>" required>
              <span id="spanpinjaman_kpg" style="color: red;"></span>
              <div class="input-group" style="margin-top: 10px;">
                  <div class="custom-file">
                        <input type="file" class="custom-file-input" name="berkaspinjaman_kpg" id="berkaspinjaman_kpg" accept=".pdf" required>
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
              </div>
              <div class="text-muted">
                    <small>Format file yang diizinkan: PDF</small>,
                    <small>Maksimal ukuran file: 10 MB</small>
              </div>
              <span id="spanberkaspinjaman_kpg" style="color: red;"></span>
            </div>
            <div class="form-group">
              <label for="pinjaman_lain">Pinjaman Lain</label>
              <input type="number" name="pinjaman_lain" required class="form-control" id="pinjaman_lain" placeholder="Isi Pinjaman Lain" value="<?= old('pinjaman_lain') ?>" required>
              <span id="spanpinjaman_lain" style="color: red;"></span>
              <div class="input-group" style="margin-top: 10px;">
                  <div class="custom-file">
                        <input type="file" class="custom-file-input" name="berkaspinjaman_lain" id="berkaspinjaman_lain" accept=".pdf" required>
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
              </div>
              <div class="text-muted">
                    <small>Format file yang diizinkan: PDF</small>,
                    <small>Maksimal ukuran file: 10 MB</small>
              </div>
              <span id="spanberkaspinjaman_lain" style="color: red;"></span>
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
                          window.location.href = '<?= site_url('developer/form_pengajuan_pt') ?>';
                      });
                    }
                },
                error: function (xhr, status, error) {
                    // Handle error response
                    if(xhr.responseJSON.status == 'error'){
                      if(xhr.responseJSON.message.nama_pt){
                        $('#nama_pt').addClass('is-invalid');
                      }
                      if(xhr.responseJSON.message.detail_alamat){
                        $('#detail_alamat').addClass('is-invalid');
                      }
                      if(xhr.responseJSON.message.npwp_pt){
                        $('#npwp_pt').addClass('is-invalid');
                      }
                      if(xhr.responseJSON.message.berkasnpwppt){
                        $('#berkasnpwppt').addClass('is-invalid');
                      }
                      if(xhr.responseJSON.message.penanggung_jawab_pt){
                        $('#penanggung_jawab_pt').addClass('is-invalid');
                      }
                      if(xhr.responseJSON.message.ktp_penanggung_jawab){
                        $('#ktp_penanggung_jawab').addClass('is-invalid');
                      }
                      if(xhr.responseJSON.message.berkasktp_penanggung_jawab){
                        $('#berkasktp_penanggung_jawab').addClass('is-invalid');
                      }
                      if(xhr.responseJSON.message.npwp_penanggung_jawab){
                        $('#npwp_penanggung_jawab').addClass('is-invalid');
                      }
                      if(xhr.responseJSON.message.berkasnpwp_penanggung_jawab){
                        $('#berkasnpwp_penanggung_jawab').addClass('is-invalid');
                      }
                      if(xhr.responseJSON.message.akta_pendirian){
                        $('#akta_pendirian').addClass('is-invalid');
                      }
                      if(xhr.responseJSON.message.berkasakta_pendirian){
                        $('#berkasakta_pendirian').addClass('is-invalid');
                      }
                      if(xhr.responseJSON.message.bank){
                        $('#bank').addClass('is-invalid');
                      }
                      if(xhr.responseJSON.message.rekening){
                        $('#rekening').addClass('is-invalid');
                      }
                      if(xhr.responseJSON.message.berkasrekening){
                        $('#berkasrekening').addClass('is-invalid');
                      }
                      if(xhr.responseJSON.message.pinjaman_kpl){
                        $('#pinjaman_kpl').addClass('is-invalid');
                      }
                      if(xhr.responseJSON.message.berkaspinjaman_kpl){
                        $('#berkaspinjaman_kpl').addClass('is-invalid');
                      }
                      if(xhr.responseJSON.message.pinjaman_kpg){
                        $('#pinjaman_kpg').addClass('is-invalid');
                      }
                      if(xhr.responseJSON.message.berkaspinjaman_kpg){
                        $('#berkaspinjaman_kpg').addClass('is-invalid');
                      }
                      if(xhr.responseJSON.message.pinjaman_lain){
                        $('#pinjaman_lain').addClass('is-invalid');
                      }
                      if(xhr.responseJSON.message.berkaspinjaman_lain){
                        $('#berkaspinjaman_lain').addClass('is-invalid');
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
                  $('#kecamatan').html(options);
                  $('#<?= csrf_token() ?>').val(response.csrfHash);
                },
                error: function () {
                  $('#kabupaten').val(oldKabupatenSelection);
                  $('#kota').val(oldKotaSelection);
                  $('#kecamatan').val(oldKecamatanSelection);
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