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

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Alternatif</h6>
                </div>

                <div class="card-body">

                    <form method="post" action="{{ route('alternatif.store') }}" autocomplete="off" id="myForm">
                        @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="nama_alternatif">Nama Alternatif<span class="small text-danger">*</span></label>
                                        <input type="text" id="nama_alternatif" class="form-control" name="nama_alternatif" placeholder="Isikan Nama alternatif">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a href="javascript:history.go(-1);" class="btn btn-secondary">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

            </div>

        </div>

    

@endsection
