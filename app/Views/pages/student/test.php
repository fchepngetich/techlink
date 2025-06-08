<?= $this->extend('layout/pages-layout') ?>
<?= $this->section('content') ?>

<div class="container rounded shadow">
    <div class="row">
        <div class="col-12 mt-3">
            <h4 class="mb-3">🧪 Aptitude & Technical Tests</h4>
        </div>

        <?php if (!empty($tests)): ?>
            <?php foreach ($tests as $test): ?>
                <div class="col-md-6 mb-4">
                    <div class="card shadow border-0">
                        <div class="card-body">
                            <h5 class="card-title"><?= esc($test['title']) ?></h5>
                            <h6 class="text-muted mb-2">
                                <?= esc($test['company']) ?> – <?= esc($test['role']) ?>
                            </h6>

                            <?php if ($test['status'] === 'completed'): ?>
                                <span class="badge bg-success mb-2">Completed</span>
                                <p>
                                    <i class="fas fa-calendar-day text-warning me-2"></i>
                                    <strong>Scheduled:</strong> <?= date('F j, Y', strtotime($test['scheduled'])) ?>
                                </p>

                                <p>
                                    <i class="fas fa-chart-bar text-info me-2"></i>
                                    <strong>Score:</strong> <?= esc($test['score']) ?>%
                                </p>
                                <a href="#" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-file-alt me-1"></i> View Results
                                </a>

                            <?php elseif ($test['status'] === 'pending'): ?>
                                <span class="badge bg-warning text-dark mb-2">Pending</span>
                                <p>
                                    <i class="fas fa-calendar-day text-warning me-2"></i>
                                    <strong>Scheduled:</strong> <?= date('F j, Y', strtotime($test['scheduled'])) ?>
                                </p>

                                <a href="#" class="btn btn-primary btn-sm">
                                    <i class="fas fa-play me-1"></i> Take Test
                                </a>

                            <?php elseif ($test['status'] === 'upcoming'): ?>
                                <span class="badge bg-info mb-2">Upcoming</span>
                                <p>
                                    <i class="fas fa-calendar-day text-warning me-2"></i>
                                    <strong>Scheduled:</strong> <?= date('F j, Y', strtotime($test['scheduled'])) ?>
                                </p>

                                <span class="text-muted">
                                    <i class="fas fa-clock me-1"></i> Scheduled
                                </span>

                            <?php else: ?>
                                <span class="badge bg-secondary mb-2">Not Assigned</span>
                                <p>
                                    <i class="fas fa-calendar-day text-muted me-2"></i>
                                    <strong>Scheduled:</strong> —
                                </p>
                                <span class="text-muted">
                                    <i class="fas fa-ban me-1"></i> Awaiting Assignment
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-info">
                    No tests have been assigned yet.
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>