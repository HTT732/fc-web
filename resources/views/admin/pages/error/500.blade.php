@extends('layout.auth')
@section('title', 'titile')
@section('main-content')
    <div class="px-2 py-3">


        <div class="text-center">
            <a href="index.html">
                <img src="assets/images/logo-dark.png" height="22" alt="logo">
            </a>

        </div>

        <div class="text-center p-3">

            <h1 class="error-page mt-5"><span>500!</span></h1>
            <h4 class="mb-4 mt-5">Sorry, page not found</h4>
            <p class="mb-4 mx-auto">It will be as simple as Occidental in fact, it will Occidental to an English person</p>
            <a class="btn btn-primary waves-effect waves-light" href="index.html"><i class="mdi mdi-home"></i> Back to Dashboard</a>
        </div>

    </div>
@endsection
                            