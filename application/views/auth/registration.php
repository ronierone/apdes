<div class="sufee-login d-flex align-content-center flex-wrap">
    <div class="container mt-5">
        <div class="login-content">
            <div class="user-img col-12">
                <img class="float-right" src="<?= base_url('assets/'); ?>images/marketing.png" alt="">
            </div>
            <div class="login-form">
                <div class="text-center">
                    <h4 class="text-gray-900 mb-4">Aplikasi Pengajuan Desain</h4>
                </div>
                <div class="text-left">
                    <h1 class="h4 text-gray-900 mb-4">Daftar akun baru</h1>
                </div>
                <form class="user" method="POST" action="<?= base_url('auth/registration'); ?>">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="nama" name="nama" placeholder="Nama lengkap" value="<?= set_value('nama'); ?>">
                        <?= form_error('nama', '<small class="text-danger">', '</small>') ?>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="kd_guru" name="kd_guru" placeholder="Kode guru" value="<?= set_value('kd_guru'); ?>">
                        <?= form_error('kd_guru', '<small class="text-danger">', '</small>') ?>
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="jabatan" name="jabatan">
                            <option>Pilih Jabatan</option>
                            <option value="1">Accessor</option>
                            <option value="2">Editor</option>
                            <option value="3">User</option>
                        </select>
                        <?= form_error('jabatan', '<small class="text-danger">', '</small>') ?>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password min 6 karakter">
                            <?= form_error('password1', '<small class="text-danger">', '</small>') ?>
                        </div>
                        <div class="col-sm-6">
                            <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Masukan ulang password">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-info btn-user btn-block">
                        Daftar akun
                    </button>
                </form>
                <hr>
                <div class="register-link m-t-15 text-center">
                    <p>Sudah punya akun? <a style="color:black" href="<?= base_url('auth'); ?>"> Login</a></p>
                </div>
            </div>
        </div>
    </div>
</div>