<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $siteName ?></title>

    <link rel="stylesheet" href="<?= base_url('/assets/library/bootstrap/css/bootstrap.css'); ?>" />

    <link rel="stylesheet" href="<?= base_url('/assets/css/admin.css'); ?>" />

    <?= $this->renderSection("style") ?>
</head>

<body>
    <div id="sidebar" class="sidebar bg-dark">
        <div class="sidebar-brand">
            <img class="img-fluid sidebar-brand-img mx-auto d-block" src="<?= base_url('/assets/img/logo.svg'); ?>" alt="icon" width="100" height="100">
            <!-- <h3 class="text-white text-center pt-2">Admin</h3> -->
        </div>
        
        <hr class="text-light">

        <ul class="sidebar-ul">
            <li class="sidebar-li">
                <a class="btn btn-outline-light w-100 btn-mobile" data-url="<?= site_url("dashboard");?>" href="<?= site_url("dashboard");?>"><span class="elm-visible-mobile">DS</span><span class="elm-visible-desktop">Dashboard</span></a>
            </li>

            <li class="sidebar-li">
                <a class="btn btn-outline-light w-100 btn-mobile" data-url="<?= site_url("book");?>" href="<?= site_url("book");?>"><span class="elm-visible-mobile">BL</span><span class="elm-visible-desktop">Book List</span></a>
            </li>

            <li class="sidebar-li">
                <a class="btn btn-outline-light w-100 btn-mobile" data-url="<?= site_url("member");?>" href="<?= site_url("member");?>"><span class="elm-visible-mobile">ML</span><span class="elm-visible-desktop">Member List</span></a>
            </li>

            <li class="sidebar-li">
                <a class="btn btn-outline-light w-100 btn-mobile" data-url="<?= site_url("loan");?>" href="<?= site_url("loan");?>"><span class="elm-visible-mobile">LL</span><span class="elm-visible-desktop">Loan List</span></a>
            </li>

            <hr class="text-light">

            <li class="sidebar-li">
                <a class="btn btn-outline-light w-100 btn-mobile" data-url="<?= site_url("config");?>" href="<?= site_url("config");?>"><span class="elm-visible-mobile">CF</span><span class="elm-visible-desktop">Config</span></a>
            </li>

            <li class="sidebar-li">
                <a class="btn btn-outline-light w-100 btn-mobile" data-url="<?= site_url("account");?>" href="<?= site_url("account");?>"><span class="elm-visible-mobile">AC</span><span class="elm-visible-desktop">Account</span></a>
            </li>

            <li class="sidebar-li">
                <a class="btn btn-outline-light w-100 btn-mobile" data-url="<?= site_url("logout");?>" href="<?= site_url("logout");?>"><span class="elm-visible-mobile">LO</span><span class="elm-visible-desktop">Logout</span></a>
            </li>
        </ul>
    </div>

    <div class="main">
        <!-- Content -->
        <div class="container-fluid">
            <?= $this->renderSection("content") ?>
        </div>
    </div>

    <!-- Footer -->
    <!-- <footer class="footer">
        <nav class="navbar fixed-bottom navbar-expand-lg navbar-dark bg-success">
            <a class="navbar-brand" href="javascript:void(0);">By RAKIFSUL</a>
        </nav>
    </footer> -->

    <!-- 3rd Party Scripts -->
    <script src="<?= base_url('/assets/library/jquery/jquery.js'); ?>"></script>
    <script src="<?= base_url('/assets/library/bootstrap/js/bootstrap.bundle.js'); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <?= $this->renderSection("script-lib") ?>

    <!-- Primary Scripts -->
    <script src="<?= base_url('/assets/js/admin.js'); ?>"></script>

    <!-- Primary Scripts Implementation -->
     <script>
        // highlight active sidebar item
        $("ul.sidebar-ul li a").each(function() {
            const dataUrl = $(this).attr("data-url");
            if(dataUrl === window.location.href){
                $(this).addClass("active");
            }
        });
     </script>

    <!-- Local Scripts -->
    <?= $this->renderSection("script") ?>
</body>

</html>