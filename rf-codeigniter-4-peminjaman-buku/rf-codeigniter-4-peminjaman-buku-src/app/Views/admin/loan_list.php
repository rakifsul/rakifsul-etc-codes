<?= $this->extend('layouts/admin') ?>

<!-- Styles -->
<?= $this->section("style") ?>
<style>

</style>
<?= $this->endSection() ?>

<!-- Contents -->
<?= $this->section("content") ?>
<?php
    use \App\Helpers\G;
?>

<!-- Main -->
<div class="row mt-2">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h2>Loan List</h2>
    </div>
</div>

<hr>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <a class="btn btn-dark w-100" role="button" href="<?= site_url('loan/create') ?>">Tambah Peminjaman</a>
         <!-- <hr> -->
        <div class="my-3"></div>

        <div class="table-responsive">
            <table class="table table-hover">
                <tr>
                    <th>Nama Anggota</th>
                    <th>Judul Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Jatuh Tempo</th>
                    <th>Tanggal Kembali</th>
                    <th>Denda</th>
                    <th>Aksi</th>
                </tr>
                <?php foreach ($loans as $loan): ?>
                <tr>
                    <td><?= esc($loan['member_name']) ?></td>
                    <td><?= esc($loan['book_title']) ?></td>
                    <td><?= esc($loan['loan_date']) ?></td>
                    <td><?= esc($loan['due_date']) ?></td>
                    <td><?= esc($loan['return_date'] ?? '-') ?></td>
                    <td><?= esc($loan['fine']) ?></td>
                    <td>
                        <a href="<?= site_url('loan/edit/'.$loan['id']) ?>" class="badge text-bg-warning">Edit</a>
                        <a href="<?= site_url('loan/delete/'.$loan['id']) ?>" onclick="return confirm('Hapus?')" class="badge text-bg-danger">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>

<?php
    $pagination["page"] = $pager->getCurrentPage();
    $pagination["perPage"] = $pager->getPerPage();
    $pagination["pageCount"] = $pager->getPageCount();

    // echo "<h1>".$pager->getCurrentPage()." - ".$pager->getPageCount()."</h1>"
?>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <nav aria-label="Page navigation example">
            <?php $prevPGN = G::pgnPrevious($pagination["page"]); $nextPGN = G::pgnNext($pagination["page"], $pagination["pageCount"]); ?>
            <ul class="pagination">
                <li class="page-item <?php if ($prevPGN['disabled']) { ?>disabled<?php } ?>">
                    <a class="page-link" href="<?= site_url("/loan/?page="); ?><?= $prevPGN['index'] ?>">Previous</a>
                </li>

                <?php for($i = 1; $i <= $pagination['pageCount']; ++$i){ ?>
                    <li class="page-item <?php if($pagination['page'] == $i){ ?> active <?php } ?>">
                        <a class="page-link" href="<?= site_url("/loan/?page="); ?><?= $i ?>"><?= $i ?></a>
                    </li>
                <?php } ?>

                <li class="page-item <?php if ($nextPGN['disabled']) { ?>disabled<?php } ?>">
                    <a class="page-link" href="<?= site_url("/loan/?page="); ?><?= $nextPGN['index'] ?>">Next</a>
                </li>
            </ul>
        </nav>
    </div>
</div>
<?= $this->endSection() ?>

<!-- Scripts -->
<?= $this->section("script") ?>
<script>
</script>
<?= $this->endSection() ?>