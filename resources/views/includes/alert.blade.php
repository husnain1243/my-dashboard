@if(Session::has('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data_dismiss="alert">
            <i class="fa fa-times"></i>
        </button>
        <strong>Success !</strong> {{session('success')}}
    </div>
@endif
@if(Session::has('error'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data_dismiss="alert">
            <i class="fa fa-times"></i>
        </button>
        <strong>Error !</strong> {{session('error')}}
    </div>
@endif