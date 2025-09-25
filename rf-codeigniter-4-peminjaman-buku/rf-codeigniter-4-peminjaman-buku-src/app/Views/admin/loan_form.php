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
        <h2>Loan Form</h2>
    </div>
</div>

<hr>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php if(session()->getFlashdata('error')): ?>
            <div style="color:red"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <form method="post" action="<?= isset($loan) ? site_url('loan/update/'.$loan['id']) : site_url('loan/store') ?>">
            <!-- <div class="form-group">
                <label for="tx-title" class="col-form-label">Judul</label>
                <input type="text" name="title" value="<?= $book['title'] ?? '' ?>" class="form-control" id="tx-title">
            </div> -->
            <div class="form-group">
                <label for="sl-member" class="col-form-label">Anggota</label>
                <select name="member_id" required class="form-control" id="sl-member">
                    <option value="">-- Pilih Anggota --</option>
                    <?php foreach($members as $member): ?>
                        <option value="<?= $member['id'] ?>" <?= (isset($loan) && $loan['member_id'] == $member['id']) ? 'selected' : '' ?>>
                            <?= esc($member['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="sl-book" class="col-form-label">Buku</label>
                <select name="book_id" required class="form-control" id="sl-book">
                    <option value="">-- Pilih Buku --</option>
                    <?php foreach($books as $book): ?>
                        <option value="<?= $book['id'] ?>" <?= (isset($loan) && $loan['book_id'] == $book['id']) ? 'selected' : '' ?>>
                            <?= esc($book['title']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="tx-loan_date" class="col-form-label">Tanggal Pinjam</label>
                <input type="date" name="loan_date" value="<?= isset($loan) ? $loan['loan_date'] : date('Y-m-d') ?>" required class="form-control" id="tx-loan_date">
            </div>

            <div class="form-group">
                <label for="tx-due_date" class="col-form-label">Jatuh Tempo</label>
                <input type="date" name="due_date" value="<?= isset($loan) ? $loan['due_date'] : date('Y-m-d', strtotime('+7 days')) ?>" required class="form-control" id="tx-due_date">
            </div>

            <div class="form-group">
                <label for="tx-return_date" class="col-form-label">Tanggal Kembali</label>
                <input type="date" name="return_date" value="<?= $loan['return_date'] ?? '' ?>" class="form-control" id="tx-return_date">
            </div>

            <div class="mb-5"></div>

            <div class="row">
                <div class="col-6">
                    <a href="<?= site_url('loan') ?>" class="btn btn-dark w-100">Batal</a>
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