@extends('admin.layouts.default')
@section('content')

@include('includes.alert')
<div class="Dashboard-container">
    <div class="container">
        <h1 class="mb-4">{{$PageTitle}}</h1>
        <a class="text-dark p-3 border rounded" href="{{route('Create_blogs')}}">Add New blogs</a>
        <div class="row justify-content-center my-5">
            <div class="col-12">
                <div class="card shadow table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                          <tr>
                            <th scope="col"><h4 class="text-center">Id:</h4></th>
                            <th scope="col"><h4 class="text-center">Images:</h4></th>
                            <th scope="col"><h4 class="text-center">Title:</h4></th>
                            <th scope="col"><h4 class="text-center">Slug:</h4></th>
                            <th scope="col"><h4 class="text-center">Blog Data:</h4></th>
                            <th scope="col"><h4 class="text-center">author:</h4></th>
                            <th scope="col"><h4 class="text-center">Views:</h4></th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody>
                            @if (count($blogs) > 0)
                                @foreach ($blogs as $blog)
                                    <tr>
                                        <td class="align-middle"><h4 class="text-center">{{$blog->id}}</h4></td>
                                        <td class="align-middle">
                                            <h4 class="text-center m-0 p-0">
                                                <img class="img-fluid m-auto d-block rounded-circle" height=50 width=50 src="/media_uploads/{{$blog->featured_img}}" alt="user_profile">
                                            </h4>
                                        </td>
                                        <td class="align-middle"><h4 class="text-center">{{$blog->title}}</h4></td>
                                        <td class="align-middle"><h4 class="text-center">{{$blog->slug}}</h4></td>
                                        <td class="align-middle"><h4 class="text-center"
                                            style="
                                                width: 500px;
                                                height: 150px;
                                                overflow-y: scroll;
                                                margin: 0 auto;
                                            "
                                            >
                                            {{$blog->summernote}}</h4></td>
                                        <td class="align-middle"><h4 class="text-center">{{$blog->author}}</h4></td>
                                        <td class="align-middle"><h4 class="text-center">{{$blog->views}}</h4></td>
                                        <td class="align-middle">
                                            <a class="text-dark" href="{{route('BlogsDetails' , $blog->id)}}">View</a>/
                                            <a class="text-dark" href="{{route('BlogsUpdate' , $blog->id)}}"><button class="border-0 bg-transparent" >Update</button></a>/
                                            @if (Auth::user()->name != 'admin')
                                                <a href="{{route('BlogDelete' , $blog->id)}}"><button class="border-0 bg-transparent" disabled>delete</button></a>
                                            @endif
                                            @if (Auth::user()->name == 'admin')
                                                <a href="{{route('BlogDelete' , $blog->id)}}"><button class="border-0 bg-transparent">delete</button></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8"><h4 class="text-center">Blogs Not Found</h4></td>
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
