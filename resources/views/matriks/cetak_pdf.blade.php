<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Laravel SB Admin 2">
    <meta name="author" content="Alejandro RH">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    {{-- <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet"> --}}
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <style>
        /* Gaya kustom Anda untuk tabel */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #dddddd;
            padding: 8px;
            font-size: 14px;
        }

        th {
            text-align: center;
            background-color: #f2f2f2;
        }

        td {
            text-align: left;
        }
    </style>
</head>

<body>
    <!-- Page Heading -->
    <div class="container">

        <center>
            <h2>Hasil Seleksi</h2>
            <h2>Penentuan Penerima Bantuan Beasiswa BSM Siswa</h2>
            <hr>
        </center>
        <div class="card-body">
            <div class="table-responsive">
                <h4 class="m-0 font-weight-bold text-primary">Data Peserta</h4>
                <hr>

                <table class='table table-bordered'>
                    <thead class="text-center">
                        <tr>
                            <th>Alternatif</th>
                            @foreach ($kriteriaNames as $kriteriaId => $kriteriaName)
                                <th>{{ $kriteriaName }} (C{{ $loop->index + 1 }})</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($matrixTable as $alternatifId => $kriteriaValues)
                            <tr>
                                <td>{{ $alternatifNames[$alternatifId] }}</td>
                                @foreach ($kriteriaNames as $kriteriaId => $kriteriaName)
                                    @php
                                        $nilai = $kriteriaValues[$kriteriaId] ?? ''; // Mendapatkan nilai dari matriks
                                        $subKriteria = ''; // Inisialisasi variabel untuk menyimpan nama subkriteria

                                        // Mencari nama subkriteria berdasarkan nilai
                                        foreach ($sub as $subKriteriaOption) {
                                            if ($subKriteriaOption['kriteria_id'] == $kriteriaId && $subKriteriaOption['nilai_sub'] == $nilai) {
                                                $subKriteria = $subKriteriaOption['nama_sub'];
                                                break;
                                            }
                                        }
                                    @endphp

                                    <td>
                                        {{-- {{ $nilai }} {{-- Menampilkan nilai --}}
                                        {{ $subKriteria }} {{-- Menampilkan nama subkriteria --}}
                                    </td>
                                @endforeach

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-body">
            <h4 class="m-0 font-weight-bold text-primary">Data Matriks</h4>
            <hr>
            <div class="table-responsive">
                @if (!empty($matrixTable))
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Alternatif</th>
                                @foreach ($kriteriaNames as $kriteriaId => $kriteriaName)
                                    <th>C{{ $loop->index + 1 }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($matrixTable as $alternatifId => $kriteriaValues)
                                <tr>
                                    <td>{{ $alternatifNames[$alternatifId] }}</td>
                                    @foreach ($kriteriaNames as $kriteriaId => $kriteriaName)
                                        <td>{{ $kriteriaValues[$kriteriaId] ?? '' }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Tidak ada data Decision Matrix yang tersimpan.</p>
                @endif


            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <h4 class="m-0 font-weight-bold text-primary">Hasil Normalisasi ( N )</h4>
            <hr>

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Alternatif</th>
                        @foreach ($kriteriaNames as $kriteriaId => $kriteriaName)
                            <th>C{{ $loop->index + 1 }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($normalisasi as $alternatifId => $kriteriaValues)
                        <tr>
                            <td>{{ $alternatifNames[$alternatifId] }}</td>
                            @foreach ($kriteriaNames as $kriteriaId => $kriteriaName)
                                <td>{{ number_format($normalisasi[$alternatifId][$kriteriaId] ?? 0, 3) }}
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <h4 class="m-0 font-weight-bold text-primary">Hasil Matriks Tertimbang ( V )</h4>
            <hr>

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Alternatif</th>
                        @foreach ($kriteriaNames as $kriteriaId => $kriteriaName)
                            <th>C{{ $loop->index + 1 }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($matriksTerimbang as $alternatifId => $kriteriaValues)
                        <tr>
                            <td>{{ $alternatifNames[$alternatifId] }}</td>
                            @foreach ($kriteriaNames as $kriteriaId => $kriteriaName)
                                <td>{{ $matriksTerimbang[$alternatifId][$kriteriaId] ?? '' }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>


    <div class="card-body">
        <div class="table-responsive">
            <h4 class="m-0 font-weight-bold text-primary">Hasil Matriks Area Perkiraan Batas ( G )</h4>
            <hr>

            <table class="table table-bordered text-center align-items-center" id="dataTable"
                width="100%"cellspacing="0">
                <thead>
                    <tr>
                        <th>Kriteria</th>
                        @foreach ($kriteriaNames as $kriteriaId => $kriteriaName)
                            <th>C{{ $loop->index + 1 }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Nilai G</td>
                        @foreach ($matriksBatas as $kriteria => $nilai)
                            <td>{{ number_format($nilai, 3) }}</td>
                        @endforeach
                    </tr>
                </tbody>
            </table>

        </div>
    </div>



    <div class="card-body">
        <div class="table-responsive">
            <h4 class="m-0 font-weight-bold text-primary">Hasil Matriks jarak Alternatif dari daerah perkiraan
                batas( Q )</h4>
            <hr>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Alternatif</th>
                        @foreach ($kriteriaNames as $kriteriaId => $kriteriaName)
                            <th>C{{ $loop->index + 1 }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($matriksQ as $alternatifId => $kriteriaValues)
                        <tr>
                            <td>{{ $alternatifNames[$alternatifId] }}</td>
                            @foreach ($kriteriaNames as $kriteriaId => $kriteriaName)
                                <td>{{ number_format($matriksQ[$alternatifId][$kriteriaId] ?? 0, 3) }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <h4 class="m-0 font-weight-bold text-primary">Hasil Perangkingan</h4>
            <hr>

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Peringkat</th>

                        <th>Alternatif</th>
                        <th>Hasil</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ranking as $alternatif => $nilaiQ)
                        <tr>
                            <td class="col-2">{{ $loop->index + 1 }}</td>
                            <td>{{ $alternatifNames[$alternatif] }}</td>
                            <td>{{ number_format($nilaiQ, 3) }}</td>
                            @if ($nilaiQ <= 0)
                                <td><span class="rank-tdk-berhak">Tidak Berhak Menerima</span></td>
                            @else
                                <td><span class="rank-berhak">Berhak Menerima</span></td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
    </div>
</body>

</html>
