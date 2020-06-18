<div class="container-fluid">

    <h4 class="h4 mb-4 text-gray-800"><?= $title; ?></h4>

    <div class="container">
        <?= $this->session->flashdata('message'); ?>
        <div class="col-sm-12 mx-2">
            <table id="myTable" class="display nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Management</th>
                        <th scope="col">Deadline</th>
                        <th scope="col">Jenis Desain</th>
                        <th scope="col">Ukuran</th>
                        <th scope="col">Kegiatan</th>
                        <th scope="col">Isi Desain</th>
                        <th scope="col">Status</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($query->result() as $row) :
                        $i = 1;
                        $jenis = $row->jenis_desain;
                        $ukuran = $row->ukuran;
                        $kegiatan = $row->kegiatan;
                        $isi = $row->isi;
                        $tgl = date('d F Y', $row->tgl_pengajuan);
                        $deadline = $row->deadline;
                        $gambar = $row->gambar;
                        $manag = $row->management;

                        if ($status = $row->status == '1') {
                            $sts = 'Pending';
                        } elseif ($status = $row->status == '2') {
                            $sts = 'Perlu Dikirim';
                        } elseif ($status = $row->status == '3') {
                            $sts = 'Menunggu ACC';
                        } elseif ($status = $row->status == '4') {
                            $sts = 'ACC';
                        };
                    ?>
                        <tr>
                            <th scope="row"><?= $no++; ?></th>
                            <td><?= $manag; ?></td>
                            <td class="text-danger"><strong><?= $deadline; ?></strong></td>
                            <td><?= $jenis; ?></td>
                            <td><?= $ukuran; ?></td>
                            <td><?= $kegiatan; ?></td>
                            <td><?= $isi; ?></td>
                            <td class="text-warning" id="statusPengajuan"> <strong><?= $sts; ?></strong></td>

                            <td>

                                <form action="<?= base_url('Editor/updateStatus') ?>" method="POST">
                                    <input type="hidden" name="id" value="<?= $row->id; ?>">
                                    <button onclick="return confirm ('Anda yakin ingin menerima pengajuan ini ?')" class="btn btn-sm btn-success"><i class="fa fa-check pr-1"></i>Terima</button>
                                </form>
                            </td>
                            <td>
                                <a href="" class="btn btn-sm btn-info" id="detailPengajuan" data-toggle="modal" data-target="#detailsModal" data-jenis="<?= $jenis; ?>" data-ukuran="<?= $ukuran; ?>" data-kegiatan="<?= $kegiatan; ?>" data-isi="<?= $isi; ?>" data-tgl="<?= $tgl; ?>" data-deadline="<?= $deadline; ?>" data-gambar="<?= $gambar; ?>" data-sts="<?= $sts; ?>" data-manag="<?= $manag; ?>"><i class="fa fa-eye pr-1"></i>Details</a>
                            </td>
                            <td>
                                <button data-toggle="modal" data-target="#kirimModal" data-id="<?= $row->id ?>" class="kirimFile btn btn-sm btn-warning"><i class="fa fa-cloud-upload-alt pr-1"></i>Kirim file</button>
                                <a href="" class=""></a>
                            </td>
                            </td>

                        </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <hr class=" my-4">
    </div>
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
                        <li class="list-group-item ">Management : <strong><span id="management"></span></strong></li>
                        <li class="list-group-item ">Jenis Desain : <strong><span id="jenis"></span></strong></li>
                        <li class="list-group-item">Ukuran : <strong><span id="ukur"></span></strong></li>
                        <li class="list-group-item">Kegiatan : <strong><span id="kgtn"></span></strong></li>
                        <li class="list-group-item">Isi Desain : <strong><span id="is"></span></strong></li>
                        <li class="list-group-item">Tanggal Pengajuan : <strong><span id="tgl"></span></strong></li>
                        <li class="list-group-item text-danger">Deadline : <strong><span id="dead"></span></strong></li>
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

<!-- Modal kirim file-->
<div class="modal fade" id="kirimModal" tabindex="-1" role="dialog" aria-labelledby="buktiModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="buktiModalLabel">Upload FIle Hasil Desain</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('Editor/uploadFile') ?>" class="mx-4" role="form" data-toggle="validator" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="idData" id="idData" value="">

                    <div class="col-sm-12">
                        <label for="gambar">Upload gambar desain (*jpg|png|jpeg|bmp) :</label>
                        <div class="custom-file  mb-2">
                            <input type="file" class="custom-file-input" id="gambar" name="gambar" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="gambar">Pilih file gambar </label>
                        </div>
                        <div>
                            <?= form_error('gambar', '<small class="text-danger">', '</small>') ?>
                        </div>
                    </div>
                    <div class="col-sm-12 mt-3">
                        <label for="file">Upload file desain (*.rar|zip) :</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="file" name="file" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="file">Pilih project desain </label>
                        </div>
                        <div>
                            <?= form_error('file', '<small class="text-danger">', '</small>') ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>