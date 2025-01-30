<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Wisata</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta content="" name="description" />
    <meta content="" name="author" />

    {{-- css  --}}
    @include('app._layouts.css')
</head>

<body class="c-layout-header-fixed c-layout-header-mobile-fixed">
    {{-- header --}}
    @include('app._layouts.header')

    {{-- content --}}
    @yield('content')

    {{-- footer --}}
    @include('app._layouts.footer')

    {{-- js --}}
    @include('app._layouts.js')

</body>

</html>
