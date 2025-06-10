<div class="container mt-5">
    <?= $this->extend('layout/pages-layout') ?>
    <?= $this->section('content') ?>




<div class="container mt-4">
    <h2 class="mb-3">Messages</h2>
    
    <!-- Conversations Section -->
    <div class="row">
        <div class="col-md-4">
            <h4>Conversations</h4>
            <ul class="list-group">
                <li class="list-group-item d-flex align-items-center">
                    <div class="me-3 fw-bold">AW</div>
                    <div>
                        <strong>Alice Wanjiku</strong><br>
                        <small>University of Nairobi</small>
                    </div>
                </li>
                <li class="list-group-item d-flex align-items-center">
                    <div class="me-3 fw-bold">BO</div>
                    <div>
                        <strong>Brian Otieno</strong><br>
                        <small>JKUAT</small>
                    </div>
                </li>
                <li class="list-group-item d-flex align-items-center">
                    <div class="me-3 fw-bold">CM</div>
                    <div>
                        <strong>Catherine Mwangi</strong><br>
                        <small>Kenyatta University</small>
                    </div>
                </li>
                <li class="list-group-item d-flex align-items-center">
                    <div class="me-3 fw-bold">DK</div>
                    <div>
                        <strong>David Kiprotich</strong><br>
                        <small>Moi University</small>
                    </div>
                </li>
            </ul>
        </div>

        <!-- Chat Section -->
        <div class="col-md-8">
            <h4>Chat with Alice Wanjiku</h4>
            <div class="border p-3 bg-light rounded">
                <div class="mb-3">
                    <strong>Hello!</strong> I'm very interested in the Software Developer position. Could you tell me more about the tech stack?<br>
                    <small class="text-muted">2 hours ago</small>
                </div>
                <div class="mb-3 text-end">
                    <strong>Hi Alice!</strong> We primarily use React, Node.js, and PostgreSQL. The internship will involve working on our customer portal.<br>
                    <small class="text-muted">1 hour ago</small>
                </div>
            </div>

            <!-- Input Section -->
            <div class="mt-3">
                <input type="text" class="form-control" placeholder="Type your message...">
                <button class="btn btn-primary mt-2">Send</button>
            </div>
        </div>
    </div>
</div>



    <?= $this->endSection() ?>
</div>