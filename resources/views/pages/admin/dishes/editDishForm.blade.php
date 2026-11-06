@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Edit dish</h1>
        @if(session('success'))
            <p class="text-success fw-bold fs-5">{{ session('success') }}</p>
        @endif
    </div>
@stop

@section('content')
    <form action="{{ route('dishes.update',$dish->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <input type="text" name="name" value='{{ old('name',$dish->name) }}' class="form-control">
            @error('name')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <textarea name="description" class="form-control" placeholder="Description">{{ old('description',$dish->description) }}</textarea>
            @error('description')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <input type="number" step="0.1" min="3" max="100" name="price" value='{{ old('price',$dish->price) }}' class="form-control">
            @error('price')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <input type="file" name="image" class="form-control">
            <img class="img-fluid my-2" width="100" src="{{asset('assets/images/'.$dish->image)}}" alt="{{ $dish->description }}">
            @error('image')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <select class="form-control" name="category">
                <option value="0" {{old('$category',$dish->food_category_id) == 0 ? 'selected' : ''}}>Choose category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{old('category',$dish->food_category_id) == $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category')
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






