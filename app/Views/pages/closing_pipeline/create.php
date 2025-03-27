<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="text-lg font-semibold uppercase mb-4">Form Closing Pipeline</div>

<div class="w-full bg-white p-6 rounded-lg shadow-md">
    <form action="<?= base_url('pipeline/closing') ?>" method="post" class="space-y-5">
        <?= csrf_field() ?>

        <!-- Nama Calon Nasabah -->
        <div>
            <label for="pipeline_id" class="block text-sm font-medium text-gray-700 mb-3">Nama Calon Nasabah</label>
            <select name="pipeline_id" id="pipeline_id" class="select2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500">
                <option value="">-- Pilih Calon Nasabah --</option>
                <?php foreach ($pipelines as $pipeline) : ?>
                    <option value="<?= $pipeline['id'] ?>" <?= old('pipeline_id') == $pipeline['id'] ? 'selected' : '' ?>>
                        <?= $pipeline['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Kode Bank -->
        <div>
            <label for="bank_code" class="block text-sm font-medium text-gray-700 mb-1">Kode Bank</label>
            <input type="text" name="bank_code" id="bank_code" value="<?= old('bank_code') ?>" class="w-full border p-2 rounded">
        </div>

        <!-- ID Produk -->
        <div>
            <label for="product_id" class="block text-sm font-medium text-gray-700 mb-1">ID Produk</label>
            <!-- <input type="text" name="product_id" id="product_id" value="<?= old('product_id') ?>" readonly class="w-full border p-2 rounded"> -->
            <select id="product_id" name="product_id" class="border rounded p-2 w-full">
                <option value="" <?= empty($data['product_id']) ? 'selected' : '' ?> disabled>-- select option --</option>

                <?php foreach ($products as $product) : ?>
                    <option value="<?= $product['id'] ?>" <?= isset($data['product_id']) && $data['product_id'] == $product['id'] ? 'selected' : '' ?>>
                        <?= $product['id_product'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Nomor Rekening -->
        <div>
            <label for="account_number" class="block text-sm font-medium text-gray-700 mb-1">Nomor Rekening</label>
            <input type="text" name="account_number" id="account_number" value="<?= old('account_number') ?>" class="w-full border p-2 rounded">
        </div>

        <!-- Aktual -->
        <div>
            <label for="actual" class="block text-sm font-medium text-gray-700 mb-1">Aktual</label>
            <input type="number" name="actual" id="actual" value="<?= old('actual') ?>" class="w-full border p-2 rounded">
        </div>

        <!-- Tombol Simpan -->
        <div class="mt-4 flex justify-end space-x-2">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Simpan</button>
        </div>
    </form>
</div>

<!-- Script AJAX dan Select2 -->
<script>
    $(document).ready(function() {
        // $('#pipeline_id').select2();

        $('#pipeline_id').on('change', function() {
            var pipelineId = $(this).val();
            if (pipelineId) {
                $.ajax({
                    url: "<?= base_url('pipeline/getPipelineDetails') ?>/" + pipelineId,
                    method: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#product_id').val(data.product_id || '');
                        $('#bank_code').val(data.branch_code || '');
                    }
                });
            } else {
                $('#product_id').val('');
                $('#bank_code').val('');
            }
        });
    });
</script>

<?= $this->endSection() ?>