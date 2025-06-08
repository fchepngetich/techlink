<?= $this->extend('layout/pages-layout') ?>
<?= $this->section('content') ?>

<div class="container rounded shadow">
    <div class="row">
        <div class="col-12 mt-3">
            <h4 class="mb-3">🔔 Notifications</h4>
        </div>

        <?php if (!empty($notifications)): ?>
            <?php foreach ($notifications as $note): ?>
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="fas fa-bell text-primary me-2"></i><?= esc($note['title']) ?>
                            </h5>
                            <p class="mb-2"><?= $note['message'] ?></p>

                            <small class="text-muted">
                                <i class="fas fa-clock me-1"></i>
                                <?= date('F j, Y, g:i A', strtotime($note['date'])) ?>
                            </small>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-info">
                    You have no new notifications.
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>