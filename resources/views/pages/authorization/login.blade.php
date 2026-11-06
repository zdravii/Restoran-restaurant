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
                        <h3>Login</h3>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('login') }}" method="POST">

                            @csrf

                            @include('pages.authorization.form-fields')

                            @error('email' || 'password')
                            <div class="text-center">
                                <p class="text-danger fw-bold fs-5">{{ $message }}</p>
                            </div>
                            @enderror


                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                            </div>

                            <div class="text-center mt-3">
                                <a class="text-decoration-none text-dark" href="{{ route('registerForm') }}">Don't have account? Register</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
