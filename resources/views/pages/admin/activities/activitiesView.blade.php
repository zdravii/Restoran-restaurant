@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Users activites</h1>
        <div>
            <form class="d-flex">
            <input type="date" name="date" id="date" class="form-control">
            <button type="button" class="btn btn-secondary" id="dateBtn">Filter</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
            </form>
        </div>

    </div>
@stop

@section('content')
    @include('pages.admin.activities.partials.activitiesTable')
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
@stop

@section('js')
    <script>
        $(document).on('click', '#paginationLinks .pagination a', function (e) {
            e.preventDefault();
            let url = $(this).attr('href');
            let date = $('#date').val();

            $.ajax({
                url: url,
                method: "GET",
                data:{
                    date: date
                },
                success: function (response) {
                    $('#activitiesSection').html(response);
                },
                error: function (xhr) {
                    console.log(xhr)
                }
            });
        });

        $(document).on('click','#dateBtn',function () {
            let date = $('#date').val();

            $.ajax({
                url: "{{route('activities.index')}}",
                method: 'GET',
                data: {
                    date:date,
                },
                success: function (response) {
                    $('#activitiesSection').html(response);
                },
                error:function (xhr) {
                    console.log(xhr);
                }
            })
        })

    </script>
@stop
