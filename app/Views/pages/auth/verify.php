<?= $this->extend('layout/auth-layout') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0">
                <div class="text-white text-center">
                    <img class="login-logo d-block mx-auto mt-2" width="100" height="70" src="/src/assets/images/techlink.png" alt="logo" />
                        <h4 class="card-title text-center mt-2">Student Verification Form</h4>
                </div>
                <div class="card-body">

                  <form action="<?= base_url('auth/verify') ?>" method="post">
    <?= csrf_field() ?>
    <label>Enter the 6-digit verification code sent to your email:</label>
    <input type="text" name="code" class="form-control" required>
    <button class="btn btn-primary mt-2">Verify</button>
</form>

                   

                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
