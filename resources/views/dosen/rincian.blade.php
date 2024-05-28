<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Form Pengajuan KP</title>
</head>
<body>
    <div class="container mt-5">
        <h4>Pengajuan Bimbingan KP</h4>
        <div class="row mt-5">
            <form action="" method="POST">
                <div class="row">   
                        <div class="col-2 text-start">
                            <label for="bidang_kajian" class="form-label">Status</label>
                        </div>
                        <div class="col-10">
                            <select class="form-select w-auto" name="bidang_kajian" id="bidang_kajian">
                                <option selected>Pilih Status</option>
                                <option value="Setuju">Setuju</option>
                                <option value="Tolak">Tolak</option>
                            </select>
                        </div>
                <div class="row mt-4">       
                    <div class="col-2 text-start">
                        <label for="judul" class="form-label">Judul</label>
                    </div>
                    <div class="col-10">
                        <input class="form-control" type="text" id="judul" name="judul" placeholder="Masukkan Judul Kerja Praktek Anda">
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-2 text-start">
                        <label for="perusahaan" class="form-label">Perusahaan</label>
                    </div>
                    <div class="col-10">
                        <input class="form-control" type="text" id="perusahaan" name="perusahaan" placeholder="Masukkan Perusahaan Kerja Praktek Anda">
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-2 text-start">
                        <label for="posisi" class="form-label">Posisi</label>
                    </div>
                    <div class="col-10">
                        <input class="form-control" type="text" id="posisi" name="posisi" placeholder="Masukkan Posisi Kerja Praktek Anda">
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-2 text-start">
                        <label for="posisi" class="form-label">Bidang Kajian</label>
                    </div>
                    <div class="col-10">
                        <input class="form-control" type="text" id="posisi" name="posisi" placeholder="Masukkan Bidang Kajian Kerja Praktek Anda">
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-2 text-start">
                        <label for="keyword" class="form-label">Keyword</label>
                    </div>
                    <div class="col-10">
                        <input class="form-control" type="text" id="keyword" name="keyword" placeholder="Masukkan Keyword Kerja Praktek Anda">
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-2 text-start">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                    </div>
                    <div class="col-10">
                        <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="6" placeholder="Masukkan Deskripsi Kerja Praktek Anda"></textarea>
                    </div>
                </div>
                <div class="row mt-4 mb-5">
                    <div class="col-2 text-start">
                        <label for="catatan" class="form-label">Catatan</label>
                    </div>
                    <div class="col-10">
                        <input class="form-control" type="text" id="catatan" name="catatan" placeholder="Masukkan Catatan Kerja Praktek Anda">
                    </div>
                </div>
                <button class="btn btn-primary mt-5 mb-3 me-5" style="width: 100px" type="submit">Simpan</button>
                <a href="" class="btn btn-warning mt-5 mb-3 me-5" style="width: 100px">Edit</a>
                <button class="btn btn-danger mt-5 mb-3" style="width: 100px">Batal</button>
            </form>
        </div>
    </div>
</body>
</html>
