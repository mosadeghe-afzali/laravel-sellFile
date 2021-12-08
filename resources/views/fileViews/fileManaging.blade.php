@extends('master.master')
@section('cssStyle')

@endsection

@section('content')

    <table>
        <tr>
            <th>نام فایل</th>
            <th>عملیات</th>
        </tr>
        @foreach($files as $file)

            <tr>
                <td>{{$file->file_name}}</td>
                <td><form action="{{route('files.edit', [$file->id])}}" method="get">
                        @csrf
                        <input type="submit" name="submit" value="submit">
                    </form></td>
                <td><form action="{{route('files.destroy', [$file->id])}}" method="post">
                        @csrf
                        @method('delete')
                        <input type="submit" name="submit" value="delete">
                    </form></td>
            </tr>
        @endforeach

    </table<br><br>
    <a href="{{route('home')}}"><button style="margin-right: 1200px;" onclick="closeForm()">بازگشت</button></a>

@endsection
