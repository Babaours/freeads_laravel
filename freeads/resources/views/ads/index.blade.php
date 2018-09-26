    @extends('layouts.default')
    @section('content')
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Ads CRUD</h2>
                </div>
            </div>
        </div>
        <a class="btn btn-info" href="{{ route('ads.create') }}"> Create Ad</a>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <table class="table table-bordered">
            <tr>
                <th> Title </th>
                <th> Description </th>
                <th> Filename </th>
                <th> Price </th>
                <th width="280px">Operation</th>
            </tr>
        @foreach ($ads as $ad)
        <tr>
            <td>{{ $ad->title}}</td>
            <td>{{ $ad->description}}</td>
            <td><img width="150px" height="150px" src='{{ asset($ad->filename) }}'/></td>
            <td>{{ $ad->price}} $</td>
            <td>
                <a class="btn btn-info" href="{{ route('ads.show',$ad->id) }}">Show</a>
                <a class="btn btn-primary" href="{{ route('ads.edit',$ad->id) }}">Edit</a>
                {!! Form::open(['method' => 'DELETE','route' => ['ads.destroy', $ad->id],'style'=>'display:inline']) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
        </table>
        {!! $ads->render() !!}
    @endsection