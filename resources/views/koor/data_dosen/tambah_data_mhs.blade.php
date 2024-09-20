<div class="modal fade" id="dialogTambahDataMhs_{{ $dosen->id }}" tabindex="-1" aria-labelledby="dialogTambahDataMhsLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dialogTambahDataMhsLabel_{{ $dosen->id }}">Tambah Data Mahasiswa untuk Dosen {{ $dosen->dosen->nama }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('simpanMhsKeDosen') }}">
                    @csrf
                    <input type="hidden" name="id_dsn" value="{{ $dosen->id }}">

                    @for($i = 1; $i <= 5; $i++)
                    <div class="form-group row mb-3">
                        <label for="mahasiswa{{ $dosen->id }}_{{ $i }}" class="col-sm-2 col-form-label">Pilih Mahasiswa {{ $i }}</label>
                        <div class="col-sm-10">
                            <select class="form-select js-example-basic-single" name="mahasiswa_id[]" id="mahasiswa{{ $dosen->id }}_{{ $i }}">
                                <option value="">Pilih Mahasiswa</option>
                                @foreach($mahasiswas as $mahasiswa)
                                    <option value="{{ $mahasiswa->id }}">
                                        {{ $mahasiswa->nama }} ({{ $mahasiswa->nim }})
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

<script>
    $(document).ready(function() {
        // Inisialisasi Select2 tanpa pencarian minimal
        $('#dialogTambahDataMhs_{{ $dosen->id }}').on('shown.bs.modal', function () {
            $('.js-example-basic-single').select2({
                dropdownParent: $('#dialogTambahDataMhs_{{ $dosen->id }}'),
                width: '100%',
                placeholder: 'Pilih Mahasiswa',
                allowClear: true,
                minimumResultsForSearch: 0, // Tampilkan hasil langsung tanpa mengetik
            });
        });
    });
</script>
