<div id="dishesSection">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Price</th>
            <th scope="col">Image</th>
            <th scope="col">Category</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        @php($number = $dishes->firstItem())
        @foreach($dishes as $dish)
            <tr>
                <td scope="row">{{$number++}}</td>
                <td>{{$dish->name}}</td>
                <td>{{$dish->description}}</td>
                <td>{{$dish->price}}</td>
                <td><img class="img-fluid" width="100" src="{{ asset('assets/images/'.$dish->image) }}" alt="{{ $dish->description }}"></td>
                <td>{{$dish->categoryName}}</td>
                <td><a href="{{ route('dishes.edit',$dish->id) }}">
                        <button class="btn"><i class="bi bi-pen"></i></button>
                    </a></td>
                <td>
                    <form action="{{ route('dishes.destroy', $dish->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center" id="paginationLinks">
        {{ $dishes->links() }}
    </div>
</div>
