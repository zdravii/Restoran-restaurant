<div id="activitiesSection">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">UserId</th>
            <th scope="col">Action</th>
            <th scope="col">Description</th>
            <th scope="col">Date and time</th>
        </tr>
        </thead>
        <tbody>
        @php($number = $activities->firstItem())
        @foreach($activities as $activity)
            <tr>
                <td scope="row">{{$number++}}</td>
                <td>{{$activity->user_id}}</td>
                <td>{{$activity->action}}</td>
                <td>{{ $activity->description ?? '/' }}</td>
                <td>{{$activity->created_at}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center" id="paginationLinks">
        {{ $activities->links() }}
    </div>
</div>
