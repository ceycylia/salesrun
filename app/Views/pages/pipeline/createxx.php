<!-- Pipiline Form -->
<?php
// Pisahkan alamat jika formatnya selalu "Jl. NamaJalan, Kecamatan, Kelurahan, Kota"
$addressParts = explode(',', isset($data['address']) ? $data['address'] : '');
$street = isset($addressParts[0]) ? trim($addressParts[0]) : '';
$district = isset($addressParts[1]) ? trim($addressParts[1]) : '';
$village = isset($addressParts[2]) ? trim($addressParts[2]) : '';
$city = isset($addressParts[3]) ? trim($addressParts[3]) : '';
?>

<form id="pipeline-form" method="POST" action="<?= base_url($action) ?>">
    <input type="hidden" name="id" value="<?= isset($data['id']) ? $data['id'] : '' ?>">

    <div>
        <label class="block text-sm font-medium">Nama Calon Nasabah</label>
        <input type="text" name="name" class="w-full border p-2 rounded" value="<?= isset($data['name']) ? $data['name'] : '' ?>">
    </div>

    <div>
        <label class="block text-sm font-medium">Potensi (Jumlah Uang)</label>
        <div class="flex items-center">
            <input type="text" name="potential" class="w-full border p-2 rounded" id="potential" value="<?= isset($data['potential']) ? $data['potential'] : '' ?>" oninput="formatCurrency(this)">
        </div>
    </div>

    <div class="flex space-x-4">
        <div class="w-1/2">
            <label class="block text-sm font-medium">Nama Jalan</label>
            <input type="text" name="street" class="w-full border p-2 rounded" value="<?= $street ?>" placeholder="Nama Jalan">
        </div>

        <div class="w-1/2">
            <label class="block text-sm font-medium">Kecamatan</label>
            <input type="text" name="district" class="w-full border p-2 rounded" value="<?= $district ?>" placeholder="Kecamatan">
        </div>
    </div>

    <div class="flex space-x-4 mt-4">
        <div class="w-1/2">
            <label class="block text-sm font-medium">Kelurahan</label>
            <input type="text" name="village" class="w-full border p-2 rounded" value="<?= $village ?>" placeholder="Kelurahan">
        </div>

        <div class="w-1/2">
            <label class="block text-sm font-medium">Kota</label>
            <input type="text" name="city" class="w-full border p-2 rounded" value="<?= $city ?>" placeholder="Kota">
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium">Keterangan Alamat</label>
        <input type="text" name="address_note" class="w-full border p-2 rounded" value="<?= isset($data['address_note']) ? $data['address_note'] : '' ?>" placeholder="Keterangan Alamat">
    </div>

    <div>
        <label class="block text-sm font-medium">Keterangan Alamat</label>
        <input type="text" name="address_note" class="w-full border p-2 rounded" value="<?= isset($data['address_note']) ? $data['address_note'] : '' ?>" placeholder="Keterangan Alamat">
    </div>

    <div>
        <label class="block text-sm font-medium">Pekerjaan</label>
        <select name="job" class="w-full border p-2 rounded">
            <option value="">Pilih Pekerjaan</option>
            <option value="ASN" <?= isset($data['job']) && $data['job'] == 'ASN' ? 'selected' : '' ?>>ASN</option>
            <option value="BUMN" <?= isset($data['job']) && $data['job'] == 'BUMN' ? 'selected' : '' ?>>BUMN</option>
            <option value="Engineer" <?= isset($data['job']) && $data['job'] == 'Engineer' ? 'selected' : '' ?>>Engineer</option>
            <option value="Freelancer" <?= isset($data['job']) && $data['job'] == 'Freelancer' ? 'selected' : '' ?>>Freelancer</option>
            <option value="Other" <?= isset($data['job']) && $data['job'] == 'Other' ? 'selected' : '' ?>>Other</option>
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium">Nasabah Exiting</label>
        <div class="flex items-center space-x-6">
            <label class="flex items-center">
                <input type="radio" name="exiting_pipelines" value="1" class="mr-2" <?= isset($data['exiting_pipelines']) && $data['exiting_pipelines'] == '1' ? 'checked' : '' ?>>
                Ya
            </label>
            <label class="flex items-center">
                <input type="radio" name="exiting_pipelines" value="0" class="mr-2" <?= isset($data['exiting_pipelines']) && $data['exiting_pipelines'] == '0' ? 'checked' : '' ?>>
                Tidak
            </label>
        </div>
    </div>

    <button type="submit" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded">Simpan</button>
</form>

<script>
    // Function to format currency
    function formatCurrency(input) {
        let value = input.value.replace(/[^0-9]/g, ''); // Remove all non-numeric characters
        if (value.length > 3) {
            value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.'); // Add dot every 3 digits
        }
        input.value = value ? 'Rp ' + value : ''; // Prefix with "Rp" and set the formatted value
    }
</script>