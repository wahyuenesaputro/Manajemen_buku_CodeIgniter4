<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0">Daftar Pustaka</h2>
    <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="bi bi-plus-lg me-1"></i> Tambah Buku
    </button>
</div>

<?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
        <i class="bi bi-check-circle me-2"></i> <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4 py-3">No</th> 
                        <th>Title</th>
                        <th>Author</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($books)): foreach($books as $key => $b): ?>
                    <tr>
                        <td class="ps-4"><?= $key + 1 ?></td> 
                        <td class="fw-bold text-primary"><?= esc($b['title']) ?></td>
                        <td><?= esc($b['author']) ?></td>
                        <td>
                            <?php 
                                $badgeColor = ($b['status'] == 'published') ? 'success' : (($b['status'] == 'draft') ? 'warning' : 'secondary');
                            ?>
                            <span class="badge bg-<?= $badgeColor ?> bg-opacity-10 text-<?= $badgeColor ?> px-3 py-2 rounded-pill">
                                <?= ucfirst($b['status']) ?>
                            </span>
                        </td> 
                        <td class="text-center">
                            <a href="/book/delete/<?= $b['id'] ?>" class="btn btn-light btn-sm text-danger" onclick="return confirm('Hapus data ini?')">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; else: ?>
                        <tr><td colspan="5" class="text-center py-5 text-muted">Belum ada data buku.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Buku Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('book/store') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Judul Buku</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Penulis</label>
                        <input type="text" name="author" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="pending">Pending</option>
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>