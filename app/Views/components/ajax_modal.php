<!-- Modal Component -->
<div id="modal-container" class="hidden z-[99] fixed inset-0 flex justify-center items-center bg-gray-800 bg-opacity-50 transition-opacity duration-300 ease-in-out">
    <div id="modal-content-wrapper" class="bg-white p-6 rounded-lg shadow-lg overflow-auto w-[80vw] h-[70vh] relative transform scale-95 opacity-0 transition-all duration-300 ease-in-out">

        <!-- Tombol Close -->
        <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-500 hover:text-gray-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- Title -->
        <h2 id="modal-title" class="text-xl font-bold mb-4">Title</h2>

        <!-- Loader -->
        <div id="modal-loader" class="hidden text-center text-gray-500">Loading...</div>

        <!-- Container untuk form atau konten lain -->
        <div id="modal-content"></div>
    </div>
</div>

<script>
    function openModal(title, contentUrl) {
        const modal = document.getElementById("modal-container");
        const modalWrapper = document.getElementById("modal-content-wrapper");
        const modalTitle = document.getElementById("modal-title");
        const modalContent = document.getElementById("modal-content");
        const modalLoader = document.getElementById("modal-loader");

        // Set title
        modalTitle.textContent = title;

        // Reset modal content dan tampilkan loading
        modalContent.innerHTML = "";
        modalLoader.classList.remove("hidden");

        // Tampilkan modal dengan animasi
        modal.classList.remove("hidden");
        setTimeout(() => {
            modalWrapper.classList.remove("scale-95", "opacity-0");
            modalWrapper.classList.add("scale-100", "opacity-100");
        }, 10);

        // Load content via AJAX
        fetch(contentUrl)
            .then(response => response.text())
            .then(html => {
                modalLoader.classList.add("hidden");
                modalContent.innerHTML = html;
            })
            .catch(() => {
                modalLoader.classList.add("hidden");
                modalContent.innerHTML = "<p class='text-red-500'>Error loading form.</p>";
            });

        // Tambahkan event listener untuk "Escape" key
        document.addEventListener("keydown", escKeyListener);
    }

    function closeModal() {
        const modal = document.getElementById("modal-container");
        const modalWrapper = document.getElementById("modal-content-wrapper");

        // Animasi keluar
        modalWrapper.classList.add("scale-95", "opacity-0");
        setTimeout(() => {
            modal.classList.add("hidden");
            document.getElementById("modal-content").innerHTML = "";
            document.removeEventListener("keydown", escKeyListener);
        }, 300);
    }

    function escKeyListener(event) {
        if (event.key === "Escape") {
            closeModal();
        }
    }

    // Tutup modal jika klik di luar area modal
    document.getElementById("modal-container").addEventListener("click", function(event) {
        if (event.target === this) {
            closeModal();
        }
    });
</script>