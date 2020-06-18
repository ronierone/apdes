<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <!-- card -->
    <div class="card mb-3" style="max-width: 540px;">
        <div class=" row no-gutters">
            <div class="col-md-4">
                <img src="<?= base_url('assets/images/profile/') . $user['foto']; ?>" class="card-img">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?= $user['nama']; ?></h5>
                    <p class="card-text"><?= $user['kd_guru']; ?></p>
                    <p class="card-text"><small class="text-muted">Dibuat pada <?= date('d F Y', $user['date_created']); ?></small></p>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->