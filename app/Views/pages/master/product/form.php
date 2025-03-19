<form id="productForm" action="<?= base_url($action) ?>" method="post">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label for="id_product" class="block text-sm font-medium">ID Produk</label>
            <input type="text" id="id_product" name="id_product" class="w-full border p-2 rounded"
                value="<?= esc($data['id_product'] ?? '') ?>" required>
        </div>

        <div>
            <label for="name" class="block text-sm font-medium">Nama Produk</label>
            <input type="text" id="name" name="name" class="w-full border p-2 rounded"
                value="<?= esc($data['name'] ?? '') ?>" required>
        </div>
    </div>

    <div class="mt-4">
        <label for="description" class="block text-sm font-medium">Deskripsi</label>
        <textarea id="description" name="description" class="w-full border p-2 rounded" rows="3" required><?= esc($data['description'] ?? '') ?></textarea>
    </div>

    <div class="mt-4">
        <label for="status" class="block text-sm font-medium">Status</label>
        <select id="status" name="status" class="w-full border p-2 rounded">
            <option value="1" <?= isset($data['status']) && $data['status'] == 1 ? 'selected' : '' ?>>Aktif</option>
            <option value="0" <?= isset($data['status']) && $data['status'] == 0 ? 'selected' : '' ?>>Nonaktif</option>
        </select>
    </div>

    <div class="mt-4 flex justify-end space-x-2">
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Simpan</button>
    </div>
</form>