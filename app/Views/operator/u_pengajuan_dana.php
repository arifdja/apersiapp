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
            <div class="card-tools" style="margin: 0px;">
              <button class="btn btn-xs btn-success" id="excel">
                <i class="fas fa-excel"></i>Download Excel
              </button>
            </div>
            <div class="card-title">
              <button class="btn btn-xs btn-info toggle-alamat">
                <i class="fas fa-eye"></i> Detail
              </button>
            </div>
          </div>

          <!-- /.card-header -->
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-condensed">
                <thead>
                  <tr class="table-info">
                    <th>No</th>
                    <th>Lihat<br>Unit</th>
                    <th>Developer</th>
                    <th>Nama PT</th>
                    <th>Surat <br>Permohonan</th>
                    <th class="detail-column" style="display:none">Alamat<br> Perumahan</th>
                    <th class="detail-column" style="display:none">Detail Alamat</th>
                    <th>Site Plan</th>
                    <th>Foto Rumah<br>dan PSU</th>
                    <th>Jumlah Unit</th>
                    <th>Harga<br> SP3K</th>
                    <th>Dana<br> Talangan</th>
                    <th>Pinjaman KPL</th>
                    <th>Pinjaman KYG</th>
                    <th>Pinjaman Lain</th>
                    <th>Disetujui Operator</th>
                    <th>Disetujui Approver</th>
                    <th>Status</th>
                    <th>Aksi</th>
                    <th style="min-width: 150px;">Pendana</th>
                    <th>Created At</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($result as $key => $p) : ?>
                    <tr class="baris<?= $p['uuid']; ?>">
                      <input type="hidden" class="csrf" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                      <td><?= $key+1; ?>.</td>
                      <td class="text-center">
                        <?php if(session()->get('kdgrpuser')=='approver') : ?>
                          <a href="<?= site_url('approver/approval_unit?uuid='.$p['uuid']) ?>" class="btn btn-xs btn-info"><i class="fa fa-eye"></i></a>
                        <?php elseif(session()->get('kdgrpuser')=='operator') : ?>
                          <a href="<?= site_url('operator/approval_unit?uuid='.$p['uuid']) ?>" class="btn btn-xs btn-info"><i class="fa fa-eye"></i></a>
                        <?php elseif(session()->get('kdgrpuser')=='pendana') : ?>
                          <a href="<?= site_url('pendana/approval_unit?uuid='.$p['uuid']) ?>" class="btn btn-xs btn-info"><i class="fa fa-eye"></i></a>
                        <?php endif; ?>
                      </td>
                      <td><?= $p['namadeveloper'] ?></td>
                      <td><?= $p['namapt'] ?></td>
                      <td><a href="#" onclick="showPDF('surat_permohonan', '<?= $p['berkassuratpermohonan'] ?>')" data-toggle="modal" data-target="#pdfModal"><?= $p['suratpermohonan'] ?></a></td>
                      <td><a href="#" onclick="showPDF('psu', '<?= $p['berkaspsu'] ?>')" data-toggle="modal" data-target="#pdfModal">Lihat</a></td>
                      <td class="detail-column" style="display:none"><?= $p['namaprovinsi'] ?> - <?= $p['namakabupaten'] ?> - <?= $p['namakecamatan'] ?></td>
                      <td class="detail-column" style="display:none"><?= $p['alamatperumahaninput'] ?></td>
                      <td><a href="#" onclick="showPDF('site_plan', '<?= $p['berkassiteplan'] ?>')" data-toggle="modal" data-target="#pdfModal">Lihat</a></td>
                      <td><?= $p['jumlahunitinput'] ?></td>
                      <td align="right"><?= number_format($p['totalhargasp3k'],0,',','.') ?></td>
                      <td align="right"><?= number_format($p['totaldanatalangan'],0,',','.') ?></td>
                      <td align="right"><?= number_format($p['totalpinjamankpl'],0,',','.') ?></td>
                      <td align="right"><?= number_format($p['totalpinjamankyg'],0,',','.') ?></td>
                      <td align="right"><?= number_format($p['totalpinjamanlain'],0,',','.') ?></td>
                      <td align="right"><?= number_format($p['totaldisetujuioperator'],0,',','.') ?></td>
                      <td align="right"><?= number_format($p['totaldisetujuiapprover'],0,',','.') ?></td>
                      
                      <td id="status<?= $p['uuid'] ?>">
                        <?= view('general/v_td_status', ['p' => $p]) ?>
                      </td>
                      
                      <td class="aksi<?= $p['uuid']; ?>">
                        <?php if(session()->get('kdgrpuser')=='operator') : ?>
                          <?php if($p['submited_status']==1) : ?>
                            <?php if($p['jumlahunitinput']==$p['totaldisetujuioperator'] && $p['totaldisetujuioperator']>0) : ?>
                              <button type="button" class="btn btn-xs btn-success teruskan" kunci="<?= $p['uuid']; ?>">Teruskan</button>
                            <?php elseif($p['jumlahunitinput']!=$p['totaldisetujuioperator']) : ?>
                              <button type="button" class="btn btn-xs btn-danger kembalikan" kunci="<?= $p['uuid']; ?>">Kembalikan</button>
                            <?php else : ?>
                              -
                            <?php endif; ?>
                          <?php else: ?>
                            -
                          <?php endif; ?>
                        <?php elseif(session()->get('kdgrpuser')=='approver') : ?>
                          <?php if($p['submited_status']==3) : ?>
                            <button type="button" class="btn btn-xs btn-success setujui" kunci="<?= $p['uuid']; ?>">Setujui</button>
                          <?php else: ?>
                            -
                          <?php endif; ?>
                        <?php elseif(session()->get('kdgrpuser')=='pendana') : ?>
                          <?php if($p['submited_status']==6) : ?>
                            <button type="button" class="btn btn-xs btn-success danai" kunci="<?= $p['uuid']; ?>">Danai</button>
                            <button type="button" class="btn btn-xs btn-danger dikembalikanpendana" kunci="<?= $p['uuid']; ?>">Kembalikan</button>
                          <?php else: ?>
                            -
                          <?php endif; ?>
                        <?php endif; ?>
                      </td>
                      
                      <td class="pendana<?= $p['uuid']; ?>">
                        <?php if(session()->get('kdgrpuser')=='approver') : ?>
                          <?php if($p['submited_status']==3) : ?>
                            <form action="<?= site_url('approver/kirimkependana') ?>" method="post" id="form-kirimkependana-<?= $p['uuid'] ?>">
                              <?= csrf_field() ?>
                              <input type="hidden" name="uuid" value="<?= $p['uuid'] ?>">
                              <div class="d-flex">
                                <select required name="pendana" class="form-control form-control-sm mr-2" id="pendana-<?= $p['uuid'] ?>">
                                  <?php foreach($dropdownpendana['pendana'] as $key => $value): ?>
                                    <option value="<?= $key ?>"><?= $value ?></option>
                                  <?php endforeach; ?>
                                </select>
                                <div id="div-kirimkependana-<?= $p['uuid'] ?>">
                                  <button disabled id="btn-kirimkependana-<?= $p['uuid'] ?>" kunci="<?= $p['uuid'] ?>" type="submit" class="btn btn-xs btn-success kirimkependana">Kirim ke Pendana</button>
                                </div>
                              </div>
                            </form> 
                          <?php elseif($p['submited_status']==4) : ?>
                            <form action="<?= site_url('approver/kirimkependana') ?>" method="post" id="form-kirimkependana-<?= $p['uuid'] ?>">
                              <?= csrf_field() ?>
                              <input type="hidden" name="uuid" value="<?= $p['uuid'] ?>">
                              <div class="d-flex">
                                <select required name="pendana" class="form-control form-control-sm mr-2" id="pendana-<?= $p['uuid'] ?>">
                                  <?php foreach($dropdownpendana['pendana'] as $key => $value): ?>
                                    <option value="<?= $key ?>"><?= $value ?></option>
                                  <?php endforeach; ?>
                                </select>
                                <div id="div-kirimkependana-<?= $p['uuid'] ?>">
                                  <button id="btn-kirimkependana-<?= $p['uuid'] ?>" kunci="<?= $p['uuid'] ?>" type="submit" class="btn btn-xs btn-success kirimkependana">Kirim ke Pendana</button>
                                </div>
                              </div>
                            </form> 
                          <?php elseif($p['submited_status']==5): ?>
                            <?= $p['namapendana'] ?>
                          <?php else: ?>
                            -
                          <?php endif; ?>
                        <?php elseif(session()->get('kdgrpuser')=='operator' || session()->get('kdgrpuser')=='developer' || session()->get('kdgrpuser')=='pendana'): ?>
                          <?= ($p['namapendana']==null) ? '-' : $p['namapendana'] ?>
                        <?php endif; ?>
                      </td>
                      <td><?= $p['created_at'] ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
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
$(document).ready(function () {
  $("#excel").click(function(){
    $(".table").table2excel({
      exclude: ".noExl",
      name: "Pendaftaran Developer", 
      filename: "DataDeveloper",
      fileext: ".xls"
    });
  });
});
</script>

<script>
$(function () {
  var table = $('.table').DataTable({
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
    "autoWidth": false,
    "language": {
      "url": "<?= base_url() ?>/adminlte/plugins/datatables/Indonesian.json"
    }
  });
});
</script>
<script>
$(document).ready(function() {
  let alamatVisible = false;
  
  $('.toggle-alamat').click(function() {
    alamatVisible = !alamatVisible;
    
    if(alamatVisible) {
      $('.detail-column').show();
      $(this).html('<i class="fas fa-eye-slash"></i> Detail');
    } else {
      $('.detail-column').hide();
      $(this).html('<i class="fas fa-eye"></i> Detail');
    }
  });
});
</script>
<script>
function showPDF(type, filename) {
  document.getElementById('pdfViewer').src = '<?= base_url() ?>/download/' + type + '/' + filename + '/pdf';
}

$(document).ready(function() {
  <?php if(session()->get('kdgrpuser')=='pendana'): ?>
    // Handle danai button click
    $(".danai").click(function(e) {
      e.preventDefault();
      var uuid = $(this).attr('kunci');
      var csrfHash = $(".csrf").val();
      var csrfToken = $(".csrf").attr('name');
      
      $.ajax({
        type: "post",
        headers: {'X-Requested-With': 'XMLHttpRequest'},
        url: "<?= base_url(); ?>/pendana/danai_pengajuan",
        data: {
          [csrfToken]: csrfHash,
          uuid: uuid,
        },
        dataType: "json",
        success: function(response) {
          if(response.status == 'success') {
            $(".csrf").val(response.csrfHash);
            $(".csrf").attr('name',response.csrfToken);
            $(".aksi"+response.uuid).html('-'); 
            $("#status"+response.uuid).html('<span class="badge badge-success">Disetujui Pendana</span>');
            Swal.fire({
              icon: 'success',
              title: 'Sukses',
              text: response.message
            });
          }
        },
        error: function(xhr, status, error) {
          if(xhr.responseJSON) {
            $(".csrf").val(xhr.responseJSON.csrfHash);
            $(".csrf").attr('name',xhr.responseJSON.csrfToken);
          }
          Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: response.message
          });
        }
      });
    });

    // Handle dikembalikan button click 
    $(".dikembalikanpendana").click(function(e) {
      e.preventDefault();
      var uuid = $(this).attr('kunci');
      var csrfHash = $(".csrf").val();
      var csrfToken = $(".csrf").attr('name');

      Swal.fire({
        text: "Keterangan pengembalian",
        input: 'textarea',
        showCancelButton: true,
        confirmButtonColor: "#DC3545",
        confirmButtonText: "Kembalikan"
      }).then((result) => {
        if (result.value) {
          var keteranganpenolakan = result.value;
          
          Swal.fire({
            title: 'Mohon tunggu...',
            text: 'Sedang memproses data',
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
            url: "<?= base_url(); ?>/pendana/kembalikan_by_pendana",
            data: {
              [csrfToken]: csrfHash,
              uuid: uuid,
              keteranganpenolakan: keteranganpenolakan
            },
            dataType: "json",
            success: function(response) {
              if(response.status == 'success') {
                $(".csrf").val(response.csrfHash);
                $(".csrf").attr('name',response.csrfToken);
                $(".aksi"+response.uuid).html('-');
                $("#status"+response.uuid).html('<span class="badge badge-danger">Dikembalikan Pendana</span>');
                Swal.fire({
                  icon: 'success',
                  title: 'Sukses',
                  text: response.message
                });
              }
            },
            error: function(xhr, status, error) {
              if(xhr.responseJSON) {
                $(".csrf").val(xhr.responseJSON.csrfHash);
                $(".csrf").attr('name',xhr.responseJSON.csrfToken);
              }
              Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Terjadi kesalahan saat memproses data'
              });
            }
          });
        }
      });
    });
  <?php endif; ?>
});
</script>
<?= $this->endSection(); ?>