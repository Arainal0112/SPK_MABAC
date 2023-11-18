@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Kriteria') }}</h1>

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
                    <h6 class="m-0 font-weight-bold text-primary">Kriteria</h6>
                </div>

                <div class="card-body">

                    <form method="post" action="{{ route('kriteria.update', $kriteria->id) }}" autocomplete="off"
                        id="myForm">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="kode_kriteria">Kode Kriteria</label>
                                    <input type="text" id="kode_kriteria" class="form-control" name="kode_kriteria"
                                        value="{{ $kriteria->kode_kriteria }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="nama_kriteria">Nama Kriteria</label>
                                    <input type="text" id="nama_kriteria" class="form-control" name="nama_kriteria"
                                        value="{{ $kriteria->nama_kriteria }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="bobot">Bobot</label>
                                    <input type="number" id="bobot" class="form-control" name="bobot"
                                        value="{{ $kriteria->bobot }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="jenis">Jenis Kriteria</label>
                                    <select id="jenis" class="form-control" name="jenis">
                                        <option value="">{{ $kriteria->jenis }}</option>
                                        <option value="cost">Cost</option>
                                        <option value="benefit">Benefit</option>
                                    </select>
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
