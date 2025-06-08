<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Techlink - Login</title>
    <link rel="stylesheet" href="/src/assets/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="/src/assets/vendors/css/vendor.bundle.base.css">

    <link rel="stylesheet" href="/src/assets/css/style.css">
    <link rel="shortcut icon" href="/src/assets/images/favicon.ico" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <?= $this->renderSection('stylesheets') ?>
</head>

<body class="login-page">

    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-9 mx-auto col-lg-9">
                    <?= $this->renderSection('content') ?>
                </div>
            </div>
        </div>
    </div>


    <!-- base:js -->
    <script src="/src/assets/vendors/js/vendor.bundle.base.js"></script>

    <script src="/src/assets/vendors/chart.js/chart.umd.js"></script>
    <script src="/src/assets/js/jquery.cookie.js"></script>

    <script src="/src/assets/js/off-canvas.js"></script>
    <script src="/src/assets/js/hoverable-collapse.js"></script>
    <script src="/src/assets/js/template.js"></script>
    <script src="/src/assets/js/settings.js"></script>
    <script src="/src/assets/js/todolist.js"></script>

    <script src="/src/assets/js/dashboard.js"></script>
    <?= $this->renderSection('scripts') ?>
</body>

</html>