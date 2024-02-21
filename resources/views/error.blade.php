@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">
            <div class="w-100 text-center">
                <img src="{{ asset('img/logo.jpg') }}" width="500" alt="Logo">
            </div>
            <div class="card">
                <div class="card-header marsman-bg-color-dark text-white">
                    <h5 class="card-title my-2">Oops! Something went wrong.</h5>
                </div>

                <div class="card-body txt-2">
                    <p>We apologize for the inconvenience. It seems that an error has occurred.</p>
                    <p>Please try again later or contact support if the issue persists.</p>

                    <div class="text-center mt-4">
                        <a href="{{ route('login') }}" class="btn btn-primary">Go to Login Page</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
