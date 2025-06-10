<?= $this->extend('layout/pages-layout') ?>
<?= $this->section('content') ?>

<div class="container">
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">📋 Manage Opportunities</h3>
    <a href="<?= base_url('company/post-opportunity') ?>" class="btn bg-primary text-white">
        <i class="fas fa-plus me-1"></i> Post New Opportunity
    </a>
</div>

    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-success"><?= esc(session()->getFlashdata('message')) ?></div>
    <?php endif ?>

    <?php if (!empty($opportunities)): ?>
        <table class="table table-hover table-bordered">
            <thead class="bg-primary text-white">
                <tr>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Location</th>
                    <th>Deadline</th>
                    <th>Posted</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($opportunities as $op): ?>
                    <tr>
                        <td><?= esc($op['title']) ?></td>
                        <td><?= esc($op['type']) ?></td>
                        <td><?= esc($op['location']) ?></td>
                        <td><?= date('M j, Y', strtotime($op['deadline'])) ?></td>
                        <td><?= date('M j, Y', strtotime($op['created_at'])) ?></td>
                        <td>
                            <a href="<?= base_url('company/opportunity/edit/' . $op['uuid']) ?>" class="btn btn-sm btn-outline-warning">Edit</a>
                            <!-- Optional: delete button -->
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-muted">No opportunities posted yet.</p>
    <?php endif ?>
</div>

<?= $this->endSection() ?>
