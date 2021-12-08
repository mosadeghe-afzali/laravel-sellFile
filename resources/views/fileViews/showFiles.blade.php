@extends('master.master')
@section('cssStyle')
    <link rel="stylesheet" href="{{asset('css/tables.css')}}"
    @endsection
@section('content')

<table>
    <tr>
    <th>لینک</th>
    <th>اظلعات فایل</th>
    <th>اطلاعات کاربر</th>
    </tr>
    @foreach($files as $file)
    <tr>
            <td> <a href="{{$file->link}}"><div>{{$file->link}}</div></a></div></td>
            <td> <a href="{{route('files.show', [$file->id] )}}" ><input  type="button" name="fileData" value="display file"></a></td>
            <td> @if($file->is_guest == 0)
                    <a href="{{route('users.show' , [$file->user_id] )}}" ><input  type="button" name="userData" value="display user"></a>
                    @else {{"کاربر مهمان"}}  @endif</td>
    </tr>
    @endforeach
</table><br><br>

<a href="{{route('home')}}"><button style="margin-right: 1200px;" onclick="closeForm()">بازگشت</button></a>

@endsection
