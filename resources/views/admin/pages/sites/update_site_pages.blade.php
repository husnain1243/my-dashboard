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
                        <form  method="POST" action="{{ route('Pages_Update_New' , ['id' => $Pages->id]) }}"  enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label for="name" class="form-label">Enter Page Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{$Pages->name}}" required />
                            </div>
                            <div class="mb-4">
                                <label for="slug" class="form-label">Enter Page Slug</label>
                                <input type="text" class="form-control" id="slug" name="slug" value="{{$Pages->slug}}"  required />
                            </div>
                            <div class="mb-4">
                                <label for="siteslug" class="form-label">Select Site Slug</label>
                                <select id="siteslug" name="siteslug" class="form-select" aria-label="Default select example" required >
                                    <option value="main">Main</option>
                                    @foreach($allsites as $all)
                                        <option @if($Pages->siteslug == $all->siteslug) selected @endif  value="{{$all->siteslug}}">{{$all->siteslug}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="status" class="form-label">Select Page Status</label>
                                <select id="status" name="status" class="form-select" aria-label="Default select example" value="{{$Pages->status}}"  required >
                                    <option selected>Select Options</option>
                                    <option value="1">Published</option>
                                    <option value="2">Draft</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="seo_title" class="form-label">Enter Seo Title</label>
                                <input type="text" class="form-control" id="seo_title" name="seo_title" value="{{$Pages->seo_title}}"  required  />
                            </div>
                            <div class="mb-4">
                                <label for="meta_desc" class="form-label">Enter Meta Desc</label>
                                <input type="text" class="form-control" id="meta_desc" name="meta_desc" value="{{$Pages->meta_desc}}"  required />
                            </div>
                            <div class="mb-4">
                                <label for="meta_tags" class="form-label">Enter Meta Tag</label>
                                <input type="text" class="form-control" id="meta_tags" name="meta_tags"  value="{{$Pages->meta_tags}}"  />
                            </div>
                            <div class="mb-4">
                                <label for="html" class="form-label">Enter Page Code Here</label>
                                <textarea type="text" class="form-control" id="html" name="html" rows="8" required >
                                    {{ old('text', $Pages->html) }}
                                </textarea>
                            </div>
                            <div class="mb-4">
                                <label for="header_scripts" class="form-label">Enter Header Script </label>
                                <textarea type="text" class="form-control" id="header_scripts" name="header_scripts" rows="6" >
                                    {{ old('text', $Pages->header_scripts) }}
                                </textarea>
                            </div>
                            <div class="mb-4">
                                <label for="footer_scripts" class="form-label">Enter Footer Script</label>
                                <textarea type="text" class="form-control" id="footer_scripts" name="footer_scripts" rows="6">
                                    {{ old('text', $Pages->footer_scripts) }}
                                </textarea>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn text-light main-bg">Update Page Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop


