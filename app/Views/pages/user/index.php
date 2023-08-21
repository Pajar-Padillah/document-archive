<?= $this->extend('pages/layout/main') ?>
<?= $this->section('content') ?>
<div class="card p-2 shadow border-bottom border-primary">
    <div class="card-body">
        <a href="<?= base_url('user/create') ?>" class="btn btn-primary btn-sm mb-2 btn-icon-text">
            <i class="ti-plus btn-icon-prepend"></i>Tambah User</a>
        <div class="table-responsive">
            <table id="table" class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Foto</th>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td>
                                <?php if (empty($user['image'])) { ?>
                                    <img src="/user-images/default.jpg" alt="Image User" width="100%" height="90px">
                                <?php } else { ?>
                                    <img src="/user-images/<?= $user['image'] ?>" alt="Image User" width="100%" height="90px">
                                <?php } ?>
                            </td>
                            <td><?= $user['nip'] ?></td>
                            <td><?= ucfirst($user['nama']) ?></td>
                            <td><?= $user['username'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <?php if ($user['role'] == 'admin') { ?>
                                <td><span class="badge badge-primary"><?= $user['role'] ?></span></td>
                            <?php } elseif ($user['role'] == 'user') { ?>
                                <td><span class="badge badge-info"><?= $user['role'] ?></span></td>
                            <?php } ?>
                            <td>
                                <a href="/user/edit/<?= $user['id'] ?>" title="Edit" class="badge bg-warning rounded-4 text-white"><i class="fa fa-edit"></i></a>
                                <?php if ($user['id'] != 1) : ?>
                                    <form id="confirm-delete" action="/user/<?= $user['id'] ?>" method="POST" class="d-inline">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button onclick="confirmDel('confirm-delete')" title="Hapus" type="submit" class="badge bg-danger border-0 rounded-4 text-white"><i class="fa fa-trash"></i></button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>