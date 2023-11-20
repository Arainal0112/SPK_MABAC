@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Dashboard') }}</h1>

    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Alternatif</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($alt) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Kriteria</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($krit) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 50%"
                                            aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">{{ __('Users') }}</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $widget['users'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-4 mt-4">
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

    <div class="row">
        <!-- Content Column -->
        <div class="col-lg-6 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Alternatif</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Alternatif</th>
                                </tr>
                            </thead>
                            <?php $i = 1; ?>
                            @foreach ($alt as $Alternatif)
                                <tbody>
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $Alternatif->nama_alternatif }}</td>
                                    </tr>
                                </tbody>
                                <?php $i++; ?>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <!-- Approach -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Kriteria</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Kriteria</th>
                                    <th>Nama Kriteria</th>
                                    <th>Bobot</th>
                                    <th>Jenis</th>
                                </tr>
                            </thead>
                            <?php $i = 1; ?>
                            @foreach ($krit as $Kriteria)
                                <tbody>
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $Kriteria->kode_kriteria }}</td>
                                        <td>{{ $Kriteria->nama_kriteria }}</td>
                                        <td>{{ $Kriteria->bobot }}</td>
                                        <td>{{ $Kriteria->jenis }}</td>
                                    </tr>
                                </tbody>
                                <?php $i++; ?>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Sub Kriteria</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Kriteria</th>
                                    <th>Nama Kriteria</th>
                                    <th>Sub Kriteria</th>
                                </tr>
                            </thead>
                            <?php $i = 1; ?>
                            @foreach ($krit as $Kriteria)
                                <tbody>
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $Kriteria->kode_kriteria }}</td>
                                        <td>{{ $Kriteria->nama_kriteria }}</td>
                                        <td>
                                            <table class="table">
                                                <tbody>
                                                    <?php $j = 1; ?>
                                                    @foreach ($Kriteria->subKriteria as $sub)
                                                        <tr>
                                                            {{-- <td>{{ $j }}</td> --}}
                                                            <td>{{ $sub->nilai_sub}}</td>
                                                            <td>{{ $sub->nama_sub }}</td>
                                                            <!-- Add more columns if needed -->
                                                        </tr>
                                                        <?php $j++; ?>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                                <?php $i++; ?>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
