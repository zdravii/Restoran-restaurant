@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    @foreach($reservations as $r)
        <p> {{$r->id}} </p>
    @endforeach
@stop

@section('css')
    {{-- custom CSS ovde --}}
@stop

@section('js')
    {{-- custom JS ovde --}}
@stop
