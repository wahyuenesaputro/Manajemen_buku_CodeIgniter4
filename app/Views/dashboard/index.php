<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="container-fluid p-0">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark">Dashboard Overview</h2>
            <p class="text-muted mb-0">Selamat datang kembali, Admin!</p>
        </div>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 overflow-hidden">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted fw-semibold mb-1">Total Koleksi</h6>
                        <h2 class="fw-bold mb-0 text-dark"><?= $total_buku ?></h2>
                    </div>
                    <div class="bg-primary bg-opacity-10 p-3 rounded-circle text-primary">
                        <i class="fas fa-book fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted fw-semibold mb-1">Published</h6>
                        <h2 class="fw-bold mb-0 text-success"><?= $jml_published ?></h2>
                    </div>
                    <div class="bg-success bg-opacity-10 p-3 rounded-circle text-success">
                        <i class="fas fa-check-circle fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted fw-semibold mb-1">Draft / Pending</h6>
                        <h2 class="fw-bold mb-0 text-warning"><?= $total_buku - $jml_published ?></h2>
                    </div>
                    <div class="bg-warning bg-opacity-10 p-3 rounded-circle text-warning">
                        <i class="fas fa-edit fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm p-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold">Statistik Upload Bulanan</h5>
                    <select class="form-select form-select-sm w-auto">
                        <option>Tahun Ini</option>
                        <option>Tahun Lalu</option>
                    </select>
                </div>
                <div style="height: 300px;">
                    <canvas id="trendChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm p-4 h-100">
                <h5 class="fw-bold mb-3">Rasio Status Buku</h5>
                <div style="height: 250px; position: relative;">
                    <canvas id="statusChart"></canvas>
                </div>
                <div class="mt-3 text-center">
                    <small class="text-muted">Perbandingan buku tayang vs draft</small>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white py-3">
            <h5 class="fw-bold mb-0">Buku Baru Ditambahkan</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Judul Buku</th>
                            <th>Penulis</th>
                            <th>Tanggal Input</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($recent_books)) : ?>
                            <?php foreach($recent_books as $b) : ?>
                            <tr>
                                <td class="ps-4 fw-semibold"><?= $b['judul'] ?></td>
                                <td><?= $b['penulis'] ?></td>
                                <td class="text-muted small"><?= date('d M Y', strtotime($b['created_at'] ?? 'now')) ?></td>
                                <td>
                                    <?php if($b['status'] == 'published'): ?>
                                        <span class="badge bg-success bg-opacity-10 text-success px-3">Published</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning bg-opacity-10 text-warning px-3">Draft</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end pe-4">
                                    <a href="#" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="5" class="text-center py-4">Belum ada data buku.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // 1. Konfigurasi Doughnut Chart (Status)
    const ctxStatus = document.getElementById('statusChart').getContext('2d');
    new Chart(ctxStatus, {
        type: 'doughnut',
        data: {
            labels: ['Published', 'Draft'],
            datasets: [{
                data: [<?= $jml_published ?>, <?= $total_buku - $jml_published ?>],
                backgroundColor: ['#198754', '#ffc107'], // Hijau Bootstrap & Kuning Bootstrap
                borderWidth: 0,
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom' }
            },
            cutout: '75%' // Membuat lingkaran lebih tipis (modern look)
        }
    });

    // 2. Konfigurasi Line Chart (Trend Bulanan)
    const ctxTrend = document.getElementById('trendChart').getContext('2d');
    
    // Bikin gradient effect warna biru di bawah garis
    let gradient = ctxTrend.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(13, 110, 253, 0.2)'); // Biru transparan atas
    gradient.addColorStop(1, 'rgba(13, 110, 253, 0)');   // Putih bawah

    new Chart(ctxTrend, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'], // Label Bulan
            datasets: [{
                label: 'Upload Buku',
                data: <?= json_encode($monthly_stats ?? [0,0,0,0,0]) ?>, // Data dari Controller
                borderColor: '#0d6efd', // Biru Primary
                backgroundColor: gradient,
                fill: true,
                tension: 0.4, // Membuat garis melengkung halus (curved)
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false } // Sembunyikan legend agar bersih
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { borderDash: [5, 5] } // Garis grid putus-putus
                },
                x: {
                    grid: { display: false } // Hilangkan grid vertikal
                }
            }
        }
    });
</script>

<?= $this->endSection() ?>