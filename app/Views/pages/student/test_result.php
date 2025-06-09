<?= $this->extend('layout/pages-layout') ?>
<?= $this->section('content') ?>

<div class="container mt-5 text-center">
    <h2>🎯 Test Completed</h2>
    <p class="lead">Your score: <strong><?= $score ?>%</strong></p>

    <?php if ($status === 'Pass'): ?>
        <div class="alert alert-success">✅ Congratulations! You passed.</div>
    <?php else: ?>
        <div class="alert alert-danger">❌ You did not pass. Try again later!</div>
    <?php endif; ?>

    <a href="<?= base_url('student/tests') ?>" class="btn btn-primary mt-3">
        <i class="fas fa-arrow-left me-1"></i> Back to Tests
    </a>
</div>

<?= $this->endSection() ?>
