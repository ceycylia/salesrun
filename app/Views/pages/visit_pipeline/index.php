<?= $this->extend('layouts/main') ?>


<?= $this->section('content') ?>
<!-- Mungkin Breadcum -->
<div style="font-size: 1rem; font-weight: bold; text-transform: uppercase;">Data Visit Nasabah</div>

<div class='w-full space-y-4'>
    <!-- Tombol Create Ajax Modal -->
    <!-- Tombol Create -->
    <div class='w-full flex justify-end'>
        <button onclick="openModal('create', 'visit/create')" class="px-4 py-2 bg-sky-500 text-white rounded">
            Tambah Data
        </button>
    </div>

    <!-- Modal untuk tambah/edit Pipeline -->

    <?= view('components/ajax_modal') ?>

    <!-- DataTable - Menampilkan Data Nasabah -->
    <div class="overflow-x-auto">
        <?= $dataTable->render(); ?>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>

<script src="<?= base_url('assets/js/submitData.js') ?>"></script>

<script>
    // INI FUNCTION EDIT NYA, namanya jangan diganti karna dari library
    function editItem(row) {

        return openModal('edit', 'visit/edit/' + row.id) // daftarin di routes nya
    }

    // INI FUNCTION DELETE DATA, namanya jangan diganti karna dari library
    function deleteItem(id) {
        if (confirm('Hapus item ' + id + '?')) {
            alert('Item ' + id + ' dihapus!');
        }
    }

    // Submit Form Modal
    // const form = document.getElementById("modal-content");
    // if (form) {
    //     form.addEventListener("submit", function(event) {
    //         event.preventDefault();

    //         Swal.fire({
    //             title: "Yakin Simpan?",
    //             text: "Pastikan data sudah benar.",
    //             icon: "question",
    //             showCancelButton: true,
    //             confirmButtonText: "Ya, Simpan!",
    //             cancelButtonText: "Batal"
    //         }).then((result) => {
    //             if (result.isConfirmed) {
    //                 let formData = new FormData(event.target);

    //                 fetch(event.target.action, {
    //                         method: event.target.method,
    //                         body: formData
    //                     })
    //                     .then(response => response.json())
    //                     .then(data => {
    //                         closeModal();
    //                         Swal.fire({
    //                             title: data.status === 'success' ? "Berhasil!" : "Gagal!",
    //                             text: data.message,
    //                             icon: data.status === 'success' ? "success" : "error"
    //                         }).then(() => {
    //                             if (data.status === 'success') {
    //                                 $('#visitPipelineTable').DataTable().ajax.reload(null, false); // Reload DataTable
    //                             }
    //                         });
    //                     })
    //                     .catch(error => {
    //                         Swal.fire("Error!", "Terjadi kesalahan, coba lagi.", "error");
    //                         console.error("Error:", error);
    //                     });
    //             }
    //         });
    //     });
    // }



    $(document).on("input", "#pipeline_search", function() {
        const query = this.value.trim();
        const resultsBox = document.getElementById("pipeline_results");

        if (query.length < 2) {
            resultsBox.innerHTML = "";
            resultsBox.classList.add("hidden");
            return;
        }

        fetch("<?= base_url('pipeline/getPipelines') ?>?search=" + encodeURIComponent(query))
            .then(response => response.json())
            .then(data => {
                resultsBox.innerHTML = "";
                resultsBox.classList.add("hidden");

                if (data.length > 0) {
                    const filteredData = data.filter(item =>
                        item.name.toLowerCase().includes(query.toLowerCase())
                    );

                    if (filteredData.length > 0) {
                        resultsBox.classList.remove("hidden");
                        filteredData.forEach(pipeline => {
                            const div = document.createElement("div");
                            div.classList.add("p-2", "hover:bg-gray-200", "cursor-pointer");
                            div.textContent = pipeline.name;
                            div.dataset.id = pipeline.id;

                            resultsBox.appendChild(div);
                        });
                    } else {
                        resultsBox.innerHTML = "<div class='p-2 text-gray-500'>Nama tidak ditemukan</div>";
                    }
                } else {
                    resultsBox.innerHTML = "<div class='p-2 text-gray-500'>Nama tidak ditemukan</div>";
                }
            })
            .catch(error => console.error("Error fetching pipeline data:", error));
    });

    // Delegasikan event click ke hasil pencarian
    $(document).on("click", "#pipeline_results div", function() {
        $("#pipeline_search").val($(this).text());
        $("#pipeline_id").val($(this).data("id"));
        $("#pipeline_results").html("").addClass("hidden");

        // Fetch detail pipeline
        fetch("<?= base_url('pipeline/getPipelineDetails/') ?>" + $(this).data("id"))
            .then(response => response.json())
            .then(detail => {
                $("#pipeline_potential").val(detail.potential || "Data tidak tersedia");
                $("#pipeline_address").val(detail.address || "Data tidak tersedia");
            })
            .catch(error => console.error("Fetch Error:", error));
    });

    // Tutup dropdown jika klik di luar
    $(document).on("click", function(event) {
        if (!$(event.target).closest("#pipeline_search, #pipeline_results").length) {
            $("#pipeline_results").addClass("hidden");
        }
    });
</script>
<?= $this->endSection() ?>