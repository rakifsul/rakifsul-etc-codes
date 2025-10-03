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
        <h2>Member Form</h2>
    </div>
</div>

<hr>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <form method="post" 
            action="<?= isset($member) ? site_url('member/update/'.$member['id']) : site_url('member/store') ?>">
            <!-- <div class="form-group">
                <label for="tx-title" class="col-form-label">Judul</label>
                <input type="text" name="title" value="<?= $book['title'] ?? '' ?>" class="form-control" id="tx-title">
            </div> -->

            <div class="form-group">
                <label for="tx-name" class="col-form-label">Nama</label>
                <input type="text" name="name" value="<?= $member['name'] ?? '' ?>" class="form-control" id="tx-name">
            </div>

            <div class="form-group">
                <label for="txa-address" class="col-form-label">Alamat</label>
                <textarea rows="5" name="address" class="form-control" id="txa-address"><?= $member['address'] ?? '' ?></textarea>
            </div>

            <div class="form-group">
                <label for="tx-phone" class="col-form-label">Telepon</label>
                <input type="text" name="phone" value="<?= $member['phone'] ?? '' ?>" class="form-control" id="tx-phone">
            </div>

            <div class="form-group">
                <label for="tx-email" class="col-form-label">Email</label>
                <input type="email" name="email" value="<?= $member['email'] ?? '' ?>" class="form-control" id="tx-email">
            </div>

            <div class="mb-5"></div>

            <div class="row">
                <div class="col-6">
                    <a href="<?= site_url('member') ?>" class="btn btn-dark w-100">Batal</a>
                </div>
                <div class="col-6">
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