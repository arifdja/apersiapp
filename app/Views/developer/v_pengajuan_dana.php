<?= $this->extend('layout/template'); ?>

<?= $this->section('north'); ?>
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url() ?>/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url() ?>/adminlte/plugins/datatables-bs4/css/custom.dataTables.css">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

     <!-- Main content -->
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <button class="btn btn-info btn-xs" onclick="window.location.href='<?= site_url('developer/form_pengajuan_dana') ?>'">Tambah Pengajuan Dana</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-2">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Aksi</th>
                      <th>Nama PT</th>
                      <th>Surat <br>Permohonan</th>
                      <th>DPP/DPD/Korwil</th>
                      <th>Alamat<br> Perumahan</th>
                      <th>Detail Alamat</th>
                      <th>Site Plan</th>
                      <th>Jumlah Unit</th>
                      <th>Bukti dan Nilai<br> Pinjaman KPL</th>
                      <th>Bukti dan Nilai<br> Pinjaman KYG</th>
                      <th>Bukti dan Nilai<br> Pinjaman Lain</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; foreach ($pengajuan as $p) { ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td>
                        <a href="<?= site_url('developer/monitoring_detail_pengajuan_dana?uuid='.$p['uuid']) ?>" class="btn btn-xs btn-info"><i class="fa fa-eye"></i></a>
                      </td>
                      <td><?= $p['namapt'] ?></td>
                      <td><a href="<?= base_url() ?>/download/surat_permohonan/<?= $p['berkassuratpermohonan'] ?>" target="_blank"><?= $p['suratpermohonan'] ?></a></td>
                      <td><?= $p['namadpd'] ?></td>
                      <td><?= $p['namaprovinsi'] ?> - <?= $p['namakabupaten'] ?> - <?= $p['namakecamatan'] ?></td>
                      <td><?= $p['alamatperumahaninput'] ?></td>
                      <td><a href="<?= base_url() ?>/download/site_plan/<?= $p['berkassiteplan'] ?>" target="_blank">Lihat</a></td>
                      <td><?= $p['jumlahunit'] ?></td>
                      <td align="right"><a href="<?= base_url() ?>/download/pinjaman_kpl/<?= $p['berkaspinjamankpl'] ?>" target="_blank"><?= number_format($p['pinjamankpl'],0,',','.') ?></a></td>
                      <td align="right"><a href="<?= base_url() ?>/download/pinjaman_kyg/<?= $p['berkaspinjamankyg'] ?>" target="_blank"><?= number_format($p['pinjamankyg'],0,',','.') ?></a></td>
                      <td align="right"><a href="<?= base_url() ?>/download/pinjaman_lain/<?= $p['berkaspinjamanlain'] ?>" target="_blank"><?= number_format($p['pinjamanlain'],0,',','.') ?></a></td>
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
                      if(xhr.responseJSON.message.pinjaman_kyg){
                        $('#pinjaman_kyg').addClass('is-invalid');
                      }
                      if(xhr.responseJSON.message.berkaspinjaman_kyg){
                        $('#berkaspinjaman_kyg').addClass('is-invalid');
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
    $('.table').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "language": {
        "url": "<?= base_url() ?>/adminlte/plugins/datatables/Indonesian.json"
    }
    });
  });
</script>
<?= $this->endSection(); ?>