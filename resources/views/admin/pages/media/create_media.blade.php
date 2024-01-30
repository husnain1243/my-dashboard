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
                        <h2 class="p-3">Create new Media</h2>
                        @include('includes.alert')
                    </div>
                    <div class="card-body">
                        <form  method="POST" action="{{ route('Media_Saver') }}"  enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label for="featured_img" class="form-label">Select Your Image</label>
                                <input type="file" class="form-control" id="featured_img" name="featured_img" required />
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn text-light main-bg">Create Media</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

