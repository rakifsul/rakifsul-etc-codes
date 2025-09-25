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
        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalTitle">Login</h5>
            </div>
           
            <form action="<?= site_url('process-login') ?>" method="POST">
                <?php if(session()->getFlashdata("error")) { ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata("error"); ?>
                </div>
                <?php } ?>
                <div class="modal-body">
                <?php if(env('CI_ENVIRONMENT') == "development"): ?>
                    <p>default username: admin</p>
                    <p>default pass: admin</p>
                <?php endif; ?>
                
                <div class="form-group mb-3">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="text" name="username" value="" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                </div>
                <div class="form-group mb-3">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" value="" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                </div>
                <div class="modal-footer">
                <a class="btn btn-dark" href="<?= site_url('/'); ?>">To Home</a>
                <!-- <a class="btn btn-dark" href="<?= site_url('register'); ?>">To Register</a> -->
                <button type="submit" class="btn btn-dark">Log In</button>
                </div>
            </form>
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
  showAuthModal("loginModal");
</script>
<?= $this->endSection() ?>