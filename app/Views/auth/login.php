<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?> | Digital Arsip BBWS-Mesuji Sekampung</title>
    <link rel="icon" href="<?= base_url('assets') ?>/images/logo-bbws.jpg">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/login/styles.min.css">
    <script src="<?= base_url('assets') ?>/js/sweetalert2.js"></script>
</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-5 col-xxl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center mb-4">
                                    <a href="/login" class="text-center logo-img mt-3">
                                        <img src="/assets/images/arsip-app.png" width="65%" />
                                    </a>
                                </div>
                                <form action="/login" method="POST">
                                    <?= csrf_field() ?>
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input value="<?= old('username') ?>" type="text" name="username" autofocus class="form-control <?= ($validation->hasError('username') ? 'is-invalid' : '') ?>" id="username">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('username') ?>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control <?= ($validation->hasError('password') ? 'is-invalid' : '') ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('password') ?>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 py-8 fs-4 rounded-2">Login</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= base_url() ?>/assets/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/bootstrap.min.js" defer></script>
    <script src="<?= base_url('assets') ?>/js/sweetalert2.min.js"></script>
    <script>
        <?php if (session()->getFlashdata('flash_message')) { ?>
            swal({
                title: "<?= session()->getFlashdata('flash_message')['title']; ?>",
                text: "<?= session()->getFlashdata('flash_message')['message']; ?>",
                icon: "<?= session()->getFlashdata('flash_message')['icon']; ?>",
                timer: 2000
            });
        <?php } ?>
    </script>
</body>

</html>