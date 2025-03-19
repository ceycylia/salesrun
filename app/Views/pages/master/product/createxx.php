
<div class="font-bold text-lg uppercase">Tambah Produk</div>

<div class="w-full bg-white p-6 rounded-lg shadow-md">
    <form id="productForm" action="<?= base_url('product/store') ?>" method="post">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="name" class="block text-sm font-medium">Nama Produk</label>
                <input type="text" id="name" name="name" class="w-full border p-2 rounded" required>
            </div>
            <div>
                <label for="timeline" class="block text-sm font-medium">Timeline</label>
                <input type="text" id="timeline" name="timeline" class="w-full border p-2 rounded" required>
            </div>
        </div>
        
        <div class="mt-4">
            <label for="description" class="block text-sm font-medium">Deskripsi</label>
            <textarea id="description" name="description" class="w-full border p-2 rounded" rows="3" required></textarea>
        </div>

        <div class="mt-4 flex justify-end space-x-2">
            <a href="<?= base_url('product') ?>" class="px-4 py-2 bg-gray-400 text-white rounded">Batal</a>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Simpan</button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    document.getElementById('productForm').addEventListener('submit', function(event) {
        event.preventDefault();

        Swal.fire({
            title: "Yakin Simpan?",
            text: "Pastikan data sudah benar.",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Ya, Simpan!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });
</script>
<?= $this->endSection() ?>