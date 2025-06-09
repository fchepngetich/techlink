<?= $this->extend('layout/pages-layout') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
    <h4 class="mb-4">📝 Take Your Test</h4>

    <form action="<?= base_url('student/tests/submit') ?>" method="post">
    <?= csrf_field() ?>
    <?php foreach ($questions as $index => $q): ?>
        <div class="mb-4">
            <p><strong><?= ($index + 1) ?>. <?= esc($q['question']) ?></strong></p>
            <?php foreach ($q['options'] as $opt): ?>
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="q<?= $index ?>" value="<?= esc($opt) ?>" required>
                    <label class="form-check-label"><?= esc($opt) ?></label>
                </div>
            <?php endforeach ?>
        </div>
    <?php endforeach ?>
    <button type="submit" class="btn btn-primary">Submit Test</button>
</form>

</div>

<?= $this->endSection() ?>
