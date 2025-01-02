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
            <?= form_open_multipart('developer/pengajuan_pt', ['id' => 'formpengajuanpt', 'class' => 'form-horizontal']); ?>
            <input type="hidden" id="<?= csrf_token() ?>" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>"/>
            
            <div class="form-group">
              <label for="nama_pt">Nama PT</label>
              <input type="text" name="nama_pt" required class="form-control" id="nama_pt" placeholder="Nama PT">
              <span id="spannama_pt" style="color: red;"></span>
            </div>

            <div class="form-group">
              <label for="provinsi">Provinsi</label>  
              <?= create_dropdown('provinsi', $dropdownprovinsi['provinsi'], old('provinsi'), ['class' => 'form-control', 'id' => 'provinsi', 'required' => 'required']); ?>
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
              <select id="lokasiref" name="lokasiref" class="form-control" required>
                  <option value="" selected disabled>Pilih Kelurahan</option>
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
              <input type="number" name="npwp_pt" required class="form-control" id="npwp_pt" placeholder="Isi Nomor NPWP PT" value="<?= old('npwp_pt') ?>">
              <span id="spannpwp_pt" style="color: red;"></span>
              <div class="input-group mt-2">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="berkasnpwppt" id="berkasnpwppt" accept=".pdf" required>
                  <label class="custom-file-label" for="berkasnpwppt">Choose file</label>
                </div>
              </div>
              <div class="text-muted">
                    <small>NPWP harus berisi 15/16 digit angka tanpa titik atau -</small><br>
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
              <input type="number" name="ktp_penanggung_jawab" required class="form-control" id="ktp_penanggung_jawab" placeholder="Isi NIK KTP Penanggung Jawab" value="<?= old('ktp_penanggung_jawab') ?>">
              <span id="spanktp_penanggung_jawab" style="color: red;"></span>
              <div class="input-group mt-2">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="berkasktp_penanggung_jawab" id="berkasktp_penanggung_jawab" accept=".pdf" required>
                  <label class="custom-file-label" for="berkasktp_penanggung_jawab">Choose file</label>
                </div>
              </div>
              <div class="text-muted">
                <small>NIK harus berisi 16 digit angka</small><br>
                <small>Format file yang diizinkan: PDF</small>,
                <small>Maksimal ukuran file: 1 MB</small>
              </div>
              <span id="spanberasktp_penanggung_jawab" style="color: red;"></span>
            </div>

            <div class="form-group">
              <label for="npwp_penanggung_jawab">NPWP Penanggung Jawab</label>
              <input type="number" name="npwp_penanggung_jawab" required class="form-control" id="npwp_penanggung_jawab" placeholder="Isi Nomor NPWP Penanggung Jawab" value="<?= old('npwp_penanggung_jawab') ?>">
              <span id="spannpwp_penanggung_jawab" style="color: red;"></span>
              <div class="input-group mt-2">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="berkasnpwp_penanggung_jawab" id="berkasnpwp_penanggung_jawab" accept=".pdf" required>
                  <label class="custom-file-label" for="berkasnpwp_penanggung_jawab">Choose file</label>
                </div>
              </div>
              <div class="text-muted">
              <small>NPWP harus berisi 15/16 digit angka tanpa titik atau -</small><br>
                <small>Format file yang diizinkan: PDF</small>,
                <small>Maksimal ukuran file: 1 MB</small>
              </div>
              <span id="spanberkasnpwp_penanggung_jawab" style="color: red;"></span>
            </div>

          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card card-info">
          <div class="card-body">
            <div class="form-group">
              <label for="pengurus_pt">Nama dan Jabatan Pengurus PT</label>
              <textarea name="pengurus_pt" id="pengurus_pt" class="form-control" rows="3" placeholder="Masukkan nama dan jabatan pengurus PT" required></textarea>
              <span id="spanpengurus_pt" style="color: red;"></span>
            </div>

            <div class="form-group">
              <label for="npwp_pengurus_pt">NPWP Pengurus PT</label>
              <span id="spannpwp_pengurus_pt" style="color: red;"></span>
              <div class="input-group mt-2">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="berkasnpwp_pengurus_pt" id="berkasnpwp_pengurus_pt" accept=".pdf" required>
                  <label class="custom-file-label" for="berkasnpwp_pengurus_pt">Choose file</label>
                </div>
              </div>
              <div class="text-muted">
                    <small>Upload semua NPWP pengurus PT (dijadikan satu file)</small><br>
                    <small>Format file yang diizinkan: PDF</small>,
                    <small>Maksimal ukuran file: 5 MB</small>
              </div>
              <span id="spanberkasnpwp_pengurus_pt" style="color: red;"></span>
            </div>

            <div class="form-group">
              <label for="ktp_pengurus_pt">KTP Pengurus PT</label>
              <span id="spanktp_pengurus_pt" style="color: red;"></span>
              <div class="input-group mt-2">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="berkasktp_pengurus_pt" id="berkasktp_pengurus_pt" accept=".pdf" required>
                  <label class="custom-file-label" for="berkasktp_pengurus_pt">Choose file</label>
                </div>
              </div>
              <div class="text-muted">
                    <small>Upload semua KTP pengurus PT (dijadikan satu file)</small><br>
                    <small>Format file yang diizinkan: PDF</small>,
                    <small>Maksimal ukuran file: 5 MB</small>
              </div>
              <span id="spanberkasktp_pengurus_pt" style="color: red;"></span>
            </div>

            <div class="form-group">
              <label for="akta_pendirian">Akta Pendirian</label>
              <div class="input-group mt-2">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="berkasakta_pendirian" id="berkasakta_pendirian" accept=".pdf" required>
                  <label class="custom-file-label" for="berkasakta_pendirian">Choose file</label>
                </div>
              </div>
              <div class="text-muted">
                <small>Format file yang diizinkan: PDF</small>,
                <small>Maksimal ukuran file: 5 MB</small>
              </div>
              <span id="spanberkasakta_pendirian" style="color: red;"></span>
            </div>

            <div class="form-group">
              <label for="skkemenkumham">SK Kemenkumham</label>
              <div class="input-group mt-2">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="berkasskkemenkumham" id="berkasskkemenkumham" accept=".pdf" required>
                  <label class="custom-file-label" for="berkasskkemenkumham">Choose file</label>
                </div>
              </div>
              <div class="text-muted">
                    <small>Upload SK Kemenkumham</small><br>
                    <small>Format file yang diizinkan: PDF</small>,
                    <small>Maksimal ukuran file: 5 MB</small>
              </div>
              <span id="spanberkasskkemenkumham" style="color: red;"></span>
            </div>

            

            <div class="form-group">
              <label for="laporankeuangan">Laporan Keuangan 2 Tahun Terakhir</label>
              <div class="input-group mt-2">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="berkaslaporankeuangan" id="berkaslaporankeuangan" accept=".pdf" required>
                  <label class="custom-file-label" for="berkaslaporankeuangan">Choose file</label>
                </div>
              </div>
              <div class="text-muted">
                    <small>Upload Laporan Keuangan 2 Tahun Terakhir</small><br>
                    <small>Format file yang diizinkan: PDF</small>,
                    <small>Maksimal ukuran file: 10 MB</small>
              </div>
              <span id="spanberkaslaporankeuangan" style="color: red;"></span>
            </div>

            

           

            <div class="form-group">    
              <label for="bank">Bank</label>
              <?= create_dropdown('bank', $dropdownbank['bank'], old('bank'), ['class' => 'form-control', 'id' => 'bank', 'required' => 'required']); ?>
              <span id="spanbank" style="color: red;"></span>
            </div>

            <div class="form-group">
              <label for="rekeningescrow">Nomor Rekening Escrow</label>
              <input type="text" name="rekeningescrow" required class="form-control" id="rekeningescrow" placeholder="Isi Nomor Rekening Escrow" value="<?= old('rekeningescrow') ?>">
              <span id="spanrekeningescrow" style="color: red;"></span>
              <div class="input-group mt-2">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="berkasrekeningescrow" id="berkasrekeningescrow" accept=".pdf" required>
                  <label class="custom-file-label" for="berkasrekeningescrow">Choose file</label>
                </div>
              </div>
              <div class="text-muted">
                    <small>Rekening Koran tiga bulan terakhir</small><br>
                    <small>Format file yang diizinkan: PDF</small>,
                    <small>Maksimal ukuran file: 1 MB</small>
              </div>
              <span id="spanberkasrekeningescrow" style="color: red;"></span>
            </div>

            <div class="form-group">
              <label for="rekening">Nomor Rekening Operasional</label>
              <input type="text" name="rekening" required class="form-control" id="rekening" placeholder="Isi Nomor Rekening Operasional" value="<?= old('rekening') ?>">
              <span id="spanrekening" style="color: red;"></span>
              <div class="input-group mt-2">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="berkasrekening" id="berkasrekening" accept=".pdf" required>
                  <label class="custom-file-label" for="berkasrekening">Choose file</label>
                </div>
              </div>
              <div class="text-muted">
                    <small>Rekening Koran tiga bulan terakhir</small><br>
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
  </div>
</div>
</section>

<?= $this->endSection(); ?>

<?= $this->section('south'); ?>

<script>
$(document).ready(function () {
  $('#formpengajuanpt').on('submit', function (e) {
    e.preventDefault(); // Prevent the default form submission

            // Create FormData object
            var formData = new FormData(this);

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
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal menyimpan data'
                      });
                    
                    $('#<?= csrf_token() ?>').val(xhr.responseJSON.csrfHash);
                   
                    $('span[id^="span"]').html('');
                    $('.is-invalid').removeClass('is-invalid');
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
                      if(xhr.responseJSON.message.berkasakta_pendirian_akhir){
                        $('#berkasakta_pendirian_akhir').addClass('is-invalid');
                        $('#spanberkasakta_pendirian_akhir').html(xhr.responseJSON.message.berkasakta_pendirian_akhir);
                      }
                      if(xhr.responseJSON.message.berkasskkemenkumham){
                        $('#berkasskkemenkumham').addClass('is-invalid');
                        $('#spanberkasskkemenkumham').html(xhr.responseJSON.message.berkasskkemenkumham);
                      }
                      if(xhr.responseJSON.message.berkasskkemenkumham_akhir){
                        $('#berkasskkemenkumham_akhir').addClass('is-invalid');
                        $('#spanberkasskkemenkumham_akhir').html(xhr.responseJSON.message.berkasskkemenkumham_akhir);
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
                      if(xhr.responseJSON.message.bankescrow){
                        $('#bankescrow').addClass('is-invalid');
                        $('#spanbankescrow').html(xhr.responseJSON.message.bankescrow);
                      }
                      if(xhr.responseJSON.message.rekeningescrow){
                        $('#rekeningescrow').addClass('is-invalid');
                        $('#spanrekeningescrow').html(xhr.responseJSON.message.rekeningescrow);
                      }
                      if(xhr.responseJSON.message.berkasrekeningescrow){
                        $('#berkasrekeningescrow').addClass('is-invalid');
                        $('#spanberkasrekeningescrow').html(xhr.responseJSON.message.berkasrekeningescrow);
                      }
                      if(xhr.responseJSON.message.berkaslaporankeuangan){
                        $('#berkaslaporankeuangan').addClass('is-invalid');
                        $('#spanberkaslaporankeuangan').html(xhr.responseJSON.message.berkaslaporankeuangan);
                      }
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

            Swal.fire({
                title: 'Mohon Tunggu',
                html: 'Sedang memproses data...',
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    // Swal.showLoading()
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
                            Swal.close();
                        },
                        error: function () {
                          Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Gagal memuat data kabupaten/kota. Silakan coba lagi.'
                          });
                        }
                    });
                    //end willopen
                },
            });

        });

        $('#kabupaten').change(function () {
          
            let csrfName = '<?= csrf_token() ?>';
            let csrfHash = $('#<?= csrf_token() ?>').val();
            let kabupatenId = $(this).val();

            Swal.fire({
                title: 'Mohon Tunggu',
                html: 'Sedang memproses data...',
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading()
                },
            });

            // Clear kabupaten_kota dropdown
            $('#kota').html('<option value="" selected disabled>Loading...</option>');
            $('#kecamatan').html('<option value="" selected disabled>Loading...</option>');
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
                  Swal.close();
                 
                },
                error: function () {
                  Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Gagal memuat data kelurahan. Silakan coba lagi.'
                  });
                }
            });
        });
        
        $('#kota').change(function () {

            let csrfName = '<?= csrf_token() ?>';
            let csrfHash = $('#<?= csrf_token() ?>').val();
            let kotaId = $(this).val();

            Swal.fire({
                title: 'Mohon Tunggu',
                html: 'Sedang memproses data...',
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading()
                },
            });

            // Clear kabupaten_kota dropdown
            $('#kecamatan').html('<option value="" selected disabled>Loading...</option>');
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
                  $('#lokasiref').html(options);
                  $('#<?= csrf_token() ?>').val(response.csrfHash);
                  
                  Swal.close();

                },
                error: function () {
                  $('#kabupaten').val(oldKabupatenSelection);
                  $('#kota').val(oldKotaSelection);
                  $('#lokasiref').val(oldKecamatanSelection);
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
<script>
function clearForm() {
  // Menghapus semua pesan error
  $('#spannama_pt').html('');
  $('#spanprovinsi').html('');
  $('#spankabupaten').html('');
  $('#spankota').html('');
  $('#spanlokasiref').html('');
  $('#spanalamat').html('');
  $('#spannpwp_pt').html('');
  $('#spanberkasnpwppt').html('');
  $('#spanpenanggung_jawab_pt').html('');
  $('#spanktp_penanggung_jawab').html('');
  $('#spanberkasktp_penanggung_jawab').html('');
  $('#spannpwp_penanggung_jawab').html('');
  $('#spanberkasnpwp_penanggung_jawab').html('');
  $('#spanpengurus_pt').html('');
  $('#spanjabatan_pengurus_pt').html('');
  $('#spanbank').html('');
  $('#spanrekening').html('');
  $('#spanberkasrekening').html('');
  $('#spanbankescrow').html('');
  $('#spanrekeningescrow').html('');
  $('#spanberkasrekeningescrow').html('');

  // Menghapus class is-invalid
  $('#nama_pt').removeClass('is-invalid');
  $('#provinsi').removeClass('is-invalid');
  $('#kabupaten').removeClass('is-invalid'); 
  $('#kota').removeClass('is-invalid');
  $('#lokasiref').removeClass('is-invalid');
  $('#detail_alamat').removeClass('is-invalid');
  $('#npwp_pt').removeClass('is-invalid');
  $('#berkasnpwppt').removeClass('is-invalid');
  $('#penanggung_jawab_pt').removeClass('is-invalid');
  $('#ktp_penanggung_jawab').removeClass('is-invalid');
  $('#berkasktp_penanggung_jawab').removeClass('is-invalid');
  $('#npwp_penanggung_jawab').removeClass('is-invalid');
  $('#berkasnpwp_penanggung_jawab').removeClass('is-invalid');
  $('#pengurus_pt').removeClass('is-invalid');
  $('#jabatan_pengurus_pt').removeClass('is-invalid');
  $('#bank').removeClass('is-invalid');
  $('#rekening').removeClass('is-invalid');
  $('#berkasrekening').removeClass('is-invalid');
  $('#bankescrow').removeClass('is-invalid');
  $('#rekeningescrow').removeClass('is-invalid');
  $('#berkasrekeningescrow').removeClass('is-invalid');
}
</script>

<?= $this->endSection(); ?>