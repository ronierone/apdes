<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">
            <?= form_open_multipart('accessor/editProfile'); ?>
            <input type="hidden" name="gambar_lama" value="<?= $user['foto']; ?>">
            <div class="form-group row">
                <label for="kd" class="col-sm-3 col-form-label">Kode guru</label>
                <div class="col-sm-3">
                    <input type="text" id="kd" name="kd" class="form-control" value="<?= $user['kd_guru']; ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="nama" class="col-sm-3 col-form-label">Nama Lengkap</label>
                <div class="col-sm-9">
                    <input type="text" id="nama" name="nama" class="form-control" value="<?= $user['nama']; ?>">
                    <?= form_error('nama', '<small class="text-danger">', '</small>') ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3">Foto Profile</div>
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="<?= base_url('assets/images/profile/') . $user['foto']; ?>" class="img-thumbnail">
                        </div>
                        <div class="col-sm-9">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="gambar" name="gambar" aria-describedby="inputGroupFileAddon01">
                                <label class="custom-file-label" for="gambar">Pilih foto profile </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row justify-content-end">
                <div class="col-sm-9">
                    <button type="submit" class="btn btn-info">Edit profile</button>
                </div>
            </div>

            <? form_close(); ?>
        </div>
    </div>

</div>