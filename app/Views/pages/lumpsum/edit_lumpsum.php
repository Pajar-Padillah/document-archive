<?= $this->extend('pages/layout/main') ?>
<?= $this->section('content') ?>
<div class="card">
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Form Edit Dokumen Lumpsum
        </h5>
        <div class="card">
            <div class="card-body">
                <form action="/lumpsum/update/<?= $lumpsum['id'] ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="PUT">
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="mb-3">
                                <label for="no_spm" class="form-label">No. SPM</label>
                                <input type="number" name="no_spm" value="<?= old('no_spm', $lumpsum['no_spm']) ?>" class="form-control <?= ($validation->hasError('no_spm') ? 'is-invalid' : '') ?>" id="no_spm">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('no_spm') ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="uraian" class="form-label">Uraian</label>
                                <textarea name="uraian" class="form-control <?= ($validation->hasError('uraian') ? 'is-invalid' : '') ?>" id="uraian" cols="30" rows="3"><?= old('uraian', $lumpsum['uraian']) ?></textarea>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('uraian') ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" value="<?= old('tanggal', $lumpsum['tanggal']) ?>" name="tanggal" class="form-control <?= ($validation->hasError('tanggal') ? 'is-invalid' : '') ?>" id="tanggal">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('tanggal') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="mb-3">
                                <label for="box" class="form-label">Box</label>
                                <input type="number" name="box" value="<?= old('box', $lumpsum['box']) ?>" class="form-control <?= ($validation->hasError('box') ? 'is-invalid' : '') ?>" id="box">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('box') ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="file_lumpsum" class="form-label">File Lumpsum</label>
                                <input type="file" name="file_lumpsum" class="form-control <?= ($validation->hasError('file_lumpsum') ? 'is-invalid' : '') ?>" id="file_lumpsum">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('file_lumpsum') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="<?= base_url('lumpsum') ?>" class="btn btn-warning text-white">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>