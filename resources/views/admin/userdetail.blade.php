
@extends('admin.layouts.default')
@section('content')

<div class="UserDetail-container">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-12">
                <div class="card shadow p-4">
                        <h2>Welcome: {{$users->name}}</h2>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
