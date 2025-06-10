<?= $this->extend('layout/pages-layout') ?>
<?= $this->section('content') ?>

<div class="container">
    <div class="card shadow border-0">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">📢 Post New Opportunity</h4>
        </div>
        <div class="card-body">
            <form action="<?= base_url('company/post-opportunity') ?>" method="post">
                <?= csrf_field() ?>
                
                <!-- Hidden company_id -->
                <input type="hidden" name="company_id" value="<?= session()->get('user_id') ?>">

                <div class="row g-3">

                    <!-- Title -->
                    <div class="col-md-6">
                        <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>

                    <!-- Type -->
                   <div class="col-md-6">
    <label for="type" class="form-label">Type <span class="text-danger">*</span></label>
    <select name="type" id="type" class="form-select border border-dark" required>
        <option value="">Select Type</option>
        <option value="internship" <?= old('type') === 'internship' ? 'selected' : '' ?>>Internship</option>
        <option value="mentorship" <?= old('type') === 'mentorship' ? 'selected' : '' ?>>Mentorship</option>
        <option value="job" <?= old('type') === 'job' ? 'selected' : '' ?>>Job</option>
        <option value="training" <?= old('type') === 'training' ? 'selected' : '' ?>>Training</option>
    </select>
</div>


                    <!-- Location -->
                    <div class="col-md-6">
                        <label for="location" class="form-label">Location <span class="text-danger">*</span></label>
                        <input type="text" name="location" id="location" class="form-control" required>
                    </div>

                    <!-- Deadline -->
                    <div class="col-md-6">
                        <label for="deadline" class="form-label">Application Deadline <span class="text-danger">*</span></label>
                        <input type="date" name="deadline" id="deadline" class="form-control" required>
                    </div>

                    <!-- Description -->
                    <div class="col-md-12">
                        <label for="description" class="form-label">Opportunity Description <span class="text-danger">*</span></label>
                        <textarea name="description" id="description" class="form-control" rows="5" required></textarea>
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="fas fa-paper-plane me-1"></i> Post Opportunity
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
