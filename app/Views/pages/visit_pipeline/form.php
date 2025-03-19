<form id="visit_pipeline-form" method="POST" action="<?= base_url($action)  ?>">
    <input type="hidden" name="id" value="<?= $id ?? '' ?>" />
    <?= var_dump($data) ?>
    <!-- Input Pencarian Nama Calon Nasabah -->
    <div>
        <label class="block text-sm font-medium">Nama Calon Nasabah</label>
        <input type="text" id="pipeline_search" class="w-full border p-2 rounded" placeholder="Cari Nama Nasabah...">
        <input type="hidden" name="pipeline_id" id="pipeline_id">
        <div id="pipeline_results" class="bg-white border rounded mt-1 max-h-40 overflow-auto hidden"></div>
    </div>

    <!-- Menampilkan Potensi dari Database -->
    <div>
        <label class="block text-sm font-medium">Potensi (Jumlah Uang)</label>
        <input type="text" id="pipeline_potential" class="w-full border p-2 rounded bg-gray-100" readonly>
    </div>

    <!-- Input Prospect Visit -->
    <div>
        <label class="block text-sm font-medium">Prospect Visit</label>
        <input type="text" name="prospect_visit" class="w-full border p-2 rounded" value="<?= $prospect_visit ?? '' ?>">
    </div>

    <!-- Input Potensi Produk ini bisa ga kalau belum di select kosong dulu, soalnya kalau dibuka formnya lansung tepilih giro gitu-->
    <div>
        <label for="product_id" class="block text-sm font-medium">Potensi Produk</label>
        <select id="product_id" name="product_id" class="border rounded p-2 w-full">
            <option value="" selected disabled>-- select option --</option>

            <?php foreach ($products as $product) : ?>
                <option value="<?= $product['id'] ?>"><?= $product['name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>


    <!-- Menampilkan Address dari Database -->
    <div>
        <label class="block text-sm font-medium">Alamat</label>
        <input type="text" id="pipeline_address" class="w-full border p-2 rounded bg-gray-100" readonly>
    </div>

    <!-- Input Lokasi Visit -->
    <div>
        <label class="block text-sm font-medium">Lokasi Visit</label>
        <input type="text" name="location_visit" class="w-full border p-2 rounded" value="<?= $location_visit ?? '' ?>">
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
            <label><input type="radio" name="status" value="Hot" <?= ($status ?? '') == 'Hot' ? 'checked' : '' ?>> Hot</label>
            <label><input type="radio" name="status" value="Warm" <?= ($status ?? '') == 'Warm' ? 'checked' : '' ?>> Warm</label>
            <label><input type="radio" name="status" value="Cold" <?= ($status ?? '') == 'Cold' ? 'checked' : '' ?>> Cold</label>
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
            <label><input type="radio" name="status_closing" value="1" <?= ($status_closing ?? 0) == 1 ? 'checked' : '' ?>> Ya</label>
            <label><input type="radio" name="status_closing" value="0" <?= ($status_closing ?? 0) == 0 ? 'checked' : '' ?>> Tidak</label>
        </div>
    </div>


    <!-- Tombol Submit -->
    <div class="mt-4">
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Simpan</button>
    </div>
</form>