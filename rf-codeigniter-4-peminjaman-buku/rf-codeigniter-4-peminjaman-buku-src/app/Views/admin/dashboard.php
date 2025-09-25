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
        <h2>Dashboard</h2>
    </div>
</div>

<hr>

<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="card p-3">
            <h3 class="card-title display-3 text-center">Total Anggota</h3>
            <p class="card-text display-1 text-center"><?= $totalMembers ?></p>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="card p-3">
            <h3 class="card-title display-3 text-center">Total Buku</h3>
            <p class="card-text display-1 text-center"><?= $totalBooks ?></p>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="card p-3">
            <h3 class="card-title display-3 text-center">Pinjaman Aktif</h3>
            <p class="card-text display-1 text-center"><?= $activeLoans ?></p>
        </div>
    </div>
</div>

<hr>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card p-3">
            <h5 class="mb-0">System Info</h5>
            <div class="my-1"></div>
            <table class="table table-sm table-bordered mb-0">
                <tbody>
                    <?php foreach ($info as $key => $value): ?>
                    <tr>
                        <th style="width: 40%;"><?= esc($key) ?></th>
                        <td><?= esc($value) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<!-- Scripts -->
<?= $this->section("script") ?>
<script>

</script>
<?= $this->endSection() ?>