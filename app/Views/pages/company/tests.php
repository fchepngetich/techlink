<div class="container mt-5">
    <?= $this->extend('layout/pages-layout') ?>
    <?= $this->section('content') ?>



<div class="container mt-4">
    <h2 class="mb-3">Aptitude Test Results</h2>
    <div class="d-flex justify-content-between mb-3">
        <button class="btn btn-primary">Test Results</button>
        <button class="btn btn-success">Create Test</button>
    </div>

    <table class="table table-striped table-hover">
        <thead class="table-light">
            <tr>
                <th>Student</th>
                <th>Test Name</th>
                <th>Score</th>
                <th>Completed Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Alice Wanjiku</td>
                <td>Technical Assessment</td>
                <td>92%</td>
                <td>2024-06-18</td>
                <td><span class="badge bg-success">Completed</span></td>
                <td>
                    <button class="btn btn-info btn-sm">View Details</button>
                    <button class="btn btn-warning btn-sm">Take Action</button>
                </td>
            </tr>
            <tr>
                <td>Brian Otieno</td>
                <td>Aptitude Test</td>
                <td>88%</td>
                <td>2024-06-17</td>
                <td><span class="badge bg-success">Completed</span></td>
                <td>
                    <button class="btn btn-info btn-sm">View Details</button>
                    <button class="btn btn-warning btn-sm">Take Action</button>
                </td>
            </tr>
            <tr>
                <td>Catherine Mwangi</td>
                <td>Programming Challenge</td>
                <td>95%</td>
                <td>2024-06-16</td>
                <td><span class="badge bg-success">Completed</span></td>
                <td>
                    <button class="btn btn-info btn-sm">View Details</button>
                    <button class="btn btn-warning btn-sm">Take Action</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>




    <?= $this->endSection() ?>
</div>