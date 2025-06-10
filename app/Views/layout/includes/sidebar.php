<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">

    <!-- 🎓 Student Navigation -->
    <?php if (session()->get('role') === 'student'): ?>

          <!-- Shared Dashboard -->
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
            <span class="menu-title">Opportunities</span>
          </div>
        </a>
      </li>

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
        <a class="nav-link" href="<?= base_url('student/notifications') ?>">
          <div class="d-flex align-items-center">
            <i class="fas fa-bell menu-icon me-2"></i>
            <span class="menu-title">Notifications</span>
          </div>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('student/profile') ?>">
          <div class="d-flex align-items-center">
            <i class="fas fa-user-circle menu-icon me-2"></i>
            <span class="menu-title">My Profile</span>
          </div>
        </a>
      </li>
    <?php endif; ?>

    <!-- 🏢 Company Navigation -->
    <?php if (session()->get('role') === 'company'): ?>

          <!-- Shared Dashboard -->
    <li class="nav-item">
      <a class="nav-link" href="<?= base_url('/company') ?>">
        <div class="d-flex align-items-center">
          <i class="fas fa-home menu-icon me-2"></i>
          <span class="menu-title">Dashboard</span>
        </div>
      </a>
    </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('company/opportunities') ?>">
          <div class="d-flex align-items-center">
            <i class="fas fa-plus-circle menu-icon me-2"></i>
            <span class="menu-title">Opportunities</span>
          </div>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('company/applications') ?>">
          <div class="d-flex align-items-center">
            <i class="fas fa-folder-open menu-icon me-2"></i>
            <span class="menu-title">Applications</span>
          </div>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('company/tests') ?>">
          <div class="d-flex align-items-center">
            <i class="fas fa-clipboard-check menu-icon me-2"></i>
            <span class="menu-title">Tests</span>
          </div>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('company/messages') ?>">
          <div class="d-flex align-items-center">
            <i class="fas fa-envelope menu-icon me-2"></i>
            <span class="menu-title">Messages</span>
          </div>
        </a>
      </li>
    <?php endif; ?>

  </ul>
</nav>
