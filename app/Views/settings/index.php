<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        
        <h2 class="fw-bold mb-4 text-center">Pengaturan Akun</h2>

        <div class="card shadow border-0">
            <div class="card-body p-5">
                
                <div class="text-center mb-4">
                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-3" 
                         style="width: 100px; height: 100px; font-size: 40px; border: 4px solid #fff; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
                        <?= strtoupper(substr($user['name'], 0, 1)) ?>
                    </div>
                    <h3 class="fw-bold"><?= esc($user['name']) ?></h3>
                    <span class="badge bg-success">Administrator</span>
                </div>

                <hr>

                <form>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label fw-bold text-muted">Nama Lengkap</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="<?= esc($user['name']) ?>" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label fw-bold text-muted">Email Akun</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="<?= esc($user['email']) ?>" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label fw-bold text-muted">No. Handphone</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="0812-3456-7890" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label fw-bold text-muted">Tanggal Lahir</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="17 Agustus 1995" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label fw-bold text-muted">Alamat</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" rows="2" readonly>Jl. Programmer Sejati No. 1, Jakarta Selatan, Indonesia</textarea>
                        </div>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="button" class="btn btn-outline-primary" onclick="alert('Fitur edit belum tersedia ya!')">
                            <i class="bi bi-pencil-square"></i> Edit Profil
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>