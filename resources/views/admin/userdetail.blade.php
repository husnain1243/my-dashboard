
@extends('admin.layouts.default')
@section('content')

<div class="UserDetail-container">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-12">
                <div class="card shadow p-4">
                    @if($users->image)
                        <h2 class="h2 mb-2">
                            <img src="{{$users->image}}" alt="">
                        </h2>
                    @endif
                    <h2 class="h2 mb-2">User: {{$users->id}}</h2>
                    <h2 class="h2 mb-2">User: {{$users->name}}</h2>
                    <h2 class="h2 mb-2">Email: {{$users->email}}</h2>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
