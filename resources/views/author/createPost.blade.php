@extends('layouts.admin')

@section('title', 'newPost')

@section('content')
    <div class="">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-light">
                            Create new post
                        </div>

                        @if(Session::has('success'))
                            <div class="alert alert-success">{{ Session::get('success') }}</div>
                        @endif

                        @if($errors->any())
                            <div class="errors_show">

                                <div class="alert alert-danger">
                                    @foreach($errors->all() as $error)

                                        <li>{{ $error }}</li>

                                    @endforeach
                                </div>

                            </div>
                        @endif
                        <form action="{{ route('author.addPost') }}" method="post">@csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label for="title" class="form-control-label">Title</label>
                                            <input type="text" name="title" id="title" class="form-control" placeholder="Post Title">
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label for="postContent">Content</label>
                                            <textarea name="postContent" id="postContent" class="form-control" rows="15" placeholder="Post Content"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-success" type="submit" value="Create">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection