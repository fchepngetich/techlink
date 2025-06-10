<div class="container mt-5">
    <?= $this->extend('layout/pages-layout') ?>
    <?= $this->section('content') ?>


    <h3>Test Page</h3>

    <p>This is a test page to verify the layout and content rendering.</p>
    <p>Ensure that the layout is applied correctly and all sections are displayed as expected.</p>
    <p>Feel free to modify this content for further testing.</p>
    <p>Current date and time: <?= date('Y-m-d H:i:s') ?></p>

    <p>Session User ID: <?= session()->get('user_id') ?></p>
    <p>Session User Name: <?= session()->get('user_name') ?></p>



    <?= $this->endSection() ?>
</div>