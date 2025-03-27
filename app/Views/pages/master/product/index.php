<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div style="font-size: 1rem; font-weight: bold; text-transform: uppercase;">Data Produk</div>

<div class='w-full space-y-4'>
    <!-- Tombol Create -->
    <div class='w-full flex justify-end'>
        <button onclick="openModal('create', 'product/create')" class="px-4 py-2 bg-sky-500 text-white rounded">
            Tambah Produk
        </button>
    </div>

    <!-- Modal untuk tambah/edit Produk -->
    <?= view('components/ajax_modal') ?>

    <!-- DataTable untuk menampilkan data produk -->
    <div class="overflow-x-auto">
        <?= $dataTable->render(); ?>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
   function editItem(row) {
    return openModal('edit', 'admin/master/product/edit/' + row.id);
}

    function deleteProduct(row) {
        Swal.fire({
            title: "Yakin Hapus?",
            text: "Produk " + row.name + " akan dihapus!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, Hapus!"
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('<?= base_url("product/delete") ?>/' + row.id, {
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
                                $('#productTable').DataTable().ajax.reload(null, false); // Reload data di DataTables tanpa reset halaman
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

    // Submit Form Modal
    const form = document.getElementById("modal-content");
    if (form) {
        form.addEventListener("submit", function(event) {
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
                    let formData = new FormData(event.target);

                    fetch(event.target.action, {
                            method: event.target.method,
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            closeModal();
                            Swal.fire({
                                title: data.status === 'success' ? "Berhasil!" : "Gagal!",
                                text: data.message,
                                icon: data.status === 'success' ? "success" : "error"
                            }).then(() => {
                                if (data.status === 'success') {
                                    $('#productTable').DataTable().ajax.reload(null, false); // Reload DataTable
                                }
                            });
                        })
                        .catch(error => {
                            Swal.fire("Error!", "Terjadi kesalahan, coba lagi.", "error");
                            console.error("Error:", error);
                        });
                }
            });
        });
    }
</script>
<?= $this->endSection() ?>