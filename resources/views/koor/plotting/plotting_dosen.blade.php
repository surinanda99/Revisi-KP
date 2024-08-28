{{-- @extends('koor.layouts.main')
@section('title', 'Data Dosen Pembimbing')
@section('content')
    <div class="container">
        <h2 class="mb-4">Plotting Dosen Pembimbing</h2>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h4 class="mb-4">Dosen Yang Tersedia</h4>
                <input type="text" id="search-dosen" class="form-control mb-3" placeholder="Cari Nama Dosen...">
                <form id="plotting-form" class="text-left">
                    @csrf
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Nama Dosen</th>
                            <th>Kuota Tersedia</th>
                        </tr>
                        </thead>
                        <tbody id="dosen-list">
                        @foreach($dsnPeriod as $dosen)
                            <tr class="dosen-row" data-dosen-id="{{ $dosen->id }}"
                                data-dosen-name="{{ strtolower($dosen->dosen->nama) }}" style="cursor: pointer;">
                                <td class="text-center">
                                    <span class="toggle-icon" data-dosen-id="{{ $dosen->id }}">></span>
                                </td>
                                <td>{{ $dosen->dosen->nama }}</td>
                                <td class="text-center">{{ $dosen->status->sisa }}</td>
                            </tr>
                            <tr id="mahasiswa-list-{{ $dosen->id }}" class="mahasiswa-list-row" style="display: none;">
                                <td colspan="4">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Nama Mahasiswa</th>
                                            <th>NIM</th>
                                            <th class="text-center">
                                                Pilih
                                                <input type="checkbox" class="select-all"
                                                       data-dosen-id="{{ $dosen->id }}">
                                            </th>
                                            <th class="text-right">
                                                <button type="button" class="btn btn-success plot-dosen"
                                                        data-dosen-id="{{ $dosen->id }}">
                                                    Plotting
                                                </button>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($mahasiswa as $mhs)
                                            <tr>
                                                <td>{{ $mhs->mahasiswa->nama }}</td>
                                                <td>{{ $mhs->mahasiswa->nim }}</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="mhs_id[{{ $dosen->id }}][]"
                                                           value="{{ $mhs->id_mhs }}"
                                                           class="select-mhs-{{ $dosen->id }}">
                                                </td>
                                                <td></td> <!-- Empty column to maintain structure -->
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>

    <style>
        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .table {
            margin: 0 auto;
        }

        .toggle-icon {
            display: inline-block;
            transform: rotate(90deg);
            transition: transform 0.3s;
        }

        .mahasiswa-list-row.show .toggle-icon {
            transform: rotate(0deg);
        }

        .container {
            margin-top: 20px;
        }

        .row.justify-content-center {
            display: flex;
            justify-content: center;
        }

        .col-md-10 {
            max-width: 80%;
        }

        .plot-dosen {
            margin-left: 10px;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Toggle mahasiswa list
            document.querySelectorAll('.dosen-row').forEach(function (row) {
                row.addEventListener('click', function () {
                    const dosenId = this.dataset.dosenId;
                    const mahasiswaRow = document.getElementById('mahasiswa-list-' + dosenId);
                    const toggleIcon = document.querySelector('.toggle-icon[data-dosen-id="' + dosenId + '"]');

                    if (mahasiswaRow.style.display === 'none' || mahasiswaRow.style.display === '') {
                        mahasiswaRow.style.display = 'table-row';
                        toggleIcon.style.transform = 'rotate(0deg)';
                    } else {
                        mahasiswaRow.style.display = 'none';
                        toggleIcon.style.transform = 'rotate(90deg)';
                    }
                });
            });

            // Select all mahasiswa
            document.querySelectorAll('.select-all').forEach(function (selectAllCheckbox) {
                selectAllCheckbox.addEventListener('change', function () {
                    const dosenId = this.dataset.dosenId;
                    const checkboxes = document.querySelectorAll('.select-mhs-' + dosenId);
                    checkboxes.forEach(checkbox => checkbox.checked = this.checked);
                });
            });

            // Plotting dosen
            document.querySelectorAll('.plot-dosen').forEach(function (plotButton) {
                plotButton.addEventListener('click', function () {
                    const dosenId = this.dataset.dosenId;
                    const checkboxes = document.querySelectorAll('.select-mhs-' + dosenId + ':checked');
                    const mahasiswaIds = Array.from(checkboxes).map(cb => cb.value);

                    if (mahasiswaIds.length === 0) {
                        alert('Pilih setidaknya satu mahasiswa untuk di-plotting.');
                        return;
                    }

                    if (confirm('Apakah Anda yakin ingin melakukan plotting untuk ' + mahasiswaIds.length + ' mahasiswa?')) {
                        $.ajax({
                            url: '{{ route("koor-plotting-dosbing-post") }}',
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                dosenId: dosenId,
                                mhs_id: mahasiswaIds
                            },
                            success: function (response) {
                                alert(response.message);
                                updateAfterPlotting(dosenId, mahasiswaIds);
                                setTimeout(function () {
                                    location.reload();
                                }, 100);
                            },
                            error: function (xhr) {
                                const errors = xhr.responseJSON.errors ? Object.values(xhr.responseJSON.errors).join('\n') : xhr.responseJSON.error;
                                alert('Terjadi kesalahan: ' + (errors || 'Error tidak terdeteksi.'));
                            }
                        });
                    }
                });
            });

            function updateAfterPlotting(dosenId, mahasiswaIds) {
                // Update kuota tersedia
                const kuotaCell = document.querySelector('.dosen-row[data-dosen-id="' + dosenId + '"] td:nth-child(3)');
                if (kuotaCell) {
                    const currentKuota = parseInt(kuotaCell.textContent, 10);
                    kuotaCell.textContent = currentKuota - mahasiswaIds.length;
                }

                // Hapus mahasiswa yang sudah di-plotting dari daftar
                mahasiswaIds.forEach(function (mhsId) {
                    const row = document.querySelector('input[name="mhs_id[' + dosenId + '][]"][value="' + mhsId + '"]').closest('tr');
                    if (row) {
                        row.remove();
                    }
                });

                // Reset checkbox "Select All"
                const selectAllCheckbox = document.querySelector('.select-all[data-dosen-id="' + dosenId + '"]');
                if (selectAllCheckbox) {
                    selectAllCheckbox.checked = false;
                }
            }

            // Improved search functionality
            document.getElementById('search-dosen').addEventListener('input', function () {
                const searchValue = this.value.toLowerCase();
                document.querySelectorAll('.dosen-row').forEach(function (row) {
                    const dosenName = row.dataset.dosenName;
                    const mahasiswaList = document.getElementById('mahasiswa-list-' + row.dataset.dosenId);
                    if (dosenName.includes(searchValue)) {
                        row.style.display = '';
                        mahasiswaList.style.display = 'none';
                    } else {
                        row.style.display = 'none';
                        mahasiswaList.style.display = 'none';
                    }
                });
            });
        });
    </script>
@endsection --}}
