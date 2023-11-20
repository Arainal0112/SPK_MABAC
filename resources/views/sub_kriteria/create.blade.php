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

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Sub Kriteria</h6>
                </div>

                <div class="card-body">

                    <form method="post" action="{{ route('sub.store') }}" autocomplete="off" id="myForm">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="kriteria">Kriteria<span
                                            class="small text-danger">*</span></label>
                                    <select id="kriteria" class="form-control" name="kriteria">
                                        <option value="" selected disabled hidden>-- Pilih Jenis Kriteria--</option>
                                        @foreach ($kriteria as $Kriteria)
                                            <option value={{ $Kriteria->id}}>{{ $Kriteria->nama_kriteria }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div id="form-container">
                                    <h6 class="m-0 font-weight-bold text-danger">Isikan berdasarkan preferensi terkecil!
                                    </h6>
                                    <div class="form-group">
                                        <div class="row">
                                        <div class="col">
                                        <label class="form-control-label" for="sub_alt_1">Sub Alternatif 1<span
                                                class="small text-danger">*</span></label>
                                        <input type="text" id="sub_alt_1" class="form-control" name="sub_alt_1"
                                            placeholder="Isikan Sub Kriteria">
                                        </div>
                                        <div class="col-2">
                                            <label class="form-control-label" for="nilai_alt_1">Nilai<span
                                                class="small text-danger">*</span></label>
                                        <input type="number" id="nilai_alt_1" class="form-control" name="nilai_alt_1"
                                            placeholder="Isikan Sub Kriteria">
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-primary" type="button" onclick="tambahForm()"><i
                                            class="fa-solid fa-plus"></i></button>
                                    <button class="btn btn-danger"type="button" onclick="hapusForm()"><i
                                            class="fa-solid fa-minus"></i></button>
                                            
                                </div>
                            </div>
                        </div>
                </div>
            </div>

            <!-- Button -->
            <div class="">
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
@endsection
