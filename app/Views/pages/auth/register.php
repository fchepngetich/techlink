<?= $this->extend('layout/auth-layout') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0">
                <div class="text-white text-center">
                    <img class="login-logo d-block mx-auto mt-2" width="100" height="70" src="/src/assets/images/techlink.png" alt="logo" />
                        <h4 class="card-title text-center mt-2">Student Registration Form</h4>
                </div>
                <div class="card-body">

                  
                    <form action="<?= base_url('auth/register') ?>" method="post">
                        <?= csrf_field() ?>
                    <?php if (session()->getFlashdata('validation')): ?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('validation')->listErrors() ?>
                        </div>
                    <?php endif; ?>


                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control border border-dark" value="<?= old('name') ?>" required>
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" id="email" class="form-control border border-dark" value="<?= old('email') ?>" required>
                            </div>

                            <div class="col-md-6">
                                <label for="university" class="form-label">University <span class="text-danger">*</span></label>
                                <input type="text" name="university" id="university" class="form-control border border-dark" value="<?= old('university') ?>" required>
                            </div>

                            <div class="col-md-6">
                                <label for="admission_no" class="form-label">Admission No <span class="text-danger">*</span></label>
                                <input type="text" name="admission_no" id="admission_no" class="form-control border border-dark" value="<?= old('admission_no') ?>" required>
                            </div>

                            <div class="col-md-6">
                                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                <input type="password" name="password" id="password" class="form-control border border-dark" required>
                            </div>

                            <div class="col-md-6">
                                <label for="confirm" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                <input type="password" name="confirm" id="confirm" class="form-control border border-dark" required>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-success px-4">Register</button>
                        </div>

                        <div class="text-center mt-3">
                            Already have an account?
                            <a href="<?= base_url('auth/login') ?>" class="text-decoration-none">Login here</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
