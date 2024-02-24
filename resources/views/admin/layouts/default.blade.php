<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
</head>
<body>
    @include('admin.includes.header')
    @yield('content')
    @include('includes.scripts')
</body>
</html>