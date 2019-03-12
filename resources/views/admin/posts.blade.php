@extends('layouts.admin')

@section('title', 'Admin Posts')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-light">
                        Comments
                    </div>
                    <div class="errormsg">

                        @if(Session::has('success'))
                            <div class="alert alert-success">
                                {{ session::get('success') }}
                            </div>
                        @endif

                            @if(Session::has('delete'))
                                <div class="alert alert-danger">
                                    {{ session::get('delete') }}
                                </div>
                            @endif

                        @if($errors->any())
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <form action="{{ route('admin.deletePost') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Created_at</th>
                                        <th>Updated_at</th>
                                        <th>Count Of Comments</th>
                                        <th>Action</th>
                                        <th>Select</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($posts as $post)

                                        <tr>
                                            <td>{{ $post->id }}</td>
                                            <td><a href="{{ route('singlePost',$post->id) }}">{{ $post->title }}</a></td>
                                            <td>{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</td>
                                            <td>{{ \Carbon\Carbon::parse($post->updated_at)->diffForHumans() }}</td>
                                            <td>{{ $post->comments->count() }}</td>
                                            <td><a href="{{ route('admin.editPost', $post->id) }}" class="btn btn-primary">Edit</a></td>
                                            <td><input type="checkbox" name="id[]" value="{{ $post->id }}"></td>
                                        </tr>

                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <button class="btn btn-danger" type="submit" name="delete">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="offset-5 col-sm-3">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection

