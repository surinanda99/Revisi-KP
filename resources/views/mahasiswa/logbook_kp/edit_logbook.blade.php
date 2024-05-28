<div class="modal fade" id="dialogEditLogbook" tabindex="-1" aria-labelledby="dialogEditLogbookLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dialogEditLogbookLabel">Edit Logbook</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <blockquote class="blockquote-primary">
                        <p class="mb-3">Form dengan tanda asterik (<span class="required">*</span>) wajib diisi.</p>
                    </blockquote>
                    <form>
                        <div class="form-group row mb-3">
                            <label for="inputCatatan" class="col-sm-2 col-form-label">Uraian Bimbingan <span class="required">*</span></label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="inputCatatan" rows="3" placeholder="Masukkan Uraian Bimbingan"></textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="inputBidang" class="col-sm-2 col-form-label">Bab Terakhir Bimbingan <span class="required">*</span></label>
                            <div class="col-sm-3">
                                <select class="form-select" id="inputBidang" aria-label="Bidang Kajian">
                                    <option disabled selected hidden>Pilih Bab</option>
                                    <option value="I">Bab I</option>
                                    <option value="II">Bab II</option>
                                    <option value="III">Bab III</option>
                                    <option value="IV">Bab IV</option>
                                    <option value="V">Bab V</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="inputDok" class="col-sm-2 col-form-label">Dokumen <span class="required">*</span></label>
                            <div class="col-sm-10">
                                <input type="topik" class="form-control" id="inputDok" placeholder="Masukkan Link Dokumen">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary">Tambah</button>
                </div>
            </div>
        </div>
    </div>
</div>