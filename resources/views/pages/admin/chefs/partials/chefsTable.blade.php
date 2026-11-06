<div id="chefsSection">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">First name</th>
            <th scope="col">Last name</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        @php($number = $chefs->firstItem())
        @foreach($chefs as $chef)
            <tr>
                <td scope="row">{{$number++}}</td>
                <td>{{$chef->first_name}}</td>
                <td>{{$chef->last_name}}</td>
                <td><a href="{{ route('chefs.edit',$chef->id) }}">
                        <button class="btn"><i class="bi bi-pen"></i></button>
                    </a></td>
                <td>
                    <form action="{{ route('chefs.destroy', $chef->id) }}" method="POST">
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
        {{ $chefs->links() }}
    </div>
</div>
