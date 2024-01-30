@extends('admin.layouts.default')
@section('content')

@include('includes.alert')
<div class="Dashboard-container">
    <div class="container">
        <h1 class="mb-4">{{$PageTitle}}</h1>
        <a class="text-dark p-3 border rounded" href="{{route('Create_Services')}}">Add New Services</a>
        <div class="row justify-content-center mt-5">
            <div class="col-12">
                <div class="card shadow table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                          <tr>
                            <th scope="col"><h4 class="text-center">Id:</h4></th>
                            <th scope="col"><h4 class="text-center">Image:</h4></th>
                            <th scope="col"><h4 class="text-center">Title:</h4></th>
                            <th scope="col"><h4 class="text-center">Slug:</h4></th>
                            <th scope="col"><h4 class="text-center">Meta Desc:</h4></th>
                            <th scope="col"><h4 class="text-center">Author:</h4></th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody>
                            @if (count($services) > 0)
                                @foreach ($services as $service)
                                    <tr>
                                        <td class="align-middle"><h4 class="text-center">{{$service->id}}</h4></td>
                                        <td class="align-middle">
                                            <h4 class="text-center m-0 p-0">
                                                <img class="img-fluid m-auto d-block rounded-circle" height=50 width=50 src="/media_uploads/{{$service->featured_img}}" alt="user_profile">
                                            </h4>
                                        </td>
                                        <td class="align-middle"><h4 class="text-center">{{$service->title}}</h4></td>
                                        <td class="align-middle"><h4 class="text-center">{{$service->slug}}</h4></td>
                                        <td class="align-middle"><h4 class="text-center">{{$service->meta_desc}}</h4></td>
                                        <td class="align-middle"><h4 class="text-center">{{$service->author}}</h4></td>
                                        <td class="align-middle">
                                            <a class="text-dark" href="{{route('Services_Detail' , $service->id)}}">View</a>/
                                            <a class="text-dark" href="{{route('Services_Update' , $service->id)}}"><button class="border-0 bg-transparent" >Update</button></a>/
                                            @if (Auth::user()->name != 'admin')
                                                <a href="{{route('Services_Delete' , $service->id)}}"><button class="border-0 bg-transparent" disabled>delete</button></a>
                                            @endif
                                           @if (Auth::user()->name == 'admin')
                                                <a href="{{route('Services_Delete' , $service->id)}}"><button class="border-0 bg-transparent">delete</button></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7"><h4 class="text-center">Pages Not Found</h4></td>
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
