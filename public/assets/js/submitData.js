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
                let form = event.target;
                let formData = new FormData(form);
                let tableId = form.getAttribute("data-table-id"); // Ambil ID tabel dari atribut data

                fetch(form.action, {
                        method: form.method,
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
                            if (data.status === 'success' && tableId) {
                                let dataTable = $('#' + tableId).DataTable();
                                if ($.fn.DataTable.isDataTable('#' + tableId)) {
                                    dataTable.ajax.reload(null, false); // Reload DataTable sesuai ID
                                }
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
