@extends('layouts.master')

@section('title', 'Home Page')

@section('content')
    <!-- Page Header -->
    <header class="masthead" style="background-image: url('{{ asset('assets/img/home-bg.jpg') }}')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="site-heading">
                        <h1>Personal Blog</h1>
                        <span class="subheading"> Personal Blog Powred by Mohamed Elaraby</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                @foreach($posts as $post)
                <div class="post-preview">
                    <a href="{{ route('singlePost',['id' => $post->id]) }}">
                        <h2 class="post-title">
                            {{ $post->title }}
                        </h2>
                    </a>
                    <p class="post-meta">Posted by
                        <a href="#">{{ $post->user->name }}</a>
                        on {{ date_format($post->created_at, 'F d, Y') }} </p>
                    <p>
                        <i class="fa fa-comments"></i> {{ $post->comments->count() }}
                    </p>
                </div>
                <hr>
                @endforeach

                {{ $posts->links() }}
                <!-- Pager -->
                <div class="clearfix">
                    <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
                </div>
            </div>
        </div>
    </div>

@endsection