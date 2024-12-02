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
                    <label for="exampleInputFile">Kartu Tanda Anggota (KTA)</label>
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
                    <label for="exampleInputFile">Permohonan Pengajuan Pinjaman</label>
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
    $("#excel").click(function(){
      $(".table").table2excel({
        // exclude CSS class
        exclude: ".noExl",
        name: "Monitoring RVRO",
        filename: "<?= session('kddept'); ?>_<?= session('kdunit'); ?>_<?= session('kdsatker'); ?>_DataRO", //do not include extension
        fileext: ".xls" // file extension
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
      "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
      "autoWidth": false,
      "language": {
        "url": "<?= base_url() ?>/adminlte/plugins/datatables/Indonesian.json"
    }
    });

    //Initialize Select2 Elements
    $('.select2').select2();

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });

  });
</script>
<?= $this->endSection(); ?>