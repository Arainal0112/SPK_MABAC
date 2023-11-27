@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Rubah Nilai Matriks') }}</h1>

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
                    <h4 class="m-0 font-weight-bold text-primary">{{ $alt->nama_alternatif }}</h4>
                </div>

                <div class="card-body">

                    <form method="post" action="{{ route('matriks.update', $alt->id) }}" autocomplete="off" id="myForm">
                        @csrf
                        @method('PUT') <!-- Use PUT method for updating -->

                        <!-- Your existing form fields for alternatif -->

                        @foreach ($krit as $Krit)
                            <div class="col-lg-12">
                                <div class="form-group focused">
                                    <label class="form-control-label"
                                        for="nilai_{{ $Krit->id }}">{{ $Krit->nama_kriteria }}<span
                                            class="small text-danger">*</span></label>
                                    <select id="nilai_{{ $Krit->id }}" class="form-control"
                                        name="nilai_{{ $Krit->id }}">
                                        <option value="" selected disabled hidden>--Pilih Kriteria--</option>

                                        @foreach ($sub->where('kriteria_id', $Krit->id) as $Sub)
                                            <option value="{{ $Sub->nilai_sub }}"
                                                @if ($matriks->where('kriteria_id', $Krit->id)->first()->nilai == $Sub->nilai_sub) selected @endif>{{ $Sub->nama_sub }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="kriteria_{{ $Krit->id }}" value="{{ $Krit->id }}">
                        @endforeach
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
