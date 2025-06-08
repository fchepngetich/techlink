<!DOCTYPE html>
<html>

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Techlink - Admin</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
  <link rel="stylesheet" href="/src/assets/vendors/typicons/typicons.css">
  <link rel="stylesheet" href="/src/assets/vendors/css/vendor.bundle.base.css">

  <link rel="stylesheet" href="/src/assets/css/style.css">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="/src/assets/css/styles.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="/src/assets/images/favicon.ico" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <?= $this->renderSection('stylesheets') ?>
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php include 'includes/navbar.php' ?>

    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <?php include 'includes/sidebar.php' ?>

      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">

          <?= $this->renderSection('content') ?>


        </div>

      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>

  <!-- base:js -->
  <script src="/src/assets/vendors/js/vendor.bundle.base.js"></script>

  <script src="/src/assets/vendors/chart.js/chart.umd.js"></script>
  <script src="/src/assets/js/jquery.cookie.js"></script>

  <!-- DataTables -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

  <script src="/src/assets/js/off-canvas.js"></script>
  <script src="/src/assets/js/hoverable-collapse.js"></script>
  <script src="/src/assets/js/template.js"></script>
  <script src="/src/assets/js/settings.js"></script>
  <script src="/src/assets/js/todolist.js"></script>

  <script src="/src/assets/js/dashboard.js"></script>
  <?php include 'includes/footer.php' ?>
  <?= $this->renderSection('scripts') ?>
  </div>

</body>

</html>