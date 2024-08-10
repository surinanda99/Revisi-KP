@extends('dosen.layouts.main')
@section('title', 'Daftar Pengajuan Sidang')
@section('content')
<div class="wrapper d-flex flex-column min-vh-100">
    <div class="container flex-grow-1">
        <h3 class="mb-3"><b>Daftar Pengajuan Sidang Mahasiswa</b></h3>
        <p class="mb-2">Berikut ini adalah daftar pengajuan Sidang Mahasiswa Kerja Praktek</p>
        <div class="input-group justify-content-end mb-3">
            <input class="form-control" type="text" placeholder="Search here..." aria-label="Search for..."
                   aria-describedby="btnNavbarSearch" />
            <button class="btn" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
        </div>
        <div class="table-container table-dosbing">
            <table class="table table-bordered mb-1">
                <thead class="table-header">
                    <th class="align-middle">No</th>
                    <th class="align-middle">NIM</th>
                    <th class="align-middle">Nama</th>
                    <th class="align-middle">File</th>
                    <th class="align-middle">Aksi</th>
                </thead>
                <tbody>
                @foreach($pengajuan_sidangs as $ps)
                    <tr class="centered-column">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $ps->mahasiswa->mahasiswa->nim }}</td>
                        <td>{{ $ps->mahasiswa->mahasiswa->nama }}</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detailModal{{ $ps->id }}">
                                Lihat Detail
                            </button>
                        </td>
                        <td class="centered-column">
                            @if ($ps->status == 'ACC')
                                <button class="btn btn-success" value="ACC">
                                    Status Diterima
                                </button>
                            @elseif ($ps->status == 'TOLAK')
                                {{-- Status Ditolak --}}
                                <button class="btn btn-danger" value="TOLAK">
                                    Status Ditolak
                                </button>
                            @else
                                <form action="{{ route('update-mahasiswa-bimbingan') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $ps->id }}">
                                    <button type="submit" name="status" class="btn btn-success" value="ACC">
                                        <i class="fa-regular fa-circle-check"></i> ACC
                                    </button>
                                </form>
                                    <button type="submit" name="status" class="btn btn-danger delete-button" value="TOLAK" id="rejectButton_{{ $ps->id }}">
                                        <i class="fa-regular fa-circle-xmark"></i> TOLAK
                                    </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <nav aria-label="pageNavigationPengajuanSidang">
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
</div>

<!-- Modal Detail Pengajuan Sidang -->
@foreach($pengajuan_sidangs as $ps)
<div class="modal fade" id="detailModal{{ $ps->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $ps->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="detailModalLabel{{ $ps->id }}">Detail Pengajuan Sidang</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Judul:</strong> {{ $ps->judul }}</p>
                <p><strong>Bidang Kajian:</strong> {{ $ps->bidang_kajian }}</p>
                <p><strong>Dokumen Logbook:</strong> <a href="{{ $ps->dokumen }}" target="_blank">Lihat Dokumen</a></p>
                <p><strong>Dokumen Validasi Dosen:</strong> <a href="{{ $ps->validasi }}" target="_blank">Lihat Dokumen</a></p>
                <p><strong>Nilai Penyelia:</strong> {{ $ps->nilaiPenyelia }}</p>
                <p><strong>Nilai Pembimbing:</strong> <input type="text" id="nilaiPembimbing{{ $ps->id }}" class="form-control w-25 d-inline" value="{{ $ps->nilaiPembimbing ?? '' }}"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary update-btn" data-pengajuan-id="{{ $ps->id }}">Simpan Nilai Pembimbing</button>
            </div>
        </div>
    </div>
</div>
@endforeach

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.update-btn').on('click', function() {
            var $this = $(this);
            var pengajuanId = $this.data('pengajuan-id');
            var nilaiPembimbing = $('#nilaiPembimbing' + pengajuanId).val();

            // Nonaktifkan tombol untuk mencegah klik ganda
            $this.prop('disabled', true);

            $.ajax({
                url: '{{ route('updatePengajuanSidang', '') }}/' + pengajuanId,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    nilaiPembimbing: nilaiPembimbing
                },
                success: function(response) {
                    alert('Nilai pembimbing updated successfully');
                    $('#detailModal' + pengajuanId).modal('hide');
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                },
                complete: function() {
                    // Aktifkan kembali tombol setelah permintaan selesai
                    $this.prop('disabled', false);
                }
            });
        });
    });
</script>
@endsection



{{-- @extends('dosen.layouts.main')
@section('title', 'Daftar Pengajuan Sidang')
@section('content')
<div class="wrapper d-flex flex-column min-vh-100">
    <div class="container flex-grow-1">
        <h3 class="mb-3"><b>Daftar Pengajuan Sidang Mahasiswa</b></h3>
        <p class="mb-2">Berikut ini adalah daftar pengajuan Sidang Mahasiswa Kerja Praktek</p>
        <div class="input-group justify-content-end mb-3">
            <input class="form-control" type="text" placeholder="Search here..." aria-label="Search for..."
                   aria-describedby="btnNavbarSearch" />
            <button class="btn" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
        </div>
        <div class="table-container table-dosbing">
            <table class="table table-bordered mb-1">
                <thead class="table-header">
                    <th class="align-middle">No</th>
                    <th class="align-middle">NIM</th>
                    <th class="align-middle">Nama</th>
                    <th class="align-middle">Judul</th>
                    <th class="align-middle">Bidang Kajian</th>
                    <th class="align-middle">Dokumen Logbook</th>
                    <th class="align-middle">Nilai Penyelia</th>
                    <th class="align-middle">Nilai Pembimbing</th>
                    <th class="align-middle">Status</th>
                    <th class="align-middle">Aksi</th>
                    </thead>
                    <tbody>
                    @foreach($pengajuan_sidangs as $ps)
                        <tr class="centered-column">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $ps->mahasiswa->mahasiswa->nim }}</td>
                            <td>{{ $ps->mahasiswa->mahasiswa->nama }}</td>
                            <td>{{ $ps->judul }}</td>
                            <td>{{ $ps->bidang_kajian }}</td>
                            <td>{{ $ps->dokumen }}</td>
                            <td>{{ $ps->nilaiPenyelia }}</td>
                        </tr>
                    @endforeach
                    </tbody>
            </table>
        </div>

        {{-- <div class="table-container table-dosbing">
            <table class="table table-bordered mb-1">
                <thead class="table-header">
                <th>No</th>
                <th>NIM</th>
                <th>Nama Mahasiswa</th>
                <th>Nilai Penyelia</th>
                <th>Nilai Pembimbing</th>
                <th>Nilai Penguji</th>
                <th>Waktu Sidang</th>
                <th>Aksi</th>
                </thead>
                {{-- @foreach ($pengajuan as $pj)
                        <tr class="centered-column">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pj->mahasiswa->mahasiswa->nim }}</td>
                            <td>{{ $pj->mahasiswa->mahasiswa->nama }}</td>
                            <td>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="{{ $pj->mahasiswa->mahasiswa->id }}">
                                    <i class="fa-solid fa-images"></i>
                                </button>
                            </td>
                            <td>{{ $pj->mahasiswa->mahasiswa->ipk }}</td>
                            <td>{{ $pj->topik }}</td>
                            <td class="centered-column">
                                <form action=" " method="post"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $pj->id }}">
                                    <button type="submit" name="status" class="btn btn-success" value="ACC"><i
                                            class="fa-regular fa-circle-check"></i></button>
                                </form>
                                <button type="button" class="btn btn-danger delete-button" value="TOLAK"
                                        id="rejectButton_{{ $pj->id }}">
                                    <i class="fa-regular fa-circle-xmark"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach --}}
                {{-- <tr class="centered-column">
                    <td>1</td>
                    <td>A11.2021.13550</td>
                    <td>Muhammad Maulana Hikam</td>
                    <td>
                        <a href="#" class="btn btn-warning"><i class="fa-solid fa-images"></i></a>
                    </td>
                    <td>3.84</td>
                    <td>Aplikasi Identifikasi Penyakit Kanker</td>
                    <td class="centered-column">
                        <button type="submit" name="status" class="btn btn-success" value="ACC"><i
                                class="fa-regular fa-circle-check"></i></button>
                        <button type="submit" name="status" class="btn btn-danger delete-button" value="REVISI"><i
                                class="fa-regular fa-circle-xmark"></i></button>
                    </td>
                </tr>
            </table>
        </div> --}}

        {{-- {{ $pengajuan->links() }} --}}
        {{-- <script>
            document.addEventListener('DOMContentLoaded', function() {
                var deleteButtons = document.querySelectorAll('.delete-button');
                deleteButtons.forEach(function(button) {
                    button.addEventListener('click', function(event) {
                        Swal.fire({
                            title: 'Pengajuan ingin ditolak?',
                            text: "Pengajuan ditolak tidak dapat dikembalikan!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, tolak!',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Proses penghapusan data di sini
                                Swal.fire(
                                    'Success!',
                                    'Pengajuan berhasil ditolak',
                                    'success'
                                );
                            } else if (result.dismiss === Swal.DismissReason.cancel) {
                                // Batalkan penghapusan
                                Swal.fire(
                                    'Canceled!',
                                    'Pengajuan gagal ditolak',
                                    'error'
                                );
                            }
                        });
                    });
                });
            });
        </script> --}}
    {{-- @endsection  --}}
