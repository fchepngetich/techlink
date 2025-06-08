<div class="container mt-5">
    <?= $this->extend('layout/auth-layout') ?>
    <?= $this->section('content') ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <img class="login-logo d-block mx-auto" src="/src/assets/images/techlink.png" alt="logo" />
                        <h4 class="card-title text-center mt-2">LOGIN HERE</h4>

                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger">
                                <?= esc($error) ?>
                            </div>
                        <?php endif; ?>

                        <form action="<?= base_url('auth/login/submit'); ?>" method="post">
                            <?= csrf_field(); ?>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <input type="password" name="password" id="password" class="form-control" required>
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                            <div class="text-center mt-3">
    Don't have an account?
    <a href="<?= base_url('auth/register') ?>" class="text-decoration-none">Register here</a>
</div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#password');
            const icon = togglePassword.querySelector('i');

            togglePassword.addEventListener('click', function () {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                icon.classList.toggle('fa-eye');
                icon.classList.toggle('fa-eye-slash');
            });
        });
    </script>

    <?= $this->endSection() ?>
</div>
