<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $siteName ?></title>

    <link rel="stylesheet" href="<?= base_url('/assets/library/bootstrap/css/bootstrap.css'); ?>" />

    <style>
        .jumbotron {
            margin-bottom: 2rem;
            padding: 2rem 1rem;
            border-radius: 0.3rem;
            background-color: #e9ecef;
        }

        .jumbotron-lower {
            margin-top: 80px !important;
        }

        @media (min-width: 576px) {
            .jumbotron {
                padding: 4rem 2rem;
            }
        }
    </style>
</head>
<body class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="jumbotron jumbotron-lower">
                <h1 class="display-4">
                    <?= $siteName ?>
                </h1>

                <p class="lead"><?= $siteTagline ?></p>

                <hr>

                <p>
                    <!-- <a class="btn btn-warning float-right ml-2" href="<?= site_url('register') ?>">Register</a> -->
                    <a class="btn btn-danger float-right" href="<?= site_url('login') ?>">Login</a>
                </p>
            </div>
        </div>
    </div>

    <!-- 3rd Party Scripts -->
    <script src="<?= base_url('/assets/library/jquery/jquery.js'); ?>"></script>
    <script src="<?= base_url('/assets/library/bootstrap/js/bootstrap.bundle.js'); ?>"></script>
</body>
</html>
