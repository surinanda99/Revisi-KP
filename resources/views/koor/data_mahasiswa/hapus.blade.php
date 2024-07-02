<div class="modal fade" id="dialogHapusMhs" tabindex="-1" aria-labelledby="dialogHapus" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dialogHapus">Hapus Data Mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Yakin untuk menghapus data mahasiswa ini?
            </div>
            @isset($mhs)
                <form action="{{ route('koor-data-mahasiswa-delete', ['id' => $mhs->statusMahasiswa->id_mhs]) }}"
                    method="POST">
                    @csrf
                    <input type="hidden" name="nim" id="nim" value="">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Ya</button>
                    </div>
                </form>
            @endisset
        </div>
    </div>
</div>
