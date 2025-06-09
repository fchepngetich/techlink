<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="navbar-brand-wrapper d-flex justify-content-center">
    <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
      <a class="navbar-brand brand-logo w-50 fw-bold text-white" href="<?= base_url('') ?>">TECHLINK</a>
<a class="navbar-brand brand-logo-mini fw-bold text-white" href="<?= base_url('') ?>">TECHLINK</a>

      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="typcn typcn-th-menu"></span>
      </button>
    </div>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
    <ul class="navbar-nav me-lg-2">
      <li class="nav-item nav-profile dropdown">
        <a class="nav-link" href="#" data-bs-toggle="dropdown" id="profileDropdown">
          <h5 class="">TECHLINK KENYA.</h5>
        </a>
      </li>
    </ul>
    <ul class="navbar-nav navbar-nav-right">
      <li class="nav-item dropdown me-0">
      <ul class="navbar-nav me-lg-2">
    <li class="nav-item nav-profile dropdown">
        <a class="nav-link" href="#" data-bs-toggle="dropdown" id="profileDropdown">
            <i class="typcn typcn-user mx-0"></i>
            <span class="nav-profile-name">
                <?php if (session()->get('isLoggedIn')): ?>
                    <?= session()->get('name');  ?>
                <?php else: ?>
                    Account
                <?php endif; ?>
            </span>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
            <a class="dropdown-item" href="<?= base_url('auth/logout') ?>">
                <i class="typcn typcn-eject text-primary"></i>
                Logout
            </a>
        </div>
    </li>
</ul>

      </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
      data-toggle="offcanvas">
      <span class="typcn typcn-th-menu"></span>
    </button>
  </div>
</nav>


