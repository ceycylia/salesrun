<form id="visit_pipeline-form" method="POST" action="<?= base_url($action) ?>" data-table-id='visitPipelineTable'>
    <input type="hidden" name="pipeline_id" id="pipeline_id" value="<?= $data['pipeline_id'] ?? '' ?>">

    <!-- Input Pencarian Nama Calon Nasabah -->
    <div>
        <label class="block text-sm font-medium">Nama Calon Nasabah</label>
        <input type="text" id="pipeline_search" class="w-full border p-2 rounded" <?= isset($data['pipeline_id'])  ? 'disabled readonly' : '' ?>
            placeholder="Cari Nama Nasabah..."
            value="<?= $data['pipeline_name'] ?? '' ?>">
        <div id="pipeline_results" class="bg-white border rounded mt-1 max-h-40 overflow-auto hidden"></div>
    </div>

    <!-- Menampilkan Potensi dari Database -->
    <div>
        <label class="block text-sm font-medium">Potensi (Jumlah Uang)</label>
        <input type="text" id="pipeline_potential" class="w-full border p-2 rounded bg-gray-100"
            readonly value="<?= $data['pipeline_potential'] ?? '' ?>">
    </div>

    <!-- Input Prospect Visit -->
    <div>
        <label class="block text-sm font-medium">Prospect Visit</label>
        <input type="text" name="prospect_visit" class="w-full border p-2 rounded" value="<?= $data['prospect_visit'] ?? '' ?>">
    </div>

    <!-- Input Potensi Produk ini bisa ga kalau belum di select kosong dulu, soalnya kalau dibuka formnya lansung tepilih giro gitu-->
    <div>
        <label for="product_id" class="block text-sm font-medium">Potensi Produk</label>
        <select id="product_id" name="product_id" class="border rounded p-2 w-full">
            <option value="" <?= empty($data['product_id']) ? 'selected' : '' ?> disabled>-- select option --</option>

            <?php foreach ($products as $product) : ?>
                <option value="<?= $product['id'] ?>" <?= isset($data['product_id']) && $data['product_id'] == $product['id'] ? 'selected' : '' ?>>
                    <?= $product['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>


    <!-- Menampilkan Address dari Database -->
    <div>
        <label class="block text-sm font-medium">Alamat</label>
        <input type="text" id="pipeline_address" class="w-full border p-2 rounded bg-gray-100"
            readonly value="<?= $data['pipeline_address'] ?? '' ?>">
    </div>

    <!-- Input Lokasi Visit -->
    <div>
        <label class="block text-sm font-medium">Lokasi Visit</label>
        <input type="text" name="location_visit" class="w-full border p-2 rounded" value="<?= $data['location_visit'] ?? '' ?>">
    </div>

    <!-- Input Tanggal Visit -->
    <div>
        <label class="block text-sm font-medium">Tanggal Visit</label>
        <input type="date" name="date_visit" class="w-full border p-2 rounded" value="<?= isset($data['date_visit']) ? substr($data['date_visit'], 0, 10) : '' ?>">
    </div>

    <!-- Input Rencana Closing -->
    <div>
        <label class="block text-sm font-medium">Rencana Closing</label>
        <input type="date" name="closing_plan" class="w-full border p-2 rounded" value="<?= isset($data['closing_plan']) && $data['closing_plan'] !== '0000-00-00 00:00:00' ? substr($data['closing_plan'], 0, 10) : '' ?>">
    </div>

    <!-- Input Status -->
    <div>
        <label class="block text-sm font-medium">Status</label>
        <div class="flex gap-4">
            <input type="radio" name="status" value="hot" <?= (isset($data['status']) && $data['status'] === 'hot') ? 'checked' : '' ?>> Hot
            <input type="radio" name="status" value="warm" <?= (isset($data['status']) && $data['status'] === 'warm') ? 'checked' : '' ?>> Warm
            <input type="radio" name="status" value="cold" <?= (isset($data['status']) && $data['status'] === 'cold') ? 'checked' : '' ?>> Cold

        </div>
    </div>
    <!-- Input Komentar -->
    <div>
        <label class="block text-sm font-medium">Testimoni</label>
        <textarea name="coment" class="w-full border p-2 rounded"><?= $coment ?? '' ?></textarea>
    </div>

    <!-- Input Status Closing -->
    <div>
        <label class="block text-sm font-medium">Status Closing</label>
        <div class="flex gap-4">
            <label>
                <input type="radio" name="status_closing" value="1" <?= (isset($data['status_closing']) && $data['status_closing'] == 1) ? 'checked' : '' ?>> Ya
            </label>
            <label>
                <input type="radio" name="status_closing" value="0" <?= (!isset($data['status_closing']) || $data['status_closing'] == 0) ? 'checked' : '' ?>> Tidak
            </label>
        </div>
    </div>


    <!-- Tombol Submit -->
    <div class="mt-4">
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Simpan</button>
    </div>
</form>