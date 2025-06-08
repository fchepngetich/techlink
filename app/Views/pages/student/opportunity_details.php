<?= $this->extend('layout/pages-layout') ?>
<?= $this->section('content') ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="mb-3 d-flex justify-content-between">
                <a href="<?= base_url('student/opportunities') ?>" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Back to Listings
                </a>
                <?php if ($alreadyApplied): ?>
                    <button class="btn btn-outline-success" disabled>
                        <i class="fas fa-check-circle me-1"></i> Applied
                    </button>
                <?php else: ?>
                    <a href="<?= base_url('student/opportunity/apply/' . $opportunity['uuid']) ?>" class="btn btn-success">
                        <i class="fas fa-paper-plane me-1"></i> Apply Now
                    </a>
                <?php endif; ?>

            </div>

            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-briefcase me-2"></i><?= esc($opportunity['title']) ?></h4>
                    <small><?= esc($opportunity['company_name']) ?></small>
                </div>
                <div class="card-body">

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <p class="mb-1">
                                <i class="fas fa-map-marker-alt text-danger me-2"></i>
                                <strong>Location:</strong> <?= esc($opportunity['location']) ?>
                            </p>
                        </div>
                        <div class="col-md-4">
                            <p class="mb-1">
                                <i class="fas fa-calendar-day text-warning me-2"></i>
                                <strong>Deadline:</strong> <?= esc($opportunity['deadline']) ?>
                            </p>
                        </div>
                        <div class="col-md-4">
                            <p class="mb-1">
                                <i class="fas fa-tags text-success me-2"></i>
                                <strong>Type:</strong> <?= ucfirst(esc($opportunity['type'])) ?>
                            </p>
                        </div>
                    </div>

                    <hr>

                    <h5 class="fw-bold"><i class="fas fa-align-left me-2"></i>Description</h5>
                    <p><?= esc($opportunity['description']) ?></p>
                </div>
            </div>


        </div>
    </div>
</div>

<?= $this->endSection() ?>