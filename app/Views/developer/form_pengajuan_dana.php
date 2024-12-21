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
                <?= form_open_multipart('developer/pengajuan_dana_ajax',['id' => 'formpengajuandana', 'class' => 'form-horizontal']); ?>
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
              <div class="text-muted" style="margin-top: 10px;">
              Download template form kredit <a href="<?= base_url('download/form_kredit') ?>" target="_blank">disini</a><br>
                    <small>Dokumen ditandatangani dan bermaterai</small><br>
                    <small>Format file yang diizinkan: PDF</small>,
                    <small>Maksimal ukuran file: 10 MB</small>
              </div>
              <span id="spanberkassuratpermohonan" style="color: red;"></span>
            </div>
                </div>
                <div class="card-footer">
                </div>
            </div>
          </div>
        <div class="col-md-6">
        <div class="card card-info">
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
                    <select id="kecamatan" id="alamatperumahanref" name="alamatperumahanref" class="form-control" style="margin-top: 10px;" required>
                        <option value="" selected disabled>Pilih Kecamatan</option>
                    </select>
                    <span id="spanalamatperumahanref" style="color: red;"></span>

                    <textarea id="alamatperumahaninput" name="alamatperumahaninput" class="form-control" style="margin-top: 10px;" rows="3" placeholder="Masukkan detail alamat seperti nama jalan, nomor rumah, RT/RW" required></textarea>
                    <span id="spanalamatperumahaninput" style="color: red;"></span>
                  </div>
                  <div class="form-group">
                    <label for="berkassiteplan">Site Plan</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="berkassiteplan" class="custom-file-input" id="berkassiteplan" accept=".pdf" required>
                        <label class="custom-file-label" for="berkassiteplan">Choose file</label>
                        
                      </div>
                    </div>
                    <div class="text-muted">
                    <small>Format file yang diizinkan: PDF</small>,
                    <small>Maksimal ukuran file: 10 MB</small>
              </div>
                  </div>
              
              <span id="spanberkassiteplan" style="color: red;"></span>

                  
                </div>
                <div class="card-footer">
              <div class="col-sm-6">
                    <button type="submit" class="btn btn-primary" style="background-color: #35B5FE !important; border:none">Simpan Pengajuan</button>
              </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    
  
<?= $this->endSection(); ?>

<?= $this->section('south'); ?>
<script>
    $(document).ready(function () {
        // Handle form submission
        $('#formpengajuandana').on('submit', function (e) {
            e.preventDefault();
            // Create FormData object
            var formData = new FormData(this);

            // Tampilkan loading spinner
            Swal.fire({
                title: 'Mohon Tunggu',
                html: 'Sedang memproses data...',
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading()
                },
            });

            // Send AJAX request
            $.ajax({
                url: "<?= site_url('developer/pengajuan_dana_ajax') ?>",
                type: "POST", 
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if(response.status == 'success'){
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Pengajuan berhasil, silahkan tunggu konfirmasi',
                            showConfirmButton: false,
                            timer: 2000
                        }).then(() => {
                            window.location.href = '<?= site_url('developer/monitoring_pengajuan_dana') ?>';
                        });
                    }
                },
                error: function (xhr, status, error) {
                    if(xhr.responseJSON.status == 'error'){
                        if(xhr.responseJSON.message.dropdownpt){
                            $('#dropdownpt').addClass('is-invalid');
                        }
                        if(xhr.responseJSON.message.suratpermohonan){
                            $('#suratpermohonan').addClass('is-invalid');
                        }
                        if(xhr.responseJSON.message.berkassuratpermohonan){
                            $('#berkassuratpermohonan').addClass('is-invalid');
                        }
                        if(xhr.responseJSON.message.dropdowndpd){
                            $('#dropdowndpd').addClass('is-invalid');
                        }
                        if(xhr.responseJSON.message.alamatperumahanref){
                            $('#alamatperumahanref').addClass('is-invalid');
                        }
                        if(xhr.responseJSON.message.alamatperumahaninput){
                            $('#alamatperumahaninput').addClass('is-invalid');
                        }
                        if(xhr.responseJSON.message.berkassiteplan){
                            $('#berkassiteplan').addClass('is-invalid');
                        }
                        if(xhr.responseJSON.message.jumlahunit){
                            $('#jumlahunit').addClass('is-invalid');
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

      
      Swal.fire({
          title: 'Mohon Tunggu',
          html: 'Sedang memproses data...',
          allowOutsideClick: false,
          showConfirmButton: false,
          willOpen: () => {
              Swal.showLoading()
          },
      });

      $.ajax({
          url: '<?= site_url('developer/get_pt'); ?>',
          type: 'POST',
          data: { uuid: uuid, [csrfName]: csrfHash },
          success: function (response) {
            $('#divberkas').html(response.html);
            $('#<?= csrf_token() ?>').val(response.csrfHash);
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Gagal mengambil data PT'
            });
            
          },
          error: function (xhr, status, error) {  
            $('#divberkas').html(xhr.responseJSON.html);
            $('#<?= csrf_token() ?>').val(xhr.responseJSON.csrfHash);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Gagal mengambil data PT'
            });
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

            Swal.fire({
                title: 'Mohon Tunggu',
                html: 'Sedang memproses data...',
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading()
                },
            });

            // Fetch kabupaten/kota berdasarkan provinsi
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
                    Swal.fire({
                      icon: 'success',
                      title: 'Berhasil!',
                      text: 'Berhasil memuat data kabupaten/kota. Silakan pilih kabupaten/kota.'
                    });
                },
                error: function () {
                  Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Gagal memuat data kabupaten/kota. Silakan coba lagi.'
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

            
            Swal.fire({
                title: 'Mohon Tunggu',
                html: 'Sedang memproses data...',
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading()
                },
            });

            // Fetch kota berdasarkan kabupaten
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
                    Swal.fire({
                      icon: 'success',
                      title: 'Berhasil!',
                      text: 'Berhasil memuat data kecamatan. Silakan pilih kecamatan.'
                    });
                 
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

            
            Swal.fire({
                title: 'Mohon Tunggu',
                html: 'Sedang memproses data...',
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading()
                },
            });

            // Fetch kota berdasarkan kabupaten
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
                    Swal.fire({
                      icon: 'success',
                      title: 'Berhasil!',
                      text: 'Berhasil memuat data kelurahan. Silakan pilih kelurahan.'
                    });
                },
                error: function () {
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
$(function () {
  bsCustomFileInput.init();
});
</script>
<?= $this->endSection(); ?>