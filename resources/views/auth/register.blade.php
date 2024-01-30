<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:wght@200;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css" integrity="sha512-6lLUdeQ5uheMFbWm3CP271l14RsX1xtx+J5x2yeIDkkiBpeVTNhTqijME7GgRKKi6hCqovwCoBTlRBEC20M8Mg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{@url('css/style.css')}}"/>
</head>
<body>

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

    <div class="register-container">
        <div class="container">
            <div class="row justify-content-center mt-5">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card shadow">
                        <div class="card-title text-center border-bottom">
                            <h2 class="p-3">Register</h2>
                            @include('includes.alert')
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('UserRegister') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" class="form-control" id="image" name="image" />
                                </div>
                                <div class="mb-4">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Your Name"/>
                                </div>
                                <div class="mb-4">
                                    <label for="username" class="form-label">UserName</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username"/>
                                </div>
                                <div class="mb-4">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email"/>
                                </div>
                                <div class="mb-4">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Your Password"/>
                                </div>
                                <div class="mb-3">
                                    <p>ALready have an account: <a class="text-dark underline" href="{{route('login')}}" >Login</a></p>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn text-light main-bg">SignUp</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>

