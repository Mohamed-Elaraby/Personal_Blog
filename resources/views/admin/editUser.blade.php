@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
    <div class="">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-light">
                            Edit User information
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
                        <form action="{{ route('admin.updateUser', $user->id) }}" method="post">@csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label for="name" class="form-control-label">User Name</label>
                                            <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}">

                                        </div>
                                    </div>

                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label for="">Permissions</label>
                                            <div>
                                                <input type="checkbox" name="admin" value="1" id="admin" {{ $user->admin == true ? 'checked' : '' }}>
                                                <label for="admin">Admin</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" name="author" value="1" id="author" {{ $user->author == true ? 'checked' : '' }}>
                                                <label for="author">Author</label>
                                            </div>
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