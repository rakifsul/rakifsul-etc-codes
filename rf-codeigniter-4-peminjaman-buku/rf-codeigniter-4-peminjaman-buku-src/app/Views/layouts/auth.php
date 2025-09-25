<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title><?= $siteName ?></title>

    <link rel="stylesheet" href="<?= base_url('/assets/library/bootstrap/css/bootstrap.css'); ?>" />

    <link rel="stylesheet" href="<?= base_url('/assets/css/auth.css'); ?>" />
    
    <?= $this->renderSection("style") ?>

</head>
<body>
    <div class="container-fluid">
        <?= $this->renderSection("content") ?>
    </div>
        
    <!-- 3rd Party Scripts -->
    <script src="<?= base_url('/assets/library/jquery/jquery.js'); ?>"></script>
    <script src="<?= base_url('/assets/library/bootstrap/js/bootstrap.bundle.js'); ?>"></script>

    <!-- Primary Scripts -->
    <script src="<?= base_url('/assets/js/auth.js'); ?>"></script>

    <!-- Local Scripts -->
    <?= $this->renderSection("script") ?>
</body>
</html>