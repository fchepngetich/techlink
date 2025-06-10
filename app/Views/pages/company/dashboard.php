<?= $this->extend('layout/pages-layout') ?>
<?= $this->section('content') ?>

<div class="container py-4">
    <h3 class="mb-4">🏢 Company Dashboard</h3>

    <!-- Summary Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card shadow border-0 bg-light">
                <div class="card-body">
                    <h6 class="text-muted">Total Applicants</h6>
                    <h4 class="fw-bold"><?= $totalApplicants ?></h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow border-0 bg-light">
                <div class="card-body">
                    <h6 class="text-muted">Active Postings</h6>
                    <h4 class="fw-bold"><?= $activePostings ?></h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow border-0 bg-light">
                <div class="card-body">
                    <h6 class="text-muted">Tests Completed</h6>
                    <h4 class="fw-bold"><?= $testsCompleted ?></h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow border-0 bg-light">
                <div class="card-body">
                    <h6 class="text-muted">Interviews Scheduled</h6>
                    <h4 class="fw-bold"><?= $interviewsScheduled ?></h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Applications -->
    <div class="card shadow border-0 mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">🧾 Recent Applications</h5>
        </div>
        <div class="card-body">
            <?php if (!empty($recentApplications)): ?>
                <div class="row g-3">
                    <?php foreach ($recentApplications as $app): ?>
                        <div class="col-md-6">
                            <div class="border p-3 rounded bg-white shadow-sm">
                                <h6 class="fw-bold mb-1"><?= esc($app['student_name']) ?></h6>
                                <p class="mb-1 text-muted"><?= esc($app['university']) ?></p>
                                <p class="mb-1">
                                    GPA: <?= esc($app['gpa'] ?? '—') ?> |
                                    Test: <?= esc($app['test_score'] ?? '—') ?>%
                                </p>
                                <span class="badge bg-secondary"><?= esc(ucwords($app['status'])) ?></span>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            <?php else: ?>
                <p class="text-muted">No recent applications.</p>
            <?php endif ?>
        </div>
    </div>

    <!-- Posting Performance -->
    <div class="card shadow border-0">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">📈 Active Postings Performance</h5>
        </div>
        <div class="card-body">
            <?php if (!empty($postingsPerformance)): ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Title</th>
                                <th>Applications</th>
                                <th>Posted</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($postingsPerformance as $post): ?>
                                <tr>
                                    <td><?= esc($post['title']) ?></td>
                                    <td><?= esc($post['application_count']) ?></td>
                                    <td><?= date('F j, Y', strtotime($post['created_at'])) ?></td>
                                    <td><span class="badge bg-success">Active</span></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p class="text-muted">No postings available yet.</p>
            <?php endif ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
