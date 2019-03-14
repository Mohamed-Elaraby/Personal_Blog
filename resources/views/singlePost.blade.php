@extends('layouts.master')

@section('title', 'SinglePost')

@section('content')
    <!-- Page Header -->
    <header class="masthead" style="background-image: url('{{ asset('assets/img/post-bg.jpg ')}}')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="post-heading">
                        <h1>{{ $post->title }}</h1>
                        <span class="meta">Posted by
              <a href="#">{{ $post->user->name }}</a>
              on {{ date_format($post->created_at, 'F d, Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Post Content -->
    <article>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    {!! nl2br($post->content) !!}
                </div>

            </div>
            <hr>
            <div class="comments_area">
                <h2>Comments</h2>
                <hr>
                @foreach($post->comments as $comments)
                    <li>{{ $comments->content }}  </li>
                    <p><small>By {{ $post->user->name }} On {{ \Carbon\Carbon::parse($comments->created_at)->diffForHumans() }}</small></p>
                    <hr>
                @endforeach
            </div>
            @if(Auth::check())
                <div class="add_comment">
                    <div class="errors">
                        @if($errors->any())
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger">
                                    <li>{{ $error }}</li>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <form action="{{ route('user.newComment') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <label for="comment">Leave a comment</label>
                            <textarea name="comment" id="comment" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="new Comment" class="btn btn-success">
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </article>

@endsection