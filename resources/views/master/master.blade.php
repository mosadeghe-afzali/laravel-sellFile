<html dir="rtl">
<head>
    @yield('cssStyle')
    <meta charset="UTF-8">
    <meta name="viewport"
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

</head>
<body>

@include('master.header')

@if($errors->any())
    <div>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif

@yield('content')
</body>
@yield('jsFiles')
</html>
