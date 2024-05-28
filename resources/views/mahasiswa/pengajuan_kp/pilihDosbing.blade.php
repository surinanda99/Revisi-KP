@extends('mahasiswa.layouts.main')
@section('title', 'Dashboard Mahasiswa')
@section('content')
<div class="container">
    <ul role="tablist" class="nav bg-light nav-pills rounded-pill nav-fill mb-3">
        <li class="nav-item">
            <a data-toggle="pill" href="#nav-tab-dosbing" class="nav-link active rounded-pill">
                <i class="fas fa-chalkboard-teacher"></i>
                Dosen Pembimbing
            </a>
        </li>
        <li class="nav-item">
            <a data-toggle="pill" href="#nav-tab-pengajuan" class="nav-link rounded-pill">
                <i class="fas fa-edit"></i>
                Form Pengajuan
            </a>
        </li>
        <li class="nav-item">
            <a data-toggle="pill" href="#nav-tab-draft" class="nav-link rounded-pill">
                <i class="fas fa-book-open"></i>
                Draft Pengajuan
            </a>
        </li>
    </ul>

    <div class="tab-content">
        <div id="nav-tab-dosbing" class="tab-pane fade show active">
            <div class="container">
                <h4 class="mb-4">Pemilihan Dosen Pembimbing</h4>
                <p class="mb-2">Berikut ini adalah daftar dosen pembimbing yang tersedia</p>
                <blockquote class="blockquote-primary">
                    <p class="mb-3">Klik tombol panah <button type="button" class="btn btn-warning"><i class="fas fa-chevron-circle-right"></i></button> untuk memilih dosen pembimbing</p>
                </blockquote>
                <div class="input-group justify-content-end mb-3">
                    <input type="text" class="form-control" placeholder="Cari Dosen">
                    <div class="input-group-append"><button class="btn btn-primary"><i class="fas fa-search"></i></button></div>
                </div>
                <div class="table-container table-dosbing">
                    <table class="table table-bordered mb-1">
                        <thead class="table-header">
                            <th>No</th>
                            <th>NIDN</th>
                            <th>Nama Dosen</th>
                            <th>Sisa Kuota</th>
                            <th>Aksi</th>
                        </thead>
                        <tr>
                            <td class="centered-column">1</td>
                            <td class="centered-column">0606107401</td>
                            <td>YANI PARTI ASTUTI, S.SI, M.Kom</td>
                            <td class="centered-column">3</td>
                            <td class="centered-column"><button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#pilihDosbingModal"><i class="fas fa-chevron-circle-right"></i></button></td>
                        </tr>
                        <tr>
                            <td class="centered-column">2</td>
                            <td class="centered-column">0618038701</td>
                            <td>ADHITYA NUGRAHA, S.Kom, M.CS</td>
                            <td class="centered-column">3</td>
                            <td class="centered-column"><button type="button" class="btn btn-warning"><i class="fas fa-chevron-circle-right"></i></button></td>
                        </tr>
                        <tr>
                            <td class="centered-column">3</td>
                            <td class="centered-column">0625078504</td>
                            <td>ARDYTHA LUTHFIARTA, M.Kom</td>
                            <td class="centered-column">3</td>
                            <td class="centered-column"><button type="button" class="btn btn-warning"><i class="fas fa-chevron-circle-right"></i></button></td>
                        </tr>
                    </table>
                </div>
                <nav aria-label="pageNavigationDosbing">
                    <ul class="pagination justify-content-end">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                        </li>
                        <li class="page-item"><a class="page-link active" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            
                <h4 class="mb-4">Dosen yang Dipilih</h4>
                <div class="table-container">
                    <table class="table table-bordered">
                        <thead class="table-header">
                            <th>No</th>
                            <th>NIDN</th>
                            <th>Nama Dosen</th>
                            <th>Aksi</th>
                        </thead>
                        <tr>
                            <td class="centered-column">1</td>
                            <td class="centered-column">0618038701</td>
                            <td>ADHITYA NUGRAHA, S.Kom, M.CS</td>
                            <td class="centered-column"><button type="button" class="btn btn-danger"><i class="fas fa-trash" data-bs-toggle="modal" data-bs-target="#hapusDosbingModal"></i></button></td>
                        </tr>
                    </table>
                </div>
            
                <div class="form-group row mb-3 justify-content-end">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-chevron-right"></i>Lanjutkan</button>
                    </div>
                </div>
                </form>
            </div>
            
            <!-- Modal Pilih Dosbing -->
            <div class="modal fade" id="pilihDosbingModal" tabindex="-1" aria-labelledby="pilihDosbingModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="pilihDosbingModalLabel">Pilih Dosen Pembimbing</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Yakin untuk memilih dosen pembimbing ini?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                            <button type="button" class="btn btn-primary">Ya</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Modal Hapus Dosbing -->
            <div class="modal fade" id="hapusDosbingModal" tabindex="-1" aria-labelledby="hapusDosbingModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="hapusDosbingModalLabel">Hapus Dosen Pembimbing</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Yakin untuk menghapus dosen pembimbing ini?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                            <button type="button" class="btn btn-primary" id="konfirmasiHapusDosbing">Ya</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dosbingList = document.getElementById('dosbingList');
        const selectedDosbingList = document.getElementById('selectedDosbingList');
        let dosbingToBeAdded = null;
        let dosbingToBeRemoved = null;

        // Handle selecting a dosbing to add
        document.querySelectorAll('.btn-pilih-dosbing').forEach(button => {
            button.addEventListener('click', function() {
                dosbingToBeAdded = this.closest('tr').cloneNode(true);
            });
        });

        // Confirm adding dosbing
        document.getElementById('konfirmasiPilihDosbing').addEventListener('click', function() {
            if (dosbingToBeAdded) {
                // Update the button to delete
                const btn = dosbingToBeAdded.querySelector('.btn-pilih-dosbing');
                btn.classList.remove('btn-warning', 'btn-pilih-dosbing');
                btn.classList.add('btn-danger', 'btn-hapus-dosen');
                btn.innerHTML = '<i class="fas fa-trash"></i>';
                btn.setAttribute('data-bs-target', '#hapusDosbingModal');

                selectedDosbingList.appendChild(dosbingToBeAdded);
                dosbingToBeAdded = null;
                updateSelectedDosbingNumbers();
                new bootstrap.Modal(document.getElementById('pilihDosbingModal')).hide();
            }
        });

        // Handle selecting a dosbing to remove
        selectedDosbingList.addEventListener('click', function(e) {
            if (e.target.closest('.btn-hapus-dosen')) {
                dosbingToBeRemoved = e.target.closest('tr');
            }
        });

        // Confirm removing dosbing
        document.getElementById('konfirmasiHapusDosbing').addEventListener('click', function() {
            if (dosbingToBeRemoved) {
                dosbingToBeRemoved.remove();
                dosbingToBeRemoved = null;
                updateSelectedDosbingNumbers();
                new bootstrap.Modal(document.getElementById('hapusDosbingModal')).hide();
            }
        });

        function updateSelectedDosbingNumbers() {
            selectedDosbingList.querySelectorAll('tr').forEach((row, index) => {
                row.querySelector('td:first-child').textContent = index + 1;
            });
        }
    });
</script>

@endsection