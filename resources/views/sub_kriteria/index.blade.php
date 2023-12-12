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
                    {{-- <a class="btn btn-primary ml-auto" href="{{ route('sub.create') }}">Tambah Sub Kriteria</a> --}}
                    <button type="button" href="" class=" btn btn-primary" data-toggle="modal"
                        data-target="#add_sub">
                        Tambah Sub Kriteria
                    </button>
                </div>
                <div class="card-body">
                    @foreach ($kriteria as $Krit)
                        <div class="table-responsive">
                            <h5 class="text-gray-800">Kriteria : {{ $Krit->nama_kriteria }}</h5>
                            <table class="table table-bordered align-items-center" id="dataTable" width="100%"
                                cellspacing="0">
                                <thead class="text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Sub Kriteria</th>
                                        <th>Nilai</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <?php $i = 1; ?>
                                @foreach ($sub->where('kriteria_id', $Krit->id) as $Sub)
                                    <tbody>
                                        <tr>
                                            <td class="col-1 text-center">{{ $i }}</td>
                                            <td class="col-6">{{ $Sub->nama_sub }}</td>
                                            <td class="text-center">{{ $Sub->nilai_sub }}</td>
                                            <td class="col-2 text-center">
                                                <a class="btn btn-primary" href="{{ route('sub.edit', $Sub->id) }}"><i
                                                        class="fa-solid fa-pen-to-square"></i></a>
                                                <a class="btn btn-danger" href="#" data-toggle="modal"
                                                    data-target="#hapusModal"><i class="fa-solid fa-trash"></i></a>
                                                <!-- Modal Hapus Sub Kriteria -->
                                                @include('components.delete', [
                                                    'route' => route('sub.destroy', $Sub->id),
                                                    'modalId' => 'hapusModalSubKriteria_' . $Sub->id,
                                                ])
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

    {{-- Modal --}}
    <div class="modal fade" id="add_sub" tabindex="-1" role="dialog" aria-labelledby="add_sub" aria-hidden="true"
        data-toggle="modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add_sub">Sub Kriteria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('sub.store') }}" autocomplete="off" id="myForm">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="kriteria">Kriteria<span
                                            class="small text-danger">*</span></label>
                                    <select id="kriteria" class="form-control" name="kriteria">
                                        <option value="" selected disabled hidden>-- Pilih Kriteria--</option>
                                        @foreach ($kriteria as $Kriteria)
                                            <option value={{ $Kriteria->id }}>{{ $Kriteria->nama_kriteria }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div id="form-container">
                                    <h6 class="m-0 font-weight-bold text-danger">Isikan berdasarkan preferensi terkecil!
                                    </h6>
                                    <div class="form-group" id="form-container">
                                        <div class="row">
                                            <div class="col">
                                                <label class="form-control-label" for="sub_krit_1">Sub Kriteria<span
                                                        class="small text-danger">*</span></label>
                                                <input type="text" id="sub_krit_1" class="form-control" name="sub_krit_1"
                                                    placeholder="Isikan Sub Kriteria">
                                            </div>
                                            <div class="col-3">
                                                <label class="form-control-label" for="nilai_sub_1">Nilai<span
                                                        class="small text-danger">*</span></label>
                                                <input type="number" id="nilai_sub_1" class="form-control"
                                                    name="nilai_sub_1" placeholder="1">
                                            </div>
                                            <input type="hidden" name="counter" id="counter" value="1">
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
                <!-- Button -->
                <div class="p-2">
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
