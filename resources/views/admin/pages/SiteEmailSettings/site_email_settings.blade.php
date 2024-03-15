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
                        <h2 class="p-3">Additional Site Settings</h2>
                        @include('includes.alert')
                    </div>
                    <div class="card-body">
                        <div class="email-site-setting">
                            <h3 class="h3 mb-5">Email Site Settings</h3>
                            <form  method="POST" action="{{ route('Site_Email_Settings_Update') }}"  enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-md-4 mb-4">
                                        <label for="mail_driver" class="form-label">MAIL_DRIVER</label>
                                        <input type="text" class="form-control" id="mail_driver" name="mail_driver" value="{{ htmlspecialchars($siteSetting->smtp_settings->mail_driver ?? '') }}"/>
                                    </div>
                                    <div class="col-12 col-md-4 mb-4">
                                        <label for="mail_mailer" class="form-label">MAIL_MAILER</label>
                                        <input type="text" class="form-control" id="mail_mailer" name="mail_mailer" value="{{ htmlspecialchars($siteSetting->smtp_settings->mail_mailer ?? '') }}"/>
                                    </div>
                                    <div class="col-12 col-md-4 mb-4">
                                        <label for="mail_port" class="form-label">MAIL_PORT</label>
                                        <input type="text" class="form-control" id="mail_port" name="mail_port" value="{{ htmlspecialchars($siteSetting->smtp_settings->mail_port ?? '') }}"/>
                                    </div>
                                    <div class="col-12 col-md-4 mb-4">
                                        <label for="mail_encryption" class="form-label">MAIL_ENCRYPTION</label>
                                        <input type="text" class="form-control" id="mail_encryption" name="mail_encryption" value="{{ htmlspecialchars($siteSetting->smtp_settings->mail_encryption ?? '') }}"/>
                                    </div>
                                    <div class="col-12 col-md-4 mb-4">
                                        <label for="mail_host" class="form-label">MAIL_HOST</label>
                                        <input type="text" class="form-control" id="mail_host" name="mail_host" value="{{ htmlspecialchars($siteSetting->smtp_settings->mail_host ?? '') }}"/>
                                    </div>
                                    <div class="col-12 col-md-4 mb-4">
                                        <label for="mail_username" class="form-label">MAIL_USERNAME</label>
                                        <input type="text" class="form-control" id="mail_username" name="mail_username" value="{{ htmlspecialchars($siteSetting->smtp_settings->mail_username ?? '') }}"/>
                                    </div>
                                    <div class="col-12 col-md-4 mb-4">
                                        <label for="mail_password" class="form-label">MAIL_PASSWORD</label>
                                        <input type="text" class="form-control" id="mail_password" name="mail_password" value="{{ htmlspecialchars($siteSetting->smtp_settings->mail_password ?? '') }}"/>
                                    </div>
                                    <div class="col-12 col-md-4 mb-4">
                                        <label for="mail_from_address" class="form-label">mail_from_address</label>
                                        <input type="text" class="form-control" id="mail_from_address" name="mail_from_address" value="{{ htmlspecialchars($siteSetting->smtp_settings->mail_from_address ?? '') }}"/>
                                    </div>
                                    <div class="col-12 col-md-4 mb-4">
                                        <label for="mail_from_name" class="form-label">MAIL_FROM_NAME</label>
                                        <input type="text" class="form-control" id="mail_from_name" name="mail_from_name" value="{{ htmlspecialchars($siteSetting->smtp_settings->mail_from_name ?? '') }}"/>
                                    </div>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn text-light main-bg mt-5">Update Settings</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
