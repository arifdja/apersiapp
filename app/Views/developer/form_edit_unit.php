<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Unit</h3>
                    </div>
                    <form id="formEditUnit">
                        <input type="hidden" id="<?= csrf_token() ?>" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>"/>
                        <input type="hidden" name="uuid" value="<?= $unit['uuid'] ?>">
                        <input type="hidden" name="uuidheader" value="<?= $uuidheader ?>">
                        
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nomor Sertifikat per Unit</label>
                                <input type="text" class="form-control" name="sertifikat" value="<?= $unit['sertifikat'] ?>" id="sertifikat" disabled>
                                <div class="invalid-feedback"></div>
                                <span id="spansertifikat" style="color: red;"></span>
                                <div class="input-group" style="margin-top: 10px;">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="berkassertifikat" id="berkassertifikat" accept=".pdf" disabled>
                                        <label class="custom-file-label labelberkassertifikat" for="exampleInputFile">Unggah Sertifikat</label>
                                    </div>
                                </div>
                                <div class="text-muted">
                                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah file</small><br>
                                    <small>Format file yang diizinkan: PDF</small>,
                                    <small>Maksimal ukuran file: 10 MB</small>
                                </div>
                                <span id="spanberkassertifikat" style="color: red;"></span>
                            </div>

                            <div class="form-group">
                                <label for="pbgimb">PBG/IMB</label>
                                <div class="input-group" style="margin-top: 10px;">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="berkaspbgimb" id="berkaspbgimb" accept=".pdf">
                                        <label class="custom-file-label labelberkaspbgimb" for="exampleInputFile">Unggah PBG/IMB</label>
                                    </div>
                                </div>
                                <div class="text-muted">
                                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah file</small><br>
                                    <small>Format file yang diizinkan: PDF</small>,
                                    <small>Maksimal ukuran file: 10 MB</small>
                                </div>
                                <span id="spanberkaspbgimb" style="color: red;"></span>
                            </div>

                            <div class="form-group">
                                <label>Nomor PBB per Unit</label>
                                <input type="text" class="form-control" name="pbb" value="<?= $unit['pbb'] ?>" id="pbb" required>
                                <div class="invalid-feedback"></div>
                                <span id="spanpbb" style="color: red;"></span>
                                <div class="input-group" style="margin-top: 10px;">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="berkaspbb" id="berkaspbb" accept=".pdf">
                                        <label class="custom-file-label labelberkaspbb" for="exampleInputFile">Unggah PBB tahun terakhir</label>
                                    </div>
                                </div>
                                <div class="text-muted">
                                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah file</small><br>
                                    <small>Format file yang diizinkan: PDF</small>,
                                    <small>Maksimal ukuran file: 10 MB</small>
                                </div>
                                <span id="spanberkaspbb" style="color: red;"></span>
                            </div>

                            <div class="form-group">
                                <label>Harga Sesuai Persetujuan Kredit (SP3K) per Unit</label>
                                <input type="number" class="form-control" name="harga" value="<?= $unit['harga'] ?>">
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="form-group">
                                <label>Nilai Dana Talangan per Unit Maksimal 70% dari harga sesuai persetujuan kredit (SP3K)</label>
                                <input type="number" class="form-control" id="nilaikredit" name="nilaikredit" value="<?= $unit['nilaikredit'] ?>">
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="form-group">
                                <label for="provinsi">Provinsi</label>  
                                <?= create_dropdown('provinsi', $dropdownprovinsi['provinsi'], $unit['provinsi'], ['class' => 'form-control', 'id' => 'provinsi','required' => 'required']); ?>
                                <span id="spanprovinsi" style="color: red;"></span>
                            </div>

                            <div class="form-group">
                                <label for="kabupaten">Kabupaten/Kota</label>
                                <select id="kabupaten" name="kabupaten" class="form-control" required>
                                    <?php foreach($dropdownkabupaten['kabupaten'] as $key => $value): ?>
                                        <option value="<?= $key ?>" <?= ($key == $unit['kabupaten']) ? 'selected' : '' ?>><?= $value ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span id="spankabupaten" style="color: red;"></span>
                            </div>

                            <div class="form-group">
                                <label for="kota">Kecamatan</label>
                                <select id="kota" name="kota" class="form-control" required>
                                    <?php foreach($dropdownkota['kota'] as $key => $value): ?>
                                        <option value="<?= $key ?>" <?= ($key == $unit['kota']) ? 'selected' : '' ?>><?= $value ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span id="spankota" style="color: red;"></span>
                            </div>

                            <div class="form-group">
                                <label for="kecamatan">Kelurahan</label>
                                <select id="kecamatan" name="lokasiref" class="form-control" required>
                                    <?php foreach($dropdownkecamatan['kecamatan'] as $key => $value): ?>
                                        <option value="<?= $key ?>" <?= ($key == $unit['kecamatan']) ? 'selected' : '' ?>><?= $value ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="detail_alamat">Detail Alamat</label>
                                <textarea id="detail_alamat" name="detail_alamat" class="form-control" rows="3" placeholder="Masukkan detail alamat seperti nama jalan, nomor rumah, RT/RW" required><?= $unit['alamatinput'] ?></textarea>
                                <span id="spanalamat" style="color: red;"></span>
                            </div>


                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card card-info">
                        <div class="card-body">

                        
                            
                        <div class="form-group">
                                <label for="sp3k">Dokumen SP3K per Unit</label>
                                <input type="text" name="sp3k" class="form-control" id="sp3k" placeholder="Nomor Dokumen SP3K" value="<?= $unit['nomordokumensp3k'] ?>" disabled>
                                <div class="invalid-feedback"></div>
                                <span id="spansp3k" style="color: red;"></span>
                                <div class="input-group" style="margin-top: 10px;">
                                    <input type="date" disabled name="tanggalsp3k" class="form-control" id="tanggalsp3k" value="<?= $unit['tanggalsp3k'] ?>">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="input-group" style="margin-top: 10px;">
                                    <div class="custom-file">
                                        <input type="file" disabled class="custom-file-input" name="berkassp3k" id="berkassp3k" accept=".pdf">
                                        <label class="custom-file-label labelberkassp3k" for="exampleInputFile">Unggah Dokumen SP3K</label>
                                    </div>
                                </div>
                                <div class="text-muted">
                                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah file</small><br>
                                    <small>Format file yang diizinkan: PDF</small>,
                                    <small>Maksimal ukuran file: 10 MB</small>
                                </div>
                                <span id="spanberkassp3k" style="color: red;"></span>
                            </div>


                            <div class="form-group">
                                <label>Nama Debitur SP3K</label>
                                <input type="text" class="form-control" name="debitur" value="<?= $unit['namadebitur'] ?>" id="debitur" required>
                                <div class="invalid-feedback"></div>
                                <span id="spannamadebitur" style="color: red;"></span>
                                <div class="input-group" style="margin-top: 10px;">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="berkasktpdebitur" id="berkasktpdebitur" accept=".pdf">
                                        <label class="custom-file-label labelberkasktpdebitur" for="exampleInputFile">Unggah KTP Debitur</label>
                                    </div>
                                </div>
                                <div class="text-muted">
                                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah file</small><br>
                                    <small>Format file yang diizinkan: PDF</small>,
                                    <small>Maksimal ukuran file: 10 MB</small>
                                </div>
                                <span id="spanberkasktpdebitur" style="color: red;"></span>
                            </div>

                            <div class="form-group">
                                <label for="pinjaman_kpl">Potongan KPL</label>
                                <input type="number" name="pinjaman_kpl" class="form-control" id="pinjaman_kpl" placeholder="Total Potongan KPL" value="<?= $unit['pinjamankpl'] ?>">
                                <span id="spanpinjaman_kpl" style="color: red;"></span>
                                <div class="input-group" style="margin-top: 10px;">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="berkaspinjaman_kpl" id="berkaspinjaman_kpl" value="<?= $unit['berkaspinjamankpl'] ?>" accept=".pdf">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                </div>
                                <div class="text-muted">
                                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah file</small><br>
                                    <small>Format file yang diizinkan: PDF</small>,
                                    <small>Maksimal ukuran file: 10 MB</small>
                                </div>
                                <span id="spanberkaspinjaman_kpl" style="color: red;"></span>
                            </div>

                            <div class="form-group">
                                <label for="pinjaman_kyg">Potongan KYG</label>
                                <input type="number" name="pinjaman_kyg" class="form-control" id="pinjaman_kyg" placeholder="Total Potongan KYG" value="<?= $unit['pinjamankyg'] ?>">
                                <span id="spanpinjaman_kyg" style="color: red;"></span>
                                <div class="input-group" style="margin-top: 10px;">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="berkaspinjaman_kyg" id="berkaspinjaman_kyg" value="<?= $unit['berkaspinjamankyg'] ?>" accept=".pdf">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                </div>
                                <div class="text-muted">
                                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah file</small><br>
                                    <small>Format file yang diizinkan: PDF</small>,
                                    <small>Maksimal ukuran file: 10 MB</small>
                                </div>
                                <span id="spanberkaspinjaman_kyg" style="color: red;"></span>
                            </div>

                            <div class="form-group">
                                <label for="pinjaman_lain">Potongan Lain</label>
                                <input type="number" name="pinjaman_lain" class="form-control" id="pinjaman_lain" placeholder="Total Potongan Lain" value="<?= $unit['pinjamanlain'] ?>">
                                <span id="spanpinjaman_lain" style="color: red;"></span>
                                <div class="input-group" style="margin-top: 10px;">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="berkaspinjaman_lain" id="berkaspinjaman_lain" value="<?= $unit['berkaspinjamanlain'] ?>" accept=".pdf">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                </div>
                                <div class="text-muted">
                                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah file</small><br>
                                    <small>Format file yang diizinkan: PDF</small>,
                                    <small>Maksimal ukuran file: 10 MB</small>
                                </div>
                                <span id="spanberkaspinjaman_lain" style="color: red;"></span>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="<?= site_url('developer/monitoring_detail_pengajuan_dana?uuid='.$uuidheader) ?>" class="btn btn-default">Kembali</a>
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
$(document).ready(function() {

     // Mencegah input titik pada input number
     $('input[type="number"]').on('keydown', function(e) {
            // Izinkan: backspace, delete, tab, escape, enter, titik
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13]) !== -1 ||
                // Izinkan: Ctrl+A, Command+A
                (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                // Izinkan: home, end, left, right, down, up
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                return;
            }
            // Pastikan itu angka dan hentikan keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });


    $('#formEditUnit').on('submit', function(e) {
        e.preventDefault();
        
         // Create FormData object
            var formData = new FormData(this);

            if($('#nilaikredit').val() > $('#harga').val()*0.7){
              Swal.fire({
                  title: 'Perhatian!',
                  text: 'Nilai dana talangan tidak boleh lebih besar dari 70% dari harga sesuai persetujuan kredit (SP3K)!',
                  icon: 'warning',
                  confirmButtonText: 'Ok'
              });
              return false;
            }

            var kpl = parseInt($('#pinjaman_kpl').val()) || 0;
            var kyg = parseInt($('#pinjaman_kyg').val()) || 0;
            var lain = parseInt($('#pinjaman_lain').val()) || 0;

            // alert($('#nilaikredit').val());return false;

            if((kpl + kyg + lain) >= $('#nilaikredit').val()){
              Swal.fire({
                  title: 'Perhatian!',
                  text: 'Total Potongan KPL, KYG, dan Lain tidak boleh lebih besar dari Nilai Dana Talangan',
                  icon: 'warning',
                  confirmButtonText: 'Ok'
              });
              $('#nilaikredit').addClass('is-invalid');
              $('#pinjaman_kpl').addClass('is-invalid');
              $('#pinjaman_kyg').addClass('is-invalid');
              $('#pinjaman_lain').addClass('is-invalid');
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


        
        $.ajax({
            url: "<?= site_url('developer/edit_unit_ajax') ?>",
            type: "POST", 
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if(response.status == 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                        window.location.href = '<?= site_url('developer/monitoring_detail_pengajuan_dana?uuid='.$uuidheader) ?>';
                    });
                }
            },
            error: function(xhr, status, error) {
                  $('span[id^="span"]').text('');
                  $('.is-invalid').removeClass('is-invalid');
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
                Swal.close();
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
                Swal.close();
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
                Swal.close();
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
<?= $this->endSection(); ?>