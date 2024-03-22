@extends('admin.layouts.default')
@section('content')

@include('includes.alert')

<style>
    .main-bg {
        background: #000 !important;
    }
    input:focus, button:focus {
        border: 1px solid var(--main-bg) !important;
        box-shadow: none !important;
    }

    .form-check-input:checked {
        background-color: var(--main-bg) !important;
        border-color: var(--main-bg) !important;
    }

    .card, .btn, input{
        border-radius:0 !important;
    }

</style>

<div class="login-container">
    <div class="container">
        <div class="row justify-content-center my-5">
            <div class="col-12 col-lg-8">
                <div class="card shadow">
                    <div class="card-title text-center border-bottom">
                        <h2 class="p-3">{{$PageTitle}}</h2>
                        @include('includes.alert')
                    </div>
                    <div class="card-body">
                        <form  method="POST" action="{{ route('AllSite_Update_saver' ,  ['id' => $AllSites->id]) }}">
                            @csrf
                            <div class="mb-4">
                                <label for="sitename" class="form-label">Enter Site Name</label>
                                <input type="text" class="form-control" id="sitename" name="sitename" value="{{$AllSites->sitename}}" required />
                            </div>
                            <div class="mb-4">
                                <label for="siteslug" class="form-label">Enter Site Slug</label>
                                <input type="text" class="form-control" id="siteslug" name="siteslug" value="{{$AllSites->siteslug}}" required />
                            </div>
                            <div class="mb-4">
                                <label for="seo_title" class="form-label">Enter Seo Title</label>
                                <input type="text" class="form-control" id="seo_title" name="seo_title" value="{{$AllSites->seo_title}}" required  />
                            </div>
                            <div class="mb-4">
                                <label for="meta_desc" class="form-label">Enter Meta Desc</label>
                                <input type="text" class="form-control" id="meta_desc" name="meta_desc" value="{{$AllSites->meta_desc}}" required />
                            </div>
                            <div class="mb-4">
                                <label for="meta_tags" class="form-label">Enter Meta Tag</label>
                                <input type="text" class="form-control" id="meta_tags" name="meta_tags" value="{{$AllSites->meta_tags}}" />
                            </div>
                            <div class="mb-4">
                                <label for="header_scripts" class="form-label">Enter Header Script</label>
                                <textarea type="text" class="form-control" id="header_scripts" name="header_scripts" rows="8" required >{{$AllSites->header_scripts}}</textarea>
                            </div>
                            <div class="mb-4">
                                <label for="site_header" class="form-label">Enter Site Header</label>
                                <textarea type="text" class="form-control" id="site_header" name="site_header" rows="6" >{{$AllSites->site_header}}</textarea>
                            </div>
                            <div class="mb-4">
                                <label for="site_footer" class="form-label">Enter Site Footer</label>
                                <textarea type="text" class="form-control" id="site_footer" name="site_footer" rows="6">{{$AllSites->site_footer}}</textarea>
                            </div>
                            <div class="mb-4">
                                <label for="footer_scripts" class="form-label">Enter Footer Script</label>
                                <textarea type="text" class="form-control" id="footer_scripts" name="footer_scripts" rows="6">{{$AllSites->footer_scripts}}</textarea>
                            </div>
                            <div class="mb-4">
                                <label for="site_css" class="form-label">Enter site Style</label>
                                <textarea type="text" class="form-control" id="site_css" name="site_css" rows="6">{{$AllSites->site_css}}</textarea>
                            </div>
                            <div class="mb-4">
                                <label for="extras" class="form-label">Enter Site Extras</label>
                                <textarea type="text" class="form-control" id="extras" name="extras" rows="6">{{$AllSites->extras}}</textarea>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn text-light main-bg">Update Site</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop


