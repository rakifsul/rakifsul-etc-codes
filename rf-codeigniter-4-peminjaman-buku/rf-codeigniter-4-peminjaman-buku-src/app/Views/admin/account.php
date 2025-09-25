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
        <h2>Account</h2>
    </div>
</div>

<hr>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <form action="<?= site_url('account/process'); ?>" method="POST">
            <?php if (session()->has('errors')): ?>
                <?php foreach (session('errors') as $error): ?>
                    <div class="alert alert-danger">
                        <?= esc($error) ?>
                    </div>
                <?php endforeach ?>
            <?php endif ?>
            <div class="form-group">
                <label for="tx-username">Username</label>
                <input type="text" name="username" value="<?= $username ?>" class="form-control" id="tx-username" placeholder="Enter Username">
            </div>

            <div class="form-group">
                <label for="tx-password">Password</label>
                <input type="text" name="password" value="" class="form-control" id="tx-password" placeholder="Enter Password">
            </div>
            
            <div class="form-group">
                <label for="tx-passwordRepeat">Repeat Password</label>
                <input type="text" name="passwordRepeat" value="" class="form-control" id="tx-passwordRepeat" placeholder="Enter Password Again">
            </div>
            <button type="submit" class="btn btn-dark">Save</button>
        </form>
    </div>
</div>
<?= $this->endSection() ?>

<!-- Scripts -->
<?= $this->section("script") ?>
<script>

</script>
<?= $this->endSection() ?>