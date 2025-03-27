<form id="target-form" method="POST" action="<?= base_url($action) ?>" data-table-id="targetTable">
    <input type="hidden" name="id" value="<?= isset($data['id']) ? $data['id'] : '' ?>">

    <div>
        <label class="block text-sm font-medium">ID FSO</label>
        <input type="text" name="id_fso" class="w-full border p-2 rounded" value="<?= isset($data['id_fso']) ? $data['id_fso'] : '' ?>">
    </div>

    <div>
        <label class="block text-sm font-medium">Target</label>
        <input type="number" name="target" class="w-full border p-2 rounded" value="<?= isset($data['target']) ? $data['target'] : '' ?>">
    </div>

    <div>
        <label class="block text-sm font-medium">Bulan</label>
        <input type="text" name="month" class="w-full border p-2 rounded" value="<?= isset($data['month']) ? $data['month'] : '' ?>">
    </div>

    <button type="submit" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded">Simpan</button>
</form>