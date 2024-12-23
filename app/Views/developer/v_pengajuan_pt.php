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
                <button class="btn btn-info btn-xs" onclick="window.location.href='<?= site_url('developer/form_pengajuan_pt') ?>'">Tambah Pengajuan PT</button>
              </div>
              <div class="card-body table-responsive p-2">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr class="table-info">
                      <th>ID</th>
                      <th>Nama<br>PT</th>
                      <th>NPWP<br>PT</th>
                      <th>Penanggung<br>Jawab PT</th>
                      <th>NPWP <br>Penanggung Jawab</th>
                      <th>Pengurus<br>PT</th>
                      <th>Akta<br>Pendirian</th>
                      <th>SK<br>Kemenkumham</th>
                      <th>Rekening<br>Operasional</th>
                      <th>Rekening<br>Escrow</th>
                      <th>DPD</th>
                      <th>Alamat</th>
                      <th>Status<br>Validator</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; foreach ($pengajuan as $p) { ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $p['namapt'] ?></td>
                      <td><a href="<?= base_url() ?>/download/npwp_pt/<?= $p['berkasnpwp'] ?>" target="_blank"><?= $p['npwppt'] ?></a></td>
                      <td><a href="<?= base_url() ?>/download/ktp_penanggungjawab/<?= $p['berkasktppj'] ?>" target="_blank"><?= $p['namapj'] ?></a></td>
                      <td><a href="<?= base_url() ?>/download/npwp_penanggungjawab/<?= $p['berkasnpwppj'] ?>" target="_blank"><?= $p['npwppj'] ?></a></td>
                      <td>
                        <?= $p['penguruspt'] ?>
                        <a href="<?= base_url() ?>/download/ktp_pengurus/<?= $p['berkaspengurusptktp'] ?>" target="_blank">KTP</a>
                        <a href="<?= base_url() ?>/download/npwp_pengurus/<?= $p['berkaspengurusptnpwp'] ?>" target="_blank">NPWP</a>
                      </td>
                      <td><a href="<?= base_url() ?>/download/akta_pendirian/<?= $p['berkasaktapendirian'] ?>" target="_blank"><?= $p['aktapendirian'] ?></a></td>
                      <td><a href="<?= base_url() ?>/download/sk_kemenkumham/<?= $p['berkasskkemenkumham'] ?>" target="_blank">Lihat</a></td>
                      <td><a href="<?= base_url() ?>/download/rekening/<?= $p['berkasrekening'] ?>" target="_blank"><?= $p['rekening'] ?></a> <?= $p['namabank'] ?></td>
                      <td><a href="<?= base_url() ?>/download/rekening_escrow/<?= $p['berkasrekeningescrow'] ?>" target="_blank"><?= $p['rekeningescrow'] ?></a> <?= $p['namabankescrow'] ?></td>
                      <td><?= $p['namadpd'] ?></td>
                      <td><?= $p['namaprovinsi'] ?> - <?= $p['namakabupaten'] ?> - <?= $p['namakecamatan'] ?> - <?= $p['alamatinput'] ?></td>
                      <td>
                        <?= ($p['statusvalidator'] == '0' || $p['statusvalidator'] == '') ? '<span class="badge bg-warning">Menunggu Validasi</span>' : '' ?>
                        <?= ($p['statusvalidator'] == '1') ? '<span class="badge bg-success">Disetujui</span>' : '' ?>
                        <?php if($p['statusvalidator'] == '2') : ?>
                          Ditolak karena : <?= $p['keteranganpenolakan'] ?><br>
                          <button onclick="window.location.href='<?= site_url('developer/form_edit_pt?uuid=' . $p['uuid']) ?>'" class="btn btn-warning btn-xs"><i class="fas fa-pencil-alt"></i></button> 
                          <button class="btn btn-danger btn-xs" onclick="hapusPT('<?= $p['uuid'] ?>')"><i class="fas fa-trash"></i></button>
                        <?php endif; ?>
                       
                      </td>
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
      "columnDefs": [
            {
                "targets": 5, // Column index (1 = second column)
                "render": function(data, type, row) {
                    return '<div style="width: 300px; white-space: normal; word-wrap: break-word;">' + data + '</div>';
                }
            }
        ],
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "pageLength": 100,
      "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Semua"]],
      "language": {
        "url": "<?= base_url() ?>/adminlte/plugins/datatables/Indonesian.json"
    }
    });
  });
</script>

<script>
function hapusPT(uuid) {
  Swal.fire({
    title: 'Apakah anda yakin?',
    text: "Data PT akan dihapus permanen!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ya, hapus!',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      let csrfName = '<?= csrf_token() ?>';
      let csrfHash = $('#<?= csrf_token() ?>').val();

      $.ajax({
        url: '<?= site_url('developer/hapus_pt') ?>',
        type: 'POST',
        data: {
          uuid: uuid,
          [csrfName]: csrfHash
        },
        success: function(response) {
          if(response.status == 'success') {
            Swal.fire({
              icon: 'success',
              title: 'Berhasil!',
              text: 'Data PT berhasil dihapus',
              showConfirmButton: false,
              timer: 1500
            }).then(() => {
              location.reload();
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Gagal!',
              text: 'Gagal menghapus data PT'
            });
          }
          $('#<?= csrf_token() ?>').val(response.csrfHash);
        },
        error: function() {
          Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Terjadi kesalahan saat menghapus data'
          });
        }
      });
    }
  });
}
</script>
<?= $this->endSection(); ?>