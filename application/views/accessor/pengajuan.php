<div class="container-fluid">

    <h4 class="h4 mb-4 text-gray-800"><?= $title; ?></h4>

    <div class="container">
        <?= $this->session->flashdata('message'); ?>
        <form action="<?= base_url('accessor/tambahPengajuan'); ?>" method="POST" role="form" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="jenisDesain"><span style="color: red">*</span>Jenis Desain</label>
                        <select class="form-control" name="jenisDesain" id="jenisDesain" required>
                            <option>..........</option>
                            <option value="Banner">Banner</option>
                            <option value="Pamflate">Pamflate</option>
                            <option value="Poster">Poster</option>
                        </select>
                        <?= form_error('jenisDesain', '<small class="text-danger">', '</small>') ?>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="ukuran"><span style="color: red">*</span>Ukuran ( cm / m )</label>
                        <input type="text" class="form-control" name="ukuran" id="ukuran" placeholder="Ukuran">
                        <?= form_error('ukuran', '<small class="text-danger">', '</small>') ?>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="kegiatan"><span style="color: red">*</span>Kegiatan</label>
                        <input type="text" class="form-control" name="kegiatan" id="kegiatan" placeholder="Nama Kegiatan">
                        <?= form_error('kegiatan', '<small class="text-danger">', '</small>') ?>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="management"><span style="color: red">*</span> Management</label>
                        <input type="text" class="form-control" name="management" id="management" placeholder="Management">
                        <?= form_error('management', '<small class="text-danger">', '</small>') ?>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-group">
                        <label for="isi"><span style="color: red">*</span> Isi Desain</label>
                        <textarea class="form-control" name="isi" id="isi" placeholder="Isi Desain" rows="3"></textarea>
                        <?= form_error('isi', '<small class="text-danger">', '</small>') ?>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="deadline"><span style="color: red">*</span> Deadline (* 01 May 2020)</label>
                        <input type="text" class="form-control" name="deadline" id="deadline" placeholder="Deadline">
                        <?= form_error('deadline', '<small class="text-danger">', '</small>') ?>
                    </div>
                </div>
                <div>
                    <input type="hidden" name="kd_guru" class="form-control" value="<?= $user['kd_guru']; ?>">
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-info btn-user btn-block">
                        Kirim Pengajuan Desain
                    </button>
                </div>
            </div>
        </form>
    </div>
    <hr>
    <div class="col-sm-12 mx-2">
        <table id="myTable" class="display nowrap" style="width:100%">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Jenis Desain</th>
                    <th scope="col">Ukuran</th>
                    <th scope="col">Kegiatan</th>
                    <th scope="col">Isi Desain</th>
                    <th scope="col">Tanggal Pengajuan</th>
                    <th scope="col">Deadline</th>
                    <th scope="col">Status</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($query->result() as $row) :
                    $jenis = $row->jenis_desain;
                    $ukuran = $row->ukuran;
                    $kegiatan = $row->kegiatan;
                    $isi = $row->isi;
                    $tgl = date('d F Y', $row->tgl_pengajuan);
                    $deadline = $row->deadline;
                    $gambar = $row->gambar;

                    if ($status = $row->status == '1') {
                        $sts = 'Terkirim';
                    } elseif ($status = $row->status == '2') {
                        $sts = 'Dikerjakan';
                    } elseif ($status = $row->status == '3') {
                        $sts = 'Menunggu ACC';
                    } elseif ($status = $row->status == '4') {
                        $sts = 'ACC';
                    };
                ?>
                    <tr>
                        <th scope="row"><?= $no++; ?></th>
                        <td><?= $jenis; ?></td>
                        <td><?= $ukuran; ?></td>
                        <td><?= $kegiatan; ?></td>
                        <td><?= $isi; ?></td>
                        <td><?= $tgl; ?></td>
                        <td><?= $deadline; ?></td>
                        <td class="text-warning" id="statusPengajuan"> <strong><?= $sts; ?></strong></td>
                        <td>
                            <a href="" class="btn btn-sm btn-info" id="detailPengajuan" data-toggle="modal" data-target="#detailsModal" data-jenis="<?= $jenis; ?>" data-ukuran="<?= $ukuran; ?>" data-kegiatan="<?= $kegiatan; ?>" data-isi="<?= $isi; ?>" data-tgl="<?= $tgl; ?>" data-deadline="<?= $deadline; ?>" data-gambar="<?= $gambar; ?>" data-sts="<?= $sts; ?>"><i class="fa fa-eye pr-2"></i>Details</a>
                        </td>
                        <td>
                            <form action="<?= base_url('accessor/download') ?>" method="POST">
                                <input type="hidden" name="id" value="<?= $row->id; ?>">
                                <input type="hidden" name="file" value="<?= $row->file; ?>">
                                <input type="hidden" name="status" value="<?= $row->status; ?>">
                                <button class="btn btn-sm btn-success"><i class="fa fa-cloud-download-alt pr-2"></i>Download</button>
                            </form>
                        </td>
                    </tr>

                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <hr class="my-4">
</div>

<!-- Details  -->
<div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="projectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="projectModalLabel">Detail Pengajuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 my-3 ">
                        <img src="" id="gbr" height="700px" class="img-fluid my-auto">
                    </div>
                    <div class="col-md-8 border-0">
                        <li class="list-group-item ">Status : <strong class="text-warning"><span id="status"></span></strong></li>
                        <li class="list-group-item ">Jenis Desain : <strong><span id="jenis"></span></strong></li>
                        <li class="list-group-item">Ukuran : <strong><span id="ukur"></span></strong></li>
                        <li class="list-group-item">Kegiatan : <strong><span id="kgtn"></span></strong></li>
                        <li class="list-group-item">Isi Desain : <strong><span id="is"></span></strong></li>
                        <li class="list-group-item">Tanggal Pengajuan : <strong><span id="tgl"></span></strong></li>
                        <li class="list-group-item text-danger">Dead : <strong><span id="dead"></span></strong></li>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-sm" data-dismiss="modal">Close detail</button>
                </form>
            </div>
        </div>
    </div>
</div>