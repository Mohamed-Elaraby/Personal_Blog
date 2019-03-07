@extends('layouts.admin')

@section('title', 'User Comments')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-light">
                        Comments
                    </div>

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
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach(Auth::user()->comments as $comment)
                                        <tr>
                                            <td>{{ $comment->id }}</td>
                                            <td><a href="{{ route('singlePost',$comment->post->id) }}">{{ $comment->post->title }}</a></td>
                                            <td>{{ $comment->content }}</td>
                                            <td>{{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</td>
                                            <td>{{ \Carbon\Carbon::parse($comment->updated_at)->diffForHumans() }}</td>
                                            <td>
                                                <form id="commentDelete-{{ $comment->id }}" action="{{ route('user.commentDelete', $comment->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <a onclick=" event.preventDefault(); document.getElementById('commentDelete-{{ $comment->id }}').submit();" class="btn btn-danger" href="{{ route('user.commentDelete', $comment->id) }}">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

