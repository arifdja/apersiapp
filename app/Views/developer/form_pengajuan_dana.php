<?= $this->extend('layout/template'); ?>

<?= $this->section('north'); ?>
<!-- bs-custom-file-input -->
<script src="<?= base_url() ?>/adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

     <!-- Main content -->
     <section class="content">
      <div class="container-fluid">
        <div class="row">
        <div class="col-md-6">
        <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Pengajuan</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form>
                <div class="card-body">

                <?= form_open('developer/pengajuan_dana_ajax',['id' => 'formpengajuandana', 'class' => 'form-horizontal']); ?>
                <input type="hidden" id="<?= csrf_token() ?>" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>"/>

                <div class="form-group">
                  <label for="kta">Kartu Tanda Anggota (KTA)</label>
                  <a href="<?= base_url('download/kta/'.session('berkaskta')) ?>" class="form-control" style="text-decoration: none; background-color: #e9ecef;"><?= session('kta') ?></a>
                  <span id="spankta" style="color: red;"></span>
                </div>

                <div class="form-group">
                  <label for="dropdownpt">Pilih PT</label>  
                  <?= create_dropdown('pt', $dropdownpt['pt'], old('dropdownpt'), ['class' => 'form-control', 'id' => 'dropdownpt','required' => 'required']); ?>
                  <span id="spandropdownpt" style="color: red;"></span>
                </div>

                <div id="divberkas" class="form-group">
                </div>

               
            <div class="form-group">
              <label for="suratpermohonan">Permohonan Pengajuan Pinjaman</label>
              <input type="text" name="suratpermohonan" class="form-control" id="suratpermohonan" placeholder="Berkas Permohonan Pengajuan Pinjaman" required>
              <span id="spansuratpermohonan" style="color: red;"></span>
              <div class="input-group" style="margin-top: 10px;">
                  <div class="custom-file">
                        <input type="file" class="custom-file-input" name="berkassuratpermohonan" id="berkassuratpermohonan" accept=".pdf" required>
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
              </div>
              <div class="text-muted">
                    <small>Format file yang diizinkan: PDF</small>,
                    <small>Maksimal ukuran file: 10 MB</small>
              </div>
              <span id="spanberkassuratpermohonan" style="color: red;"></span>
            </div>

            
            




                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                </div>
            </div>
          </div>
          <!-- /.col -->

        <div class="col-md-6">
        <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Pengajuan</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form>
                <div class="card-body">

                <div class="form-group">
                  <label for="dropdowndpd">Pilih DPD/DPP/Korwil</label>  
                  <?= create_dropdown('dpd', $dropdowndpd['dpd'], old('dropdowndpd'), ['class' => 'form-control', 'id' => 'dropdowndpd','required' => 'required']); ?>
                  <span id="spandropdowndpd" style="color: red;"></span>
                </div>


                  <div class="form-group">
                    <label for="kta">Lokasi Perumahan</label>
                    <?= create_dropdown('provinsi', $dropdownprovinsi['provinsi'], old('provinsi'), ['class' => 'form-control', 'id' => 'provinsi','required' => 'required']); ?>
                    <select id="kabupaten" name="kabupaten" class="form-control" style="margin-top: 10px;" required>
                      <option value="" selected disabled>Pilih Kabupaten</option>
                    </select>
                    <select id="kota" name="kota" class="form-control" style="margin-top: 10px;" required>
                      <option value="" selected disabled>Pilih Kota</option>
                    </select>
                    <select id="kecamatan" name="alamatperumahanref" class="form-control" style="margin-top: 10px;" required>
                        <option value="" selected disabled>Pilih Kecamatan</option>
                    </select>
                    <textarea id="detail_alamat" name="alamatperumahaninput" class="form-control" style="margin-top: 10px;" rows="3" placeholder="Masukkan detail alamat seperti nama jalan, nomor rumah, RT/RW" required></textarea>
                  </div>


                  <div class="form-group">
                    <label for="berkassiteplan">Site Plan</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="berkassiteplan" accept=".pdf" required>
                        <label class="custom-file-label" for="berkassiteplan">Choose file</label>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="jumlahunit">Jumlah Unit yang diagunkan</label>
                    <input type="number" name="jumlahunit" class="form-control" id="jumlahunit" placeholder="Isi jumlah unit yang diagunkan" required>
                  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
              <div class="col-sm-6">
                    <button type="submit" class="btn btn-primary" style="background-color: #35B5FE !important; border:none">Simpan Header Pengajuan</button>
              </div>

                </div>
              </form>
            </div>
          </div>
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
        $('#formpengajuandana').on('submit', function (e) {
            e.preventDefault(); // Prevent the default form submission
          
            // Create FormData object
            var formData = new FormData(this);

            console.log(formData);

            // Send AJAX request
            $.ajax({
                url: "<?= site_url('developer/pengajuan_dana_ajax') ?>", // Controller method to handle the upload
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
                          window.location.href = '<?= site_url('developer/form_pengajuan_dana') ?>';
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

      
    $('#dropdownpt').change(function () {

      let csrfName = '<?= csrf_token() ?>';
      let csrfHash = $('#<?= csrf_token() ?>').val();
      let uuid = $(this).val();

      $.ajax({
          url: '<?= site_url('developer/get_pt'); ?>',
          type: 'POST',
          data: { uuid: uuid, [csrfName]: csrfHash },
          success: function (response) {
            $('#divberkas').html(response.html);
            $('#<?= csrf_token() ?>').val(response.csrfHash);
          },
          error: function (xhr, status, error) {  
            $('#divberkas').html(xhr.responseJSON.html);
            $('#<?= csrf_token() ?>').val(xhr.responseJSON.csrfHash);
          }
      });
      });
      
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