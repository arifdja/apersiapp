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
              <div class="card-tools" style="margin: 0px;"><button class="btn btn-xs btn-success" id="excel"><i class="fas fa-excel"></i>Download Excel</button></div>
                <?php if($tampilkan) : ?>
                  <div class="card-title">
                    <button class="btn btn-info btn-xs" onclick="window.location.href='<?= site_url('developer/form_tambah_unit?uuidheader='.$uuidheader) ?>'">Tambah Unit yang diagunkan</button>
                  </div>
                <?php endif; ?>
                
                <button class="btn btn-xs btn-info toggle-alamat">
                          <i class="fas fa-eye"></i> Alamat
                        </button>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-2">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr class="table-info">
                      <th>No.</th>
                      <th>Aksi</th>
                      <th>Status</th>
                      <th>Sertifikat</th>
                      <th>PBB</th>
                      <th>SP3K</th>
                      <th>Nama <br>Debitur</th>
                      <th class="alamat-column" style="display:none">Alamat</th>
                      <th>Rekening</th>
                      <th>Harga sesuai persetujuan<br>kredit (SP3K) (Rp)</th>
                      <th>Nilai Dana<br> Talangan (Rp)</th>
                      <th>Pinjaman KPL</th>
                      <th>Pinjaman KYG</th>
                      <th>Pinjaman Lain</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; foreach ($pengajuandetail as $p) { ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td>
                        <?php if(($p['submited_status'] == '1')) { ?>
                          -
                        <?php } elseif($p['submited_status'] == '2' && ($p['statusvalidator'] != 1 || $p['statussikumbang'] != 1 || $p['statuseflpp'] != 1 || $p['statussp3k'] != 1)) { ?>
                          <a href="<?= site_url('developer/form_edit_unit?uuidheader='.$p['uuidheader'].'&uuid='.$p['uuid']) ?>" class="btn btn-info btn-xs"><i class="fas fa-edit"></i></a>
                          <button onclick="deleteUnit('<?= $p['uuid'] ?>')" class="btn btn-danger btn-xs">
                            <i class="fas fa-trash"></i>
                          </button>
                        <?php } elseif($p['submited_status'] == '3') { ?>
                          -
                        <?php } elseif($p['submited_status'] == '4') { ?>
                          -
                        <?php } else { ?>
                          -
                        <?php } ?>
                      </td>
                      <td>
                        <?php if($p['submited_status'] == '0' || $p['submited_status'] == '') { ?>
                          <span class="badge bg-success">Simpan</span>
                        <?php } elseif($p['submited_status'] == '1') { ?>
                          <span class="badge bg-success">Proses Pengecekan</span>
                        <?php } elseif($p['submited_status'] == '2' && ($p['statusvalidator'] != 1 || $p['statussikumbang'] != 1 || $p['statuseflpp'] != 1 || $p['statussp3k'] != 1)) { ?>
                            <?php if (!empty($p['keteranganpenolakan'])) : ?>
                              <strong>Ditolak DPD/DPP/Korwil:</strong><?= $p['keteranganpenolakan'].".<br>" ?>
                            <?php endif; ?>
                            <?php if (!empty($p['kettolaksikumbang'])) : ?>
                              <strong>Sikumbang:</strong> <?= $p['kettolaksikumbang'].".<br>" ?>
                            <?php endif; ?>
                            <?php if (!empty($p['kettolakeflpp'])) : ?>
                              <strong>EFLPP:</strong> <?= $p['kettolakeflpp'].".<br>" ?>
                            <?php endif; ?>
                            <?php if (!empty($p['kettolaksp3k'])) : ?>
                              <strong>SP3K:</strong> <?= $p['kettolaksp3k'].".<br>" ?>
                            <?php endif; ?>
                        <?php } elseif($p['submited_status'] == '2' && $p['statusvalidator'] == 1 && $p['statussikumbang'] == 1 && $p['statuseflpp'] == 1 && $p['statussp3k'] == 1) { ?>
                          <span class="badge bg-success">Disetujui</span>
                        <?php } elseif($p['submited_status'] == '3') { ?>
                          <span class="badge bg-success">Proses Persetujuan</span>
                        <?php } elseif($p['submited_status'] == '4') { ?>
                          <span class="badge bg-success">Disetujui</span>
                        <?php } else { ?>
                          -
                        <?php } ?>
                      </td>
                      <td><a href="<?= base_url() ?>/download/sertifikat/<?= $p['berkassertifikat'] ?>" target="_blank"><?= $p['sertifikat'] ?></a></td>
                      <td><a href="<?= base_url() ?>/download/pbb/<?= $p['berkaspbb'] ?>" target="_blank"><?= $p['pbb'] ?></a></td>
                      <td><a href="<?= base_url() ?>/download/sp3k/<?= $p['berkassp3k'] ?>" target="_blank"><?= $p['nomordokumensp3k'] ?></a></td>
                      <td><a href="<?= base_url() ?>/download/ktp_debitur/<?= $p['berkasktpdebitur'] ?>" target="_blank"><?= $p['namadebitur'] ?></a></td>
                      <td class="alamat-column" style="display:none"><?= $p['namaprovinsi'] ?> - <?= $p['namakabupaten'] ?> - <?= $p['namakecamatan'] ?> - <?= $p['namakota'] ?> - <?= $p['alamatinput'] ?></td>
                      
                      <td><a href="<?= base_url() ?>/download/rekening_debitur/<?= $p['berkasrekening'] ?>" target="_blank"><?= $p['rekening'] ?> - <?= $p['namabank'] ?></a></td>
                      <td align="right"><?= number_format($p['harga'],0,',','.') ?></td>
                      <td align="right"><?= number_format($p['nilaikredit'],0,',','.') ?></td>
                      <td align="right">
                        <?php if($p['berkaspinjamankpl'] != '') : ?>
                        <a href="<?= base_url() ?>/download/pinjaman_kpl/<?= $p['berkaspinjamankpl'] ?>" target="_blank"><?= number_format($p['pinjamankpl'],0,',','.') ?></a>
                        <?php else : ?>
                        0
                        <?php endif; ?>
                      </td>
                      <td align="right">
                        <?php if($p['berkaspinjamankyg'] != '') : ?>
                        <a href="<?= base_url() ?>/download/pinjaman_kyg/<?= $p['berkaspinjamankyg'] ?>" target="_blank"><?= number_format($p['pinjamankyg'],0,',','.') ?></a>
                        <?php else : ?>
                        0
                        <?php endif; ?>
                      </td>
                      <td align="right">
                        <?php if($p['berkaspinjamanlain'] != '') : ?>
                        <a href="<?= base_url() ?>/download/pinjaman_lain/<?= $p['berkaspinjamanlain'] ?>" target="_blank"><?= number_format($p['pinjamanlain'],0,',','.') ?></a>
                        <?php else : ?>
                        0
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

<script>
  window.deleteUnit = function(uuid) {
    let csrfName = '<?= csrf_token() ?>';
    let csrfHash = '<?= csrf_hash() ?>';
    
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Data unit akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '<?= site_url('developer/delete_unit_ajax') ?>',
                type: 'POST',
                data: {
                    uuid: uuid,
                    [csrfName]: csrfHash
                },
                success: function(response) {
                    if(response.status === 'success') {
                        Swal.fire(
                            'Terhapus!',
                            response.message,
                            'success'
                        ).then(() => {
                            // Refresh halaman atau update tampilan
                            location.reload();
                        });
                    }
                    // Update CSRF hash
                    csrfName = response.csrfName;
                    csrfHash = response.csrfHash;
                },
                error: function(xhr) {
                    Swal.fire(
                        'Error!',
                        xhr.responseJSON.message,
                        'error'
                    );
                    // Update CSRF hash
                    csrfName = xhr.responseJSON.csrfName;
                    csrfHash = xhr.responseJSON.csrfHash;
                }
            });
        }
    });
}
</script>
<script>
$(document).ready(function() {
  // Status awal kolom tersembunyi
  let alamatVisible = false;
  
  // Handler untuk toggle button
  $('.toggle-alamat').click(function() {
    alamatVisible = !alamatVisible;
    
    if(alamatVisible) {
      $('.alamat-column').show();
      $(this).html('<i class="fas fa-eye-slash"></i> Alamat');
    } else {
      $('.alamat-column').hide(); 
      $(this).html('<i class="fas fa-eye"></i> Alamat');
    }
  });
});
</script>
<?= $this->endSection(); ?>