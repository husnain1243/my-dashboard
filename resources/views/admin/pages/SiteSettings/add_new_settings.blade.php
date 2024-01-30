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
                        <h2 class="p-3">Create new Settings</h2>
                        @include('includes.alert')
                    </div>
                    <div class="card-body">
                        <form  method="POST" action="{{ route('Create_Site_Form') }}"  enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label for="site_logo" class="form-label">Enter Site Logo</label>
                                <input type="file" class="form-control" id="site_logo" name="site_logo"/>
                            </div>
                            <div class="mb-4">
                                <label for="site_name" class="form-label">Enter Site Name</label>
                                <input type="text" class="form-control" id="site_name" name="site_name" required/>
                            </div>
                            <div class="mb-4">
                                <label for="title" class="form-label">Enter Seo Title</label>
                                <input type="text" class="form-control" id="title" name="title" required/>
                            </div>
                            <div class="mb-4">
                                <label for="header_scripts" class="form-label">Enter Header Scripts	</label>
                                <textarea type="text" class="form-control" id="header_scripts" name="header_scripts" rows="6"></textarea>
                            </div>
                            <div class="mb-4">
                                <label for="footer_scripts" class="form-label">Enter Footer Scripts	</label>
                                <textarea type="text" class="form-control" id="footer_scripts" name="footer_scripts" rows="6" ></textarea>
                            </div>
                            <div class="mb-4">
                                <label for="nav_html" class="form-label">Enter Nav Html</label>
                                <textarea type="text" class="form-control" id="nav_html" name="nav_html" rows="6" ></textarea>
                            </div>
                            <div class="mb-4">
                                <label for="nav_css	" class="form-label">Enter Nav CSS</label>
                                <textarea type="text" class="form-control" id="nav_css	" name="nav_css" rows="6"></textarea>
                            </div>
                            <!-- <div class="mb-4">
                                <label for="nav_project_data" class="form-label">Enter Nav Project Extra Data</label>
                                <textarea type="text" class="form-control" id="nav_project_data" name="nav_project_data" rows="6" ></textarea>
                            </div> -->
                            <div class="mb-4">
                                <label for="footer_html" class="form-label">Enter Footer Html</label>
                                <textarea type="text" class="form-control" id="footer_html" name="footer_html" rows="6" ></textarea>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn text-light main-bg">Create New Settings</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
