
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Edit table</h1>
        @if(session('success'))
            <p class="text-success fw-bold fs-5">{{ session('success') }}</p>
        @endif
    </div>
@stop

@section('content')
    <form action="{{ route('tables.update',$table->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Table number</label>
            <input type="number" name="number" value='{{ old('number',$table->number) }}' min="1" max="50" class="form-control">
            @error('number')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label>Number of seats</label>
            <input type="number" name="numberOfSeats" value='{{ old('numberOfSeats',$table->seat_number) }}' min="2" max="8" class="form-control">
            @error('numberOfSeats')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <select class="form-control" name="area">
                <option value="0" {{ old('area',$table->area_id ?? 0) == 0 ? 'selected' : '' }}>Choose area</option>
                @foreach($areas as $area)
                    <option value="{{ $area->id }}" {{ old('area',$table->area_id ?? 0) == $area->id ? 'selected' : '' }}>{{ $area->name }}</option>
                @endforeach
            </select>
            @error('area')
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






