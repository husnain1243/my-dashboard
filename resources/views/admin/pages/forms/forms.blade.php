@extends('admin.layouts.default')
@section('content')

@include('includes.alert')
<div class="Dashboard-container">
    <div class="container">
        <h1 class="mb-4">{{$PageTitle}}</h1>
        <div class="row justify-content-center mt-5">
            <div class="col-12">
                <div class="card shadow">
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col"><h4 class="text-center">Id:</h4></th>
                            <th scope="col"><h4 class="text-center">Forms Data:</h4></th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody>
                            @if (count($forms) > 0)
                                @foreach ($forms as $form)
                                    <tr>
                                        <td class="align-middle"><h4 class="text-center">{{$form->id}}</h4></td>
                                        <td class="align-middle"><h4 class="text-center"
                                            style="
                                                width: 400px;
                                                height: 100px;
                                                overflow-y: scroll;
                                            "
                                            >{{$form->data}}</h4></td>
                                        <td class="align-middle">
                                            @if ($form->name != 'admin')
                                                <a href="{{route('Forms_Delete' , $form->id)}}"><button class="border-0 bg-transparent" disabled>Delete</button></a>
                                            @endif
                                            @if ($form->name == 'admin')
                                                <a href="{{route('Forms_Delete' , $form->id)}}"><button class="border-0 bg-transparent">Delete</button></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7"><h4 class="text-center">Form Data Not Found</h4></td>
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
