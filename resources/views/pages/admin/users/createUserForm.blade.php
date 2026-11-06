@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Add user</h1>
        @if(session('success'))
            <p class="text-success fw-bold fs-5">{{ session('success') }}</p>
        @endif
    </div>
@stop

@section('content')
    <form action="{{ route('users.store') }}" method="POST" id="createUserForm">
        @csrf
        <div class="form-group">
            <input type="text" name="firstName" value='{{ old('firstName') }}' class="form-control" placeholder="First Name">
            @error('firstName')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <input type="text" name="lastName" value='{{ old('lastName') }}' class="form-control" placeholder="Last Name">
            @error('lastName')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <input type="email" name="email" value='{{ old('email') }}' class="form-control" placeholder="Email">
            @error('email')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Password">
            @error('password')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password">
            @error('password_confirmation')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <select class="form-control" name="role">
                <option value="0" {{ old('role') == 0 ? 'selected' : '' }}>Choose role</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ old('role') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                @endforeach
            </select>
            @error('role')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary mb-5">Confirm</button>
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
@stop

@section('js')

@stop






