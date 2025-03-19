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
<script>
    // INI FUNCTION EDIT NYA, namanya jangan diganti karna dari library
    function editItem(row) {
        console.log(row);

        return openModal('edit', 'visit/edit/' + row.id) // daftarin di routes nya
    }

    // INI FUNCTION DELETE DATA, namanya jangan diganti karna dari library
    function deleteItem(id) {
        if (confirm('Hapus item ' + id + '?')) {
            alert('Item ' + id + ' dihapus!');
        }
    }

    // Lainnya ... 
    // ini sama aja tapi pakai Observer
    // document.addEventListener("DOMContentLoaded", function() {
    //     const modalContent = document.getElementById("modal-content");

    //     if (modalContent) {
    //         const observer = new MutationObserver(() => {
    //             // Setelah konten berubah, cari input dalam modal
    //             const searchInput = document.getElementById("pipeline_search");
    //             const resultsBox = document.getElementById("pipeline_results");
    //             const pipelineIdInput = document.getElementById("pipeline_id");
    //             const pipelinePotential = document.getElementById("pipeline_potential");
    //             const pipelineAddress = document.getElementById("pipeline_address");

    //             console.log("First search:", searchInput);

    //             // Fungsi untuk mencari pipeline
    //             function searchPipeline(query) {
    //                 fetch("<?= base_url('pipeline/getPipelines') ?>?search=" + encodeURIComponent(query))
    //                     .then(response => response.json())
    //                     .then(data => {
    //                         resultsBox.innerHTML = "";
    //                         resultsBox.classList.add("hidden");

    //                         if (data.length > 0) {
    //                             const filteredData = data.filter(item =>
    //                                 item.name.toLowerCase().includes(query.toLowerCase())
    //                             );

    //                             if (filteredData.length > 0) {
    //                                 resultsBox.classList.remove("hidden");
    //                                 filteredData.forEach(pipeline => {
    //                                     const div = document.createElement("div");
    //                                     div.classList.add("p-2", "hover:bg-gray-200", "cursor-pointer");
    //                                     div.textContent = pipeline.name;
    //                                     div.dataset.id = pipeline.id;

    //                                     div.addEventListener("click", function() {
    //                                         searchInput.value = this.textContent;
    //                                         pipelineIdInput.value = this.dataset.id;
    //                                         resultsBox.innerHTML = "";
    //                                         resultsBox.classList.add("hidden");

    //                                         // Fetch detail pipeline (potential & address)
    //                                         fetch("<?= base_url('pipeline/getPipelineDetails/') ?>" + this.dataset.id)
    //                                             .then(response => response.json())
    //                                             .then(detail => {
    //                                                 if (detail.error) {
    //                                                     pipelinePotential.value = "Data tidak tersedia";
    //                                                     pipelineAddress.value = "Data tidak tersedia";
    //                                                 } else {
    //                                                     pipelinePotential.value = detail.potential;
    //                                                     pipelineAddress.value = detail.address;
    //                                                 }
    //                                             })
    //                                             .catch(error => console.error("Fetch Error:", error));
    //                                     });

    //                                     resultsBox.appendChild(div);
    //                                 });
    //                             } else {
    //                                 resultsBox.innerHTML = "<div class='p-2 text-gray-500'>Nama tidak ditemukan</div>";
    //                             }
    //                         } else {
    //                             resultsBox.innerHTML = "<div class='p-2 text-gray-500'>Nama tidak ditemukan</div>";
    //                         }
    //                     })
    //                     .catch(error => console.error("Error fetching pipeline data:", error));
    //             }

    //             // Event listener untuk pencarian
    //             searchInput.addEventListener("input", function() {
    //                 const query = searchInput.value.trim();
    //                 if (query.length < 2) {
    //                     resultsBox.innerHTML = "";
    //                     resultsBox.classList.add("hidden");
    //                     return;
    //                 }
    //                 searchPipeline(query);
    //             });

    //             // Tutup dropdown jika klik di luar
    //             document.addEventListener("click", function(event) {
    //                 if (!searchInput.contains(event.target) && !resultsBox.contains(event.target)) {
    //                     resultsBox.classList.add("hidden");
    //                 }
    //             });
    //         });

    //         // Observasi perubahan dalam modal-content
    //         observer.observe(modalContent, {
    //             childList: true,
    //             subtree: true
    //         });
    //     }
    // });


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
        const searchInput = document.getElementById("pipeline_search");
        const pipelineIdInput = document.getElementById("pipeline_id");
        const pipelinePotential = document.getElementById("pipeline_potential");
        const pipelineAddress = document.getElementById("pipeline_address");
        const resultsBox = document.getElementById("pipeline_results");

        searchInput.value = this.textContent;
        pipelineIdInput.value = this.dataset.id;
        resultsBox.innerHTML = "";
        resultsBox.classList.add("hidden");

        // Fetch detail pipeline (potential & address)
        fetch("<?= base_url('pipeline/getPipelineDetails/') ?>" + this.dataset.id)
            .then(response => response.json())
            .then(detail => {
                if (detail.error) {
                    pipelinePotential.value = "Data tidak tersedia";
                    pipelineAddress.value = "Data tidak tersedia";
                } else {
                    pipelinePotential.value = detail.potential;
                    pipelineAddress.value = detail.address;
                }
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