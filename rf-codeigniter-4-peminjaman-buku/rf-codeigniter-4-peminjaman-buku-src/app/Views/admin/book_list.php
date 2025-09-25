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
        <h2>Book List</h2>
    </div>
</div>

<hr>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <a class="btn btn-dark w-100" role="button" href="<?= site_url('book/create') ?>">Tambah Buku</a>
        <!-- <hr> -->
        <div class="my-3"></div>
        <div class="table-responsive">
            <table class="table table-hover">
                <tr>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Kategori</th>
                    <th>Tahun</th>
                    <th>Unit Denda</th>
                    <th>Aksi</th>
                </tr>
                <?php foreach ($books as $book): ?>
                <tr>
                    <td><?= esc($book['title']) ?></td>
                    <td><?= esc($book['author']) ?></td>
                    <td><?= esc($book['category']) ?></td>
                    <td><?= esc($book['year']) ?></td>
                    <td><?= esc($book['fine_unit']) ?></td>
                    <td>
                        <?php
                            $imgUrl = $book['cover'] !== null ? base_url('uploads/'.$book['cover']) : "javascript:void(0)";
                            $textBg = $book['cover'] === null ? "text-bg-secondary" : "text-bg-success";
                            $targetBlank = $book['cover'] === null ? "" : "target=\"_blank\"";
                        ?>
                        <a href="<?= $imgUrl ?>" class="badge <?= $textBg ?>" <?= $targetBlank ?> >Cover</a>
                        <a href="<?= site_url('book/edit/'.$book['id']) ?>" class="badge text-bg-warning">Edit</a>
                        <a href="<?= site_url('book/delete/'.$book['id']) ?>" onclick="return confirm('Hapus?')" class="badge text-bg-danger">Hapus</a>
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
                    <a class="page-link" href="<?= site_url("/book/?page="); ?><?= $prevPGN['index'] ?>">Previous</a>
                </li>

                <?php for($i = 1; $i <= $pagination['pageCount']; ++$i){ ?>
                    <li class="page-item <?php if($pagination['page'] == $i){ ?> active <?php } ?>">
                        <a class="page-link" href="<?= site_url("/book/?page="); ?><?= $i ?>"><?= $i ?></a>
                    </li>
                <?php } ?>

                <li class="page-item <?php if ($nextPGN['disabled']) { ?>disabled<?php } ?>">
                    <a class="page-link" href="<?= site_url("/book/?page="); ?><?= $nextPGN['index'] ?>">Next</a>
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