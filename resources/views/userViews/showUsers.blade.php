@extends('master.master')
@section('content')
    <table>
        <tr>
            <th>نام کاربری</th>
            <th>عملیات</th>
        </tr>
        @foreach($users as $user)

            <tr>
                <td>{{$user->username}}</td>
                <td><form action="{{route('users.edit', [$user->id])}}" method="get">
                        @csrf
                        <input type="submit" name="submit" value="change level">
                    </form></td>
                <td><form action="{{route('users.destroy', [$user->id])}}" method="post">
                        @csrf
                        <input type="submit" name="submit" value="delete">
                    </form></td>
            </tr>
        @endforeach

    </table<br><br>
    <a href="{{route('home')}}"><button style="margin-right: 1200px;" onclick="closeForm()">بازگشت</button></a>

@endsection
