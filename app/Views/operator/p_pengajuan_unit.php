<?= $this->extend('layout/template'); ?>

<?= $this->section('north'); ?>

<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url() ?>/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url() ?>/adminlte/plugins/datatables-bs4/css/custom.dataTables.css">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<section class="content">
      <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <div class="card-tools" style="margin: 0px;"><button class="btn btn-xs btn-success" id="excel"><i class="fas fa-excel"></i>Download Excel</button></div>
                <div class="card-title">
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-condensed">
                    <thead>
                      <tr class="table-info">
                        <th align="center">No</th>
                        <th align="center">Sertifikat</th>
                        <th align="center">PBG/<br>IMB</th>
                        <th align="center">PBB</th>
                        <th align="center">SP3K</th>
                        <th align="center">Nama <br>Debitur</th>
                        <th align="center">Alamat</th>
                        <th align="right">Harga sesuai persetujuan<br>kredit (SP3K) (Rp)</th>
                        <th align="right">Nilai Dana<br> Talangan (Rp)</th>
                        <th align="right">Pinjaman KPL</th>
                        <th align="right">Pinjaman KYG</th>
                        <th align="right">Pinjaman Lain</th>
                        <th align="center" width="50px">Validasi DPP/DPD/Korwil</th>
                        <th align="center" width="50px">Validasi Sikumbang</th>
                        <th align="center" width="50px">Validasi FLPP</th>
                        <th align="center" width="50px">Validasi SP3K</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($result as $key => $p) : ?>
                      <tr class="baris<?= $p['uuid']; ?>">
                      <input type="hidden" class="csrf" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                      <td><?= $key+1; ?>.</td>
                      <td><a href="#" onclick="showPDF('sertifikat', '<?= $p['berkassertifikat'] ?>')" data-toggle="modal" data-target="#pdfModal"><?= $p['sertifikat'] ?></a></td>
                      <td><a href="#" onclick="showPDF('pbgimb', '<?= $p['berkaspbgimb'] ?>')" data-toggle="modal" data-target="#pdfModal">Lihat</a></td>
                      <td><a href="#" onclick="showPDF('pbb', '<?= $p['berkaspbb'] ?>')" data-toggle="modal" data-target="#pdfModal"><?= $p['pbb'] ?></a></td>
                      <td><a href="#" onclick="showPDF('sp3k', '<?= $p['berkassp3k'] ?>')" data-toggle="modal" data-target="#pdfModal"><?= $p['nomordokumensp3k'] ?></a> <?= tanggal_indo($p['tanggalsp3k']) ?></td>
                      <td><a href="#" onclick="showPDF('ktp_debitur', '<?= $p['berkasktpdebitur'] ?>')" data-toggle="modal" data-target="#pdfModal"><?= $p['namadebitur'] ?></a></td>
                      <td><?= $p['provinsi'] ?> <?= $p['kabupaten'] ?> <?= $p['kota'] ?> <br> <?= $p['kecamatan'] ?> - <?= $p['alamatinput'] ?></td>
                      <td align="right"><?= number_format($p['harga'],0,',','.') ?></td>
                      <td align="right"><?= number_format($p['nilaikredit'],0,',','.') ?></td>
                     <td align="right">
                        <?php if($p['berkaspinjamankpl'] != '') : ?>
                        <a href="#" onclick="showPDF('pinjaman_kpl', '<?= $p['berkaspinjamankpl'] ?>')" data-toggle="modal" data-target="#pdfModal"><?= number_format($p['pinjamankpl'],0,',','.') ?></a>
                        <?php else : ?>
                        0
                        <?php endif; ?>
                      </td>
                      <td align="right">
                        <?php if($p['berkaspinjamankyg'] != '') : ?>
                        <a href="#" onclick="showPDF('pinjaman_kyg', '<?= $p['berkaspinjamankyg'] ?>')" data-toggle="modal" data-target="#pdfModal"><?= number_format($p['pinjamankyg'],0,',','.') ?></a>
                        <?php else : ?>
                        0
                        <?php endif; ?>
                      </td>
                      <td align="right">
                        <?php if($p['berkaspinjamanlain'] != '') : ?>
                        <a href="#" onclick="showPDF('pinjaman_lain', '<?= $p['berkaspinjamanlain'] ?>')" data-toggle="modal" data-target="#pdfModal"><?= number_format($p['pinjamanlain'],0,',','.') ?></a>
                        <?php else : ?>
                        0
                        <?php endif; ?>
                      </td>
                      <td class="aksivalidator<?= $p['uuid']; ?>">
                        <?php if($p['submited_status']==1) : ?>
                          <?php if($p['statusvalidator']==0 || $p['statusvalidator']==null) : ?>
                          <a href="#" kunci="<?= $p['uuid']; ?>" class="btn btn-xs btn-success approve"><i class="fas fa-check"></i></a>
                          <a href="#" kunci="<?= $p['uuid']; ?>" class="btn btn-xs btn-danger reject"><i class="fas fa-times"></i></a>
                          <?php elseif($p['statusvalidator']==1) : ?>
                            <span class="text-success text-bold">Disetujui</span>
                          <?php elseif($p['statusvalidator']==2) : ?>
                            <span class="text-danger text-bold" data-toggle="tooltip" title="<?= $p['keteranganpenolakan'] ?>">Ditolak</span>
                          <?php else : ?>
                            -
                          <?php endif; ?>
                        <?php elseif($p['submited_status']==2 || $p['submited_status']==3 || $p['submited_status']==4 || $p['submited_status']==5) : ?>
                          <?php if($p['statusvalidator']==0 || $p['statusvalidator']==null) : ?>
                            -
                          <?php elseif($p['statusvalidator']==1) : ?>
                            <span class="text-success text-bold">Disetujui</span>
                          <?php elseif($p['statusvalidator']==2) : ?>
                            <span class="text-danger text-bold" data-toggle="tooltip" title="<?= $p['keteranganpenolakan'] ?>">Ditolak</span>
                          <?php else : ?>
                            -
                          <?php endif; ?>
                        <?php else : ?>
                          -
                        <?php endif; ?>
                      </td>
                      <td class="aksisikumbang<?= $p['uuid']; ?>">
                        <?php if($p['submited_status']==1) : ?>
                          <?php if($p['statussikumbang']==0 || $p['statussikumbang']==null) : ?>
                          <a href="#" kunci="<?= $p['uuid']; ?>" class="btn btn-xs btn-success approvesikumbang"><i class="fas fa-check"></i></a>
                          <a href="#" kunci="<?= $p['uuid']; ?>" class="btn btn-xs btn-danger rejectsikumbang"><i class="fas fa-times"></i></a>
                          <?php elseif($p['statussikumbang']==1) : ?>
                            <span class="text-success text-bold">Disetujui</span>
                          <?php elseif($p['statussikumbang']==2) : ?>
                            <span class="text-danger text-bold" data-toggle="tooltip" title="<?= $p['kettolaksikumbang'] ?>">Ditolak</span>
                          <?php else : ?>
                            -
                          <?php endif; ?>
                        <?php elseif($p['submited_status']==2 || $p['submited_status']==3 || $p['submited_status']==4 || $p['submited_status']==5) : ?>
                          <?php if($p['statussikumbang']==0 || $p['statussikumbang']==null) : ?>
                            -
                          <?php elseif($p['statussikumbang']==1) : ?>
                            <span class="text-success text-bold">Disetujui</span>
                          <?php elseif($p['statussikumbang']==2) : ?>
                            <span class="text-danger text-bold" data-toggle="tooltip" title="<?= $p['kettolaksikumbang'] ?>">Ditolak</span>
                          <?php else : ?>
                            -
                          <?php endif; ?>
                        <?php else : ?>
                          -
                        <?php endif; ?>
                      </td>
                      <td class="aksieflpp<?= $p['uuid']; ?>">
                        <?php if($p['submited_status']==1) : ?>
                          <?php if($p['statuseflpp']==0 || $p['statuseflpp']==null) : ?>
                          <a href="#" kunci="<?= $p['uuid']; ?>" class="btn btn-xs btn-success approveeflpp"><i class="fas fa-check"></i></a>
                          <a href="#" kunci="<?= $p['uuid']; ?>" class="btn btn-xs btn-danger rejecteflpp"><i class="fas fa-times"></i></a>
                          <?php elseif($p['statuseflpp']==1) : ?>
                            <span class="text-success text-bold">Disetujui</span>
                          <?php elseif($p['statuseflpp']==2) : ?>
                            <span class="text-danger text-bold" data-toggle="tooltip" title="<?= $p['kettolakeflpp'] ?>">Ditolak</span>
                          <?php else : ?>
                            -
                          <?php endif; ?>
                        <?php elseif($p['submited_status']==2 || $p['submited_status']==3 || $p['submited_status']==4 || $p['submited_status']==5) : ?>
                          <?php if($p['statuseflpp']==0 || $p['statuseflpp']==null) : ?>
                            -
                          <?php elseif($p['statuseflpp']==1) : ?>
                            <span class="text-success text-bold">Disetujui</span>
                          <?php elseif($p['statuseflpp']==2) : ?>
                            <span class="text-danger text-bold" data-toggle="tooltip" title="<?= $p['kettolakeflpp'] ?>">Ditolak</span>
                          <?php else : ?>
                            -
                          <?php endif; ?>
                        <?php else : ?>
                          -
                        <?php endif; ?>
                      </td>
                      <td class="aksisp3k<?= $p['uuid']; ?>">
                        <?php if($p['submited_status']==1) : ?>
                          <?php if($p['statussp3k']==0 || $p['statussp3k']==null) : ?>
                            <a href="#" kunci="<?= $p['uuid']; ?>" class="btn btn-xs btn-success approvesp3k"><i class="fas fa-check"></i></a>
                            <a href="#" kunci="<?= $p['uuid']; ?>" class="btn btn-xs btn-danger rejectsp3k"><i class="fas fa-times"></i></a>
                          <?php elseif($p['statussp3k']==1) : ?>
                            <span class="text-success text-bold">Disetujui</span>
                          <?php elseif($p['statussp3k']==2) : ?>
                            <span class="text-danger text-bold" data-toggle="tooltip" title="<?= $p['kettolaksp3k'] ?>">Ditolak</span>
                          <?php else : ?>
                            -
                          <?php endif; ?>
                        <?php elseif($p['submited_status']==2 || $p['submited_status']==3 || $p['submited_status']==4 || $p['submited_status']==5) : ?>
                          <?php if($p['statussp3k']==0 || $p['statussp3k']==null) : ?>
                            -
                          <?php elseif($p['statussp3k']==1) : ?>
                            <span class="text-success text-bold">Disetujui</span>
                          <?php elseif($p['statussp3k']==2) : ?>
                            <span class="text-danger text-bold" data-toggle="tooltip" title="<?= $p['kettolaksp3k'] ?>">Ditolak</span>
                          <?php else : ?>
                            -
                          <?php endif; ?>
                        <?php else : ?>
                          -
                        <?php endif; ?>
                      </td>
                      </tr>
                    <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
            </div>
          </div>
        </div>
      </div>
    </section>
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
        $('[data-toggle="tooltip"]').tooltip()
    })
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
    $(document).ready(function() {
        

        $(".approve").click(function(e) {
            e.preventDefault();
            var uuid = $(this).attr('kunci');
            var csrfHash = $(this).closest('tr').find('.csrf').val();
            approve(uuid, csrfHash, 'validator', 'approve');
        });
        $(".reject").click(function(e) {
            e.preventDefault();
            var uuid = $(this).attr('kunci');
            var csrfHash = $(this).closest('tr').find('.csrf').val();
            reject(uuid, csrfHash, 'validator', 'reject');
        });
        
        $(".approvesikumbang").click(function(e) {
            e.preventDefault();
            var uuid = $(this).attr('kunci');
            var csrfHash = $(this).closest('tr').find('.csrf').val();
            approve(uuid, csrfHash, 'sikumbang', 'approve');
        });
        $(".rejectsikumbang").click(function(e) {
            e.preventDefault();
            var uuid = $(this).attr('kunci');
            var csrfHash = $(this).closest('tr').find('.csrf').val();
            reject(uuid, csrfHash, 'sikumbang', 'reject');
        });

        $(".approveeflpp").click(function(e) {
            e.preventDefault();
            var uuid = $(this).attr('kunci');
            var csrfHash = $(this).closest('tr').find('.csrf').val();
            approve(uuid, csrfHash, 'eflpp', 'approve');
        });
        $(".rejecteflpp").click(function(e) {
            e.preventDefault();
            var uuid = $(this).attr('kunci');
            var csrfHash = $(this).closest('tr').find('.csrf').val();
            reject(uuid, csrfHash, 'eflpp', 'reject');
        });

        $(".approvesp3k").click(function(e) {
            e.preventDefault();
            var uuid = $(this).attr('kunci');
            var csrfHash = $(this).closest('tr').find('.csrf').val();
            approve(uuid, csrfHash, 'sp3k', 'approve');
        });
        $(".rejectsp3k").click(function(e) {
            e.preventDefault();
            var uuid = $(this).attr('kunci');
            var csrfHash = $(this).closest('tr').find('.csrf').val();
            reject(uuid, csrfHash, 'sp3k', 'reject');
        });

        function approve(uuid, csrfHash, type, action) {

            $.ajax({
                type: "post",
                headers: {'X-Requested-With': 'XMLHttpRequest'},
                url: "<?= base_url(); ?>/operator/do_approve_unit/" + type + "/" + action,
                data: {
                    csrf_test_name: csrfHash,
                    uuid: uuid
                },
                dataType: "json",
                success: function(response) {
                    if(response.status == 'success') {
                        $(".csrf").val(response.csrf);
                        $(".aksi"+type+response.uuid).html('<span class="text-success text-bold">Disetujui</span>');
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil disetujui!',
                            text: response.message,
                        });
                    }
                },
                error: function(xhr, status, error) {
                    if(xhr.responseJSON) {
                        $(".csrf").val(xhr.responseJSON.csrf);
                    }
                    Swal.fire({
                        icon: 'error', 
                        title: 'Oops...',
                        text: 'Gagal disetujui!',
                    });
                }
            });
        }
        function reject(uuid, csrfHash, type, action) {
            
            Swal.fire({
                text: "Keterangan penolakan",
                input: 'textarea', 
                showCancelButton: true,
                confirmButtonColor: "#DC3545",
                confirmButtonText: "Tolak"
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
                        url: "<?= base_url(); ?>/operator/do_reject_unit/" + type + "/" + action,
                        data: {
                            csrf_test_name: csrfHash,
                            uuid: uuid,
                            keteranganpenolakan: keteranganpenolakan
                        },
                        dataType: "json",
                        success: function(response) {
                            if(response.status == 'success') {
                                $(".csrf").val(response.csrf);
                                $(".aksi"+type+response.uuid).html('<span class="text-danger text-bold" data-toggle="tooltip" title="'+response.message+'">Ditolak</span>');
                                $('[data-toggle="tooltip"]').tooltip();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil ditolak!',
                                    text: '',
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            if(xhr.responseJSON) {
                                $(".csrf").val(xhr.responseJSON.csrf);
                            }
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: xhr.responseJSON.message,
                            });
                        }
                    });
                }
            });
        }
    }); 
</script>

<?= $this->endSection(); ?>