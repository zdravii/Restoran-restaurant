<div id="categoriesTable">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        @php($number = $categories->firstItem())
        @foreach($categories as $category)
            <tr>
                <td scope="row">{{$number++}}</td>
                <td>{{$category->name}}</td>
                <td><a href="{{ route('categories.edit',$category->id) }}">
                        <button class="btn"><i class="bi bi-pen"></i></button>
                    </a></td>
                <td>
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
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
        {{ $categories->links() }}
    </div>
</div>
