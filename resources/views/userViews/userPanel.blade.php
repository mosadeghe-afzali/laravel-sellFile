@extends('master.master')
@section('cssStyle')
    <link rel="stylesheet" href="{{asset('css/settings.css')}}">
    <link rel="stylesheet" href="{{asset('css/tables.css')}}">

@endsection
@section('content')
    <h1>پنل کاربری</h1>
    <div>
        @if(session()->has('username'))
            {{session()->get('username')}}
        @endif
    </div>
    <div style="display: flex" class="panel">

        <div class="myDropdown" style="display: @if(\App\Http\Controllers\AuthController::userLevel() !== 'admin') echo 'none' @endif ">
            <button onclick="myFunction()" class="dropbtn">تنظیمات</button>
            <div id="myDropdown" class="dropdown-content">
                <a href="{{route('settings')}}">file settings</a>
                <a href="{{route('users.index')}}">user settings</a>
                <a href="{{route('files.list')}}">confirmer panel</a>
                <a href="{{route('storeTimeView')}}">storeTime managing</a>

            </div>
        </div>
    </div><br><br>


    <table>
        <tr>
            <th>حجم فایل ها</th>
            <th>اعتبار کاربر</th>
            <th>تعداد دانلود کلی</th>
        </tr>
        <tr>
            @foreach($data as $item)
            <td>{{$item}}</td><br>
            @endforeach
        </tr>
    </table><br><br>
    <div style=" ;">
       <div> <a href="{{route('home')}}"><button style="margin-right: 1200px;" >بازگشت به صفحه اصلی</button></a></div>
        <div><a href="{{route('logout')}}"><button style="margin-right: 1200px;" >خروج از حساب کاربری</button></a></div>
    </div>

@endsection
@section('jsFiles')
     <script src="{{asset('css/setting.js')}}" ></script>
@endsection
