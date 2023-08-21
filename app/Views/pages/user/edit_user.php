<?= $this->extend('pages/layout/main') ?>
<?= $this->section('content') ?>
<div class="card">
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Edit User
        </h5>
        <div class="card">
            <div class="card-body">
                <form action="/user/update/<?= $user['id'] ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="PUT">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="nip" class="form-label">NIP</label>
                                <input type="number" value="<?= old('nip', $user['nip']) ?>" name="nip" class="form-control <?= ($validation->hasError('nip') ? 'is-invalid' : '') ?>" id="nip">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('nip') ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="nama" <?= ($validation->hasError('nama') ? 'is-invalid' : '') ?> value="<?= old('nama', $user['nama']) ?>" name="nama" class="form-control <?= ($validation->hasError('nama') ? 'is-invalid' : '') ?>" id="nama">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('nama') ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" value="<?= old('username', $user['username']) ?>" name="username" class="form-control <?= ($validation->hasError('username') ? 'is-invalid' : '') ?>" id="username">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('username') ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" value="<?= old('email', $user['email']) ?>" name="email" class="form-control <?= ($validation->hasError('email') ? 'is-invalid' : '') ?>" id="email">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('email') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control <?= ($validation->hasError('password') ? 'is-invalid' : '') ?>" id="password">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('password') ?>
                                </div>
                                <p style="font-size: 12px;" class="text-danger"><i>Kosongkan password jika tidak ingin mengganti password</i></p>
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select name="role" class="form-control <?= ($validation->hasError('role') ? 'is-invalid' : '') ?>" id="role">
                                    <option disabled selected value>Pilih Role</option>
                                    <option value="admin" <?= old('role', $user['role']) == 'admin' ? 'selected' : '' ?>>Admin</option>
                                    <option value="user" <?= old('role', $user['role']) == 'user' ? 'selected' : '' ?>>User</option>
                                </select>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('role') ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Foto</label>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="button-wrapper">
                                            <label for="upload" class="btn btn-sm btn-primary text-white">
                                                <i class="fa fa-upload"></i>
                                                <span>Upload Foto Baru</span>
                                                <input type="file" onchange="previewImage()" id="upload" name="image" class="account-file-input <?= ($validation->hasError('image') ? 'is-invalid' : '') ?>" hidden />
                                                <div class="invalid-feedback text-white">
                                                    <?= $validation->getError('image') ?>
                                                </div>
                                            </label>
                                            <p style="font-size: 12px;" class="text-muted mb-0">Allowed JPG, JPEG or PNG. Max size of 2Mb</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <?php if (!empty($user['image'])) { ?>
                                            <img src="/user-images/<?= $user['image'] ?>" class="img-preview img-fluid">
                                        <?php } else { ?>
                                            <img src="/user-images/default.jpg" class="img-preview img-fluid">
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update User</button>
                    <a href="<?= base_url('user') ?>" class="btn btn-warning text-white">Batal</a>
                </form>
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