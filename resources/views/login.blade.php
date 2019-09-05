@extends('layouts.main')

@section('content')
    <form action="{{route('login')}}" method="post">
        @csrf
        <div class="card">
            <div class="card-header">
                用户登录
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="email">邮箱：</label>
                    <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <label for="password">密码：</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
            </div>
            <div class="card-footer text-muted">
                <button type="submit" class="btn btn-success">登录</button>
                <a href="{{ route('findPassword') }}">找回密码</a>
            </div>
        </div>
    </form>
@stop