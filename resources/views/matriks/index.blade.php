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
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Alternatif</th>
                                    @foreach($krit as $Krit)
                                        <th>{{$Krit->kode_kriteria}}</th>
                                    @endforeach
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1 ?>
                                @foreach ($alt as $Alt)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{ $Alt->nama_alternatif}}</td>
                                        @foreach($krit as $Krit)
                                            <?php $found = false; ?>
                                            @foreach($matriks as $Mat)
                                                @if ($Mat->alternatif_id == $Alt->id && $Mat->kriteria_id == $Krit->id)
                                                    <td>{{$Mat->nilai}}</td>
                                                    <?php $found = true; ?>
                                                    @break
                                                @endif
                                            @endforeach
                                            @if (!$found)
                                                <td>0</td>
                                            @endif
                                        @endforeach
                                        <td>
                                            <a class="btn btn-primary"href="{{ route('matriks.edit', $Alt->id) }}">edit</a>
                                        </td>
                                    </tr>
                                    <?php $i++ ?>
                                @endforeach
                            </tbody>
                        </table>
                        

                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection
