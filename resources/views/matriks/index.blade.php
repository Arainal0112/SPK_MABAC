@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Data Matriks') }}</h1>

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
                        @if (!empty($matrixTable))
                            <table class="table table-bordered align-items-center" id="dataTable" width="100%" cellspacing="0">
                                <thead class="text-center">
                                    <tr>
                                        <th>Alternatif</th>
                                        @foreach ($kriteriaNames as $kriteriaId => $kriteriaName)
                                            <th>{{ $kriteriaName }}</th>
                                        @endforeach
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($matrixTable as $alternatifId => $kriteriaValues)
                                        <tr>
                                            <td>{{ $alternatifNames[$alternatifId] }}</td>
                                            @foreach ($kriteriaNames as $kriteriaId => $kriteriaName)
                                                @php
                                                    $nilai = $kriteriaValues[$kriteriaId] ?? ''; // Mendapatkan nilai dari matriks
                                                    $subKriteria = ''; // Inisialisasi variabel untuk menyimpan nama subkriteria

                                                    // Mencari nama subkriteria berdasarkan nilai
                                                    foreach ($sub as $subKriteriaOption) {
                                                        if ($subKriteriaOption['kriteria_id'] == $kriteriaId && $subKriteriaOption['nilai_sub'] == $nilai) {
                                                            $subKriteria = $subKriteriaOption['nama_sub'];
                                                            break;
                                                        }
                                                    }
                                                @endphp

                                                <td>
                                                    {{-- {{ $nilai }} {{-- Menampilkan nilai --}}
                                                    {{ $subKriteria }} {{-- Menampilkan nama subkriteria --}}
                                                </td>
                                            @endforeach
                                            <td class="col-2 text-center">
                                                <form action="{{ route('matriks.destroy', $alternatifId) }}" method="POST"
                                                    onsubmit="return confirm('Apakah anda yakin untuk menghapus Nilai {{ $alternatifNames[$alternatifId] }}?')">
                                                    <a class="btn btn-primary"
                                                        href="{{ route('matriks.edit', $alternatifId) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>Tidak ada data Decision Matrix yang tersimpan.</p>
                        @endif


                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection
