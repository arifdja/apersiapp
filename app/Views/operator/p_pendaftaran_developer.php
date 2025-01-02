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
                    <label><input type="checkbox" class="toggle-column" data-column="2" checked> Email</label>
                    <label><input type="checkbox" class="toggle-column" data-column="3" checked> No Telp</label>
                    <label><input type="checkbox" class="toggle-column" data-column="4" checked> Alamat</label>
                    <label><input type="checkbox" class="toggle-column" data-column="5" checked> KTA</label>
                </div>
              </div> 
              
               

              <!-- /.card-header -->
              <div class="card-body">
             
                <div class="table-responsive">
                  <table class="table table-bordered table-condensed">
                    <thead>
                      <tr class="table-info">
                        <th style="width: 10px">No.</th>
                        <th>Nama Developer</th>
                        <th>Email</th>
                        <th>No Telp</th>
                        <th>Alamat</th>
                        <th>KTA</th>
                        <th>DPD/DPP/Korwil</th>
                        <?php if(session()->get('kdgrpuser') == "operator") : ?>
                            <th class="noExl">Aksi</th>
                        <?php endif; ?>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($result as $key => $value) : ?>
                      <tr class="baris<?= $value['uuid']; ?>">
                        
                    <input type="hidden" class="csrf" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                        <td><?= $key+1; ?>.</td>
                        <td><?= $value['nama']; ?></td>
                        <td><?= $value['email']; ?></td>
                        <td><?= $value['notelp']; ?></td>
                        <td><?= $value['alamatinput']; ?>, <?= $value['kecamatan']; ?>, <?= $value['kota']; ?>, <?= $value['kabupaten']; ?>, <?= $value['provinsi']; ?>, kodepos <?= $value['kodepos']; ?></td>
                        <td><a href="#" onclick="showPDF('kta', '<?= $value['berkaskta']; ?>')" data-toggle="modal" data-target="#pdfModal"><?= $value['kta']; ?></a></td>
                        <td><?= $value['namadpd']; ?></td>
                        <?php if(session()->get('kdgrpuser') == "operator") : ?>
                        <td id="aksi<?= $value['uuid']; ?>">
                            <?php if ($value['statusvalidator']==0 || $value['statusvalidator']==null) : ?>
                              <a href="#" kunci="<?= $value['uuid']; ?>" class="btn btn-xs btn-success approve"><i class="fas fa-check"></i></a>
                              <a href="#" kunci="<?= $value['uuid']; ?>" class="btn btn-xs btn-danger reject"><i class="fas fa-times"></i></a>
                            <?php elseif ($value['statusvalidator']==1) : ?>
                                <span class="badge bg-success">Disetujui</span>
                            <?php elseif ($value['statusvalidator']==2) : ?>
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
          url: "<?= base_url(); ?>/operator/do_approve_developer",
          data: {
            csrf_test_name:csrfHash,
            uuid:uuid
          },
          dataType: "json",
          success: function (response) {
            if(response.status == 'success'){
              $(".csrf").val(response.csrf);
              $("#aksi"+response.uuid).html('<span class="badge bg-success">Disetujui</span>');
              Swal.fire({
                icon: 'success',
                title: 'Pendaftaran developer berhasil disetujui!',
                text: response.message,
              });
            }
          },
          error: function (xhr, status, error) {
            $(".csrf").val(xhr.responseJSON.csrf);
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Pendaftaran developer gagal disetujui!',
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
                url: "<?= base_url(); ?>/operator/dont_approve_developer",
                data: {
                csrf_test_name:csrfHash,
                uuid:uuid,
                keteranganpenolakan:keteranganpenolakan
                },  
                dataType: "json",
                success: function (response) {
                if(response.status == 'success'){
                    $(".csrf").val(response.csrf);
                    $(".baris"+response.uuid).remove();
                    Swal.fire({
                    icon: 'success',
                    title: 'Pendaftaran developer berhasil ditolak!',
                    text: response.message,
                    });
                }
                },
                error: function (xhr, status, error) {
                $(".csrf").val(xhr.responseJSON.csrf);
                Swal.fire({   
                    icon: 'error',
                    title: 'Oops...',   
                    text: 'Pendaftaran developer gagal ditolak!',
                });
                }
            }); 
        }
    });
  });
}); 
</script>
<?= $this->endSection(); ?>