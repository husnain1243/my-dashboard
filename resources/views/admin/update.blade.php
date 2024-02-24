@extends('admin.layouts.default')
@section('content')

    <div class="Update-container">
        <div class="container">
            <div class="row justify-content-center mt-5">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card shadow">
                        <div class="card-title text-center border-bottom">
                            <h2 class="p-3">Update User</h2>
                            @include('includes.alert')
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('updateUserRecord' , ['id' => $users->id]) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" class="form-control" id="image" name="image"/>
                                </div>
                                <div class="mb-4">
                                    <label for="username" class="form-label">User Name</label>
                                    <input type="text" class="form-control" id="username" name="username" value="{{$users->username}}"/>
                                </div>
                                <div class="mb-4">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{$users->name}}"/>
                                </div>
                                <div class="mb-4">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{$users->email}}"/>
                                </div>
                                <div class="mb-4">
                                    <label for="password" class="form-label">New Password</label>
                                    <input type="password" class="form-control" id="password" name="password" />
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn text-light main-bg bg-dark">Update Users</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
