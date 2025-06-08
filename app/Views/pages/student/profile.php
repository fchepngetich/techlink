<?= $this->extend('layout/pages-layout') ?>
<?= $this->section('content') ?>

<div class="container">

    <div class="row align-items-center mb-4">
        <div class="col text-start">
            <h2 class="mb-0">👤 My Profile</h2>
        </div>
        <div class="col-auto text-end">
            <a href="<?= base_url('student/profile/edit') ?>" class="btn btn-outline-primary">
                <i class="bi bi-pencil"></i> Edit Profile
            </a>
        </div>
    </div>

    <div class="row g-4">
        <!-- Profile Card -->
        <div class="col-lg-8">
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">👤 Personal Information</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Name:</label>
                            <p><?= esc($student['name']) ?></p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Email:</label>
                            <p><?= esc($student['email']) ?></p>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Phone:</label>
                            <p><?= esc($student['phone']) ?: '<span class="text-muted">Not provided</span>' ?></p>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">University:</label>
                            <p><?= esc($student['university']) ?></p>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Admission No:</label>
                            <p><?= esc($student['admission_no']) ?></p>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Course:</label>
                            <p><?= esc($student['course']) ?: '<span class="text-muted">Not specified</span>' ?></p>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Skills -->
            <div class="card mt-4 shadow-sm border-0">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">🛠️ Skills</h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($student['skills'])): ?>
                        <?php foreach (explode(',', $student['skills']) as $skill): ?>
                            <span class="badge bg-info me-1 mb-1"><?= esc(trim($skill)) ?></span>
                        <?php endforeach ?>
                    <?php else: ?>
                        <p class="text-muted">No skills listed yet.</p>
                    <?php endif ?>
                </div>
            </div>

            <!-- GitHub / Portfolio -->
            <div class="card mt-4 shadow-sm border-0">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">🌐 Online Presence</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <?php if (!empty($student['github'])): ?>
                            <li><strong>GitHub:</strong> <a href="<?= esc($student['github']) ?>"
                                    target="_blank"><?= esc($student['github']) ?></a></li>
                        <?php endif ?>
                        <?php if (!empty($student['portfolio'])): ?>
                            <li><strong>Portfolio:</strong> <a href="<?= esc($student['portfolio']) ?>"
                                    target="_blank"><?= esc($student['portfolio']) ?></a></li>
                        <?php endif ?>
                        <?php if (empty($student['github']) && empty($student['portfolio'])): ?>
                            <li class="text-muted">No links added yet.</li>
                        <?php endif ?>
                    </ul>
                </div>
            </div>

            <!-- Documents -->
            <div class="card mt-4 shadow-sm border-0">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">📄 Uploaded Documents</h5>
                </div>
                <div class="card-body">
                    <?php if ($documents): ?>
                        <ul class="list-group list-group-flush">
                            <?php foreach ($documents as $doc): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <?= ucfirst(esc($doc['type'])) ?>
                                    <a href="<?= base_url('writable/' . $doc['path']) ?>" class="btn btn-sm btn-outline-primary"
                                        target="_blank">View</a>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-muted">No documents uploaded.</p>
                    <?php endif ?>
                </div>
            </div>
        </div>

        <!-- Profile Completion Summary -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">✅ Profile Completion</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li><i class="text-success bi bi-check-circle-fill"></i> Basic Info</li>
                        <li>
                            <?php if (!empty($student['skills'])): ?>
                                <i class="text-success bi bi-check-circle-fill"></i> Skills
                            <?php else: ?>
                                <i class="text-warning bi bi-exclamation-circle-fill"></i> Skills (missing)
                            <?php endif ?>
                        </li>
                        <li>
                            <?php if ($documents): ?>
                                <i class="text-success bi bi-check-circle-fill"></i> Documents
                            <?php else: ?>
                                <i class="text-danger bi bi-x-circle-fill"></i> Documents (missing)
                            <?php endif ?>
                        </li>
                    </ul>


                    <div class="progress mt-3">
                        <div class="progress-bar bg-success" role="progressbar" style="width: <?= $completion ?>%;"
                            aria-valuenow="<?= $completion ?>" aria-valuemin="0" aria-valuemax="100">
                            <?= $completion ?>%
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection() ?>