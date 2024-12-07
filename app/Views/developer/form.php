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

                <div class="form-group">
                  <label for="kta">Kartu Tanda Anggota (KTA)</label>
                  <a href="<?= base_url('downloadkta/'.session('berkaskta')) ?>" class="form-control" style="text-decoration: none; background-color: #e9ecef;"><?= session('kta') ?></a>
                  <span id="spankta" style="color: red;"></span>
                </div>

                <div class="form-group">
                  <label for="dropdownpt">Pilih PT</label>  
                  <?= create_dropdown('dropdownpt', $dropdownpt['pt'], old('dropdownpt'), ['class' => 'form-control', 'id' => 'dropdownpt','required' => 'required']); ?>
                  <span id="spandropdownpt" style="color: red;"></span>
                </div>

                <div id="divberkas" class="form-group">
                  <a href="<?= base_url('download/akta_pendirian/'.session('berkasakta')) ?>" class="form-control" style="text-decoration: none; background-color: #e9ecef;">Akta Pendirian : </a>

                  <a href="<?= base_url('download/npwp_pt/'.session('berkasnpwp')) ?>" class="form-control" style="text-decoration: none; background-color: #e9ecef;margin-top:10px;">NPWP PT : </a>
                  
                  <a href="<?= base_url('download/ktp_penanggung_jawab/'.session('berkasktp')) ?>" class="form-control" style="text-decoration: none; background-color: #e9ecef;margin-top:10px;">Penanggung Jawab : </a>
                  
                  <a href="<?= base_url('download/npwp_penanggung_jawab/'.session('berkasnpwp')) ?>" class="form-control" style="text-decoration: none; background-color: #e9ecef;margin-top:10px;">NPWP Penanggung Jawab : </a>

                  <a href="<?= base_url('downloadkta/'.session('berkaskta')) ?>" class="form-control" style="text-decoration: none; background-color: #e9ecef;margin-top:10px;">Pinjaman KPL : <?= session('kta') ?></a>

                  <a href="<?= base_url('downloadkta/'.session('berkaskta')) ?>" class="form-control" style="text-decoration: none; background-color: #e9ecef;margin-top:10px;">Pinjaman KPG : <?= session('kta') ?></a>
                  
                  <a href="<?= base_url('downloadkta/'.session('berkaskta')) ?>" class="form-control" style="text-decoration: none; background-color: #e9ecef;margin-top:10px;">Pinjaman Lain : <?= session('kta') ?></a>
                </div>

               
            <div class="form-group">
              <label for="suratpermohonan">Permohonan Pengajuan Pinjaman</label>
              <input type="text" name="suratpermohonan" required class="form-control" id="suratpermohonan" placeholder="Berkas Permohonan Pengajuan Pinjaman" required>
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

            
            



            
            <div class="form-group">
                  <label for="aktapendirian">Akta Pendirian</label>
                  <a href="<?= base_url('downloadakta/'.session('berkasakta')) ?>" class="form-control" style="text-decoration: none; background-color: #e9ecef;"><?= session('akta') ?></a>
                  <span id="spanaktapendirian" style="color: red;"></span>
                </div>

                
            <div class="form-group">
                  <label for="namapj">Nama Penanggung Jawab</label>
                  <a href="<?= base_url('downloadkta/'.session('berkaskta')) ?>" class="form-control" style="text-decoration: none; background-color: #e9ecef;"><?= session('kta') ?></a>
                  <span id="spankta" style="color: red;"></span>
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
                    <label for="exampleInputFile">Akta Pendirian</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="kta">Nama PT</label>
                    <input type="text" class="form-control" id="kta" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="kta">NPWP Perusahaan</label>
                    <input type="text" class="form-control" id="kta" placeholder="">
                    <div class="input-group" style="margin-top: 10px;">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="kta">Penanggung Jawab PT</label>
                    <input type="text" class="form-control" id="kta" placeholder="">
                  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                </div>
              </form>
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
                    <label for="kta">KTP Penanggung Jawab</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="kta">NPWP Penanggung Jawab</label>
                    <input type="text" class="form-control" id="kta" placeholder="">
                    <div class="input-group" style="margin-top: 10px;">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div>
                  
                  <div class="form-group">
                        <label>DPP/DPD/Korwil</label>
                        <select class="form-control">
                          <option>Jawa Barat</option>
                          <option>Jawa Tengah</option>
                          <option>Jawa Timur</option>
                        </select>
                      </div>


                  <div class="form-group">
                    <label for="kta">Lokasi Perumahan</label>
                    <input type="text" class="form-control" id="kta" placeholder="">
                  </div>


                  <div class="form-group">
                    <label for="kta">Site Plan</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="kta">Jumlah Unit yang diagunkan</label>
                    <input type="text" class="form-control" id="kta" placeholder="">
                  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                </div>
              </form>
            </div>
          </div>


          <div class="col-md-12">
          <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Detil Pengajuan</h3>

                
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-2" style="height: 500px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Sertifikat</th>
                      <th>PBB Tahun Terakhir</th>
                      <th>Harga Sesuai SP3K</th>
                      <th>Nilai Kredit yang diajukan</th>
                      <th>Nomor Dokumen SP3K</th>
                      <th>Tanggal SP3K</th>
                      <th>Dokumen SP3K per Debitur</th>
                      <th>Nama Sesuai KTP calon Debitur di SP3K</th>
                      <th>KTP calon Debitur di SP3K</th>
                      <th>Bank Penerbit SP3K</th>
                      <th>No Rekening Perusahaan</th>
                      <th>Bukti dan Nilai Pinjaman KPL</th>
                      <th>Bukti dan Nilai Pinjaman KYG</th>
                      <th>Bukti dan Nilai Pinjaman Lain</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php for ($i=0; $i < 10; $i++) { ?>
                    <tr>
                      <td><?= $i+1 ?></td>
                      <td><input type="file" id="sertifikat" name="sertifikat" accept="pdf" /></td>
                      <td><input type="file" id="pbb" name="pbb" accept="pdf" /></td>
                      <td><input type="number" id="harga" name="harga" /></td>
                      <td><input type="number" id="nilai-kredit" name="nilai-kredit" /></td>
                      <td><input type="text" id="nomor-sp3k" name="nomor-sp3k" /></td>
                      <td><input type="date" id="tanggal-sp3k" name="tanggal-sp3k" /></td>
                      <td><input type="file" id="dokumen-sp3k" name="dokumen-sp3k" accept="pdf" /></td>
                      <td><input type="text" id="nama-debitur" name="nama-debitur" /><input type="file" id="ktp-debitur" name="ktp-debitur" accept="pdf" /></td>
                      <td><input type="file" id="ktp-debitur" name="ktp-debitur" accept="pdf" /></td>
                      <td><input type="text" id="bank-penerbit" name="bank-penerbit" /></td>
                      <td><input type="text" id="rekening-perusahaan" name="rekening-perusahaan" /><input type="file" id="bukti-kpl" name="bukti-kpl" accept="pdf" /></td>
                      <td><input type="file" id="bukti-kpl" name="bukti-kpl" accept="pdf" /></td>
                      <td><input type="file" id="bukti-kyg" name="bukti-kyg" accept="pdf" /></td>
                      <td><input type="file" id="bukti-lain" name="bukti-lain" accept="pdf" /></td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
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
    $('#divberkas').hide();

    $('#dropdownpt').change(function () {
    alert('test');

    let csrfName = '<?= csrf_token() ?>';
    let csrfHash = '<?= csrf_hash() ?>';
    let uuid = $(this).val();

    $.ajax({
        url: '<?= site_url('developer/get_pt'); ?>',
        type: 'POST',
        data: { uuid: uuid, [csrfName]: csrfHash },
        success: function (response) {
          $('#divberkas').html();
          console.log(response);
          $('#<?= csrf_token() ?>').val(response.csrfHash);
        },
        error: function () {
          Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Gagal memuat data PT. Silakan coba lagi.'
          });
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