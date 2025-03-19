<form id="visit_pipeline-form" method="POST" action="<?= base_url('pipeline/visit') ?>">
    <input type="hidden" name="id" value="<?= $id ?? '' ?>" />

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

    <!-- Input Potensi Produk -->
    <div>
    <label for="product_potential" class="block text-sm font-medium">Potensi Produk</label>
    <select id="product_potential" name="product_potential" class="border rounded p-2 w-full">
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
        <input type="date" name="date_visit" class="w-full border p-2 rounded" value="<?= $date_visit ?? '' ?>">
    </div>

    <!-- Input Rencana Closing -->
    <div>
        <label class="block text-sm font-medium">Rencana Closing</label>
        <input type="date" name="closing_plan" class="w-full border p-2 rounded" value="<?= $closing_plan ?? '' ?>">
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

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const searchInput = document.getElementById("pipeline_search");
            const resultsBox = document.getElementById("pipeline_results");
            const pipelineIdInput = document.getElementById("pipeline_id");
            const pipelinePotential = document.getElementById("pipeline_potential");
            const pipelineAddress = document.getElementById("pipeline_address");

            // Fungsi untuk mencari pipeline
            function searchPipeline(query) {
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

                                    div.addEventListener("click", function () {
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
            }

            // Event listener untuk pencarian
            searchInput.addEventListener("input", function () {
                const query = searchInput.value.trim();
                if (query.length < 2) {
                    resultsBox.innerHTML = "";
                    resultsBox.classList.add("hidden");
                    return;
                }
                searchPipeline(query);
            });

            // Tutup dropdown jika klik di luar
            document.addEventListener("click", function (event) {
                if (!searchInput.contains(event.target) && !resultsBox.contains(event.target)) {
                    resultsBox.classList.add("hidden");
                }
            });
        });
    </script>

