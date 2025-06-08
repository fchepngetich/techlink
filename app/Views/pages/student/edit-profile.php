<?= $this->extend('layout/pages-layout') ?>
<?= $this->section('content') ?>

<div class="container">
    <div class="card shadow border-1">
        <div class="card-header bg-primary text-white">
            <h4>Edit Profile</h4>
        </div>
        <div class="card-body">

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            <?php endif ?>

            <form action="<?= base_url('student/profile/update') ?>" method="post">
                <?= csrf_field() ?>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="<?= esc($student['name']) ?>"
                            required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="<?= esc($student['email']) ?>"
                            required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Phone</label>
                        <input type="number" name="phone" class="form-control" value="<?= esc($student['phone']) ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Admission No</label>
                        <input type="text" name="admission_no" class="form-control"
                            value="<?= esc($student['admission_no']) ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Course</label>
                        <input type="text" name="course" class="form-control" value="<?= esc($student['course']) ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>University</label>
                        <input type="text" name="university" class="form-control"
                            value="<?= esc($student['university']) ?>" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Skills (comma-separated)</label>
                        <input type="text" name="skills" class="form-control" value="<?= esc($student['skills']) ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>GitHub</label>
                        <input type="url" name="github" class="form-control"
                            value="<?= esc($student['github'] ?? '') ?>">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Portfolio Link</label>
                        <input type="url" name="portfolio" class="form-control"
                            value="<?= esc($student['portfolio'] ?? '') ?>">
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success">Save Changes</button>
                </div>
            </form>

        </div>
    </div>
</div>

<?= $this->endSection() ?>