@extends('layouts.admin')

@section('title', 'Admin Users')

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
                    <form action="{{ route('admin.deleteUser') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User Name</th>
                                        <th>Email</th>
                                        <th>Permissions</th>
                                        <th>Created_at</th>
                                        <th>Updated_at</th>
                                        <th>Count Of Posts</th>
                                        <th>Count Of Comments</th>
                                        <th>Action</th>
                                        <th>Select</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($users as $user)

                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @if($user->admin == 1)
                                                    Admin
                                                @elseif($user->author == 1)
                                                    Author
                                                @else
                                                    User
                                                @endif
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</td>
                                            <td>{{ \Carbon\Carbon::parse($user->updated_at)->diffForHumans() }}</td>
                                            <td>{{ $user->Posts->count() }}</td>
                                            <td>{{ $user->comments->count() }}</td>
                                            <td><a href="{{ route('admin.editUser', $user->id) }}" class="btn btn-primary">Edit</a></td>
                                            <td><input type="checkbox" name="id[]" value="{{ $user->id }}"></td>
                                        </tr>

                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <button class="btn btn-danger" type="submit" name="delete" onclick=" confirm('Are you sure delete it?')">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="offset-5 col-sm-3">
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection



