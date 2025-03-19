<?= $this->extend('layouts/main') ?>


<?= $this->section('content') ?>
<!-- Mungkin Breadcum -->
<div style="font-size: 1rem; font-weight: bold; text-transform: uppercase;">Data Visit Nasabah</div>

<div class='w-full space-y-4'>
    <!-- Tombol Create Ajax Modal -->
    <div class='w-full flex justify-end'>
        <!-- OPEN MODAL ITU BAWAAN KOMPONEN MODAL -->
        <button onclick="openModal()" class="px-4 py-2 bg-sky-500 text-white rounded">
            Tambah Data
        </button>
    </div>

    <!-- Modal biasa -->
    <!-- Include Modal dengan Form Langsung -->
    <?= view('components/modal', [ // KOMPONEN USABLE MODAL
        'title' => 'Tambah Data visit', // INI TITLE MODAL FORM NYA (HEADER FORM)
        'formContent' => view('pages/visit_pipeline/create', ['action' => '/customer/store']) // INI LOKASI ISI FORMNYA ACTION ITU UNTUK ROUTE NYA NANTI STORE ATAU UPDATE
    ]) ?>

    <!-- DataTable - Menampilkan Data Nasabah -->
    <div class="overflow-x-auto">
        <?= $dataTable->render(); ?>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    // INI FUNCTION EDIT NYA, namanya jangan diganti karna dari library
    function editItem(id) {
        alert('Edit item ' + id);
    }

    // INI FUNCTION DELETE DATA, namanya jangan diganti karna dari library
    function deleteItem(id) {
        if (confirm('Hapus item ' + id + '?')) {
            alert('Item ' + id + ' dihapus!');
        }
    }

    // Lainnya ... 
</script>
<?= $this->endSection() ?>

