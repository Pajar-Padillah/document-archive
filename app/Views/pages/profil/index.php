<?= $this->extend('pages/layout/main') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-lg-7 col-sm-12 mb-3">
                <div class="card p-2 shadow border-bottom border-primary">
                    <div class="card-body">
                        <div class="card-title">Edit Profil</div>
                        <form action="/profil/update/<?= $user['id'] ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="PUT">
                            <div class="row">
                                <div class="col-md-4 mb-4 mb-md-0">
                                    <?php if (!empty($user['image'])) { ?>
                                        <img src="/user-images/<?= $user['image'] ?>" alt="" class="img-preview img-thumbnail rounded-5 mb-2">
                                    <?php } else { ?>
                                        <img src="/user-images/default.jpg" alt="" class="img-preview img-thumbnail rounded-5 mb-2">
                                    <?php } ?>
                                    <div class="button-wrapper">
                                        <label for="upload" class="btn btn-sm btn-primary text-white">
                                            <i class="fa fa-upload"></i>
                                            <span>Upload Foto Baru</span>
                                            <input type="file" onchange="previewImage()" id="upload" name="image" class="account-file-input" hidden />
                                        </label>
                                        <p style="font-size: 12px;" class="text-muted mb-0">Allowed JPG, JPEG or PNG. Max size of 2Mb</p>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="">NIP</label>
                                        <input type="number" name="nip" value="<?= old('nip', $user['nip']) ?>" class="form-control <?= ($validation->hasError('nip') ? 'is-invalid' : '') ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('nip') ?>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="name">Nama</label>
                                        <input type="text" name="nama" value="<?= old('nama', $user['nama'])  ?>" class="form-control <?= ($validation->hasError('nama') ? 'is-invalid' : '') ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('nama') ?>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="username">Username</label>
                                        <input type="text" name="username" value="<?= old('username', $user['username']) ?>" class="form-control <?= ($validation->hasError('username') ? 'is-invalid' : '') ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('username') ?>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" value="<?= old('email', $user['email'])  ?>" class="form-control <?= ($validation->hasError('email') ? 'is-invalid' : '') ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('email') ?>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Ubah Profil</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-sm-12">
                <div class="card p-2 shadow border-bottom border-primary">
                    <div class="card-body">
                        <div class="card-title">Change Password</div>
                        <div class="row">
                            <div class="col-12">
                                <form action="/profil/change_password/<?= $user['id'] ?>" method="post">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="_method" value="PUT">
                                    <div class="mb-3">
                                        <label for="password">Password Lama</label>
                                        <input type="password" name="password" class="form-control <?= ($validation->hasError('password') ? 'is-invalid' : '') ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('password') ?>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="new_password">Password Baru</label>
                                        <input type="password" name="new_password" class="form-control <?= ($validation->hasError('new_password') ? 'is-invalid' : '') ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('new_password') ?>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password_confirm">Konfirmasi Password</label>
                                        <input type="password" name="password_confirm" class="form-control <?= ($validation->hasError('password_confirm') ? 'is-invalid' : '') ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('password_confirm') ?>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-lock"></i> Ubah Password</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function previewImage() {
        const img = document.querySelector('#upload');
        const imgPreview = document.querySelector('.img-preview');
        imgPreview.style.display = 'block';

        const blob = URL.createObjectURL(img.files[0]);
        imgPreview.src = blob;
    }
</script>
<?= $this->endSection() ?>