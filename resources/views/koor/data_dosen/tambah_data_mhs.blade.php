<div class="modal fade" id="dialogTambahDataMhs" tabindex="-1" aria-labelledby="dialogTambahDataMhs" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dialogTambahDataMhs">Tambah Data Mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <blockquote class="blockquote-primary">
                        <p class="mb-3">Form dengan tanda asterik (<span class="required">*</span>) wajib diisi.</p>
                    </blockquote>
                    <form method="POST" action="{{ route('simpanMhs') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id_dsn" value="{{ $dosen->id }}">
                        <div class="form-group row mb-3">
                            <label for="inputNIM" class="col-sm-2 col-form-label">NIM <span class="required">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('nim') is-invalid @enderror" name="nim" id="inputNIM" value="{{ old('nim') }}">
                                @error('nim')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="inputNama" class="col-sm-2 col-form-label">Nama <span class="required">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="inputNama" value="{{ old('nama') }}">
                                @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="inputEmail" class="col-sm-2 col-form-label">Email <span class="required">*</span></label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="inputEmail" value="{{ old('email') }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="inputStatusKP" class="col-sm-2 col-form-label">Status KP <span
                                    class="required">*</span></label>
                            <div class="col-sm-10">
                                <select class="form-select @error('status_kp') is-invalid @enderror" name="status_kp" id="inputStatusKP" aria-label="Status KP">
                                    <option disabled selected hidden>Pilih Status Kerja Praktek</option>
                                    <option value="BARU" {{ old('status_kp') === 'BARU' ? 'selected' : '' }}>BARU</option>
                                    <option value="ULANG" {{ old('status_kp') === 'ULANG' ? 'selected' : '' }}>ULANG</option>
                                </select>
                                @error('status_kp')
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
