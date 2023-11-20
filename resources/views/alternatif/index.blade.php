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
                    <h6 class="m-0 font-weight-bold text-primary">Data Alternatif</h6>
                    {{-- <form action="{{ route('alternatif.index') }}" method="GET" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Cari Alternatif..."
                                aria-label="Search" aria-describedby="basic-addon2" name="nama" value="{{request('nama')}}" required>
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
        
                    </form> --}}
                    {{-- <a class="btn btn-primary ml-auto" href="{{ route('alternatif.create') }}">Tambah Alternatif</a> --}}
                    <button type="button" href="" class=" btn btn-primary" data-toggle="modal"
                        data-target="#add_alternatif">
                        Tambah Alternatif
                    </button>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Alternatif</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <?php $i = 1; ?>
                            @foreach ($alternatif as $Alternatif)
                                <tbody>
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $Alternatif->nama_alternatif }}</td>
                                        <td>
                                            <form action="{{ route('alternatif.destroy', $Alternatif->id) }}" method="POST"
                                                onsubmit="return confirm('Apakah anda yakin untuk menghapus {{ $Alternatif->nama_alternatif }}?')">
                                                <a class="btn btn-primary"
                                                    href="{{ route('alternatif.edit', $Alternatif->id) }}">edit</a>
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
                </div>
            </div>

        </div>

    </div>

    {{-- Modal Create --}}
    <div class="modal fade" id="add_alternatif" tabindex="-1" role="dialog" aria-labelledby="add_alternatif"
        aria-hidden="true" data-toggle="modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add_alternatif">Alternatif</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('alternatif.store') }}" autocomplete="off" id="myForm">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="nama_alternatif">Nama Alternatif<span
                                            class="small text-danger">*</span></label>
                                    <input type="text" id="nama_alternatif" class="form-control" name="nama_alternatif"
                                        placeholder="Isikan Nama alternatif">
                                </div>
                            </div>
                        </div>
                </div>

                <!-- Button -->
                <div class="p-2">
                    <div class="row">
                        <div class="col text-center">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>



@endsection
