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
                                <label>Nomor Sertifikat</label>
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
                                <label>Nomor PBB</label>
                                <input type="text" class="form-control" name="pbb" value="<?= $unit['pbb'] ?>" id="pbb" required>
                                <div class="invalid-feedback"></div>
                                <span id="spanpbb" style="color: red;"></span>
                                <div class="input-group" style="margin-top: 10px;">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="berkaspbb" id="berkaspbb" accept=".pdf">
                                    <label class="custom-file-label labelberkaspbb" for="exampleInputFile">Unggah PBB</label>
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
                                <label>Harga Sesuai Persetujuan Kredit (SP3K)</label>
                                <input type="number" class="form-control" name="harga" value="<?= $unit['harga'] ?>">
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="form-group">
                                <label>Nilai Dana Talangan</label>
                                <input type="number" class="form-control" name="nilaikredit" value="<?= $unit['nilaikredit'] ?>">
                                <div class="invalid-feedback"></div>
                            </div>

                            
                            <div class="form-group">
                            <label for="provinsi">Provinsi</label>  
                            <?= create_dropdown('provinsi', $dropdownprovinsi['provinsi'], $unit['provinsi'], ['class' => 'form-control', 'id' => 'provinsi','required' => 'required']); ?>
                            <span id="spanprovinsi" style="color: red;"></span>
                            </div>
                            <div class="form-group">
                            <label for="kabupaten">Kabupaten</label>
                            <select id="kabupaten" name="kabupaten" class="form-control" required>
                                <?php foreach($dropdownkabupaten['kabupaten'] as $key => $value): ?>
                                    <option value="<?= $key ?>" <?= ($key == $unit['kabupaten']) ? 'selected' : '' ?>><?= $value ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span id="spankabupaten" style="color: red;"></span>
                            </div>
                            <div class="form-group">
                            <label for="kota">Kota</label>
                            <select id="kota" name="kota" class="form-control" required>
                                <?php foreach($dropdownkota['kota'] as $key => $value): ?>
                                    <option value="<?= $key ?>" <?= ($key == $unit['kota']) ? 'selected' : '' ?>><?= $value ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span id="spankota" style="color: red;"></span>
                            </div>
                            <div class="form-group">
                            <label for="kecamatan">Kecamatan</label>
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
                            
                            <div class="form-group">
                                <label for="sp3k">Dokumen SP3K</label>
                                <input type="text" name="sp3k" class="form-control" id="sp3k" placeholder="Nomor Dokumen SP3K" value="<?= $unit['nomordokumensp3k'] ?>" disabled>
                                <div class="invalid-feedback"></div>
                                <span id="spansp3k" style="color: red;"></span>
                                <div class="input-group" style="margin-top: 10px;">
                                    <input type="date" disabled name="tanggalsp3k" class="form-control" id="tanggalsp3k" value="<?= $unit['tanggalsp3k'] ?>">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="input-group" style="margin-top: 10px;">
                                    <div class="custom-file">
                                        <input type="file"disabled class="custom-file-input" name="berkassp3k" id="berkassp3k" accept=".pdf">
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

                            



                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card card-info">
                        <div class="card-body">

                            <div class="form-group">
                                <label>Nama Debitur</label>
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
                                <label>Bank</label>
                                <?= form_dropdown('bank', $dropdownbank['bank'], $unit['bank'], ['class' => 'form-control', 'id' => 'bank', 'required' => 'required']) ?>
                                <div class="invalid-feedback"></div>
                                <span id="spanbank" style="color: red;"></span>
                            </div>

                            <div class="form-group">
                                <label>Rekening Debitur</label>
                                <input type="text" class="form-control" name="rekening" value="<?= $unit['rekening'] ?>" id="rekening" required>
                                <div class="invalid-feedback"></div>
                                <span id="spanrekening" style="color: red;"></span>
                                <div class="input-group" style="margin-top: 10px;">
                              <div class="custom-file">
                                  <input type="file" class="custom-file-input" name="berkasrekening" id="berkasrekening" accept=".pdf">
                                  <label class="custom-file-label labelberkasrekening" for="exampleInputFile">Unggah Rekening Debitur</label>
                              </div>
                          </div>
                                <div class="text-muted">
                                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah file</small><br>
                                    <small>Format file yang diizinkan: PDF</small>,
                                    <small>Maksimal ukuran file: 10 MB</small>
                          </div>
                          <span id="spanberkasrekening" style="color: red;"></span>
                            </div>

                                
                        <div class="form-group">
                            <label for="pinjaman_kpl">Pinjaman KPL</label>
                            <input type="number" name="pinjaman_kpl" class="form-control" id="pinjaman_kpl" placeholder="Total Pinjaman KPL" value="<?= $unit['pinjamankpl'] ?>" >
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
                            <label for="pinjaman_kyg">Pinjaman KYG</label>
                            <input type="number" name="pinjaman_kyg" class="form-control" id="pinjaman_kyg" placeholder="Total Pinjaman KYG" value="<?= $unit['pinjamankyg'] ?>" >
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
                            <label for="pinjaman_lain">Pinjaman Lain</label>
                            <input type="number" name="pinjaman_lain" class="form-control" id="pinjaman_lain" placeholder="Total Pinjaman Lain" value="<?= $unit['pinjamanlain'] ?>" >
                            <span id="spanpinjaman_lain" style="color: red;"></span>
                            <div class="input-group" style="margin-top: 10px;">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="berkaspinjaman_lain" id="berkaspinjaman_lain"<?= $unit['berkaspinjamanlain'] ?> accept=".pdf">
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
    $('#formEditUnit').on('submit', function(e) {
        e.preventDefault();
        
        var formData = new FormData(this);
        
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
                if(xhr.responseJSON.status == 'error') {
                    // Reset all invalid classes
                    $('.form-control').removeClass('is-invalid');
                    
                    // Add invalid class and show error message for each field
                    Object.keys(xhr.responseJSON.message).forEach(function(key) {
                        $('[name="' + key + '"]').addClass('is-invalid')
                            .siblings('.invalid-feedback')
                            .text(xhr.responseJSON.message[key]);
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
<?= $this->endSection(); ?> 