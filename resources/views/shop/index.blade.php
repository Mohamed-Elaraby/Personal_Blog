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
                        <h1>Shop</h1>
                        <span class="subheading">Super Cool T-shirt</span>
                    </div>
                </div>
            </div>
        </div>
    </header>


@endsection