<!DOCTYPE html>
<html>
<head>
    <title>Login | AMINS PROJECT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow border-0">
                <div class="card-body p-4">
                    <h4 class="text-center mb-4 fw-bold">Login Area</h4>

                    <?php if(session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if(session()->getFlashdata('success')): ?>
                        <div class="alert alert-success">
                            <?= session()->getFlashdata('success') ?>
                        </div>
                    <?php endif; ?>

                    <form method="post" action="<?= base_url('login') ?>">
                        <?= csrf_field() ?> 
                        <div class="mb-3">
                            <label class="form-label text-muted small">Email Address</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button class="btn btn-primary w-100 mb-3">Masuk Sekarang</button>
                    </form>

                    <div class="text-center">
                        <small class="text-muted">Belum punya akun? <a href="<?= base_url('register') ?>" class="text-decoration-none fw-bold">Daftar Disini</a></small>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>