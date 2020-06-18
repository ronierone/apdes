<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

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
                        $file = $row->file;
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
                            <td class="text-danger"><strong><?= $deadline; ?></strong></td>
                            <td><?= $manag; ?></td>
                            <td><?= $jenis; ?></td>
                            <td><?= $ukuran; ?></td>
                            <td><?= $kegiatan; ?></td>
                            <td><?= $isi; ?></td>
                            <td class="text-warning" id="statusPengajuan"> <strong><?= $sts; ?></strong></td>

                            <td>
                                <a href="" class="btn btn-sm btn-info" id="detailPengajuan" data-toggle="modal" data-target="#detailsModal" data-jenis="<?= $jenis; ?>" data-ukuran="<?= $ukuran; ?>" data-kegiatan="<?= $kegiatan; ?>" data-isi="<?= $isi; ?>" data-tgl="<?= $tgl; ?>" data-deadline="<?= $deadline; ?>" data-gambar="<?= $gambar; ?>" data-sts="<?= $sts; ?>" data-file="<?= $file; ?>" data-manag="<?= $manag; ?>"><i class="fa fa-eye pr-1"></i>Details</a>
                            </td>
                            <td>
                                <form action="<?= base_url('Accessor/updateStatus') ?>" method="POST">
                                    <input type="hidden" name="id" value="<?= $row->id; ?>">
                                    <button onclick="return confirm ('Anda yakin ingin menyetujui pengajuan ini ?')" class="btn btn-sm btn-success"><i class="fa fa-check pr-1"></i>ACC</button>
                                </form>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <hr class=" my-4">
    </div>
</div>
<!-- model details  -->
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
                        <li class="list-group-item ">File Project : <strong><span id="file"></span></strong></li>
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