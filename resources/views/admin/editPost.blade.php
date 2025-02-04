@extends('layouts.admin')

@section('title', 'Edit Post')

@section('content')
    <div class="">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-light">
                            Edit Post
                        </div>

                        @if($errors->any())
                            <div class="errors_show">

                                <div class="alert alert-danger">
                                    @foreach($errors->all() as $error)

                                        <li>{{ $error }}</li>

                                    @endforeach
                                </div>

                            </div>
                        @endif
                        <form action="{{ route('admin.updatePost', $post->id) }}" method="post">@csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label for="title" class="form-control-label">Title</label>
                                            <input type="text" name="title" id="title" class="form-control" value="{{ $post->title }}">
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label for="postContent">Content</label>
                                            <textarea name="postContent" id="postContent" class="form-control" rows="15">{{ $post->content }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-success" type="submit" value="Update">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection