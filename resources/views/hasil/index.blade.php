@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Alternatif') }}</h1>

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

    <div class="row">


        <div class="col-lg-12 order-lg-1">

            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Data Matriks</h6>
                    <a class="btn btn-primary ml-auto" href="{{ route('matriks.create') }}">Input Nilai</a>
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
                                    @foreach ($matrixTable as $alternatifId => $kriteriaValues)
                                        <tr>
                                            <td>{{ $alternatifNames[$alternatifId] }}</td>
                                            @foreach ($kriteriaNames as $kriteriaId => $kriteriaName)
                                                <td>{{ $normalisasi[$alternatifId][$kriteriaId] ?? '' }}</td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                    </div>
                </div>
            </div>
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
                                    @foreach ($matrixTable as $alternatifId => $kriteriaValues)
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

    </div>

@endsection
