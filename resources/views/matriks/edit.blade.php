@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('alternatif') }}</h1>

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
                    <h6 class="m-0 font-weight-bold text-primary">Nilai Matriks</h6>
                </div>

                <div class="card-body">

                    <form method="post" action="{{ route('matriks.update', $matriks->alternatif_id) }}" autocomplete="off" id="myForm">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="alternatif">Alternatif<span
                                            class="small text-danger">*</span></label>
                                    <select id="alternatif" class="form-control" name="alternatif">
                                        <option value="{{ $Alt->nama_alternatif }}" selected disabled hidden>-- Pilih alternatif--</option>
                                        @foreach ($alt as $Alt)
                                            <option value={{ $Alt->id }}>{{ $Alt->nama_alternatif }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @foreach ($krit as $Krit)
                                <div class="col-lg-12">
                                    <div class="form-group focused">
                                        <label class="form-control-label"
                                            for="nilai_{{ $Krit->id }}">{{ $Krit->nama_kriteria }}<span
                                                class="small text-danger">*</span></label>
                                        <select id="nilai_{{ $Krit->id }}" class="form-control"
                                            name="nilai_{{ $Krit->id }}">
                                            <option value="{{ $Sub->nama_sub }}" selected disabled hidden>{{ $Sub->nama_sub }}</option>

                                            @foreach ($sub->where('kriteria_id', $Krit->id) as $Sub)
                                                <option value="{{ $Sub->nilai_sub }}">{{ $Sub->nama_sub }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" name="kriteria_{{ $Krit->id }}" value="{{ $Krit->id }}">
                            @endforeach


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
