<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pinkzy World</title>
    <link rel="stylesheet" href="{{ asset('styles/styles.css') }}">
</head>

<body>
    
    @include('partials.navbar')

    @yield('content')

    @include('partials.footer')
</body>

</html>
