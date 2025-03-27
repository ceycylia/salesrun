<form action="<?= base_url('pipeline/closing') ?>" method="post">
    <?= csrf_field() ?>

    <div class="mb-3">
        <label for="pipeline_id" class="form-label">Nama Calon Nasabah</label>
        <select name="visitpipeline_id" id="visitpipeline_id" class="form-control select2">
            <option value="">-- Pilih Calon Nasabah --</option>
            <?php foreach ($pipelines as $pipeline) : ?>
                <option value="<?= $pipeline['id'] ?>" <?= old('pipeline_id') == $pipeline['id'] ? 'selected' : '' ?>>
                    <?= $pipeline['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="bank_code" class="form-label">Kode Bank</label>
        <input type="text" name="bank_code" id="bank_code" class="form-control" value="<?= old('bank_code') ?>">
    </div>

    <div class="mb-3">
        <label for="product_id" class="form-label">ID Produk</label>
        <input type="text" name="product_id" id="product_id" class="form-control" value="<?= old('product_id') ?>" readonly>
    </div>

    <div class="mb-3">
        <label for="account_number" class="form-label">Nomor Rekening</label>
        <input type="text" name="account_number" id="account_number" class="form-control" value="<?= old('account_number') ?>">
    </div>

    <div class="mb-3">
        <label for="actual" class="form-label">Aktual</label>
        <input type="text" name="actual" id="actual" class="form-control" value="<?= old('actual') ?>">
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
</form>

<script>
    // Aktifkan Select2
    $(document).ready(function() {
        // $('#pipeline_id').select2();

        console.log(12312312);

        // Ambil data detail saat select berubah
        $('#visitpipeline_id').on('change', function() {
            var id = $(this).val();
            if (id) {
                $.ajax({
                    url: "<?= base_url('pipeline/getPipelineDetails') ?>/" + id,
                    method: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#product_id').val(data.product_id || '');
                        $('#bank_code').val(data.branch_code || '');
                    }
                });
            }
        });
    });
</script>