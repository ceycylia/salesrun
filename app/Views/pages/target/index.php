<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div style="font-size: 1rem; font-weight: bold; text-transform: uppercase;">Data Target</div>

<div class='w-full space-y-4'>
    <!-- Tombol Create -->
    <div class='w-full flex justify-end'>
        <button onclick="openModal('create', 'target/create')" class="px-4 py-2 bg-sky-500 text-white rounded">
            Tambah Data
        </button>
    </div>

    <!-- Modal untuk tambah/edit Target -->
    <?= view('components/ajax_modal') ?>

    <!-- DataTable untuk menampilkan data target -->
    <div class="overflow-x-auto">
        <?= $dataTable->render(); ?>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>

<script src="<?= base_url('assets/js/submitData.js') ?>"></script>

<script>
    function editTarget(row) {
        return openModal('edit', 'target/edit/' + row.id);
    }

    function deleteTarget(row) {
        Swal.fire({
            title: "Yakin Hapus?",
            text: "Data dengan ID FSO " + row.id_fso + " akan dihapus!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, Hapus!"
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('<?= base_url("target/delete") ?>/' + row.id, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        Swal.fire({
                            title: data.status === 'success' ? "Berhasil!" : "Gagal!",
                            text: data.message,
                            icon: data.status === 'success' ? "success" : "error"
                        }).then(() => {
                            if (data.status === 'success') {
                                $('#targetTable').DataTable().ajax.reload(null, false);
                            }
                        });
                    })
                    .catch(error => {
                        Swal.fire("Error!", "Terjadi kesalahan, coba lagi.", "error");
                        console.error("Error:", error);
                    });
            }
        });
    }
</script>
<?= $this->endSection() ?>