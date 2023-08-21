<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title ?> | Digital Arsip BBWS-Mesuji Sekampung</title>
    <link rel="stylesheet" href="<?= base_url('assets') ?>/vendors/feather/feather.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets') ?>/js/select.dataTables.min.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/css/vertical-layout-light/style.css">
    <link rel="shortcut icon" href="<?= base_url('assets') ?>/images/logo-bbws.jpg" />
</head>

<body>
    <div class="container-scroller">
        <?= $this->include('pages/layout/navbar') ?>
        <div class="container-fluid page-body-wrapper">
            <?= $this->include('pages/layout/sidebar') ?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="row">
                                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                                    <h3 class="font-weight-bold"><?= $title ?></h3>
                                </div>
                                <div class="col-12 col-xl-4">
                                    <div class="justify-content-end d-flex">
                                        <a class="btn btn-sm btn-light bg-warning text-white">
                                            <i class="mdi mdi-calendar"></i> <?= date('D') ?> (<?= date('d M Y') ?>)
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?= $this->renderSection('content') ?>
                </div>
                <?= $this->include('pages/layout/footer') ?>
            </div>
        </div>
    </div>
    <?php
    $req = \Config\Services::request();
    $segment1 = $req->getUri()->getSegment(1);
    ?>
    <?php if ($segment1 != 'home') : ?>
        <script src="<?= base_url('assets') ?>/vendors/js/vendor.bundle.base.js"></script>
    <?php endif; ?>
    <script src="<?= base_url('assets') ?>/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="<?= base_url('assets') ?>/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="<?= base_url('assets') ?>/js/dataTables.select.min.js"></script>
    <script src="<?= base_url('assets') ?>/js/sweetalert2.min.js"></script>
    <script src="<?= base_url('assets') ?>/js/off-canvas.js"></script>
    <script src="<?= base_url('assets') ?>/js/hoverable-collapse.js"></script>
    <script src="<?= base_url('assets') ?>/js/template.js"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        });

        <?php if (session()->getFlashdata('flash_message')) { ?>
            swal({
                title: "<?= session()->getFlashdata('flash_message')['title']; ?>",
                text: "<?= session()->getFlashdata('flash_message')['message']; ?>",
                icon: "<?= session()->getFlashdata('flash_message')['icon']; ?>",
                timer: 2000
            });
        <?php } ?>

        function confirmDel(item_id) {
            event.preventDefault();
            swal({
                    title: "Yakin ingin menghapus?",
                    text: "Semua data akan hilang dan tidak dapat di kembalikan!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $('#' + item_id).submit();
                    } else {
                        swal({
                            title: "Tindakan berhasil dibatalkan",
                            text: "Perubahan tidak akan diterapkan dan data tetap utuh",
                            icon: "info",
                            buttons: false,
                            timer: 2000
                        });
                    }
                });
        }
    </script>
</body>

</html>