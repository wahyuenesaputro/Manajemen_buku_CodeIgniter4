<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

    <h2 class="fw-bold mb-4">Overview </h2>

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 h-100">
                <small class="text-muted">Total Buku</small>
                <h2 class="text-primary fw-bold mb-0"><?= $total_buku ?></h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 h-100">
                <small class="text-muted">Published</small>
                <h2 class="text-success fw-bold mb-0"><?= $jml_published ?></h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 h-100">
                <small class="text-muted">Draft</small>
                <h2 class="text-warning fw-bold mb-0"><?= $total_buku - $jml_published ?></h2>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>