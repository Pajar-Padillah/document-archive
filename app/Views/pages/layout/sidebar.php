<?php
$req = \Config\Services::request();
$segment1 = $req->getUri()->getSegment(1);
?>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item <?= ($segment1 == 'home') ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('home') ?>">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item <?= ($segment1 == 'profil') ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('profil') ?>">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">Profile</span>
            </a>
        </li>
        <?php if ($userdata['role'] == 'admin') : ?>
            <li class="nav-item <?= ($segment1 == 'user') ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('user') ?>">
                    <i class="icon-file menu-icon"></i>
                    <span class="menu-title">Data User</span>
                </a>
            </li>
        <?php endif; ?>
        <li class="nav-item <?= ($segment1 == 'lumpsum' or $segment1 == 'gup') ? 'active' : '' ?>">
            <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
                <i class="icon-paper menu-icon"></i>
                <span class="menu-title">Dokumen Arsip</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse <?= ($segment1 == 'lumpsum' or $segment1 == 'gup') ? 'show' : '' ?>" id="form-elements">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('lumpsum') ?>">Lumpsum</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('gup') ?>">GUP</a></li>
                </ul>
            </div>
        </li>
        <!-- <li class="nav-item <?= ($segment1 == 'category') ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('category') ?>">
                <i class="icon-file menu-icon"></i>
                <span class="menu-title">Data Category</span>
            </a>
        </li> -->
    </ul>
</nav>