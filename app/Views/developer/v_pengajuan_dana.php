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
                <?= view('general/v_ket_status') ?>
                <button class="btn btn-info btn-xs" onclick="window.location.href='<?= site_url('developer/form_pengajuan_dana') ?>'">Tambah Pengajuan Dana</button>
              
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
                      <th>Detail<br>Unit</th>
                      <th>Nama<br> PT</th>
                      <th class="alamat-column" style="display:none">Alamat<br> Perumahan</th> 
                      <th class="alamat-column" style="display:none">Detail<br>Alamat</th>
                      <th>Site<br>Plan</th>
                      <th>Foto Rumah<br>dan PSU</th>
                      <th>Jumlah<br>Unit</th>
                      <th>Harga<br> SP3K</th>
                      <th>Dana<br> Talangan</th>
                      <th>Total<br>Potongan</th>
                      <th>Potongan<br> KPL</th>
                      <th>Potongan<br> KYG</th>
                      <th>Potongan<br> Lain</th>
                      <th>Surat <br>Permohonan</th>
                      <th>Status</th>
                      <th>Aksi</th>
                      <th>Created At</th>
                    </tr>
                    <input type="hidden" class="csrf_hash" name="<?= csrf_hash() ?>" value="<?= csrf_hash() ?>" />
                    <input type="hidden" class="csrf_token" name="<?= csrf_token() ?>" value="<?= csrf_token() ?>" />
                  </thead>
                  <tbody>
                    <?php $no=1; foreach ($pengajuan as $p) { ?>
                    <tr>
                      <input type="hidden" name="uuid" value="<?= $p['uuid'] ?>">
                      <td><?= $no++ ?></td>
                      <td>
                        <a href="<?= site_url('developer/monitoring_detail_pengajuan_dana?uuid='.$p['uuid']) ?>" class="btn btn-xs btn-info" data-toggle="tooltip" title="Isi detail pengajuan dana"><i class="fa fa-eye"></i></a>
                      </td>
                      <td><?= $p['namapt'] ?></td>
                      <td><a href="#" onclick="showPDF('psu', '<?= $p['berkaspsu'] ?>')" data-toggle="modal" data-target="#pdfModal">Lihat</a></td>
                      <td class="alamat-column" style="display:none"><?= $p['provinsi'] ?> - <?= $p['kabupaten'] ?> - <?= $p['kota'] ?> - <?= $p['kecamatan'] ?></td>
                      <td class="alamat-column" style="display:none"><?= $p['alamatperumahaninput'] ?></td>
                      <td><a href="#" onclick="showPDF('site_plan', '<?= $p['berkassiteplan'] ?>')" data-toggle="modal" data-target="#pdfModal">Lihat</a></td>
                      <td id="jumlahunitinput<?= $p['uuid'] ?>"><?= $p['jumlahunitinput'] ?></td>
                      <td align="right"><?= number_format($p['totalhargasp3k'],0,',','.') ?></td>
                      <td align="right"><?= number_format($p['totaldanatalangan'],0,',','.') ?></td>
                      <td align="right"><?= number_format($p['totalpinjamankpl']+$p['totalpinjamankyg']+$p['totalpinjamanlain'],0,',','.') ?></td>
                      <td align="right"><?= number_format($p['totalpinjamankpl'],0,',','.') ?></td>
                      <td align="right"><?= number_format($p['totalpinjamankyg'],0,',','.') ?></td>
                      <td align="right"><?= number_format($p['totalpinjamanlain'],0,',','.') ?></td>
                      <td>
                        <?php if(!empty($p['berkassuratpermohonan'])): ?>
                          <a href="#" onclick="showPDF('surat_permohonan', '<?= $p['berkassuratpermohonan'] ?>')" data-toggle="modal" data-target="#pdfModal">Lihat</a>
                        <?php else: ?>
                          -
                        <?php endif; ?>
                      </td>
                      <td id="ajukan_dana<?= $p['uuid'] ?>">
                        <?= view('general/v_td_status', ['p' => $p]) ?>
                      </td>
                      <td id="aksi_ajukan_dana<?= $p['uuid'] ?>">
                        <?php if($p['submited_status'] == 0 || $p['submited_status'] == ''): ?>
                        <button class="btn btn-xs btn-info ajukan_dana">Ajukan</button>
                        <?php elseif($p['submited_status'] == 2): ?>
                          <button class="btn btn-xs btn-info ajukan_dana">Ajukan</button>
                        <?php elseif($p['submited_status'] == 5 || $p['submited_status'] == 7): ?>
                          <?php if(!empty($p['keteranganpenolakanpendana'])): ?>
                            <strong>Dikembalikan karena :</strong> <?= $p['keteranganpenolakanpendana'] ?>.<br> Silahkan upload surat permohonan kembali.
                          <?php endif ?>
                            <form action="<?= site_url('developer/kirimkependana') ?>" enctype="multipart/form-data" method="post" id="form-kirimkependana-<?= $p['uuid'] ?>">
                              <?= csrf_field() ?>
                              <input type="hidden" name="uuid" value="<?= $p['uuid'] ?>">
                              <div class="d-flex">
                                <input type="file" name="berkassuratpermohonan" id="berkassuratpermohonan-<?= $p['uuid'] ?>" accept=".pdf" required><br>
                                <button id="btn-kirimkependana-<?= $p['uuid'] ?>" kunci="<?= $p['uuid'] ?>" type="submit" class="btn btn-info btn-xs kirimkependana">Upload Surat Permohonan</button>
                              </div>
                            </form> 
                        <?php else: ?>
                          -
                        <?php endif; ?>
                      </td>
                      <td><?= $p['created_at'] ?></td>
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
    
    <!-- Modal -->
    <div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="pdfModalLabel">Dokumen</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <iframe id="pdfViewer" style="width:100%; height:800px;" frameborder="0"></iframe>
          </div>
        </div>
      </div>
    </div>
  
<?= $this->endSection(); ?>

<?= $this->section('south'); ?>
<script>
    function showPDF(type, filename) {
      document.getElementById('pdfViewer').src = '<?= base_url() ?>/download/' + type + '/' + filename + '/pdf';
    }
  $(document).ready(function() {
    $('.ajukan_dana').click(function(e) {
      e.preventDefault();
      var uuid = $(this).closest('tr').find('input[name="uuid"]').val();
      var csrfToken = $(".csrf_token").val();
      var csrfHash = $(".csrf_hash").val();
      var jumlahunit = parseInt($("#jumlahunitinput"+uuid).text().trim());

      if(jumlahunit == 0){
        Swal.fire({
          icon: 'error',
          title: 'Peringatan',
          text: 'Jumlah unit tidak boleh 0',
        });
        return false;
      }

      Swal.fire({
        title: 'Konfirmasi',
        text: "Apakah anda yakin ingin mengajukan dana ini?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Ajukan',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            type: 'POST',
            headers: {'X-Requested-With': 'XMLHttpRequest'},
            url: '<?= site_url('developer/ajukan_dana_ajax') ?>',
            data: {uuid: uuid, jumlahunit: jumlahunit, [csrfToken]: csrfHash},
            dataType: 'json',
            success: function(response) {
              if(response.status == 'success') {
                $(".csrf_hash").val(response.csrfHash);
                $(".csrf_token").val(response.csrfToken);
                $("#ajukan_dana"+uuid).html('<span class="badge bg-warning">Proses Pengecekan</span>');
                $("#aksi_ajukan_dana"+uuid).html('-');
                Swal.fire({ 
                  icon: 'success',
                  title: 'Berhasil',
                  text: response.message,
                });
              }
            },
            error: function(xhr, status, error) {
              if(xhr.responseJSON) {
                $(".csrf_hash").val(xhr.responseJSON.csrfHash);
                $(".csrf_token").val(xhr.responseJSON.csrfToken);
              }
              Swal.fire({
                icon: 'error', 
                title: 'Gagal',
                text: 'Dana gagal di ajukan. Mohon coba lagi',
              });
            }
          });
        }
      });
    });

    
  // Handle kirim ke pendana button click
  $(".kirimkependana").click(function(e) {
      e.preventDefault();
      var uuid = $(this).attr('kunci');
      var csrfToken = $(".csrf_token").val();
      var csrfHash = $(".csrf_hash").val();

      let formData = new FormData();
      let fileInput = $('#berkassuratpermohonan-'+uuid)[0].files[0]; // Get the selected file

      if (!fileInput) {
          alert('Please select a file!');
          return;
      }

      formData.append('berkassuratpermohonan', fileInput);
      formData.append('uuid', uuid);
      formData.append(csrfToken, csrfHash);

     Swal.fire({
         title: 'Loading...',
         text: 'Sedang mengirim data',
         allowOutsideClick: false,
         allowEscapeKey: false,
         showConfirmButton: false,
         didOpen: () => {
             Swal.showLoading();
         }
     });

      $.ajax({
        type: "post",
        headers: {'X-Requested-With': 'XMLHttpRequest'},
        url: "<?= base_url(); ?>/developer/kirimkependana",
        data: formData,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function(response) {
          if(response.status == 'success') {
            $(".csrf_token").val(response.csrfToken);
            $(".csrf_hash").val(response.csrfHash);
            $("#aksi_ajukan_dana"+response.uuid).html('-');
            $("#ajukan_dana"+response.uuid).html('<span class="badge badge-success">Dikirim ke Pendana</span>');
            Swal.fire({
              icon: 'success',
              title: 'Sukses',
              text: response.message
            });
          }
        },
        error: function(xhr, status, error) {
          if(xhr.responseJSON) {
            $(".csrf_token").val(xhr.responseJSON.csrfToken);
            $(".csrf_hash").val(xhr.responseJSON.csrfHash);
          }
          Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: 'Gagal mengirim file. Mohon coba lagi'
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