@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Hasil Perhitungan MABAC') }}</h1>
    <a class="btn btn-primary m-2" href="{{ route('matriks.create') }}">Input Nilai</a>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" id="matrix-tab" data-toggle="tab" href="#matrix">Data Matriks</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="normalisasi-tab" data-toggle="tab" href="#normalisasi">Hasil Normalisasi ( N )</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="matriksV-tab" data-toggle="tab" href="#matriksV">Hasil Matriks ( V )</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="matriksG-tab" data-toggle="tab" href="#matriksG">Hasil Matriks ( G )</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="matriksQ-tab" data-toggle="tab" href="#matriksQ">Hasil Matriks ( Q )</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="rangking-tab" data-toggle="tab" href="#rangking">Hasil Perangkingan</a>
        </li>
        <!-- Add more tabs as needed for other matrices -->
    </ul>

    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger border-left-danger" role="alert">
            <ul class="pl-4 my-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="tab-content">
        <div class="tab-pane fade show active" id="matrix">
            <div class="row">
                <div class="col-lg-12 order-lg-1">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Data Matriks</h6>
                            
                        </div>
                        <div class="card-body">
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
                </div>
            </div>
        </div>
        <div class="tab-pane fade show" id="normalisasi">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Hasil Normalisasi ( N )</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">

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
                                            <td>{{ number_format($normalisasi[$alternatifId][$kriteriaId] ?? '', 3) }}
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade show" id="matriksV">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Hasil Matriks Tertimbang ( V )</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">

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
            </div>
        </div>
        <div class="tab-pane fade show" id="matriksG">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Hasil Matriks Area Perkiraan Batas ( G )</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
            </div>
        </div>
        <div class="tab-pane fade show" id="matriksQ">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Hasil Matriks jarak Alternatif dari daerah perkiraan batas
                        ( Q )</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">

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
                                            <td>{{ number_format($matriksQ[$alternatifId][$kriteriaId], 3) }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade show" id="rangking">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Hasil Perangkingan</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Peringkat</th>
                                    <th>Alternatif</th>
                                    <th>Hasil</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ranking as $alternatif => $nilaiQ)
                                    <tr>
                                        <td class="col-2">{{ $loop->index + 1 }}</td>
                                        <td>{{ $alternatifNames[$alternatif] }}</td>
                                        <td>{{ number_format($nilaiQ, 3) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
