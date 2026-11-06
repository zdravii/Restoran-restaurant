@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Create a reservation</h1>
        @if(session('error'))
            <p class="text-danger fw-bold fs-5">{{ session('error') }}</p>
        @endif
    </div>
@stop

@section('content')
    <form action="{{ route('reservations.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <input type="email" name="email" value='{{old('email')}}' class="form-control" placeholder="User email">
            @error('email')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <select class="form-control" name="table">
                <option value="0" {{old('table') == 0 ? 'selected' : '' }}>Choose table</option>
                @foreach($tables as $table)
                    <option value="{{ $table->id }}" {{old('table') == $table->id ? 'selected' : '' }}>{{ $table->number }}</option>
                @endforeach
            </select>
            @error('table')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <input type="date" name="date" value='{{old('date')}}' class="form-control">
            @error('date')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <input type="time" name="time" value='{{old('time')}}' class="form-control">
            @error('time')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <textarea class="form-control" name="description" placeholder="Description">{{ old('description') }}</textarea>
        </div>
        <div class="form-group">
            <select class="form-control" name="status">
                <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Status</option>
                @foreach($statuses as $status)
                    <option value="{{ $status }}" {{ old('status') == $status ? 'selected' : '' }}>{{ $status }}</option>
                @endforeach
            </select>
            @error('status')
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
