@extends('master.master')
@section('cssStyle')
    <link rel="stylesheet" href="{{asset('css/form.css')}}">
@endsection

@section('content')
    <br><br>
    <div style="display: flex">
    <div class="form-popup" id="myForm">
    <form action="{{route('addValidTypes')}}" method="post" class="form-container">
        <h1>افزودن نوع فایل مجاز</h1>

        @csrf
        <label for="validType">نوع فایل مورد نظر را وارد کنید:</label>
        <input type="text" name="type" id="validType" ><br><br>
        <button type="submit" class="btn">ثبت</button>
        <a href="{{route('home')}}"><button type="button" class="btn cancel" onclick="closeForm()">Close</button></a>    </form>
    </div>
    <div class="form-popup" id="myForm">
    <form action="{{route('deleteValidTypes')}}" method="post" class="form-container">
        <h1>حذف نوع فایل مجاز</h1>

        @csrf
        <label for="validType">نوع فایل مورد نظر را انتخاب کنید:</label>
        <select id="validType" >
            @foreach($types as $type)
                <option name="types" value="{{$type}}">{{$type}}</option>
            @endforeach
        </select>
        <button type="submit" class="btn">ثبت</button>
        <a href="{{route('home')}}"><button type="button" class="btn cancel" onclick="closeForm()">Close</button></a>    </form>
    </div>

    <div class="form-popup" id="myForm">
    <form action="{{route('changeValidSize')}}" method="post" class="form-container">
        <h1>تغییر سایز مجاز</h1>
        @csrf
        <label for="validSize">سایز فایل مورد نظر را وارد کنید:</label>
        <input type="text" name="size" id="validSize" ><br><br>
        <button type="submit" class="btn">ثبت</button>
        <a href="{{route('home')}}"><button type="button" class="btn cancel" onclick="closeForm()">Close</button></a>
    </form>
    </div>
    </div>
@endsection
