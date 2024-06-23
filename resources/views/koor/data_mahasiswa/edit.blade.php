<div class="modal fade" id="dialogEditMhsKoor" tabindex="-1" aria-labelledby="dialogEditMhs" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dialogEditMhs">Edit Data Mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <blockquote class="blockquote-primary">
                        <p class="mb-3">Form dengan tanda asterik (<span class="required">*</span>) wajib diisi.</p>
                    </blockquote>
                    @isset($mhs)
                        <form method="POST"
                            {{-- action="{{ route('koor-data-mahasiswa-update', ['id' => $mhs->statusMahasiswa->id_mhs]) }}" --}}
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="oldNim" id="oldNim" value="">
                            <div class="form-group row mb-3">
                                <label for="inputNIM" class="col-sm-2 col-form-label">NIM <span
                                        class="required">*</span></label>
                                <div class="col-sm-10">
                                    <input type="topik" name="nim" class="form-control" id="inputNIM">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="inputNama" class="col-sm-2 col-form-label">Nama <span
                                        class="required">*</span></label>
                                <div class="col-sm-10">
                                    <input type="topik" name="nama" class="form-control" id="inputNama">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="inputIPK" class="col-sm-2 col-form-label">IPK <span
                                        class="required">*</span></label>
                                <div class="col-sm-10">
                                    <input type="topik" name="ipk" class="form-control" id="inputIPK">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="inputTranskrip" class="col-sm-2 col-form-label">Transkrip Nilai <span
                                        class="required">*</span></label>
                                <div class="col-sm-10">
                                    <input type="topik" name="transkrip_nilai" class="form-control" id="inputTranskrip">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="inputTelp" class="col-sm-2 col-form-label">Telp Mhs <span
                                        class="required">*</span></label>
                                <div class="col-sm-10">
                                    <input type="topik" name="telp_mhs" class="form-control" id="inputTelp">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Email <span
                                        class="required">*</span></label>
                                <div class="col-sm-10">
                                    <input type="topik" name="email" class="form-control" id="inputEmail">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="inputDoswal" class="col-sm-2 col-form-label">Dosen Wali <span
                                        class="required">*</span></label>
                                <div class="col-sm-10">
                                    <input type="topik" name="dosen_wali" class="form-control" id="inputDoswal">
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Edit</button>
                    </div>
                    </form>
                @endisset
            </div>
        </div>
    </div>
</div>
