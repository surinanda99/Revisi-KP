<div class="modal fade" id="dialogDetailDataMahasiswa" tabindex="-1" aria-labelledby="dialogDetailDataMahasiswaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dialogDetailDataMahasiswaLabel">Data Dosbing Dari Mahasiswa {{ $mahasiswa->nama }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-header">
                        <tr>
                            <th class="align-middle">No.</th>
                            <th class="align-middle">NPP </th>
                            <th class="align-middle">Dosen Pembimbing</th>
                            <th class="align-middle">Email</th>
                            <th class="align-middle">Telepon</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="centered-column">1</td>
                            <td class="centered-column">0686.11.2012.444</td>
                            <td class="centered-column">ADHITYA NUGRAHA, S.Kom, M.CS</td>
                            <td class="centered-column">adhitya@dsn.dinus.ac.id</td>
                            <td class="centered-column">0000000000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <nav aria-label="pageNavigationLogbook">
                <ul class="pagination custom-left-shift">
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
    </div>
</div>

