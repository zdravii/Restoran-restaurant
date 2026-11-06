@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Edit user</h1>
    </div>
@stop

@section('content')
    <form action="{{ route('users.update',$user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <input type="text" name="firstName" value="{{ $user->first_name }}" {{old('firstName')}} class="form-control" placeholder="First Name">
            @error('firstName')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <input type="text" name="lastName" value="{{ $user->last_name }}" {{old('lastName')}} class="form-control" placeholder="Last Name">
            @error('lastName')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <input type="email" name="email" value="{{ $user->email }}" {{old('email')}} class="form-control" placeholder="Email">
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
            @php
            $selectedRole = old('role',$user->role_id ?? 0);
             @endphp
            <select class="form-control" name="role">
                <option value="0" {{ $selectedRole == 0 ? 'selected' : '' }}>Choose role</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ $selectedRole == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
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






