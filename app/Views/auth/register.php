<!DOCTYPE html>
<html>
<head>
    <title>Daftar Akun | AMINS PROJECT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow border-0">
                <div class="card-body p-4">
                    <h4 class="text-center mb-4 fw-bold">Buat Akun Baru</h4>

                    <?php if(session()->getFlashdata('errors')): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach(session()->getFlashdata('errors') as $error): ?>
                                    <li><?= $error ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form method="post" action="<?= base_url('register/process') ?>">
                        <?= csrf_field() ?>
                        
                        <div class="mb-3">
                            <label class="form-label text-muted small">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" value="<?= old('name') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted small">Email Address</label>
                            <input type="email" name="email" class="form-control" value="<?= old('email') ?>" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted small">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted small">Konfirmasi Password</label>
                                <input type="password" name="password_conf" class="form-control" required>
                            </div>
                        </div>

                        <button class="btn btn-primary w-100 mb-3">Daftar Sekarang</button>
                    </form>

                    <div class="text-center">
                        <small class="text-muted">Sudah punya akun? <a href="<?= base_url('login') ?>" class="text-decoration-none fw-bold">Login Disini</a></small>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>