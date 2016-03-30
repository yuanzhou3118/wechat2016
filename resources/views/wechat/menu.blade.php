@extends('master')

@section('title', '欢迎')

@section('content')

    <form action="{{URL::route('wechat.menu.edit')}}" method="post">
        {{csrf_field()}}
        <input type="submit" value="submit">
    </form>
@endsection
