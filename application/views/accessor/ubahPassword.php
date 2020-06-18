<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="col-lg-6">
        <?= $this->session->flashdata('message'); ?>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <form action="<?= base_url('Accessor/ubahPassword') ?>" method="POST">
                <div class="form-group">
                    <input type="hidden" class="form-control" id="passworddb" name="passwordb" value="<?= $user['password'] ?>">
                    <label for="password_lama">Password lama</label>
                    <input type="password" class="form-control" id="password_lama" name="password_lama">
                    <?= form_error('password_lama', '<small class="text-danger">', '</small>') ?>
                </div>
                <div class="form-group">
                    <label for="password_baru1">Password baru</label>
                    <input type="password" class="form-control" id="password_baru1" name="password_baru1">
                    <?= form_error('password_baru1', '<small class="text-danger">', '</small>') ?>
                </div>
                <div class="form-group">
                    <label for="password_baru2">Ulangi password</label>
                    <input type="password" class="form-control" id="password_baru2" name="password_baru2">
                    <?= form_error('password_baru2', '<small class="text-danger">', '</small>') ?>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-info"> Ubah password</button>
                </div>
            </form>
        </div>
    </div>


</div>