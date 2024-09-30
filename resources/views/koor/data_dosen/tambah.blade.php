<div class="modal fade" id="dialogTambah" tabindex="-1" aria-labelledby="dialogTambah" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dialogTambah">Tambah Data Dosbing</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <blockquote class="blockquote-primary">
                        <p class="mb-3">Form dengan tanda asterik (<span class="required">*</span>) wajib diisi.</p>
                    </blockquote>
                    <form action="{{ route('simpanDosen') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- <input type="hidden" name="id_dsn" value="{{ $dosen->id }}"> <!-- Sesuaikan dengan apa yang Anda butuhkan --> --}}
                        <div class="form-group row mb-3">
                            <label for="inputNPP" class="col-sm-2 col-form-label">NPP <span class="required">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('npp') is-invalid @enderror" name="npp" id="inputNPP" value="{{ old('npp') }}">
                                @error('npp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="inputNama" class="col-sm-2 col-form-label">Nama Dosbing <span class="required">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="inputNama" value="{{ old('nama') }}">
                                @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
