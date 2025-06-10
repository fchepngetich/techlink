<?= $this->extend('layout/auth-layout') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
    <h4>Email Verification</h4>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('message') ?></div>
    <?php endif; ?>

    <form method="post" action="<?= base_url('/auth/verify-code') ?>">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label>Email used during registration</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Enter verification code</label>
            <input type="text" name="code" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Verify</button>
        <a href="<?= base_url('/auth/resend-code') ?>" class="btn btn-link">Resend Code</a>
    </form>
</div>


<?= $this->endSection() ?>
