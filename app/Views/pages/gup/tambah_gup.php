<?= $this->extend('pages/layout/main') ?>
<?= $this->section('content') ?>
<div class="card">
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Form Tambah Dokumen GUP
        </h5>
        <div class="card">
            <div class="card-body">
                <form action="<?= base_url('gup/save') ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="mb-3">
                                <label for="no_spm" class="form-label">No. SPM</label>
                                <input type="number" name="no_spm" value="<?= old('no_spm') ?>" class="form-control <?= ($validation->hasError('no_spm') ? 'is-invalid' : '') ?>" id="no_spm">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('no_spm') ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="uraian" class="form-label">Uraian</label>
                                <textarea name="uraian" class="form-control <?= ($validation->hasError('uraian') ? 'is-invalid' : '') ?>" id="uraian" cols="30" rows="3"><?= old('uraian') ?></textarea>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('uraian') ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" value="<?= old('tanggal') ?>" name="tanggal" class="form-control <?= ($validation->hasError('tanggal') ? 'is-invalid' : '') ?>" id="tanggal">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('tanggal') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="mb-3">
                                <label for="box" class="form-label">Box</label>
                                <input type="number" name="box" value="<?= old('box') ?>" class="form-control <?= ($validation->hasError('box') ? 'is-invalid' : '') ?>" id="box">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('box') ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="file_gup" class="form-label">File GUP</label>
                                <input type="file" name="file_gup" class="form-control <?= ($validation->hasError('file_gup') ? 'is-invalid' : '') ?>" id="file_gup">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('file_gup') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                    <a href="<?= base_url('gup') ?>" class="btn btn-warning text-white">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>