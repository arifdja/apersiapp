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
            
          <?= form_open_multipart('developer/edit_pt_ajax',['id' => 'formeditpt', 'class' => 'form-horizontal']); ?>
          <input type="hidden" id="<?= csrf_token() ?>" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>"/>
          <input type="hidden" name="uuid" value="<?= $pt['uuid'] ?>"/>
          <div class="form-group">
              <label for="nama_pt">Nama PT</label>
              <input type="text" name="nama_pt" required class="form-control" id="nama_pt" placeholder="Nama PT" value="<?= $pt['namapt'] ?>">
              <span id="spannama_pt" style="color: red;"></span>
            </div>
            <div class="form-group">
              <label for="provinsi">Provinsi</label>  
              <?= create_dropdown('provinsi', $dropdownprovinsi['provinsi'], substr($pt['alamatref'],0,2), ['class' => 'form-control', 'id' => 'provinsi','required' => 'required']); ?>
              <span id="spanprovinsi" style="color: red;"></span>
            </div>
            <div class="form-group">
              <label for="kabupaten">Kabupaten/Kota</label>
              <?= create_dropdown('kabupaten', $dropdownkabupaten['kabupaten'], substr($pt['alamatref'],0,4), ['class' => 'form-control', 'id' => 'kabupaten','required' => 'required']); ?>
              <span id="spankabupaten" style="color: red;"></span>
            </div>
            <div class="form-group">
              <label for="kota">Kecamatan</label>
              <?= create_dropdown('kota', $dropdownkota['kota'], substr($pt['alamatref'],0,6), ['class' => 'form-control', 'id' => 'kota','required' => 'required']); ?>
              <span id="spankota" style="color: red;"></span>
            </div>
            <div class="form-group">
              <label for="kecamatan">Kelurahan</label>
              <?= create_dropdown('lokasiref', $dropdownkecamatan['kecamatan'], $pt['alamatref'], ['class' => 'form-control', 'id' => 'lokasiref','required' => 'required']); ?>
              <span id="spanlokasiref" style="color: red;"></span>
            </div>
            <div class="form-group">
              <label for="detail_alamat">Detail Alamat</label>
              <textarea id="detail_alamat" name="detail_alamat" class="form-control" rows="3" placeholder="Masukkan detail alamat seperti nama jalan, nomor rumah, RT/RW" required><?= $pt['alamatinput'] ?></textarea>
              <span id="spanalamat" style="color: red;"></span>
            </div>
            <div class="form-group">
              <label for="npwp_pt">NPWP PT</label>
              <input type="number" disabled name="npwp_pt" required class="form-control" id="npwp_pt" placeholder="Isi Nomor NPWP PT" value="<?= $pt['npwppt'] ?>">
              <span id="spannpwp_pt" style="color: red;"></span>
              <div class="input-group" style="margin-top: 10px;">
                  <div class="custom-file">
                        <input type="file" class="custom-file-input" name="berkasnpwppt" id="berkasnpwppt" accept=".pdf">
                        <label class="custom-file-label" for="berkasnpwppt">Choose file</label>
                  </div>
              </div>
              <div class="text-muted">
                    <small>Format file yang diizinkan: PDF</small>,
                    <small>Maksimal ukuran file: 1 MB</small>
                    <?php if($pt['berkasnpwp']): ?>
                    <br><small>File saat ini: <?= $pt['berkasnpwp'] ?></small>
                    <?php endif; ?>
              </div>
              <span id="spanberkasnpwppt" style="color: red;"></span>
            </div>
            <div class="form-group">
              <label for="penanggung_jawab_pt">Penanggung Jawab PT</label>
              <input type="text" name="penanggung_jawab_pt" required class="form-control" id="penanggung_jawab_pt" placeholder="Nama Penanggung Jawab PT" value="<?= $pt['namapj'] ?>">
              <span id="spanpenanggung_jawab_pt" style="color: red;"></span>
            </div>
            <div class="form-group">
              <label for="ktp_penanggung_jawab">KTP Penanggung Jawab</label>
              <input type="number" name="ktp_penanggung_jawab" required class="form-control" id="ktp_penanggung_jawab" placeholder="Isi NIK KTP Penanggung Jawab" value="<?= $pt['ktppj'] ?>">
              <span id="spanktp_penanggung_jawab" style="color: red;"></span>
              <div class="input-group" style="margin-top: 10px;">
                  <div class="custom-file">
                        <input type="file" class="custom-file-input" name="berkasktp_penanggung_jawab" id="berkasktp_penanggung_jawab" accept=".pdf">
                        <label class="custom-file-label" for="berkasktp_penanggung_jawab">Choose file</label>
                  </div>
              </div>
              <div class="text-muted">
                    <small>Format file yang diizinkan: PDF</small>,
                    <small>Maksimal ukuran file: 1 MB</small>
                    <?php if($pt['berkasktppj']): ?>
                    <br><small>File saat ini: <?= $pt['berkasktppj'] ?></small>
                    <?php endif; ?>
              </div>
              <span id="spanberasktp_penanggung_jawab" style="color: red;"></span>
            </div>

            <div class="form-group">
              <label for="npwp_penanggung_jawab">NPWP Penanggung Jawab</label>
              <input type="number" name="npwp_penanggung_jawab" required class="form-control" id="npwp_penanggung_jawab" placeholder="Isi Nomor NPWP Penanggung Jawab" value="<?= $pt['npwppj'] ?>">
              <span id="spannpwp_penanggung_jawab" style="color: red;"></span>
              <div class="input-group" style="margin-top: 10px;">
                  <div class="custom-file">
                        <input type="file" class="custom-file-input" name="berkasnpwp_penanggung_jawab" id="berkasnpwp_penanggung_jawab" accept=".pdf">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
              </div>
              <div class="text-muted">
                    <small>Format file yang diizinkan: PDF</small>,
                    <small>Maksimal ukuran file: 1 MB</small>
                    <?php if($pt['berkasnpwppj']): ?>
                    <br><small>File saat ini: <?= $pt['berkasnpwppj'] ?></small>
                    <?php endif; ?>
              </div>
              <span id="spanberkasnpwppj" style="color: red;"></span>
            </div>

          </div>
      </div>
    </div>
  <div class="col-md-6">
  <div class="card card-info">
       
          <div class="card-body">
            <div class="form-group">
              <label for="pengurus_pt">Nama dan Jabatan Pengurus PT</label>
              <textarea name="pengurus_pt" id="pengurus_pt" class="form-control" rows="3" placeholder="Masukkan nama dan jabatan pengurus PT" required><?= $pt['penguruspt'] ?></textarea>
              <span id="spanpengurus_pt" style="color: red;"></span>
            </div>

            <div class="form-group">
              <label for="npwp_pengurus_pt">NPWP Pengurus PT</label>
              <span id="spannpwp_pengurus_pt" style="color: red;"></span>
              <div class="input-group" style="margin-top: 10px;">
                  <div class="custom-file">
                        <input type="file" class="custom-file-input" name="berkasnpwp_pengurus_pt" id="berkasnpwp_pengurus_pt" accept=".pdf">
                        <label class="custom-file-label" for="berkasnpwp_pengurus_pt">Choose file</label>
                  </div>
              </div>
              <div class="text-muted">
                    <small>Format file yang diizinkan: PDF</small>,
                    <small>Maksimal ukuran file: 5 MB</small>
                    <?php if($pt['berkaspengurusptnpwp']): ?>
                    <br><small>File saat ini: <?= $pt['berkaspengurusptnpwp'] ?></small>
                    <?php endif; ?>
              </div>
              <span id="spanberkasnpwp_pengurus_pt" style="color: red;"></span>
            </div>

            <div class="form-group">
              <label for="ktp_pengurus_pt">KTP Pengurus PT</label>
              <span id="spanktp_pengurus_pt" style="color: red;"></span>
              <div class="input-group" style="margin-top: 10px;">
                  <div class="custom-file">
                        <input type="file" class="custom-file-input" name="berkasktp_pengurus_pt" id="berkasktp_pengurus_pt" accept=".pdf">
                        <label class="custom-file-label" for="berkasktp_pengurus_pt">Choose file</label>
                  </div>
              </div>
              <div class="text-muted">
                    <small>Format file yang diizinkan: PDF</small>,
                    <small>Maksimal ukuran file: 5 MB</small>
                    <?php if($pt['berkaspengurusptktp']): ?>
                    <br><small>File saat ini: <?= $pt['berkaspengurusptktp'] ?></small>
                    <?php endif; ?>
              </div>
              <span id="spanberkasktp_pengurus_pt" style="color: red;"></span>
            </div>
            
            <div class="form-group">
              <label for="akta_pendirian">Akta Pendirian</label>
              <input type="text" name="akta_pendirian" required class="form-control" id="akta_pendirian" placeholder="Isi Nomor Akta Pendirian" value="<?= $pt['aktapendirian'] ?>">
              <span id="spanakta_pendirian" style="color: red;"></span>
              <div class="input-group" style="margin-top: 10px;">
                  <div class="custom-file">
                        <input type="file" class="custom-file-input" name="berkasakta_pendirian" id="berkasakta_pendirian" accept=".pdf">
                        <label class="custom-file-label" for="berkasakta_pendirian">Choose file</label>
                  </div>
              </div>
              <div class="text-muted">
                    <small>Format file yang diizinkan: PDF</small>,
                    <small>Maksimal ukuran file: 5 MB</small>
                    <?php if($pt['berkasaktapendirian']): ?>
                    <br><small>File saat ini: <?= $pt['berkasaktapendirian'] ?></small>
                    <?php endif; ?>
              </div>
              <span id="spanberkasakta_pendirian" style="color: red;"></span>
            </div>

            <div class="form-group">
              <label for="skkemenkumham">SK Kemenkumham</label>
              <div class="input-group" style="margin-top: 10px;">
                  <div class="custom-file">
                        <input type="file" class="custom-file-input" name="berkasskkemenkumham" id="berkasskkemenkumham" accept=".pdf">
                        <label class="custom-file-label" for="berkasskkemenkumham">Choose file</label>
                  </div>
              </div>
              <div class="text-muted">
                    <small>Upload SK Kemenkumham</small><br>
                    <small>Format file yang diizinkan: PDF</small>,
                    <small>Maksimal ukuran file: 5 MB</small>
                    <?php if($pt['berkasskkemenkumham']): ?>
                    <br><small>File saat ini: <?= $pt['berkasskkemenkumham'] ?></small>
                    <?php endif; ?>
              </div>
              <span id="spanberkasskkemenkumham" style="color: red;"></span>
            </div>

            <div class="form-group">    
              <label for="bank">Bank (Rekening Operasional)</label>
              <?= create_dropdown('bank', $dropdownbank['bank'], $pt['kodebank'], ['class' => 'form-control', 'id' => 'bank','required' => 'required']); ?>
              <span id="spanbank" style="color: red;"></span>
            </div>
            <div class="form-group">
              <label for="rekening">Nomor Rekening Operasional</label>
              <input type="text" name="rekening" required class="form-control" id="rekening" placeholder="Isi Nomor Rekening Operasional" value="<?= $pt['rekening'] ?>">
              <span id="spanrekening" style="color: red;"></span>
              <div class="input-group" style="margin-top: 10px;">
                  <div class="custom-file">
                        <input type="file" class="custom-file-input" name="berkasrekening" id="berkasrekening" accept=".pdf">
                        <label class="custom-file-label" for="berkasrekening">Choose file</label>
                  </div>
              </div>
              <div class="text-muted">
                    <small>Rekening Koran tiga bulan terakhir</small><br>
                    <small>Format file yang diizinkan: PDF</small>,
                    <small>Maksimal ukuran file: 1 MB</small>
                    <?php if($pt['berkasrekening']): ?>
                    <br><small>File saat ini: <?= $pt['berkasrekening'] ?></small>
                    <?php endif; ?>
              </div>
              <span id="spanberkasrekening" style="color: red;"></span>
            </div>

            <div class="form-group">    
              <label for="bankescrow">Bank (Rekening Escrow)</label>
              <?= create_dropdown('bankescrow', $dropdownbank['bank'], $pt['kodebankescrow'], ['class' => 'form-control', 'id' => 'bankescrow','required' => 'required']); ?>
              <span id="spanbankescrow" style="color: red;"></span>
            </div>
            
            <div class="form-group">
              <label for="rekeningescrow">Nomor Rekening Escrow</label>
              <input type="text" name="rekeningescrow" required class="form-control" id="rekeningescrow" placeholder="Isi Nomor Rekening Escrow" value="<?= $pt['rekeningescrow'] ?>">
              <span id="spanrekeningescrow" style="color: red;"></span>
              <div class="input-group" style="margin-top: 10px;">
                  <div class="custom-file">
                        <input type="file" class="custom-file-input" name="berkasrekeningescrow" id="berkasrekeningescrow" accept=".pdf">
                        <label class="custom-file-label" for="berkasrekeningescrow">Choose file</label>
                  </div>
              </div>
              <div class="text-muted">
                    <small>Rekening Koran tiga bulan terakhir</small><br>
                    <small>Format file yang diizinkan: PDF</small>,
                    <small>Maksimal ukuran file: 1 MB</small>
                    <?php if($pt['berkasrekeningescrow']): ?>
                    <br><small>File saat ini: <?= $pt['berkasrekeningescrow'] ?></small>
                    <?php endif; ?>
              </div>
              <span id="spanberkasrekeningescrow" style="color: red;"></span>
            </div>

            
            <div class="form-group">
                  <label for="dropdowndpd">Pilih DPD/DPP/Korwil</label>  
                  <?= create_dropdown('dpd', $dropdowndpd['dpd'], $pt['dpd'], ['class' => 'form-control', 'id' => 'dropdowndpd']); ?>
                  <span id="spandropdowndpd" style="color: red;"></span>
                </div>

          </div>
          <div class="card-footer">
            <div class="form-group">
              <div class="col-sm-6">
                    <button type="submit" class="btn btn-primary" style="background-color: #35B5FE !important; border:none">Update PT</button>
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
        $('#formeditpt').on('submit', function (e) {
            e.preventDefault();

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

            $.ajax({
                url: "<?= site_url('developer/edit_pt_ajax') ?>",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if(response.status == 'success'){
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 2000
                        }).then(() => {
                            window.location.href = '<?= site_url('developer/monitoring_pengajuan_pt') ?>';
                        });
                    }
                },
                error: function (xhr, status, error) {
                    clearForm();
                    $('#<?= csrf_token() ?>').val(xhr.responseJSON.csrfHash);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal mengupdate data'
                      });
                    
                    if(xhr.responseJSON.status == 'error'){
                        // Reset semua pesan error
                        $('span[id^="span"]').html('');
                        $('input, select, textarea').removeClass('is-invalid');
                        
                        // Tampilkan pesan error
                        $.each(xhr.responseJSON.message, function(field, message) {
                            $('#span' + field).html(message);
                            $('#' + field).addClass('is-invalid');
                        });
                    }
                    
                    $('#<?= csrf_token() ?>').val(xhr.responseJSON.csrfHash);
                }
            });
        });

        // Inisialisasi bs-custom-file-input
        bsCustomFileInput.init();

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
  function clearForm() {
    // Menghapus semua pesan error
    $('span[id^="span"]').html('');
    $('input, select, textarea').removeClass('is-invalid');
  }
</script>
<?= $this->endSection(); ?> 