@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Chefs table</h1>
        @if(session('success'))
            <p class="text-success fw-bold fs-5">{{ session('success') }}</p>
        @endif
        <a href="{{ route('chefs.create') }}">
            <button class="btn btn-secondary" id="btn-add">Add chef</button>
        </a>
    </div>
@stop

@section('content')
    @include('pages.admin.chefs.partials.chefsTable')
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
@stop

@section('js')
    <script>
        $(document).on('click', '#paginationLinks .pagination a', function (e) {
            e.preventDefault();
            let url = $(this).attr('href');

            $.ajax({
                url: url,
                method: "GET",
                success: function (response) {
                    $('#chefsSection').html(response);
                },
                error: function (xhr) {
                    console.log(xhr)
                }
            });
        });

    </script>
@stop
