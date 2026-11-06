@extends('layouts.layout')

@section('title')@endsection
@section('description')@endsection
@section('keywords')@endsection

@section('content')
    @include('pages.authorization.section')
    <div class="container my-5 py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-header text-center">
                        <h3>Register</h3>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('register') }}" method="POST">
                            @csrf

                            @include('pages.authorization.form-fields',['firstName' => true,'lastName' => true,'passwordConfirmation' => true])

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>

                            <div class="text-center mt-3">
                                <a class="text-decoration-none text-dark" href="{{ route('loginForm') }}">Already have an account? Login</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
