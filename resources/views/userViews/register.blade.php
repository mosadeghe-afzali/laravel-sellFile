@extends('master.master')
@section('cssStyle')
    <link rel="stylesheet" href="{{asset('css/form.css')}}"
@endsection
@section('content')
    <div class="form-popup" id="myForm">
    <form action="{{route('users.store')}}" method="post"  class="form-container">
        <h2>فرم ثبت نام</h2>
        @csrf
        <label for="name">نام</label><br>
        <input type="text" name="name" id="name"  minlength="3">
        <label for="email">ایمیل</label><br>
        <input type="text" name="email" id="email" required><br>
        <label for="un">نام کاربری </label><br>
        <input type="text" name="username" id="un" minlength="3" required><br><br>
        <label for="pass"> رمز عبور</label><br>
        <input type="text" name="password" id="pass" minlength="8" required><br><br>
        <label for="confpass"> تایید رمز عبور</label><br>
        <input type="text" name="password_confirmation" id="confpass" minlength="8" required><br><br>
        <button type="submit" class="btn">register</button>
        <a href="{{route('home')}}"><button type="button" class="btn cancel" onclick="closeForm()">Close</button></a>

    </form>
    </div>
@endsection
