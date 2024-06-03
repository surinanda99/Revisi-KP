@foreach($dosens as $dosen)
    <div class="modal fade" id="dialogEditDosen_{{ $dosen->id }}" tabindex="-1" aria-labelledby="dialogEditDosenLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dialogEditDosenLabel">Edit Data Dosen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('updateDosen', ['id' => $dosen->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="container">
                            <div class="form-group row mb-3">
                                <label for="inputKuota" class="col-sm-2 col-form-label">Kuota Mhs KP Baru</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('kuota') is-invalid @enderror" id="inputKuota" name="kuota" value="{{ old('kuota') ? old('kuota') : $dosen->kuota }}">
                                    @error('kuota')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="inputJumlahAjuan" class="col-sm-2 col-form-label">Jumlah Ajuan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('jumlah_ajuan') is-invalid @enderror" id="inputJumlahAjuan" name="jumlah_ajuan" value="{{ old('jumlah_ajuan') ? old('jumlah_ajuan') : $dosen->jumlah_ajuan }}">
                                    @error('jumlah_ajuan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
