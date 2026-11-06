<div id="areasSection">
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
        @php($number = $areas->firstItem())
        @foreach($areas as $area)
            <tr>
                <td scope="row">{{$number++}}</td>
                <td>{{$area->name}}</td>
                <td><a href="{{ route('areas.edit',$area->id) }}">
                        <button class="btn"><i class="bi bi-pen"></i></button>
                    </a></td>
                <td>
                    <form action="{{ route('areas.destroy', $area->id) }}" method="POST">
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
        {{ $areas->links() }}
    </div>
</div>
