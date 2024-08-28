<!-- Modal Tambah Pengumuman -->
<div class="modal fade" id="tambahPengumumanModal" tabindex="-1" role="dialog" aria-labelledby="tambahPengumumanModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahPengumumanModalLabel">Tambah Pengumuman Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formPengumuman" action="{{ route('koor-pengumuman.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="judulPengumuman">Judul Pengumuman</label>
                        <input class="form-control" type="text" name="judul" id="judulPengumuman" required>
                    </div>
                    <div class="form-group">
                        <label for="isiPengumuman">Isi Pengumuman</label>
                        <textarea class="form-control" name="isi" id="isiPengumuman" rows="4" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Pengumuman</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Pengumuman -->
@foreach ($pengumuman as $p)
<div class="modal fade" id="editPengumumanModal{{ $p->id }}" tabindex="-1" role="dialog" aria-labelledby="editPengumumanModalLabel{{ $p->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPengumumanModalLabel{{ $p->id }}">Edit Pengumuman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('koor-pengumuman.update', $p->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="judulPengumuman{{ $p->id }}">Judul Pengumuman</label>
                        <input class="form-control" type="text" name="judul" id="judulPengumuman{{ $p->id }}" value="{{ $p->judul }}" required>
                    </div>
                    <div class="form-group">
                        <label for="isiPengumuman{{ $p->id }}">Isi Pengumuman</label>
                        <textarea class="form-control" name="isi" id="isiPengumuman{{ $p->id }}" rows="4" required>{{ $p->isi }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Pengumuman</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach