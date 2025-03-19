<div id="modal-container" class="hidden z-[99] fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center transition-opacity duration-300 ease-in-out">
    <div class="bg-white p-6 rounded-lg shadow-lg overflow-auto w-[80vw] h-[70vh] relative">
        <!-- Tombol Close (Icon Silang) -->
        <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-500 hover:text-gray-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <h2 id="modalTitle" class="text-xl font-bold mb-4"></h2>

        <!-- Form atau konten lain -->
        <?= $formContent ?? '' ?>
    </div>
</div>

<script>
    function openModal(mode, data = null) {
        $('#modalTitle').text(mode == 'update' ? 'Edit Data' : 'Tambah Data'); // Ubah judul modal
        document.getElementById("modal-container").classList.remove("hidden");
    }

    function closeModal() {
        document.getElementById("modal-container").classList.add("hidden");
    }
</script>