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
                        <?= csrf_field() ?>
                        <input type="hidden" name="uuid" value="<?= $unit['uuid'] ?>">
                        <input type="hidden" name="uuidheader" value="<?= $uuidheader ?>">
                        
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nomor Sertifikat</label>
                                <input type="text" class="form-control" name="sertifikat" value="<?= $unit['sertifikat'] ?>" id="sertifikat" required>
                                <div class="invalid-feedback"></div>
                                <span id="spansertifikat" style="color: red;"></span>
                                <div class="input-group" style="margin-top: 10px;">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="berkassertifikat" id="berkassertifikat" accept=".pdf">
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
                                <label>Harga</label>
                                <input type="number" class="form-control" name="harga" value="<?= $unit['harga'] ?>">
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="form-group">
                                <label>Nilai Kredit</label>
                                <input type="number" class="form-control" name="nilaikredit" value="<?= $unit['nilaikredit'] ?>">
                                <div class="invalid-feedback"></div>
                            </div>
                            
                            <div class="form-group">
                                <label for="sp3k">Dokumen SP3K</label>
                                <input type="text" name="sp3k" required class="form-control" id="sp3k" placeholder="Nomor Dokumen SP3K" value="<?= $unit['nomordokumensp3k'] ?>" required>
                                <div class="invalid-feedback"></div>
                                <span id="spansp3k" style="color: red;"></span>
                                <div class="input-group" style="margin-top: 10px;">
                                    <input type="date" name="tanggalsp3k" required class="form-control" id="tanggalsp3k" value="<?= $unit['tanggalsp3k'] ?>">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="input-group" style="margin-top: 10px;">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="berkassp3k" id="berkassp3k" accept=".pdf">
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
                                <label>Nomor Rekening</label>
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
<?= $this->endSection(); ?> 