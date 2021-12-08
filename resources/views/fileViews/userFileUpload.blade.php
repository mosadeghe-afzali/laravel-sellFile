@extends('master.master')
@section('cssStyle')
    <link rel="stylesheet" href="{{asset('css/form.css')}}"
@endsection
@section('content')
    <div class="form-popup" id="myForm">
    <form action="{{route('files.store')}}" method="post" enctype="multipart/form-data" class="form-container">
        @csrf
        <label>انتخاب فایل:</label><br>
        <input type="file" name="file_name"><br><br>
        <label>قیمت پیشنهادی:</label><br>
        <input type="number" name="price"><br><br>
        <label>توضیحات:</label><br>
        <input type="text" name="description"><br><br>
        <button type="submit" class="btn">Login</button>
        <a href="{{route('home')}}"><button type="button" class="btn cancel" onclick="closeForm()">Close</button></a>    </form>
    </div>
    @endsection


