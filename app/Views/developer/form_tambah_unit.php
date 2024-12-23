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
                            <input type="text" name="sertifikat" class="form-control" id="sertifikat" placeholder="Nomor Sertifikat" required>
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
                            <label for="pbgimb">PBG/IMB</label>
                            <div class="input-group" style="margin-top: 10px;">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="berkaspbgimb" id="berkaspbgimb" accept=".pdf" required>
                                    <label class="custom-file-label labelberkaspbgimb" for="exampleInputFile">Unggah PBG/IMB</label>
                                </div>
                            </div>
                            <div class="text-muted">
                                <small>Format file yang diizinkan: PDF</small>,
                                <small>Maksimal ukuran file: 10 MB</small>
                            </div>
                            <span id="spanberkaspbgimb" style="color: red;"></span>
                        </div>

                        <div class="form-group">
                            <label for="pbb">Nomor PBB</label>
                            <input type="text" name="pbb" class="form-control" id="pbb" placeholder="Nomor PBB" required>
                            <span id="spanpbb" style="color: red;"></span>
                            <div class="input-group" style="margin-top: 10px;">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="berkaspbb" id="berkaspbb" accept=".pdf" required>
                                    <label class="custom-file-label labelberkaspbb" for="exampleInputFile">Unggah PBB tahun terakhir</label>
                                </div>
                            </div>
                            <div class="text-muted">
                              <small>Format file yang diizinkan: PDF</small>,
                                <small>Maksimal ukuran file: 10 MB</small>
                            </div>
                            <span id="spanberkaspbb" style="color: red;"></span>
                        </div>

                        <div class="form-group">
                            <label for="harga">Harga Sesuai Persetujuan Kredit (SP3K)</label>
                            <input type="number" name="harga" class="form-control" id="harga" placeholder="Contoh: 100.000.000" required>
                            <span id="spanharga" style="color: red;"></span>
                        </div>

                        <div class="form-group">
                            <label for="nilaikredit">Nilai Dana Talangan</label>
                            <input type="number" name="nilaikredit" class="form-control" id="nilaikredit" placeholder="Contoh: 70.000.000" required>
                            <span id="spannilaikredit" style="color: red;"></span>
                            <div class="text-muted">
                                <small>Maksimal 70% dari harga sesuai persetujuan kredit (SP3K)</small>
                            </div>
                        </div>

                        
                        <div class="form-group">
                          <label for="provinsi">Provinsi</label>  
                          <?= create_dropdown('provinsi', $dropdownprovinsi['provinsi'], old('provinsi'), ['class' => 'form-control', 'id' => 'provinsi','required' => 'required']); ?>
                          <span id="spanprovinsi" style="color: red;"></span>
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
                          <label for="detail_alamat">Detail Alamat</label>
                          <textarea id="detail_alamat" name="detail_alamat" class="form-control" rows="3" placeholder="Masukkan detail alamat seperti nama jalan, nomor rumah, RT/RW" required><?= old('detail_alamat') ?></textarea>
                          <span id="spanalamat" style="color: red;"></span>
                        </div>
                       

                        <div class="form-group">
                            <label for="sp3k">Dokumen SP3K</label>
                            <input type="text" name="sp3k" class="form-control" id="sp3k" placeholder="Nomor Dokumen SP3K" required>
                            <span id="spansp3k" style="color: red;"></span>
                            <div class="input-group" style="margin-top: 10px;">
                                <input type="date" name="tanggalsp3k" class="form-control" id="tanggalsp3k" required>
                                
                            </div>
                            
                            <div class="text-muted">
                                  <small>Diisi tanggal SP3K</small>
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
                              <input type="text" name="debitur" class="form-control" id="debitur" placeholder="Nama Debitur" required>
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
                        <label for="pinjaman_kpl">Pinjaman KPL</label>
                        <input type="number" name="pinjaman_kpl" class="form-control" id="pinjaman_kpl" placeholder="Total Pinjaman KPL">
                        <span id="spanpinjaman_kpl" style="color: red;"></span>
                        <div class="input-group" style="margin-top: 10px;">
                            <div class="custom-file">
                                  <input type="file" class="custom-file-input" name="berkaspinjaman_kpl" id="berkaspinjaman_kpl" accept=".pdf">
                                  <label class="custom-file-label labelberkaspinjaman_kpl" for="exampleInputFile">Unggah Pinjaman KPL</label>
                            </div>
                        </div>
                        <div class="text-muted">
                              <small>Format file yang diizinkan: PDF</small>,
                              <small>Maksimal ukuran file: 10 MB</small>
                        </div>
                        <span id="spanberkaspinjaman_kpl" style="color: red;"></span>
                      </div>
                      <div class="form-group">
                        <label for="pinjaman_kyg">Pinjaman KYG</label>
                        <input type="number" name="pinjaman_kyg" class="form-control" id="pinjaman_kyg" placeholder="Total Pinjaman KYG" >
                        <span id="spanpinjaman_kyg" style="color: red;"></span>
                        <div class="input-group" style="margin-top: 10px;">
                            <div class="custom-file">
                                  <input type="file" class="custom-file-input" name="berkaspinjaman_kyg" id="berkaspinjaman_kyg" accept=".pdf">
                                  <label class="custom-file-label labelberkaspinjaman_kyg" for="exampleInputFile">Unggah Pinjaman KYG</label>
                            </div>
                        </div>
                        <div class="text-muted">
                              <small>Format file yang diizinkan: PDF</small>,
                              <small>Maksimal ukuran file: 10 MB</small>
                        </div>
                        <span id="spanberkaspinjaman_kyg" style="color: red;"></span>
                      </div>
                      <div class="form-group">
                        <label for="pinjaman_lain">Pinjaman Lain</label>
                        <input type="number" name="pinjaman_lain" class="form-control" id="pinjaman_lain" placeholder="Total Pinjaman Lain" >
                        <span id="spanpinjaman_lain" style="color: red;"></span>
                        <div class="input-group" style="margin-top: 10px;">
                            <div class="custom-file">
                                  <input type="file" class="custom-file-input" name="berkaspinjaman_lain" id="berkaspinjaman_lain" accept=".pdf">
                                  <label class="custom-file-label labelberkaspinjaman_lain" for="exampleInputFile">Unggah Pinjaman Lain</label>
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
            

            if(($('#pinjaman_kpl').val() == '' && $('#berkaspinjaman_kpl').val() != '') || ($('#pinjaman_kyg').val() == '' && $('#berkaspinjaman_kyg').val() != '') || ($('#pinjaman_lain').val() == '' && $('#berkaspinjaman_lain').val() != '')){
              Swal.fire({
                  title: 'Perhatian!',
                  text: 'Jika mengisi berkas pinjaman KPL/KYG/Lain, nominal pinjaman KPL/KYG/Lain harus diisi!',
                  icon: 'warning',
                  confirmButtonText: 'Ok'
              });
              return false;
            }

            if(($('#pinjaman_kpl').val() != '' && $('#berkaspinjaman_kpl').val() == '') || ($('#pinjaman_kyg').val() != '' && $('#berkaspinjaman_kyg').val() == '') || ($('#pinjaman_lain').val() != '' && $('#berkaspinjaman_lain').val() == '')){
              Swal.fire({
                  title: 'Perhatian!',
                  text: 'Jika mengisi nominal pinjaman KPL/KYG/Lain, berkas pinjaman KPL/KYG/Lain harus diisi!',
                  icon: 'warning',
                  confirmButtonText: 'Ok'
              });
              return false;
            }

            if($('#nilaikredit').val() > $('#harga').val()*0.7){
              Swal.fire({
                  title: 'Perhatian!',
                  text: 'Nilai dana talangan tidak boleh lebih besar dari 70% dari harga sesuai persetujuan kredit (SP3K)!',
                  icon: 'warning',
                  confirmButtonText: 'Ok'
              });
              return false;
            }

            // Tampilkan loading alert
            Swal.fire({
                title: 'Sedang memproses...',
                text: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

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
                              $('#berkaspbgimb').val('');
                              $('#pbb').val('');
                              $('#berkaspbb').val('');
                              $('#harga').val('');
                              $('#nilaikredit').val('');
                              $('#sp3k').val('');
                              $('#tanggalsp3k').val('');
                              $('#berkassp3k').val('');
                              $('#lokasiref').val('');
                              $('#provinsi').val('');
                              $('#kabupaten').val('');
                              $('#kota').val('');
                              $('#kecamatan').val('');
                              $('#detail_alamat').val('');
                              $('#debitur').val('');
                              $('#berkasktpdebitur').val('');
                              $('#bank').val('');
                              $('#rekening').val('');
                              $('#berkasrekening').val(''); 
                              $('#pinjaman_kpl').val('');
                              $('#berkaspinjaman_kpl').val('');
                              $('#pinjaman_kyg').val('');
                              $('#berkaspinjaman_kyg').val('');
                              $('#pinjaman_lain').val('');
                              $('#berkaspinjaman_lain').val('');
                              $('.labelberkassertifikat').html('Unggah Sertifikat');
                              $('.labelberkaspbb').html('Unggah PBB tahun terakhir');
                              $('.labelberkassp3k').html('Unggah Dokumen SP3K');
                              $('.labelberkasktpdebitur').html('Unggah KTP Debitur');
                              $('.labelberkasrekening').html('Unggah Rekening Debitur');
                              $('.labelberkaspinjaman_kpl').html('Unggah Pinjaman KPL');
                              $('.labelberkaspinjaman_kyg').html('Unggah Pinjaman KYG');
                              $('.labelberkaspinjaman_lain').html('Unggah Pinjaman Lain');
                              $('input').removeClass('is-invalid');
                              $('span').html('');
                          } else {
                            window.location.href = '<?= site_url('developer/monitoring_pengajuan_dana'); ?>';
                          }
                      });
                    }
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal menyimpan data'
                      });
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
                      if(xhr.responseJSON.message.berkaspbgimb){
                        $('#berkaspbgimb').addClass('is-invalid');
                        $('#spanberkaspbgimb').html(xhr.responseJSON.message.berkaspbgimb);
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
                      if(xhr.responseJSON.message.lokasiref){
                        $('#lokasiref').addClass('is-invalid');
                        $('#spanlokasiref').html(xhr.responseJSON.message.lokasiref);
                      }
                      if(xhr.responseJSON.message.detail_alamat){
                        $('#detail_alamat').addClass('is-invalid');
                        $('#spanalamat').html(xhr.responseJSON.message.detail_alamat);
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
                      if(xhr.responseJSON.message.pinjaman_kpl){
                        $('#pinjaman_kpl').addClass('is-invalid');
                        $('#spanpinjaman_kpl').html(xhr.responseJSON.message.pinjaman_kpl);
                      }
                      if(xhr.responseJSON.message.berkaspinjaman_kpl){
                        $('#berkaspinjaman_kpl').addClass('is-invalid');
                        $('#spanberkaspinjaman_kpl').html(xhr.responseJSON.message.berkaspinjaman_kpl);
                      } 
                      if(xhr.responseJSON.message.pinjaman_kyg){
                        $('#pinjaman_kyg').addClass('is-invalid');
                        $('#spanpinjaman_kyg').html(xhr.responseJSON.message.pinjaman_kyg);
                      }
                      if(xhr.responseJSON.message.berkaspinjaman_kyg){
                        $('#berkaspinjaman_kyg').addClass('is-invalid');
                        $('#spanberkaspinjaman_kyg').html(xhr.responseJSON.message.berkaspinjaman_kyg);
                      } 
                      if(xhr.responseJSON.message.pinjaman_lain){
                        $('#pinjaman_lain').addClass('is-invalid');
                        $('#spanpinjaman_lain').html(xhr.responseJSON.message.pinjaman_lain);
                      }
                      if(xhr.responseJSON.message.berkaspinjaman_lain){
                        $('#berkaspinjaman_lain').addClass('is-invalid');
                        $('#spanberkaspinjaman_lain').html(xhr.responseJSON.message.berkaspinjaman_lain);
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