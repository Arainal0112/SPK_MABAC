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
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Data Kriteria</h6>
                    {{-- <a class="btn btn-primary ml-auto" href="{{ route('kriteria.create') }}">Tambah Kriteria</a> --}}
                    <button type="button" href="" class=" btn btn-primary" data-toggle="modal"
                        data-target="#add_kriteria">
                        Tambah Kriteria
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered align-items-center" id="dataTable" width="100%" cellspacing="0">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Kode Kriteria</th>
                                    <th>Nama Kriteria</th>
                                    <th>Bobot</th>
                                    <th>Jenis Kriteria</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <?php $i = 1; ?>
                            @foreach ($kriteria as $Kriteria)
                                <tbody>
                                    <tr>
                                        <td class="text-center col-1">{{ $i }}</td>
                                        <td>{{ $Kriteria->kode_kriteria }}</td>
                                        <td>{{ $Kriteria->nama_kriteria }}</td>
                                        <td class="text-center">{{ $Kriteria->bobot }}</td>
                                        <td>{{ $Kriteria->jenis }}</td>
                                        <td class="col-2 text-center">
                                            <a class="btn btn-primary" href="{{ route('kriteria.edit', $Kriteria->id) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#hapusModal"><i class="fa-solid fa-trash"></i></a>
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
    <div class="modal fade" id="add_kriteria" tabindex="-1" role="dialog" aria-labelledby="add_kriteria"
        aria-hidden="true" data-toggle="modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add_kriteria">Kriteria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('kriteria.store') }}" autocomplete="off" id="myForm">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-12">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="kode_kriteria">Kode Kriteria<span
                                                class="small text-danger">*</span></label>
                                        <input type="text" id="kode_kriteria" class="form-control" name="kode_kriteria"
                                            placeholder="Isikan kode Kriteria">
                                    </div>

                                </div>


                                <div class="col-lg-12">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="nama_kriteria">Nama Kriteria<span
                                                class="small text-danger">*</span></label>
                                        <input type="text" id="nama_kriteria" class="form-control" name="nama_kriteria"
                                            placeholder="Isikan Nama Kriteria">
                                    </div>

                                </div>


                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="bobot">Bobot<span
                                                class="small text-danger">*</span></label>
                                        <input type="number" id="bobot" class="form-control" name="bobot"
                                            placeholder="Tuliskan Nilai Bobot dari Kriteria">
                                    </div>

                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="jenis">Jenis Kriteria<span
                                                class="small text-danger">*</span></label>
                                        <select id="jenis" class="form-control" name="jenis">
                                            <option value="" selected disabled hidden>-- Pilih Jenis Kriteria--
                                            </option>
                                            <option value="cost">Cost</option>
                                            <option value="benefit">Benefit</option>
                                        </select>
                                    </div>

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
{{-- Modal Hapus --}}
<div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Apakah Anda Yakin Untuk Menghapus Data?') }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div>
            <div class="modal-body">Jika ada menghapus data kriteria, data pada matriks juga akan terhapus.</div>
            <div class="modal-footer">
                <button class="btn btn-link" type="button" data-dismiss="modal">{{ __('Cancel') }}</button>
                <form action="{{ route('kriteria.destroy', $Kriteria->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
