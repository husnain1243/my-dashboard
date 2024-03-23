@extends('admin.layouts.default')
@section('content')

@include('includes.alert')
<div class="Dashboard-container">
    <div class="container">
        <h1 class="mb-4">{{$PageTitle}}</h1>
        @if(Auth::user()->name == 'admin')
            <a class="text-dark p-3 border rounded" href="{{route('Create_Site_Settings')}}">Add New Settings</a>
        @endif
        <div class="row justify-content-center mt-5">
            <div class="col-12">
                <div class="card shadow table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                          <tr>
                            <th scope="col"><h4 class="text-center">Id:</h4></th>
                            <th scope="col"><h4 class="text-center">Home Page:</h4></th>
                            <th scope="col"><h4 class="text-center">Header Scripts:</h4></th>
                            <th scope="col"><h4 class="text-center">Footer Scripts:</h4></th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody>
                            @if (count($siteSetting) > 0)
                                @foreach ($siteSetting as $site_setting)
                                    <tr>
                                        <td class="align-middle"><h4 class="text-center">{{$site_setting->id}}</h4></td>
                                        <td class="align-middle"><h4 class="text-center">{{$site_setting->homepage}}</h4></td>
                                        <td class="align-middle"><h4 class="text-center"
                                            style="
                                                width: 400px;
                                                height: 150px;
                                                overflow-y: scroll;
                                                margin: 0 auto;
                                            "
                                            >{{$site_setting->header_scripts}}</h4></td>
                                        <td class="align-middle"><h4 class="text-center"
                                            style="
                                                width: 400px;
                                                height: 150px;
                                                overflow-y: scroll;
                                                margin: 0 auto;
                                            "
                                            >{{$site_setting->footer_scripts}}</h4></td>
                                        <td class="align-middle">
                                            <h4 class=""
                                                style="
                                                    width: 200px;
                                                "
                                                >
                                                @if (Auth::user()->name != 'admin')
                                                    <a class="text-dark" href="{{route('Update_Site_Settings' , $site_setting->id)}}"><button class="border-0 bg-transparent">Update</button></a>/
                                                    <a href="{{route('Site_Setting_Delete' , $site_setting->id)}}"><button class="border-0 bg-transparent" disabled>delete</button></a>
                                                @endif
                                                @if (Auth::user()->name == 'admin')
                                                    <a class="text-dark" href="{{route('Update_Site_Settings' , $site_setting->id)}}"><button class="border-0 bg-transparent" >Update</button></a>/
                                                    <a href="{{route('Site_Setting_Delete' , $site_setting->id)}}"><button class="border-0 bg-transparent" >delete</button></a>
                                                @endif
                                            </h4>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8"><h4 class="text-center">Settings Not Found</h4></td>
                                <tr>
                            @endif
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
