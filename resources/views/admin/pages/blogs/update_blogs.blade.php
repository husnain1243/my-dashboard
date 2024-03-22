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
                        <h2 class="p-3">Update Blog</h2>
                        @include('includes.alert')
                    </div>
                    <div class="card-body">
                        <form  method="POST" action="{{ route('Blogs_Update_New', ['id' => $blogs->id]) }}"  enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label for="featured_img" class="form-label">Image</label>
                                <input type="file" class="form-control" id="featured_img" name="featured_img"required />
                            </div>
                            <div class="mb-4">
                                <label for="title" class="form-label">Enter Blog Name</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{$blogs->title}}" required />
                            </div>
                            <div class="mb-4">
                                <label for="slug" class="form-label">Enter Blog Slug</label>
                                <input type="text" class="form-control" id="slug" name="slug" value="{{$blogs->slug}}"required />
                            </div>
                            <div class="mb-4">
                                <label for="AllSites" class="form-label">Select Site</label>
                                <select id="AllSites" name="AllSites" class="form-select" aria-label="Default select example" required >
                                    <option selected value="main">Main</option>
                                    @foreach($AllSites as $All)
                                        <option @if($blogs->siteslug == $All->siteslug) selected @endif value="{{$All->siteslug}}">{{$All->siteslug}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="status" class="form-label">Select Blog Status</label>
                                <select id="status" name="status" class="form-select" aria-label="Default select example" value="{{$blogs->status}}"required >
                                    <option selected>Select Options</option>
                                    <option value="Published">Published</option>
                                    <option value="Draft">Draft</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="seo_title" class="form-label">Enter Seo Title</label>
                                <input type="text" class="form-control" id="seo_title" name="seo_title" value="{{$blogs->seo_title}}"required/>
                            </div>
                            <div class="mb-4">
                                <label for="author" class="form-label">Enter Blog Author</label>
                                <input type="text" class="form-control" id="author" name="author" value="{{$blogs->author}}"required />
                            </div>
                            <div class="mb-4">
                                <label for="meta_desc" class="form-label">Enter Meta Desc</label>
                                <input type="text" class="form-control" id="meta_desc" name="meta_desc" value="{{$blogs->meta_desc}}"required />
                            </div>
                            <div class="mb-4">
                                <label for="meta_tags" class="form-label">Enter Meta Tag</label>
                                <input type="text" class="form-control" id="meta_tags" name="meta_tags" value="{{$blogs->meta_tags}}"/>
                            </div>
                            <div class="mb-4">
                                <label for="additional_tags" class="form-label">Enter Additional Tag</label>
                                <input type="text" class="form-control" id="additional_tags" name="additional_tags" value="{{$blogs->additional_tags}}"/>
                            </div>
                            <div class="mb-4">
                                <label for="category" class="form-label">Enter Blog Category</label>
                                <input type="text" class="form-control" id="category" name="category" value="{{$blogs->category}}"/>
                            </div>
                            <div class="mb-4">
                                <label for="summernote" class="form-label">Enter Code Here</label>
                                <textarea type="text" class="form-control" id="summernote" name="summernote" rows="8">
                                    {{ old('text', $blogs->summernote) }}
                                </textarea>
                            </div>
                            <div class="mb-4">
                                <label for="header_scripts" class="form-label">Enter Header Script </label>
                                <textarea type="text" class="form-control" id="header_scripts" name="header_scripts" rows="8">
                                    {{ old('text', $blogs->header_scripts) }}
                                </textarea>
                            </div>
                            <div class="mb-4">
                                <label for="footer_scripts" class="form-label">Enter Footer Script</label>
                                <textarea type="text" class="form-control" id="footer_scripts" name="footer_scripts" rows="8">
                                    {{ old('text', $blogs->footer_scripts) }}
                                </textarea>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn text-light main-bg">Update Blog</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

