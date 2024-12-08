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
                <div class="card">

                    <div class="card-body">
                        <?= form_open_multipart('developer/tambah_unit_ajax',['id' => 'formtambahunit', 'class' => 'form-horizontal']); ?>
                        <input type="hidden" id="<?= csrf_token() ?>" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>"/>

                        <input type="hidden" name="uuidheader" value="<?= $uuidheader ?>">

                        <div class="form-group">
                            <label for="sertifikat">Nomor Sertifikat</label>
                            <input type="text" name="sertifikat" required class="form-control" id="sertifikat" placeholder="Nomor Sertifikat" required>
                            <span id="spansertifikat" style="color: red;"></span>
                            <div class="input-group" style="margin-top: 10px;">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="berkassertifikat" id="berkassertifikat" accept=".pdf" required>
                                    <label class="custom-file-label labelberkassertifikat" for="exampleInputFile">Unggah Sertifikat</label>
                                </div>
                            </div>
                            <div class="text-muted">
                                <small>Format file yang diizinkan: PDF</small>,
                                <small>Maksimal ukuran file: 10 MB</small>
                            </div>
                            <span id="spanberkassertifikat" style="color: red;"></span>
                        </div>

                        <div class="form-group">
                            <label for="pbb">Nomor PBB</label>
                            <input type="text" name="pbb" required class="form-control" id="pbb" placeholder="Nomor PBB" required>
                            <span id="spanpbb" style="color: red;"></span>
                            <div class="input-group" style="margin-top: 10px;">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="berkaspbb" id="berkaspbb" accept=".pdf" required>
                                    <label class="custom-file-label labelberkaspbb" for="exampleInputFile">Unggah PBB</label>
                                </div>
                            </div>
                            <div class="text-muted">
                                <small>Format file yang diizinkan: PDF</small>,
                                <small>Maksimal ukuran file: 10 MB</small>
                            </div>
                            <span id="spanberkaspbb" style="color: red;"></span>
                        </div>

                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="number" name="harga" required class="form-control" id="harga" placeholder="Contoh: 150.000.000">
                            <span id="spanharga" style="color: red;"></span>
                        </div>

                        <div class="form-group">
                            <label for="nilaikredit">Nilai Kredit</label>
                            <input type="number" name="nilaikredit" required class="form-control" id="nilaikredit" placeholder="Contoh: 170.000.000">
                            <span id="spannilaikredit" style="color: red;"></span>
                        </div>

                        <div class="form-group">
                            <label for="sp3k">Dokumen SP3K</label>
                            <input type="text" name="sp3k" required class="form-control" id="sp3k" placeholder="Nomor Dokumen SP3K" required>
                            <span id="spansp3k" style="color: red;"></span>
                            <div class="input-group" style="margin-top: 10px;">
                                <input type="date" name="tanggalsp3k" required class="form-control" id="tanggalsp3k">
                            </div>
                            <div class="input-group" style="margin-top: 10px;">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="berkassp3k" id="berkassp3k" accept=".pdf" required>
                                    <label class="custom-file-label labelberkassp3k" for="exampleInputFile">Unggah Dokumen SP3K</label>
                                </div>
                            </div>
                            <div class="text-muted">
                                <small>Format file yang diizinkan: PDF</small>,
                                <small>Maksimal ukuran file: 10 MB</small>
                            </div>
                            <span id="spanberkassp3k" style="color: red;"></span>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card card-info">
                    <div class="card-body">

                      <div class="form-group">
                          <label for="debitur">Nama Debitur</label>
                          <input type="text" name="debitur" required class="form-control" id="debitur" placeholder="Nama Debitur" required>
                          <span id="spandebitur" style="color: red;"></span>
                          <div class="input-group" style="margin-top: 10px;">
                              <div class="custom-file">
                                  <input type="file" class="custom-file-input" name="berkasktpdebitur" id="berkasktpdebitur" accept=".pdf" required>
                                  <label class="custom-file-label labelberkasktpdebitur" for="exampleInputFile">Unggah KTP Debitur</label>
                              </div>
                          </div>
                          <div class="text-muted">
                              <small>Format file yang diizinkan: PDF</small>,
                              <small>Maksimal ukuran file: 10 MB</small>
                          </div>
                          <span id="spanberkasktpdebitur" style="color: red;"></span>
                      </div>

                      <div class="form-group">
                          <label for="bank">Bank</label>  
                          <?= create_dropdown('bank', $dropdownbank['bank'], old('bank'), ['class' => 'form-control', 'id' => 'bank','required' => 'required']); ?>
                          <span id="spanbank" style="color: red;"></span>
                      </div>

                      <div class="form-group">
                          <label for="rekening">Rekening Debitur</label>
                          <input type="text" name="rekening" required class="form-control" id="rekening" placeholder="Rekening Debitur">
                          <span id="spanrekening" style="color: red;"></span>
                          <div class="input-group" style="margin-top: 10px;">
                              <div class="custom-file">
                                  <input type="file" class="custom-file-input" name="berkasrekening" id="berkasrekening" accept=".pdf" required>
                                  <label class="custom-file-label labelberkasrekening" for="exampleInputFile">Unggah Rekening Debitur</label>
                              </div>
                          </div>
                          <div class="text-muted">
                              <small>Format file yang diizinkan: PDF</small>,
                              <small>Maksimal ukuran file: 10 MB</small>
                          </div>
                          <span id="spanberkasrekening" style="color: red;"></span>
                      </div>

                    </div>

                    <div class="card-footer">
                        <div class="form-group">
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-primary" style="background-color: #35B5FE !important; border:none">Tambah Unit</button>
                            </div>
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
      
        $('#formtambahunit').on('submit', function (e) {
            e.preventDefault(); // Prevent the default form submission

            // Create FormData object
            var formData = new FormData(this);

            // console.log(formData);

            // Send AJAX request
            $.ajax({
                url: "<?= site_url('developer/tambah_unit_ajax') ?>", // Controller method to handle the upload
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    // Handle success response
                    if(response.status == 'success'){
                      Swal.fire({
                        title: 'Berhasil!',
                        text: 'Tambah unit berhasil, Tambah unit lagi?',
                        icon: 'success',
                        showCancelButton: true,
                        confirmButtonText: 'Ya',
                        cancelButtonText: 'Kembali ke pengajuan dana'
                      }).then((result) => {
                        $('#<?= csrf_token() ?>').val(response.csrfHash);
                          if (result.isConfirmed) {
                              $('#sertifikat').val('');
                              $('#berkassertifikat').val('');
                              $('#pbb').val('');
                              $('#berkaspbb').val('');
                              $('#harga').val('');
                              $('#nilaikredit').val('');
                              $('#sp3k').val('');
                              $('#tanggalsp3k').val('');
                              $('#berkassp3k').val('');
                              $('#debitur').val('');
                              $('#berkasktpdebitur').val('');
                              $('#bank').val('');
                              $('#rekening').val('');
                              $('#berkasrekening').val(''); 
                              $('.labelberkassertifikat').html('Unggah Sertifikat');
                              $('.labelberkaspbb').html('Unggah PBB');
                              $('.labelberkassp3k').html('Unggah Dokumen SP3K');
                              $('.labelberkasktpdebitur').html('Unggah KTP Debitur');
                              $('.labelberkasrekening').html('Unggah Rekening Debitur');
                              $('input').removeClass('is-invalid');
                              $('span').html('');
                          } else {
                            window.location.href = '<?= site_url('developer/monitoring_pengajuan_dana'); ?>';
                          }
                      });
                    }
                },
                error: function (xhr, status, error) {
                    $('#<?= csrf_token() ?>').val(xhr.responseJSON.csrfHash);
                    // Handle error response
                    if(xhr.responseJSON.status == 'error'){
                      if(xhr.responseJSON.message.sertifikat){
                        $('#sertifikat').addClass('is-invalid');
                        $('#spansertifikat').html(xhr.responseJSON.message.sertifikat);
                      }
                      if(xhr.responseJSON.message.berkassertifikat){
                        $('#berkassertifikat').addClass('is-invalid');
                        $('#spanberkassertifikat').html(xhr.responseJSON.message.berkassertifikat);
                      }
                      if(xhr.responseJSON.message.pbb){
                        $('#pbb').addClass('is-invalid');
                        $('#spanpbb').html(xhr.responseJSON.message.pbb);
                      }
                      if(xhr.responseJSON.message.berkaspbb){
                        $('#berkaspbb').addClass('is-invalid');
                        $('#spanberkaspbb').html(xhr.responseJSON.message.berkaspbb);
                      }
                      if(xhr.responseJSON.message.harga){
                        $('#harga').addClass('is-invalid');
                        $('#spanharga').html(xhr.responseJSON.message.harga);
                      }
                      if(xhr.responseJSON.message.nilaikredit){
                        $('#nilaikredit').addClass('is-invalid');
                        $('#spannilaikredit').html(xhr.responseJSON.message.nilaikredit);
                      }
                      if(xhr.responseJSON.message.sp3k){
                        $('#sp3k').addClass('is-invalid');
                        $('#spansp3k').html(xhr.responseJSON.message.sp3k);
                      }
                      if(xhr.responseJSON.message.berkassp3k){
                        $('#berkassp3k').addClass('is-invalid');
                        $('#spanberkassp3k').html(xhr.responseJSON.message.berkassp3k);
                      }
                      if(xhr.responseJSON.message.debitur){
                        $('#debitur').addClass('is-invalid');
                        $('#spandebitur').html(xhr.responseJSON.message.debitur);
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