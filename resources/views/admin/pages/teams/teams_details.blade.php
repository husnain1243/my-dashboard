@extends('admin.layouts.default')
@section('content')

@include('includes.alert')
<div class="Dashboard-container">
    <div class="container">
        <h1 class="mb-4">{{$PageTitle}}</h1>
        <div class="row mt-5">
            <div class="col-12 col-lg-6 mb-5">
                <div class="image-container">
                    <img src="/asserts/{{$teams->featured_img}}" alt="{{$teams->featured_img_alt}}" class="img-fluid d-block"/>
                </div>
            </div>
            <div class="col-12 col-lg-6 mb-5">
                <ul class="ul ps-0">
                    <li class="li"><h2 class="h2">Name: {{$teams->title}} </h2></li>
                    <li class="li"><h2 class="h2">Slug: {{$teams->slug}} </h2></li>
                    <li class="li"><h2 class="h2">Status: {{$teams->status}} </h2></li>
                    <li class="li"><h2 class="h2">Seo Title: {{$teams->seo_title}} </h2></li>
                    <li class="li"><h2 class="h2">Category: {{$teams->category}} </h2></li>
                    <li class="li"><h2 class="h2">Author: {{$teams->author}} </h2></li>
                    <li class="li"><h2 class="h2">Meta Desc: {{$teams->meta_desc}} </h2></li>
                </ul>
            </div>
            <div class="col-12 mb-5">
                <h2 class="h2">Page Code:</h2>
                <p class="p">
                    {!!$teams->summernote!!}
                </p>
            </div>
        </div>
    </div>
</div>

@stop
