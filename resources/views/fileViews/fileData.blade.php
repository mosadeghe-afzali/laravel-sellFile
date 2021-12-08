@extends('master.master')

@section('cssStyle')
    <link rel="stylesheet" href="{{asset('css/tables.css')}}"
@endsection

@section('content')
    <table>
        <tr>
            <th>نام فایل</th>
            <th>نوع فایل</th>
            <th>اندازه فایل</th>
            <th>وضعیت</th>
        </tr>
        <tr>
            @foreach($file as $item)
            <td>{{$item->file_name}}</td>
            <td>{{$item->type}}</td>
            <td>{{$item->size}}</td>
            <td>{{'تایید شده'}}</td>
            @endforeach
        </tr>

    </table>
@endsection
