<?= $this->extend('layout/pages-layout') ?>
<?= $this->section('content') ?>

<div class="container">
    <h2 class="mb-4">👋 Hello, <?= esc($student['name']) ?></h2>

    <div class="row g-4">

        <!-- Stats Summary Cards -->
        <div class="col-md-3">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <h6 class="text-muted">📤 Applications Sent</h6>
                    <h2 class="fw-bold"><?= esc($stats['applications_sent'] ?? 0) ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <h6 class="text-muted">🏢 Companies Viewed</h6>
                    <h2 class="fw-bold"><?= esc($stats['companies_viewed'] ?? 0) ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <h6 class="text-muted">🧪 Tests Completed</h6>
                    <h2 class="fw-bold"><?= esc($stats['tests_completed'] ?? 0) ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <h6 class="text-muted">📈 Profile Complete</h6>
                    <h2 class="fw-bold"><?= esc($stats['profile_percent'] ?? '0%') ?></h2>
                </div>
            </div>
        </div>


        <!-- Recent Applications -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">📥 Recent Applications</div>
                <div class="card-body">
                    <?php if ($applications): ?>
                        <?php foreach ($applications as $app): ?>
                            <div class="mb-3 p-3 border rounded d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="mb-0"><?= esc($app['company_name']) ?></h6>
                                    <p class="mb-1 text-muted"><?= esc($app['opportunity_title']) ?></p>
                                </div>
                                <div>
                                    <span class="badge bg-secondary"><?= esc($app['status']) ?></span>
                                </div>
                            </div>

                        <?php endforeach ?>
                    <?php else: ?>
                        <p class="text-muted">You haven’t applied to any opportunities yet.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Upcoming Tests -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-warning text-dark">🧪 Upcoming Tests</div>
                <div class="card-body">
                    <?php if (!empty($upcoming_tests)): ?>
                        <?php foreach ($upcoming_tests as $test): ?>
                            <div class="mb-3 p-3 border rounded">
                                <h6 class="mb-0"><?= esc($test['company_name']) ?></h6>
                                <p class="mb-1 text-muted"><?= esc($test['test_name']) ?></p>
                                <p class="mb-1">
                                    <i class="fas fa-calendar-day text-warning me-1"></i>
                                    <?= date('F j, Y', strtotime($test['test_date'])) ?>
                                </p>
                                <span class="badge bg-secondary"><?= esc($test['status']) ?></span>
                            </div>
                        <?php endforeach ?>
                    <?php else: ?>
                        <p class="text-muted">No upcoming tests scheduled.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>


    </div>
</div>

<?= $this->endSection() ?>