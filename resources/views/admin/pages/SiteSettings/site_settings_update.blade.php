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
        <div class="row justify-content-center mt-5">
            <div class="col-12 col-lg-8">
                <div class="card shadow">
                    <div class="card-title text-center border-bottom">
                        <h2 class="p-3">{{$PageTitle}}</h2>
                        @include('includes.alert')

                    </div>
                    <div class="card-body">
                        <form  method="POST" action="{{ route('Update_Site_Settings_New' , ['id' => $site_setting->id]) }}"  enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-md-6 mb-4">
                                    <label for="site_logo" class="form-label">Select Site Logo</label>
                                    <input type="file" class="form-control" id="site_logo" name="site_logo"/>
                                </div>
                                <div class="col-12 col-md-6 mb-4">
                                    <label for="AllSites" class="form-label">Select Home Page</label>
                                    <select id="AllSites" name="AllSites" class="form-control form-select" aria-label=".form-select example">
                                        @foreach($AllSites as $all)
                                            <option @if($site_setting->homepage == $all->siteslug) selected @endif value="{{$all->siteslug}}">{{$all->siteslug}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-6 mb-4">
                                    <label for="site_preloader" class="form-label">Select Site Favicon</label>
                                    <input type="file" class="form-control" id="site_preloader" name="site_preloader" value="{{$site_setting->site_name}}" />
                                </div>
                                <div class="col-12 col-md-6 mb-4">
                                    <label for="site_preloader_name" class="form-label">Favicon Selector</label>
                                    <select id="site_preloader_name" name="site_preloader_name" class="form-control form-select" aria-label=".form-select example">
                                        <option value="true">Enabled</option>
                                        <option value="false">DisEnabled</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label for="header_scripts" class="form-label">Enter Header Scripts	</label>
                                    <textarea type="text" class="form-control" id="header_scripts" name="header_scripts" rows="8">
                                        {{ old('text', $site_setting->header_scripts) }}
                                    </textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="footer_scripts" class="form-label">Enter Footer Scripts	</label>
                                    <textarea type="text" class="form-control" id="footer_scripts" name="footer_scripts" rows="8" >
                                        {{ old('text', $site_setting->footer_scripts) }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn text-light main-bg">Update New Settings</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
