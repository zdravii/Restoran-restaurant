<div id="tablesSection">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Number</th>
            <th scope="col">Number of seats</th>
            <th scope="col">Area</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        @php($number = $tables->firstItem())
        @foreach($tables as $table)
            <tr>
                <td scope="row">{{$number++}}</td>
                <td>{{$table->number}}</td>
                <td>{{$table->seat_number}}</td>
                <td>{{$table->areaName}}</td>
                <td><a href="{{ route('tables.edit',$table->id) }}">
                        <button class="btn"><i class="bi bi-pen"></i></button>
                    </a></td>
                <td>
                    <form action="{{ route('tables.destroy', $table->id) }}" method="POST">
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
        {{ $tables->links() }}
    </div>
</div>
