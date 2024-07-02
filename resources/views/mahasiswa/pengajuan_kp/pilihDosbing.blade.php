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
                        <table class="table table-bordered mb-1" id="dosbingList">
                            <thead class="table-header">
                                <tr>
                                    <th>No</th>
                                    <th>NPP</th>
                                    <th>Nama Dosen</th>
                                    <th>Sisa Kuota</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dosens as $dosen)
                                    <tr>
                                        <td class="centered-column">{{ $loop->iteration }}</td>
                                        <td class="centered-column">{{ $dosen->npp }}</td>
                                        <td>{{ $dosen->nama }}</td>
                                        <td class="centered-column">{{ $dosen->sisa_kuota }}</td>
                                        <td class="centered-column"><button type="button" class="btn btn-warning btn-pilih-dosbing" data-bs-toggle="modal" data-bs-target="#pilihDosbingModal"><i class="fas fa-chevron-circle-right"></i></button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
                    </div>

                    <!-- Hidden initially -->
                    <h4 class="mb-4 mt-5" id="selectedDosbingTitle" style="display: none;">Dosen Pembimbing Terpilih</h4>
                    <div class="table-container table-dosbing" id="selectedDosbingContainer" style="display: none;">
                        <table class="table table-bordered mb-1" id="selectedDosbingList">
                            <thead class="table-header">
                                <tr>
                                    <th>No</th>
                                    <th>NIDN</th>
                                    <th>Nama Dosen</th>
                                    <th>Sisa Kuota</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Selected supervisors will appear here -->
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group row mb-3 justify-content-end" id="continueButtonContainer" style="display: none;">
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('formPengajuan') }}" class="btn btn-primary">
                                <input type="hidden" name="id_dospem" id="id_dospem" value="">
                                <i class="fas fa-chevron-right"></i>Lanjutkan
                            </a>
                            {{-- <button type="submit" class="btn btn-primary"><i class="fas fa-chevron-right"></i>Lanjutkan</button> --}}
                        </div>
                    </div>
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
                                <button type="button" class="btn btn-primary" id="konfirmasiPilihDosbing">Ya</button>
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
            const dosbingList = document.getElementById('dosbingList').querySelector('tbody');
            const selectedDosbingList = document.getElementById('selectedDosbingList').querySelector('tbody');
            const selectedDosbingContainer = document.getElementById('selectedDosbingContainer');
            const selectedDosbingTitle = document.getElementById('selectedDosbingTitle');
            const continueButtonContainer = document.getElementById('continueButtonContainer');
            let dosbingToBeAdded = null;
            let dosbingToBeRemoved = null;
            const pilihDosbingModalElement = document.getElementById('pilihDosbingModal');
            const hapusDosbingModalElement = document.getElementById('hapusDosbingModal');
            const pilihDosbingModal = new bootstrap.Modal(pilihDosbingModalElement);
            const hapusDosbingModal = new bootstrap.Modal(hapusDosbingModalElement);
            let id_dospem = document.getElementById('id_dospem');

            document.getElementById('konfirmasiPilihDosbing').addEventListener('click', 
            function() {
                if (dosbingToBeAdded) {
                    // Logika untuk menambah dosbing terpilih ke dalam daftar
                    // Set nilai id_dospem ke input tersembunyi
                    document.getElementById('id_dospem').value = 'your_dospem_id_value';
                    // Tampilkan elemen tersembunyi dan lanjutkan ke logika berikutnya
                }
            });

            // Function to update display status
            function updateDisplayStatus() {
                const savedSelectedDosbings = JSON.parse(localStorage.getItem('selectedDosbings')) || [];
                if (savedSelectedDosbings.length > 0) {
                    selectedDosbingContainer.style.display = 'block';
                    selectedDosbingTitle.style.display = 'block';
                    continueButtonContainer.style.display = 'block';
                } else {
                    selectedDosbingContainer.style.display = 'none';
                    selectedDosbingTitle.style.display = 'none';
                    continueButtonContainer.style.display = 'none';
                }
            }

            updateDisplayStatus();

            // Hide selected dosbing section and continue button by default
            selectedDosbingContainer.style.display = 'none';
            selectedDosbingTitle.style.display = 'none';
            continueButtonContainer.style.display = 'none';

            // Handle selecting a dosbing to add
            document.querySelectorAll('.btn-pilih-dosbing').forEach(button => {
                button.addEventListener('click', function() {
                    dosbingToBeAdded = this.closest('tr');
                });
            });

            document.getElementById('konfirmasiPilihDosbing').addEventListener('click', function() {
                if (dosbingToBeAdded) {
                    // Show selected dosbing section and continue button
                    selectedDosbingContainer.style.display = 'block';
                    selectedDosbingTitle.style.display = 'block';
                    continueButtonContainer.style.display = 'block';
                    
                    // Clone the row and update its buttons
                    const clonedRow = dosbingToBeAdded.cloneNode(true);
                    const btn = clonedRow.querySelector('.btn-pilih-dosbing');
                    btn.classList.remove('btn-warning', 'btn-pilih-dosbing');
                    btn.classList.add('btn-danger', 'btn-hapus-dosen');
                    btn.innerHTML = '<i class="fas fa-trash"></i>';
                    btn.removeAttribute('data-bs-toggle');
                    btn.removeAttribute('data-bs-target');
                    btn.setAttribute('data-bs-toggle', 'modal');
                    btn.setAttribute('data-bs-target', '#hapusDosbingModal');
                    clonedRow.querySelector('.btn-hapus-dosen').addEventListener('click', function() {
                        dosbingToBeRemoved = this.closest('tr');
                    });

                    // Add the cloned row to the selected list
                    selectedDosbingList.appendChild(clonedRow);

                    // Remove the original row from the available list
                    dosbingToBeAdded.remove();
                    dosbingToBeAdded = null;

                    updateSelectedDosbingNumbers();

                    // Show selected dosbing section
                    selectedDosbingContainer.style.display = 'block';
                    selectedDosbingTitle.style.display = 'block';
                    continueButtonContainer.style.display = 'block';

                    // Close the modal
                    pilihDosbingModal.hide();

                    // Clear modal backdrop and remove focus from modal
                    $('.modal-backdrop').remove();
                    $('body').removeClass('modal-open');
                    $('body').css('padding-right', '');
                    $('.modal').removeClass('show');
                    $('.modal').attr('aria-modal', 'false');
                    $('.modal').attr('aria-hidden', 'true');

                    // Set focus back to main content
                    document.getElementById('nav-tab-dosbing').scrollIntoView();
                }
            });

            // Confirm removing dosbing
            document.getElementById('konfirmasiHapusDosbing').addEventListener('click', function() {
                if (dosbingToBeRemoved) {
                    // Revert the row back to the available list
                    const clonedRow = dosbingToBeRemoved.cloneNode(true);
                    const btn = clonedRow.querySelector('.btn-hapus-dosen');
                    btn.classList.remove('btn-danger', 'btn-hapus-dosen');
                    btn.classList.add('btn-warning', 'btn-pilih-dosbing');
                    btn.innerHTML = '<i class="fas fa-chevron-circle-right"></i>';
                    btn.removeAttribute('data-bs-toggle');
                    btn.removeAttribute('data-bs-target');
                    btn.setAttribute('data-bs-toggle', 'modal');
                    btn.setAttribute('data-bs-target', '#pilihDosbingModal');
                    clonedRow.querySelector('.btn-pilih-dosbing').addEventListener('click', function() {
                        dosbingToBeAdded = this.closest('tr');
                    });

                    dosbingList.appendChild(clonedRow);
                    dosbingToBeRemoved.remove();
                    dosbingToBeRemoved = null;

                    updateSelectedDosbingNumbers();

                    // Hide selected dosbing section if there are no selected dosbings
                    if (selectedDosbingList.querySelectorAll('tr').length === 0) {
                        selectedDosbingContainer.style.display = 'none';
                        selectedDosbingTitle.style.display = 'none';
                        continueButtonContainer.style.display = 'none';
                    }

                    // Close the modal
                    hapusDosbingModal.hide();

                    // Clear modal backdrop and remove focus from modal
                    $('.modal-backdrop').remove();
                    $('body').removeClass('modal-open');
                    $('body').css('padding-right', '');
                    $('.modal').removeClass('show');
                    $('.modal').attr('aria-modal', 'false');
                    $('.modal').attr('aria-hidden', 'true');

                    // Set focus back to main content
                    document.getElementById('nav-tab-dosbing').scrollIntoView();
                }
            });

            function updateSelectedDosbingNumbers() {
                const selectedRows = selectedDosbingList.querySelectorAll('tr');
                selectedRows.forEach((row, index) => {
                    row.querySelector('.centered-column:first-child').textContent = index + 1;
                });
            }

            // Remove the modal from the DOM after it's hidden
            pilihDosbingModal.addEventListener('hidden.bs.modal', function () {
                // Remove the modal from the DOM
                pilihDosbingModalElement.remove();
            });

            hapusDosbingModal.addEventListener('hidden.bs.modal', function () {
                // Remove the modal from the DOM
                hapusDosbingModalElement.remove();
            });
        });
    </script>

@endsection