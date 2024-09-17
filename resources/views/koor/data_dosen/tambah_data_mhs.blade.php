<div class="modal fade" id="dialogTambahDataMhs" tabindex="-1" aria-labelledby="dialogTambahDataMhs" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dialogTambahDataMhs">Tambah Data Mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form method="POST" action="{{ route('simpanMhsKeDosen') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id_dsn" value="{{ $dosen->id }}">

                        @for($i = 1; $i <= 5; $i++)
                        <div class="form-group row mb-3">
                            <label for="mahasiswa{{ $i }}" class="col-sm-2 col-form-label">Pilih Mahasiswa {{ $i }}</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="mahasiswa_id[]" id="mahasiswa{{ $i }}">
                                    <option value="">Pilih Mahasiswa</option>
                                    @foreach($mahasiswas as $mahasiswa)
                                        <option value="{{ $mahasiswa->id }}">
                                            {{ $mahasiswa->nim }} - {{ $mahasiswa->nama }} (Status: {{ $mahasiswa->status_kp }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endfor

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
