<?= $this->extend('layout/pages-layout') ?>
<?= $this->section('content') ?>

<div class="container card rounded shadow-sm">
    <h3 class="mb-4 mt-3">📋 My Applications</h3>

    <?php if (!empty($applications)): ?>
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>🏢 Company</th>
                        <th>💼 Position</th>
                        <th>📅 Applied Date</th>
                        <th>📌 Status</th>
                        <th>🔍 Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($applications as $app): ?>
                        <tr>
                            <td><?= esc($app['company_name']) ?></td>
                            <td><?= esc($app['opportunity_title']) ?></td>
                            <td>
                                <?= isset($app['created_at'])
                                    ? date('F j, Y', strtotime($app['created_at']))
                                    : '<span class="text-muted">N/A</span>' ?>
                            </td>

                            <td>
                                <span class="badge bg-warning"><?= esc($app['status']) ?></span>
                            </td>
                            <td>
                                <a href="<?= base_url('student/opportunity/view/' . $app['opportunity_uuid']) ?>"
                                    class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye me-1"></i> View Details
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-warning">
            You haven’t applied to any opportunities yet.
        </div>
    <?php endif ?>
</div>

<?= $this->endSection() ?>