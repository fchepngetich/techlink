<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">

    <li class="nav-item">
      <a class="nav-link" href="<?= base_url('/') ?>">
        <div class="d-flex align-items-center">
          <i class="fas fa-home menu-icon me-2"></i>
          <span class="menu-title">Dashboard</span>
        </div>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="<?= base_url('student/opportunities') ?>">
        <div class="d-flex align-items-center">
          <i class="fas fa-building menu-icon me-2"></i>
          <span class="menu-title">Companies</span>
        </div>
      </a>
    </li>

    <div class="admin-section">
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('student/applications') ?>">
          <div class="d-flex align-items-center">
            <i class="fas fa-paper-plane menu-icon me-2"></i>
            <span class="menu-title">My Applications</span>
          </div>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('student/tests') ?>">
          <div class="d-flex align-items-center">
            <i class="fas fa-vial menu-icon me-2"></i>
            <span class="menu-title">Tests</span>
          </div>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= site_url('student/notifications') ?>">
          <div class="d-flex align-items-center">
            <i class="fas fa-bell menu-icon me-2"></i>
            <span class="menu-title">Notifications</span>
          </div>
        </a>
      </li>
    </div>

    <hr>
    <div class="user-section">
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('student/profile') ?>">
          <div class="d-flex align-items-center">
            <i class="fas fa-user-circle menu-icon me-2"></i>
            <span class="menu-title">My Profile</span>
          </div>
        </a>
      </li>
    </div>

  </ul>
</nav>
