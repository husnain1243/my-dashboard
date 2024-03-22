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
                        <h2 class="p-3">Update Your Template</h2>
                        @include('includes.alert')
                    </div>
                    <div class="card-body">
                        <form  method="POST" action="{{ route('Email_Template_Update_saver' ,  ['id' => $Email_template->id]) }}">
                            @csrf
                            <div class="mb-4">
                                <label for="name" class="form-label">Enter Template Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{$Email_template->name}}" required />
                            </div>
                            <div class="mb-4">
                                <label for="siteslug" class="form-label">Select Site Slug</label>
                                <select id="siteslug" name="siteslug" class="form-select" aria-label="Default select example" required >
                                    <option value="main">Main</option>
                                    @foreach($allsites as $all)
                                        <option @if($Email_template->siteslug == $all->siteslug) selected @endif value="{{$all->siteslug}}">{{$all->siteslug}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="html" class="form-label">Enter Template Code Here</label>
                                <textarea type="text" class="form-control" id="html" name="html" rows="8" required >
                                    {{ old('text', $Email_template->html) }}
                                </textarea>
                            </div>
                            <div class="mb-4">
                                <label for="extras" class="form-label">Enter Extras</label>
                                <textarea type="text" class="form-control" id="extras" name="extras" rows="8" required >
                                    {{ old('text', $Email_template->extras) }}
                                </textarea>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn text-light main-bg">Update Template</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop


