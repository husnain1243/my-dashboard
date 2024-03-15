@extends('admin.layouts.default')
@section('content')

@include('includes.alert')
<div class="Dashboard-container">
    <div class="container">
        <h1 class="mb-4">{{$PageTitle}}</h1>
        <a class="text-dark p-3 border rounded" href="{{route('Email_Template_create')}}">Add New Template</a>
        <div class="row justify-content-center my-5">
            <div class="col-12">
                <div class="card shadow table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                          <tr>
                            <th scope="col"><h4 class="text-center">Id:</h4></th>
                            <th scope="col"><h4 class="text-center">Title:</h4></th>
                            <th scope="col"><h4 class="text-center">Page Code:</h4></th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody>
                            @if (count($Email_template) > 0)
                                @foreach ($Email_template as $Email)
                                    <tr>
                                        <td class="align-middle"><h4 class="text-center">{{$Email->id}}</h4></td>
                                        <td class="align-middle"><h4 class="text-center">{{$Email->name}}</h4></td>
                                        <td class="align-middle"><h4 class="text-center"
                                            style="
                                                width: 500px;
                                                height: 150px;
                                                overflow-y: scroll;
                                                margin: 0 auto;
                                            "
                                            >{{$Email->html}}</h4></td>
                                        <td class="align-middle">
                                            <a class="text-dark" href="{{route('Email_Template_Update' , $Email->id)}}"><button class="border-0 bg-transparent" >Update</button></a>/
                                            @if (Auth::user()->name != 'admin')
                                                <a href="{{route('Email_Template_Delete' , $Email->id)}}"><button class="border-0 bg-transparent" disabled>Delete</button></a>
                                            @endif
                                            @if (Auth::user()->name == 'admin')
                                                <a href="{{route('Email_Template_Delete' , $Email->id)}}"><button class="border-0 bg-transparent">Delete</button></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6"><h4 class="text-center">Pages Not Found</h4></td>
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
