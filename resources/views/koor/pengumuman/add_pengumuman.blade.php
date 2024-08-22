@extends('koor.layouts.main')
@section('title', 'Tambah Pengumuman')
@section('content')

    <!-- Button to trigger modal -->
    <!-- Button to trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahPengumumanModal">
        Tambah Pengumuman Baru
    </button>

    <!-- Modal -->
    <div class="modal fade" id="tambahPengumumanModal" tabindex="-1" role="dialog" aria-labelledby="tambahPengumumanModalLabel"
        aria-hidden="true">
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
                            <input type="text" class="form-control" id="judulPengumuman" name="judul" required>
                        </div>
                        <div class="form-group">
                            <label for="isiPengumuman">Isi Pengumuman</label>
                            <textarea class="form-control" id="isiPengumuman" name="isi" rows="4" required></textarea>
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

    <!-- Include Bootstrap JS and jQuery if not already included -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endsection
