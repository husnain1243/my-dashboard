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
                        <h2 class="p-3">Downloads & Uploads</h2>
                        @include('includes.alert')
                    </div>
                    <div class="card-body">
                        <a href="{{route('DownloadsDB')}}" class="a btn border rounded p-3 mb-3">Download Project DB</a>
                        <a typr="button" class="a btn border rounded p-3 mb-3" data-bs-toggle="modal" data-bs-target="#UploadDB">Uploads Projects DB</a>
                        <a href="{{route('DownloadsFile')}}" class="a btn border rounded p-3 mb-3">Download Project File</a>
                        <a typr="button" class="a btn border rounded p-3 mb-3" data-bs-toggle="modal" data-bs-target="#UploadFile">Uploads Project File</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Upload DB --}}
        <div class="modal fade" id="UploadDB" tabindex="-1" aria-labelledby="UploadDBLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-tittle fs-5" id="UploadDBLabel">Upload Database</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('UploadDB')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label for="sql_file" class="form-label">Select Sql file to upload:</label>
                                        <input type="file" class="form-control" id="sql_file" name="sql_file" placeholder="sql_file" accept=".sql">
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn w-25 border rounded p-2 mb-4" >Upload</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

         {{-- Upload File --}}
         <div class="modal fade" id="UploadFile" tabindex="-1" aria-labelledby="UploadFileLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-tittle fs-5" id="UploadFileLabel">Upload Database</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('UploadFile')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label for="project_file" class="form-label">Select Sql file to upload:</label>
                                        <input type="file" class="form-control" id="project_file" name="project_file" placeholder="project_file" accept=".zip">
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn w-25 border rounded p-2 mb-4" >Upload</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@stop
