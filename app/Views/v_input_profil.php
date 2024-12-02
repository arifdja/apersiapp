<?= $this->extend('v2024/layout/template'); ?>

<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <!-- <img class="profile-user-img img-fluid img-circle"
                            src="../../dist/img/user4-128x128.jpg" alt="User profile picture"> -->
                        </div>

                        <?php if (!empty(session('kddept'))): ?>
                            <h3 class="profile-username text-center">(<?= session('kddept'); ?>) <?= getNamaDept(session('kddept'),'db2024'); ?></h3> 
                        <?php endif ?>
                        <?php if (!empty(session('kdunit'))): ?>
                            <h3 class="profile-username text-center">(<?= session('kdunit'); ?>) <?= getNamaUnit(session('kddept'),session('kdunit'),'db2024'); ?></h3> 
                        <?php endif ?>
                        <?php if (!empty(session('kdsatker'))): ?>
                            <h3 class="profile-username text-center">(<?= session('kdsatker'); ?>) <?= getNamaSatker(session('kdsatker'),'db2024'); ?></h3> 
                        <?php endif ?>

                        <?= form_open('app2024/profil/ubahProfil','class="form-horizontal"'); ?>
                        <?= csrf_field() ?>
                        <input type="hidden" name="mawar" value="<?= $result['id']; ?>">
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="nama" class="col-sm-2 col-form-label">Nama Operator</label>
                                <div class="col-sm-10">
                                    <input
                                        name="nama"
                                        type="text"
                                        class="form-control <?= $validation->hasError('nama') ? 'is-invalid' : ''; ?>"
                                        id="nama"
                                        value="<?php echo set_value('nama',(string) $result['nama']); ?>"
                                        placeholder="Nama">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('nama'); ?>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group row">
                                <label for="nip" class="col-sm-2 col-form-label">NIP</label>
                                <div class="col-sm-10">
                                    <input
                                        name="nip"
                                        type="text"
                                        class="form-control <?= $validation->hasError('nip') ? 'is-invalid' : ''; ?>"
                                        id="nip"
                                        value="<?php echo set_value('nip',(string) $result['nip']); ?>"
                                        placeholder="NIP">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('nip'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="telp" class="col-sm-2 col-form-label">Telepon</label>
                                <div class="col-sm-10">
                                    <input
                                        name="telp"
                                        type="text"
                                        class="form-control <?= $validation->hasError('telp') ? 'is-invalid' : ''; ?>"
                                        id="telp"
                                        value="<?php echo set_value('telp',(string) $result['notelp']); ?>"
                                        placeholder="Telepon">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('telp'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Alamat Email</label>
                                <div class="col-sm-10">
                                    <input
                                        name="email"
                                        type="email"
                                        class="form-control <?= $validation->hasError('email') ? 'is-invalid' : ''; ?>"
                                        id="email"
                                        value="<?php echo set_value('email',(string) $result['email']); ?>"
                                        placeholder="Email">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('email'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword1" class="col-sm-2 col-form-label">Password Lama</label>
                                <div class="col-sm-10">
                                    <input
                                        name="plma"
                                        type="password"
                                        class="form-control password <?= $validation->hasError('plma') ? 'is-invalid' : ''; ?>"
                                        id="inputPassword1"
                                        placeholder="Password Lama">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('plma'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword2" class="col-sm-2 col-form-label">Password Baru</label>
                                <div class="col-sm-10">
                                    <input
                                        name="pbru"
                                        type="password"
                                        class="form-control password <?= $validation->hasError('pbru') ? 'is-invalid' : ''; ?>"
                                        id="inputPassword2"
                                        placeholder="Password Baru">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('pbru'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Ulangi Password Baru</label>
                                <div class="col-sm-10">
                                    <input
                                        name="pbru2"
                                        type="password"
                                        class="form-control password <?= $validation->hasError('pbru2') ? 'is-invalid' : ''; ?>"
                                        id="inputPassword3"
                                        placeholder="Ulangi Password Baru">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('pbru2'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <input type="checkbox" class="" id="check">
                                    <label class="form-check-label" for="exampleCheck2">Tampilkan Password</label>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Ubah</button>
                                </div>
                            </div>
                        </div>

                        <!-- /.card-body -->
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
</div>
<!-- /.container-fluid -->
</section>
<?= $this->endSection(); ?>

<?= $this->section('south'); ?>
<script>
$(document).ready(function () {
// $('#textinfo').modal();
$('#check').click(function () {
    $(this).is(':checked')
        ? $('.password').attr('type', 'text')
        : $('.password').attr('type', 'password');
});
});
</script>
<?= $this->endSection(); ?>