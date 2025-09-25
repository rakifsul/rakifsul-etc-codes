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
        <h2>Book Form</h2>
    </div>
</div>

<hr>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <form method="post" enctype="multipart/form-data" 
            action="<?= isset($book) ? site_url('book/update/'.$book['id']) : site_url('book/store') ?>">

            <div class="form-group">
                <label for="tx-title" class="col-form-label">Judul</label>
                <input type="text" name="title" value="<?= $book['title'] ?? '' ?>" class="form-control" id="tx-title">
            </div> 

            <div class="form-group">
                <label for="tx-author" class="col-form-label">Penulis</label>
                <input type="text" name="author" value="<?= $book['author'] ?? '' ?>" class="form-control" id="tx-author">
            </div> 

            <div class="form-group">
                <label for="tx-category" class="col-form-label">Kategori</label>
                <input type="text" name="category" value="<?= $book['category'] ?? '' ?>" class="form-control" id="tx-category">
            </div> 

            <div class="form-group">
                <label for="tx-year" class="col-form-label">Tahun</label>
                <input type="number" name="year" value="<?= $book['year'] ?? '' ?>" class="form-control" id="tx-year">
            </div> 

            <div class="form-group">
                <label for="tx-fine-unit" class="col-form-label">Unit Denda</label>
                <input type="number" name="fine_unit" value="<?= $book['fine_unit'] ?? '' ?>" class="form-control" id="tx-fine-unit">
            </div> 

            <div class="form-group">
                <label for="tx-cover" class="col-form-label">Cover</label>
                <input type="file" name="cover" class="form-control" id="tx-cover">
            </div> 

            <div class="mb-5"></div>

            <div class="row">
                <div class="col-6">
                    <a href="<?= site_url('book') ?>" class="btn btn-dark w-100">Batal</a>
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