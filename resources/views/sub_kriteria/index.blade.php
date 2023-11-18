@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Sub Kriteria') }}</h1>

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
                    <h6 class="m-0 font-weight-bold text-primary">Data Sub Kriteria</h6>
                    <a class="btn btn-primary ml-auto" href="{{ route('sub.create') }}">Tambah Sub Kriteria</a>
                </div>
                <div class="card-body">
                    <?php $i = 1; ?>
                    @foreach ($kriteria as $Krit)
                        <div class="table-responsive">
                            <hr>
                            <h5 class="text-gray-800">Kriteria : {{$Krit->nama_kriteria }}</h5>
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Sub Kriteria</th>
                                        <th>Nilai</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                @foreach ($sub->where('kriteria_id', $Krit->id) as $Sub)
                                    <tbody>
                                        <tr>
                                            <td class="col-1">{{ $i }}</td>
                                            <td class="col-6">{{ $Sub->nama_sub }}</td>
                                            <td class="col-1">{{ $Sub->nilai_sub }}</td>
                                            <td class="col-2">
                                                <form action="{{ route('sub.destroy', $Sub->id) }}" method="POST"
                                                    onsubmit="return confirm('Apakah anda yakin untuk menghapus data?')">
                                                    <a class="btn btn-primary"
                                                        href="{{ route('sub.edit', $Sub->id) }}">edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <?php $i++; ?>
                                @endforeach
                            </table>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>

    </div>

@endsection
