@extends('layouts.admin')

@section('title', 'Admin Comments')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-light">
                        Comments
                    </div>
                    <div class="errormsg">
                        @if($errors->any())
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <form action="{{ route('admin.deleteComment') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Related Posts</th>
                                        <th>Comments</th>
                                        <th>Created_at</th>
                                        <th>Updated_at</th>
                                        <th>Select</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($comments as $comment)
                                        <tr>
                                            <td>{{ $comment->id }}</td>
                                            <td><a href="{{ route('singlePost', ['id' => $comment->post->id]) }}">{{ $comment->post->title }}</a></td>
                                            <td>{{ $comment->content }}</td>
                                            <td>{{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</td>
                                            <td>{{ \Carbon\Carbon::parse($comment->updated_at)->diffForHumans() }}</td>
                                            <td><input type="checkbox" name="id[]" value="{{ $comment->id }}"></td>
                                        </tr>

                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <button class="btn btn-danger" type="submit" name="delete" onclick="return confirm('Are you sure delete it?')">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="offset-5 col-sm-3">
                {{ $comments->links() }}
            </div>
        </div>
    </div>
@endsection

