@extends('admin.layouts.default')
@section('content')

@include('includes.alert')
<div class="Dashboard-container">
    <div class="container">
        <h1 class="mb-4">{{$PageTitle}}</h1>
        <a class="text-dark p-3 border rounded" href="{{route('Create_Media')}}">Add New Media</a>
        <div class="card shadow my-5">
            <div class="row p-5">
                @if (count($media) > 0)
                    @foreach ($media as $media)
                        <div class="col-12 col-md-6 col-lg-4 col-xl-3 p-4 text-center">
                            <div class="align-middle">
                                <h4 class="text-center m-0 p-0">
                                    <div class="image-container" style="width: 100%; height: 250px;">
                                        <img class="m-auto d-block " height="100%" width="100%" src="/media_uploads/{{$media->path}}" alt="user_profile">
                                    </div>
                                </h4>
                            </div>
                            <div class="text-center mb-3"><h4 class="text-center">{{$media->title}}</h4></div>
                            @if (Auth::user()->name != 'admin')
                                <a class="" href="{{route('Media_Delete' , $media->id)}}">
                                    <button class="text-dark p-2 px-5 border rounded" disabled>delete</button></a>
                            @endif
                            @if (Auth::user()->name == 'admin')
                                <a class="" href="{{route('Media_Delete' , $media->id)}}">
                                    <button class="text-dark p-2 px-5 border rounded">delete</button></a>
                            @endif
                        </div>
                    @endforeach
                @else
                    <td colspan="4"><h4 class="text-center">Media Not Found</h4></td>
                @endif
            </div>
        </div>
    </div>
</div>

@stop
