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
                <div class="card-title">
                    <label><input type="checkbox" class="toggle-column" data-column="5" checked> Pengurus PT</label>
                    <label><input type="checkbox" class="toggle-column" data-column="10" checked> Alamat</label>
                </div>
              </div> 
              
               

              <!-- /.card-header -->
              <div class="card-body">
             
                <div class="table-responsive">
                  <table class="table table-bordered table-condensed">
                    <thead>
                      <tr class="table-info">
                        <th>No</th>
                        <th>Nama<br>PT</th>
                        <th>Developer</th>
                        <th>NPWP<br>PT</th>
                        <th>Penanggung<br>Jawab PT</th>
                        <th>NPWP <br>Penanggung Jawab</th>
                        <th>Pengurus<br>PT</th>
                        <th>Akta<br>Pendirian</th>
                        <th>SK<br>Kemenkumham</th>
                        <th>Laporan<br>Keuangan</th>
                        <th>Rekening<br>Operasional</th>
                        <th>Rekening<br>Escrow</th>
                      <th>Alamat</th>
                        <?php if(session()->get('kdgrpuser') == "operator") : ?>
                            <th>Aksi</th>
                        <?php endif; ?>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($result as $key => $p) : ?>
                      <tr class="baris<?= $p['uuid']; ?>">
                        
                    <input type="hidden" class="csrf" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                        <td><?= $key+1; ?>.</td>
                        <td><?= $p['namapt']; ?></td>
                        <td><?= $p['namadeveloper']; ?></td>
                        <td><a href="#" onclick="showPDF('npwp_pt', '<?= $p['berkasnpwp'] ?>')" data-toggle="modal" data-target="#pdfModal"><?= $p['npwppt'] ?></a></td>
                        <td><a href="#" onclick="showPDF('ktp_penanggungjawab', '<?= $p['berkasktppj'] ?>')" data-toggle="modal" data-target="#pdfModal"><?= $p['namapj'] ?></a></td>
                        <td><a href="#" onclick="showPDF('npwp_penanggungjawab', '<?= $p['berkasnpwppj'] ?>')" data-toggle="modal" data-target="#pdfModal"><?= $p['npwppj'] ?></a></td>
                        <td>
                          <?= $p['penguruspt'] ?>
                          <a href="#" onclick="showPDF('ktp_pengurus', '<?= $p['berkaspengurusptktp'] ?>')" data-toggle="modal" data-target="#pdfModal">KTP</a>
                          <a href="#" onclick="showPDF('npwp_pengurus', '<?= $p['berkaspengurusptnpwp'] ?>')" data-toggle="modal" data-target="#pdfModal">NPWP</a>
                        </td>
                        <td><a href="#" onclick="showPDF('akta_pendirian', '<?= $p['berkasaktapendirian'] ?>')" data-toggle="modal" data-target="#pdfModal">Lihat</a></td>
                        <td><a href="#" onclick="showPDF('sk_kemenkumham', '<?= $p['berkasskkemenkumham'] ?>')" data-toggle="modal" data-target="#pdfModal">Lihat</a></td>
                        <td>
                          <?php if($p['berkaslaporankeuangan'] != '') : ?>
                            <a href="#" onclick="showPDF('laporan_keuangan', '<?= $p['berkaslaporankeuangan'] ?>')" data-toggle="modal" data-target="#pdfModal">Lihat</a>
                          <?php else : ?>
                            -
                          <?php endif; ?>
                        </td>
                      <td><a href="#" onclick="showPDF('rekening', '<?= $p['berkasrekening'] ?>')" data-toggle="modal" data-target="#pdfModal"><?= $p['rekening'] ?></a> <?= $p['namabank'] ?></td>
                      <td><a href="#" onclick="showPDF('rekening_escrow', '<?= $p['berkasrekeningescrow'] ?>')" data-toggle="modal" data-target="#pdfModal"><?= $p['rekeningescrow'] ?></a> <?= $p['namabankescrow'] ?></td>
                        <td><?= $p['provinsi'] ?> - <?= $p['kabupaten'] ?> - <?= $p['kota'] ?> - <?= $p['kecamatan'] ?> - <?= $p['alamatinput'] ?></td>
                        <?php if(session()->get('kdgrpuser') == "operator") : ?>
                        <td class="aksi<?= $p['uuid']; ?>">
                          <?php if($p['statusvalidator']==0 || $p['statusvalidator']==null) : ?>
                          <a href="#" kunci="<?= $p['uuid']; ?>" kuncideveloper="<?= $p['uuiddeveloper']; ?>" class="btn btn-xs btn-success approve"><i class="fas fa-check"></i></a>
                          <a href="#" kunci="<?= $p['uuid']; ?>" kuncideveloper="<?= $p['uuiddeveloper']; ?>" class="btn btn-xs btn-danger reject"><i class="fas fa-times"></i></a>
                          <?php elseif($p['statusvalidator']==1) : ?>
                            <span class="badge bg-success">Disetujui</span>
                          <?php elseif($p['statusvalidator']==2) : ?>
                            <span class="badge bg-danger">Ditolak</span>  
                          <?php endif; ?>
                        </td>
                        <?php endif; ?>
                      </tr>
                    <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>

              <!-- /.card-body -->
              <!-- <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" href="#">«</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">»</a></li>
                </ul>
              </div> -->
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
        // exclude CSS class
        exclude: ".noExl",
        name: "Pendaftaran Developer",
        filename: "DataDeveloper", //do not include extension
        fileext: ".xls" // file extension
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
     // Toggle column visibility
     $('.toggle-column').on('change', function () {
                var column = table.column($(this).attr('data-column'));
                column.visible(!column.visible());
            });

  });
</script>
<script>
    
    function showPDF(type, filename) {
      document.getElementById('pdfViewer').src = '<?= base_url() ?>/download/' + type + '/' + filename + '/pdf';
    }
  $(document).ready(function(){


    $(".approve").click(function(e){
        e.preventDefault();
        var uuid = $(this).attr('kunci');
        var uuiddeveloper = $(this).attr('kuncideveloper');
        var csrfHash = $(this).closest('tr').find('.csrf').val();

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
          url: "<?= base_url(); ?>/operator/do_approve_pt",
          data: {
            csrf_test_name:csrfHash,
            uuid:uuid,
            uuiddeveloper:uuiddeveloper
          },
          dataType: "json",
          success: function (response) {
            if(response.status == 'success'){
              $(".csrf").val(response.csrf);
              $(".aksi"+response.uuid).html('<span class="badge bg-success">Disetujui</span>');
              Swal.fire({
                icon: 'success',
                title: 'Pendaftaran PT berhasil disetujui!',
                text: response.message,
              });
            }
          },
          error: function (xhr, status, error) {
            $(".csrf").val(xhr.responseJSON.csrf);
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Pendaftaran PT gagal disetujui!',
            });
          }
        });

    });

    $(".reject").click(function(e){
      e.preventDefault();
      
    Swal.fire({
        text: "Keterangan penolakan",
        input: 'textarea',
        showCancelButton: true,
        confirmButtonColor: "#DC3545",  
        confirmButtonText: "Tolak"      
    }).then((result) => {
        if (result.value) {
            var uuid = $(this).attr('kunci');
            var uuiddeveloper = $(this).attr('kuncideveloper');
            var csrfHash = $(this).closest('tr').find('.csrf').val();
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
                url: "<?= base_url(); ?>/operator/dont_approve_pt",
                data: {
                csrf_test_name:csrfHash,
                uuid:uuid,
                uuiddeveloper:uuiddeveloper,
                keteranganpenolakan:keteranganpenolakan
                },  
                dataType: "json",
                success: function (response) {
                if(response.status == 'success'){
                    $(".csrf").val(response.csrf);
                    $(".aksi"+response.uuid).html('<span class="badge bg-danger">Ditolak</span>');
                    Swal.fire({
                    icon: 'success',
                    title: 'Pendaftaran PT berhasil ditolak!',
                    text: response.message,
                    });
                }
                },
                error: function (xhr, status, error) {
                $(".csrf").val(xhr.responseJSON.csrf);
                Swal.fire({   
                    icon: 'error',
                    title: 'Oops...',   
                    text: 'Pendaftaran PT gagal ditolak!',
                });
                }
            }); 
        }
    });
  });
}); 
</script>
<?= $this->endSection(); ?>