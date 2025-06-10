<?= $this->extend('layout/pages-layout') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0"><i class="fas fa-paper-plane me-2"></i>Applications Received</h3>
    </div>

    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-success"><?= esc(session()->getFlashdata('message')) ?></div>
    <?php endif; ?>

    <?php if (!empty($applications)): ?>
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Student Name</th>
                        <th>University</th>
                        <th>Opportunity</th>
                        <th>Status</th>
                        <th>Applied On</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($applications as $index => $app): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= esc($app['student_name']) ?></td>
                            <td><?= esc($app['university']) ?></td>
                            <td><?= esc($app['opportunity_title']) ?></td>
                            <td><span class="badge bg-primary"><?= ucfirst(esc($app['status'])) ?></span></td>
                            <td>
                                <?= isset($app['created_at']) 
                                    ? date('F j, Y', strtotime($app['created_at'])) 
                                    : '<span class="text-muted">N/A</span>' ?>
                            </td>
                            <td>
                                <a href="#" class="btn btn-sm btn-outline-info">
                                    <i class="fas fa-eye me-1"></i> View
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-info text-center">
            <i class="fas fa-info-circle me-2"></i> No applications have been received yet.
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
