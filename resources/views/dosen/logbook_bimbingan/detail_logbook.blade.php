<div class="modal fade" id="dialogDetailLogbook" tabindex="-1" aria-labelledby="dialogDetailLogbookLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dialogDetailLogbookLabel">History Logbook</h5>
            </div>
            <div class="modal-body">
                <div class="container">
                    <h4 class="mb-4">Logbook Bimbingan</h4>
                    <table class="table table-bordered mb-5">
                        <thead class="table-header">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Bab</th>
                            <th>Uraian Bimbingan</th>
                            <th>Dokumen</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody id="mahasiswaLogbookList">

                        </tbody>
{{--                        <tbody>--}}
{{--                            <tr>--}}
{{--                                <td class="centered-column">1</td>--}}
{{--                                <td class="col-2 centered-column" id="">7 Juni 2024</td>--}}
{{--                                <td class="col-2 centered-column" id="">1</td>--}}
{{--                                <td class="col-4">Membahas mengenai arsitektur yang digunakan</td>--}}
{{--                                <td class="centered-column"><a href="https://github.com/zalllrizalll" target="_blank">https://github.com/zalllrizalll</a></td>--}}
{{--                                <td class="col-2 centered-column">--}}
{{--                                    <button type="submit" name="status" class="btn btn-success" value="ACC"><i class="fa-regular fa-circle-check"></i></button>--}}
{{--                                    <button type="submit" name="status" class="btn btn-danger delete-button" value="REVISI"><i class="fa-regular fa-circle-xmark"></i></button>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        </tbody>--}}
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

{{--<script>--}}
{{--    document.addEventListener('DOMContentLoaded', function() {--}}
{{--        var deleteButtons = document.querySelectorAll('.delete-button');--}}
{{--        deleteButtons.forEach(function(button) {--}}
{{--            button.addEventListener('click', function(event) {--}}
{{--                Swal.fire({--}}
{{--                    title: 'Apakah Anda Yakin?',--}}
{{--                    text: "Logbook yang ditolak tidak dapat dikembalikan!",--}}
{{--                    icon: 'warning',--}}
{{--                    showCancelButton: true,--}}
{{--                    confirmButtonColor: '#3085d6',--}}
{{--                    cancelButtonColor: '#d33',--}}
{{--                    confirmButtonText: 'Ya, tolak!',--}}
{{--                    cancelButtonText: 'Batal'--}}
{{--                }).then((result) => {--}}
{{--                    if (result.isConfirmed) {--}}
{{--                        // Proses penghapusan data di sini--}}
{{--                        Swal.fire(--}}
{{--                            'Success!',--}}
{{--                            'Logbook berhasil ditolak',--}}
{{--                            'success'--}}
{{--                        );--}}
{{--                    } else if (result.dismiss === Swal.DismissReason.cancel) {--}}
{{--                        // Batalkan penghapusan--}}
{{--                        Swal.fire(--}}
{{--                            'Canceled!',--}}
{{--                            'Logbook gagal ditolak',--}}
{{--                            'error'--}}
{{--                        );--}}
{{--                    }--}}
{{--                });--}}
{{--            });--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}