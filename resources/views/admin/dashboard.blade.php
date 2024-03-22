@extends('admin.layouts.default')
@section('content')

@include('includes.alert')
<div class="Dashboard-container">
    <div class="container">
        <h1> Welcome: {{ $userName = Auth::user()->name;}}</h1>
        <div class="row justify-content-center mt-5">
            <div class="col-12">
                <div class="card shadow">
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col"><h4 class="text-center">UserId:</h4></th>
                            <th scope="col"><h4 class="text-center">Profile Photo:</h4></th>
                            <th scope="col"><h4 class="text-center">UserName:</h4></th>
                            <th scope="col"><h4 class="text-center">UserEmail:</h4></th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody>
                            @if (count($users) > 0)
                                @foreach ($users as $user)
                                    @if($user->name != Auth::user()->name && $user->name != 'admin')
                                        <tr>
                                            <td class="align-middle"><h4 class="text-center">{{$user->id}}</h4></td>
                                            <td class="align-middle">
                                                <h4 class="text-center m-0 p-0">
                                                    <img class="img-fluid m-auto d-block rounded-circle" height=50 width=50 src="/media_uploads/{{$user->image}}" alt="user_profile">
                                                </h4>
                                            </td>
                                            <td class="align-middle"><h4 class="text-center">{{$user->name}}</h4></td>
                                            <td class="align-middle"><h4 class="text-center">{{$user->email}}</h4></td>
                                            <td class="align-middle">
                                                <a class="text-dark" href="{{route('UserDetails' , $user->id)}}">View</a>/
                                                @if (Auth::user()->name == 'admin')
                                                    <a class="text-dark" href="{{route('update' , $user->id)}}"><button class="border-0 bg-transparent" >Update</button></a>/
                                                    <a href="{{route('DeleteUser' , $user->id)}}"><button class="border-0 bg-transparent">delete</button></a>
                                                @endif
                                                @if (Auth::user()->name != 'admin')
                                                    <a class="text-dark" href="{{route('update' , $user->id)}}"><button class="border-0 bg-transparent" disabled>Update</button></a>/
                                                    <a href="{{route('DeleteUser' , $user->id)}}"><button class="border-0 bg-transparent" disabled>delete</button></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5"><h4 class="text-center">User Not Found</h4></td>
                                <tr>
                            @endif
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
