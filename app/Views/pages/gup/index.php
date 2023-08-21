<?= $this->extend('pages/layout/main') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-lg-3 mb-3">
        <div class="card shadow border-bottom border-primary">
            <div class="card-body">
                <h4 class="card-title">Cari dokumen GUP</h4>
                <p class="card-description">
                    Cari dokumen <code>GUP</code> berdasarkan tahun
                </p>
                <form action="/gup/search" method="post">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <input type="number" placeholder="Ex: 2023" value="<?= old('tahun', $tahun) ?>" class="form-control mr-2 <?= ($validation->hasError('tahun') ? 'is-invalid' : '') ?>" id="tahun" name="tahun">
                        <button type="submit" class="btn btn-warning mt-2 btn-sm text-primary"><i class="fa fa-search"></i></button>
                        <div class="invalid-feedback">
                            <?= $validation->getError('tahun') ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-9 mb-3">
        <div class="card p-2 shadow border-bottom border-primary">
            <div class="card-body">
                <?php if ($userdata['role'] == 'admin') : ?>
                    <a href="<?= base_url('gup/create') ?>" class="btn btn-primary btn-sm mb-2 btn-icon-text">
                        <i class="ti-plus btn-icon-prepend"></i>Tambah</a>
                <?php endif; ?>
                <div class="table-responsive">
                    <table id="table" class="table table-striped" width="100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th>No. SPM</th>
                                <th scope="col">Uraian</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Box</th>
                                <th scope="col">File GUP</th>
                                <?php if ($userdata['role'] == 'admin') : ?>
                                    <th>Aksi</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1 ?>
                            <?php foreach ($gups as $gup) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $gup['no_spm'] ?></td>
                                    <?php if (str_word_count($gup['uraian']) > 5) { ?>
                                        <td><?= implode(' ', array_slice(explode(' ', $gup['uraian']), 0, 5)) . "<small><a data-toggle='modal' data-target='#readmoregup" . $gup['id'] . "'>...<i>read more</i></a></small>" ?></td>
                                    <?php } else { ?>
                                        <td><?= $gup['uraian'] ?></td>
                                    <?php } ?>
                                    <td><?= date('d M Y', strtotime($gup['tanggal'])) ?></td>
                                    <td><?= $gup['box'] ?></td>
                                    <td>
                                        <a href="/upload/gup/<?= $gup['file_gup'] ?>" class="badge badge-success" target="next_page"><i class="fa fa-download"></i> Download</a>
                                    </td>
                                    <?php if ($userdata['role'] == 'admin') : ?>
                                        <td>
                                            <a href="/gup/edit/<?= $gup['id'] ?>" title="Edit" class="badge bg-warning rounded-4 text-white"><i class="fa fa-edit"></i></a>
                                            <form id="confirm-delete" action="/gup/<?= $gup['id'] ?>" method="POST" class="d-inline">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button onclick="confirmDel('confirm-delete')" title="Hapus" type="submit" class="badge bg-danger border-0 rounded-4 text-white"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                                <div class="modal fade" id="readmoregup<?= $gup['id'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Detail Uraian GUP</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p><?= $gup['uraian'] ?></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>