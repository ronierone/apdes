            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Aplikasi Pengajuan Desain SMK KP Pasirjambu <?= date('Y'); ?></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

            </div>
            <!-- End of Page Wrapper -->

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>

            <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Anda yakin ingin keluar?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Klik 'logout' untuk keluar</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bootstrap core JavaScript-->
            <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
            <script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

            <!-- Core plugin JavaScript-->
            <script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

            <!-- Custom scripts for all pages-->
            <script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

            <!-- Data table -->
            <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>

            <script>
                $(document).ready(function() {
                    $('#myTable').DataTable({
                        "scrollX": true
                    });
                });
            </script>
            <script>
                $('.custom-file-input').on('change', function() {
                    let fileName = $(this).val().split('\\').pop();
                    $(this).next('.custom-file-label').addClass("selected").html(fileName);
                });
            </script>
            <!-- Modal Detail Pengajuan  -->
            <script type="text/javascript">
                $(document).ready(function() {
                    $(document).on('click', '#detailPengajuan', function() {
                        let gambar = $(this).attr('data-gambar');
                        let management = $(this).attr('data-manag');
                        let file = $(this).attr('data-file');
                        let status = $(this).attr('data-sts');
                        let jenis = $(this).attr('data-jenis');
                        let ukuran = $(this).attr('data-ukuran');
                        let kegiatan = $(this).attr('data-kegiatan');
                        let isi = $(this).attr('data-isi');
                        let tgl = $(this).attr('data-tgl');
                        let deadline = $(this).attr('data-deadline');

                        $('#gbr').attr("src", "<?= base_url('assets/images/pengajuan_desain/') ?>" + gambar);
                        $('#management').text(management);
                        $('#file').text(file);
                        $('#status').text(status);
                        $('#ukur').text(ukuran);
                        $('#jenis').text(jenis);
                        $('#kgtn').text(kegiatan);
                        $('#is').text(isi);
                        $('#tgl').text(tgl);
                        $('#dead').text(deadline);
                    });

                });
            </script>

            <!-- Modal Kirim File  -->
            <script>
                $(document).on("click", ".kirimFile", function() {
                    var id = $(this).data('id');
                    $("#idData").val(id);
                });
            </script>


            </body>

            </html>