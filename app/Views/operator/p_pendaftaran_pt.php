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
                      <tr>
                        <th>ID</th>
                        <th>Nama<br>PT</th>
                        <th>NPWP<br>PT</th>
                        <th>Penanggung<br>Jawab PT</th>
                        <th>NPWP <br>Penanggung Jawab</th>
                        <th>Akta Pendirian</th>
                        <th>Bank</th>
                        <th>Rekening</th>
                        <th>Alamat</th>
                        <th>Pinjaman KPL</th>
                        <th>Pinjaman KYG</th>
                        <th>Pinjaman Lain</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($result as $key => $p) : ?>
                      <tr class="baris<?= $p['uuid']; ?>">
                        
                    <input type="hidden" class="csrf" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                        <td><?= $key+1; ?>.</td>
                        <td><?= $p['namapt']; ?></td>
                        <td><a href="<?= base_url() ?>/download/npwp_pt/<?= $p['berkasnpwp'] ?>" target="_blank"><?= $p['npwppt'] ?></a></td>
                        <td><a href="<?= base_url() ?>/download/ktp_penanggungjawab/<?= $p['berkasktppj'] ?>" target="_blank"><?= $p['namapj'] ?></a></td>
                        <td><a href="<?= base_url() ?>/download/npwp_penanggungjawab/<?= $p['berkasnpwppj'] ?>" target="_blank"><?= $p['npwppj'] ?></a></td>
                        <td><a href="<?= base_url() ?>/download/akta_pendirian/<?= $p['berkasaktapendirian'] ?>" target="_blank"><?= $p['aktapendirian'] ?></a></td>
                        <td><?= $p['kodebank'] ?> - <?= $p['namabank'] ?></td>
                        <td><a href="<?= base_url() ?>/download/rekening/<?= $p['berkasrekening'] ?>" target="_blank"><?= $p['rekening'] ?></a></td>
                        <td><?= $p['namaprovinsi'] ?> - <?= $p['namakabupaten'] ?> - <?= $p['namakecamatan'] ?> - <?= $p['alamatinput'] ?></td>
                        <td align="right"><a href="<?= base_url() ?>/download/pinjaman_kpl/<?= $p['berkaspinjamankpl'] ?>" target="_blank"><?= number_format($p['pinjamankpl'],0,',','.') ?></a></td>
                        <td align="right"><a href="<?= base_url() ?>/download/pinjaman_kyg/<?= $p['berkaspinjamankyg'] ?>" target="_blank"><?= number_format($p['pinjamankyg'],0,',','.') ?></a></td>
                        <td align="right"><a href="<?= base_url() ?>/download/pinjaman_lain/<?= $p['berkaspinjamanlain'] ?>" target="_blank"><?= number_format($p['pinjamanlain'],0,',','.') ?></a></td>
                        <td class="aksi<?= $p['uuid']; ?>">
                          <?php if($p['statusvalidator']==0 || $p['statusvalidator']==null) : ?>
                          <a href="#" kunci="<?= $p['uuid']; ?>" kuncideveloper="<?= $p['uuiddeveloper']; ?>" class="btn btn-xs btn-success approve"><i class="fas fa-check"></i></a>
                          <a href="#" kunci="<?= $p['uuid']; ?>" kuncideveloper="<?= $p['uuiddeveloper']; ?>" class="btn btn-xs btn-danger reject"><i class="fas fa-times"></i></a>
                          <?php else : ?>
                            -
                          <?php endif; ?>
                        </td>
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
  $(document).ready(function(){

    $(".approve").click(function(e){
        e.preventDefault();
        var uuid = $(this).attr('kunci');
        var uuiddeveloper = $(this).attr('kuncideveloper');
        var csrfHash = $(this).closest('tr').find('.csrf').val();
        
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
              $(".statusvalidator"+response.uuid).html('Approved');
              $(".aksi"+response.uuid).html('-');
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
                    $(".aksi"+response.uuid).html('-');
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