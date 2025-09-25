<?= $this->extend('layouts/admin') ?>

<!-- Styles -->
<?= $this->section("style") ?>
<style>

</style>
<?= $this->endSection() ?>

<!-- Contents -->
<?= $this->section("content") ?>

<!-- Main -->
<div class="row mt-2">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h2>Config</h2>
    </div>
</div>

<hr>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <form action="<?= site_url('config/process'); ?>" method="POST">
            <div class="form-group">
                <label for="tx-site_name">Site Name</label>
                <input type="text" name="site_name" value="<?= $siteName ?>" class="form-control" id="tx-site_name" placeholder="Enter Site Name">
            </div>

            <div class="form-group">
                <label for="tx-site_tagline">Site Tagline</label>
                <input type="text" name="site_tagline" value="<?= $siteTagline ?>" class="form-control" id="tx-site_tagline" placeholder="Enter Site Tagline">
            </div>

            <div class="form-group">
                <label for="tx-admin_pagination">Admin Pagination</label>
                <input type="text" name="admin_pagination" value="<?= $adminPagination ?>" class="form-control" id="tx-admin_pagination" placeholder="Enter Pagination">
            </div>

            <div class="mb-5"></div>

            <div class="row">
                <div class="col-12">
                   <button type="submit" class="btn btn-dark w-100">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>

<!-- Scripts -->
<?= $this->section("script") ?>
<script>

</script>
<?= $this->endSection() ?>