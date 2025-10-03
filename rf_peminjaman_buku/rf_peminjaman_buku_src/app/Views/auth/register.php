<?= $this->extend('layouts/auth') ?>

<!-- Styles -->
<?= $this->section("style") ?>
<style>

</style>
<?= $this->endSection() ?>

<!-- Contents -->
<?= $this->section("content") ?>

<div class="row">
    <div class="col-md">
        <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header"><h5 class="modal-title" id="registerModalTitle">Register</h5></div>
            
            <form action="<?= site_url('process-register'); ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="tx-username">Username</label>
                        <input type="text" name="username" class="form-control" id="tx-username" aria-describedby="emailHelp" placeholder="Enter Username">
                    </div>
                    <div class="form-group mb-3">
                        <label for="tx-password">Password</label>
                        <input type="password" name="password" class="form-control" id="tx-password" placeholder="Password">
                    </div>
                    <div class="form-group mb-3">
                        <label for="tx-password-repeat" class="form-label">Repeat Password</label>
                        <input type="password" name="password_repeat" class="form-control" id="tx-password-repeat" placeholder="Masukkan password lagi">
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-dark" href="<?= site_url('/'); ?>">To Home</a>
                    <a class="btn btn-dark" href="<?= site_url('login'); ?>">To Login</a>
                    <button type="submit" class="btn btn-dark">Register</button>
                </div>
            </form>

            <?= session()->getFlashdata("error"); ?>
            </div>
        </div>
        </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>

<!-- Scripts -->
<?= $this->section("script") ?>
<script>
  showAuthModal("registerModal");
</script>
<?= $this->endSection() ?>