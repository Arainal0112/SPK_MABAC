@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('About') }}</h1>

    <div class="row justify-content-center">

        <div class="col-lg-6">

            <div class="card shadow mb-4">

                <div class="card-profile-image mt-4">
                    <img src="{{ asset('img/favicon.png') }}" class="rounded-circle" alt="user-image">
                </div>

                <div class="card-body">

                    <div class="row">
                        <div class="col-lg-12 mb-1">
                            <div class="text-center">
                                <h5 class="font-weight-bold">Arainal Aldiansyah</h5>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-1 text-center">
                            <a href="https://facebook.com/arainal.aldiansyah.0112" target="_blank" class="btn btn-facebook btn-circle btn-lg"><i class="fab fa-facebook-f fa-fw"></i></a>
                        </div>
                        <div class="col-md-4 mb-1 text-center">
                            <a href="https://github.com/Arainal0112" target="_blank" class="btn btn-github btn-circle btn-lg"><i class="fab fa-github fa-fw"></i></a>
                        </div>
                        <div class="col-md-4 mb-1 text-center">
                            <a href="https://wa.me/+6281391484458" target="_blank" class="btn btn-twitter btn-circle btn-lg"><i class="fa-brands fa-whatsapp"></i></a>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-lg-12">
                            <h5 class="font-weight-bold">Arainal Aldiansyah</h5>
                            <h5 class="font-weight-bold">2141720042</h5>
                            <h5 class="font-weight-bold">TI-3C</h5>
                            <h5 class="font-weight-bold">03</h5>
                            <a href="https://github.com/Arainal0112?tab=repositories" target="_blank" class="btn btn-github">
                                <i class="fab fa-github fa-fw"></i> Go to repository
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Profil Lian Mega --}}
        <div class="col-lg-6">

            <div class="card shadow mb-4">

                <div class="card-profile-image mt-4">
                    <img src="{{ asset('img/favicon.png') }}" class="rounded-circle" alt="user-image">
                </div>

                <div class="card-body">

                    <div class="row">
                        <div class="col-lg-12 mb-1">
                            <div class="text-center">
                                <h5 class="font-weight-bold">Lian Mega Pratiwi</h5>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-1 text-center">
                            <a href="https://facebook.com/aleckrh" target="_blank" class="btn btn-facebook btn-circle btn-lg"><i class="fab fa-facebook-f fa-fw"></i></a>
                        </div>
                        <div class="col-md-4 mb-1 text-center">
                            <a href="https://github.com/aleckrh" target="_blank" class="btn btn-github btn-circle btn-lg"><i class="fab fa-github fa-fw"></i></a>
                        </div>
                        <div class="col-md-4 mb-1 text-center">
                            <a href="https://twitter.com/aleckrh" target="_blank" class="btn btn-twitter btn-circle btn-lg"><i class="fab fa-twitter fa-fw"></i></a>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-lg-12">
                            <h5 class="font-weight-bold">Lian Mega</h5>
                            <h5 class="font-weight-bold">Nim</h5>
                            <h5 class="font-weight-bold">TI-3C</h5>
                            <h5 class="font-weight-bold">absen</h5>
                            <a href="https://github.com/aleckrh/laravel-sb-admin-2" target="_blank" class="btn btn-github">
                                <i class="fab fa-github fa-fw"></i> Go to repository
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

@endsection
