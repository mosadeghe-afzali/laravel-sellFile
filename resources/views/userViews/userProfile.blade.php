@extends('master.master')
@section('cssStyle')
    <link rel="stylesheet" href="{{asset('css/tables.css')}}"
@endsection

@section('content')
<table>

    <tr>
        <th>username</th>
        <th>status</th>
        <th>file numbers</th>
    </tr>
    <tr>
        @foreach($user as $item)
        <td>@if(!empty($user)){{$item->username}}  @else {{'کاربر مهمان'}} @endif </td>
        <td>@if(!empty($user) && $item->deleted_at == null){{'فعال'}}@endif  </td>
        <td>@if(!empty($user) && $item->deleted_at == null){{$file}}@endif  </td>
        @endforeach




    </tr>
</table>
@endsection
