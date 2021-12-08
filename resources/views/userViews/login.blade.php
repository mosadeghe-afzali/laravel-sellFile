@extends('master.master')

@section('cssStyle')
    <link rel="stylesheet" href="{{asset('css/form.css')}}">
@endsection

@section('content')
<div class="form-popup" id="myForm">
    <form action="{{route('login')}}" class="form-container" method="post">
        <h1>فرم ورود</h1>
        @csrf

        <label for="username"><b>username</b></label>
        <input type="text" placeholder="Enter username" name="username" required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>

        <button type="submit" class="btn">Login</button>
      <a href="{{route('home')}}"><button type="button" class="btn cancel" onclick="closeForm()">Close</button></a>
    </form>
</div>
@endsection
@section('js')

@endsection

