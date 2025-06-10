<?= $this->extend('layout/pages-layout') ?>
<?= $this->section('content') ?>

<div class="container rounded shadow">
    <h3 class="mb-4">📢 Available Opportunities</h3>

    <div class="row g-4">
        <?php if (session()->getFlashdata('message')): ?>
            <div class="alert alert-success">
                <?= esc(session()->getFlashdata('message')) ?>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= esc(session()->getFlashdata('error')) ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($opportunities)): ?>
            <?php foreach ($opportunities as $op): ?>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="card-title fw-bold mb-0">
                                    <i class="fas fa-building me-2 text-primary"></i><?= esc($op['company_name']) ?>
                                </h5>

                                <span class="badge bg-success">
                                    <i class="fas fa-bolt me-1"></i> Open
                                </span>
                            </div>


                            <h6 class="card-subtitle mb-2">
                                <i class="fas fa-code me-2 text-info"></i><?= esc($op['title']) ?>
                            </h6>


                            <p class="mb-1">
                                <i class="fas fa-map-marker-alt me-2 text-danger"></i><?= esc($op['location']) ?>
                            </p>
                            <p class="mb-1">
                                <i class="fas fa-calendar-day me-2 text-warning"></i>
                                Deadline: <?= date('M j, Y', strtotime($op['deadline'])) ?>

                            </p>
                            <p class="mb-2">
                                <i class="fas fa-tags me-2 text-success"></i><?= ucfirst(esc($op['type'])) ?>
                            </p>

                            <div class="mt-auto d-flex justify-content-between gap-2">
                                <a href="<?= base_url('student/opportunity/view/' . $op['uuid']) ?>"
                                    class="btn btn-outline-secondary btn-sm">
                                    <i class="fas fa-eye"></i> View Details
                                </a>
                                <?php if (in_array($op['id'], $appliedIds)): ?>
                                    <button class="btn btn-outline-success btn-sm" disabled>
                                        <i class="fas fa-check-circle"></i> Applied
                                    </button>
                                <?php else: ?>
                                    <button 
    class="btn btn-primary btn-sm apply-btn"
    data-url="<?= base_url('student/opportunity/apply/' . $op['uuid']) ?>"
    data-company="<?= esc($op['company_name']) ?>"
>
    <i class="fas fa-paper-plane"></i> Apply Now
</button>

                                <?php endif; ?>


                            </div>
                        </div>
                    </div>
                </div>


            <?php endforeach ?>
        <?php else: ?>
            <div class="col-12">
                <p class="text-muted">No opportunities are available at the moment.</p>
            </div>
        <?php endif ?>
    </div>
</div>

<?= $this->section('scripts') ?>

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const applyButtons = document.querySelectorAll('.apply-btn');

        applyButtons.forEach(button => {
            button.addEventListener('click', function () {
                const url = this.getAttribute('data-url');
                const company = this.getAttribute('data-company');

                Swal.fire({
                    title: 'Are you sure?',
                    text: `By submitting you consent to sharing your data with ${company} company.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Apply',
                    cancelButtonText: 'Cancel',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url;
                    }
                });
            });
        });
    });
</script>
<?= $this->endSection() ?>

<?= $this->endSection() ?>