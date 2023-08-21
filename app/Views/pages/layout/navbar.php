<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mx-2" href="/home"><img src="<?= base_url('assets') ?>/images/arsip-app.png" width="200" alt="logo" /></a>
        <a class="navbar-brand brand-logo-mini" href="/home"><img src="<?= base_url('assets') ?>/images/logo-bbws.jpg" alt="logo" /></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
            <li class="nav-item nav-search d-none d-lg-block">
                <div class="input-group">
                    <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                        <span class="input-group-text" id="search">
                            <i class="icon-search"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" id="navbar-search-input" placeholder="Search" aria-label="search" aria-describedby="search">
                </div>
            </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                    <?php if (!empty($userdata['image'])) { ?>
                        <img src="<?= base_url() ?>/user-images/<?= $userdata['image'] ?>" alt="profile" />
                    <?php } else { ?>
                        <img src="<?= base_url() ?>/user-images/default.jpg" alt="profile" />
                    <?php } ?>
                    <span><?= ucfirst($userdata['role']) ?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="/profil">
                        <i class="ti-user text-primary"></i>
                        Profile
                    </a>
                    <a class="dropdown-item" data-toggle="modal" data-target="#modallogout">
                        <i class="ti-power-off text-primary"></i>
                        Logout
                    </a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="icon-menu"></span>
        </button>
    </div>
</nav>
<!-- Logout Modal-->
<div class="modal fade" id="modallogout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Yakin Untuk Logout?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="/logout" method="POST">
                <div class="modal-body">
                    <?= csrf_field() ?>
                    <span>Klik "Logout" dibawah ini jika anda yakin ingin logout.</span>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-warning text-white" type="button" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Logout</button>
                </div>
            </form>
        </div>
    </div>
</div>