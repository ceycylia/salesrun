<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div style="font-size: 1rem; font-weight: bold; text-transform: uppercase;">Data Actual Performance</div>

<div class='w-full space-y-4'>

    <!-- Modal AJAX -->
    <?= view('components/ajax_modal') ?>

    <!-- Tabel Actual -->
    <div class="overflow-x-auto">
        <?= $dataTable->render(); ?>
    </div>

</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    function editItem(row) {
        openModal('edit', 'actual/edit/' + row.id);
    }

    function deleteItem(row) {
        Swal.fire({
            title: "Yakin Hapus?",
            text: "Data actual dari " + row.pipeline_name + " akan dihapus!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, Hapus!"
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('<?= base_url("actual/delete") ?>/' + row.id, {
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
                                $('#actualTable').DataTable().ajax.reload(null, false); // Reload tabel
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

    // Form Submit Modal (kalau ada edit)
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
                                    $('#actualTable').DataTable().ajax.reload(null, false);
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
