<?= $this->extend('layout/pages-layout') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h3>Edit Opportunity</h3>
    <form action="<?= base_url('company/opportunity/update/' . $opportunity['uuid']) ?>" method="post">
        <?= csrf_field() ?>
        <div class="row g-3">
            <div class="col-md-6">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="<?= esc($opportunity['title']) ?>" required>
            </div>

            <div class="col-md-6">
                <label for="type" class="form-label">Type</label>
                <select name="type" class="form-select" required>
                    <option value="">Select type</option>
                    <?php foreach (['Internship', 'Job', 'Mentorship'] as $type): ?>
                        <option value="<?= $type ?>" <?= $opportunity['type'] === $type ? 'selected' : '' ?>><?= $type ?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="col-md-6">
                <label for="location" class="form-label">Location</label>
                <input type="text" name="location" class="form-control" value="<?= esc($opportunity['location']) ?>" required>
            </div>

            <div class="col-md-6">
                <label for="deadline" class="form-label">Deadline</label>
                <input type="date" name="deadline" class="form-control" value="<?= esc($opportunity['deadline']) ?>" required>
            </div>

            <div class="col-md-12">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" rows="4" class="form-control" required><?= esc($opportunity['description']) ?></textarea>
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-success">Update</button>
            <a href="<?= base_url('company') ?>" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
