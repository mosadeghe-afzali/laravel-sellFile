@extends('master.master')
@section('cssStyle')
@endsection

@section('content')
    <form action="{{route('validStoreTime')}}">
        @csrf
        <label>مدت زمان مجاز را به ساعت وارد کنید:</label>
        <input type="number" name="time">
        <input type="submit" name="ثبت">
    </form>
@endsection
