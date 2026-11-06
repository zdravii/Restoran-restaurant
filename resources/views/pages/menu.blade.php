@extends("layouts.layout")

@section("title")
    Home
@endsection
@section("description")
    The main page of website
@endsection
@section("keywords")
    restaurant,food,dinner,launch,breakfast
@endsection

@section("content")
    <main>
        <section class="page-banner d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="banner-content">
                        <h2 class="text-white display-3 text-center" data-aos="fade-right" data-aos-delay="3000">
                            Menu</h2>
                        <div class="divider" data-aos="fade-up-right" data-aos-delay="3000">
                            <div class="dot mb-2"></div>
                        </div>
                        <p class="text-center">The various dishes are waiting for your coming to enjoy its</p>
                    </div>
                </div>
            </div>
        </section>
        <div class="container my-5">
            <div class="row mb-5">
                <div class="col-12">
                    <form action="{{ route('menu') }}" method="GET" class="d-flex justify-content-around" id="filterForm">
                        <select name="categoryFilter" id="categoryFilter" class="form-control">
                            <option value="0">Choose category...</option>
                            @foreach($categories as $c)
                                <option value="{{ $c->id }}" {{ request('categoryFilter') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                            @endforeach
                        </select>
                        <input type="number" name="minPrice" value="{{ request('minPrice') }}" min="0" max="49" class="form-control" placeholder="Minimal price">
                        <input type="number" name="maxPrice" value="{{ request('maxPrice') }}" min="1" max="50" class="form-control" placeholder="Maximum price">
                        <button type="button" onclick="applyFilters()">Apply filters</button>
                        <button type="reset">Clear filters</button>
                    </form>
                </div>
            </div>
            <div class="row justify-content-around text-center" id="menuProducts">
                @include('partials.menuProducts')
            </div>
        </div>
    </main>
@endsection

@section('additionalScripts')
    <script>
        function applyFilters() {
            $.ajax({
                url: '{{ route('menu') }}',
                method : 'GET',
                data: $('#filterForm').serialize(),
                success: function (response){
                    $('#menuProducts').html(response);
                },
                error:function () {
                    alert('Error while filtrating');
                }
            })
        }

        $(document).on('click','.pagination a',function (e) {
            e.preventDefault();

            let url = $(this).attr('href');

            $.ajax({
                url : url,
                method : "GET",
                success: function (response) {
                    $('#menuProducts').html(response);
                },
                error:function () {
                    alert('Error while paginate');
                }
            })
        })
    </script>
@endsection
