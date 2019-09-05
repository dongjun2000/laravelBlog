@extends('layouts.main')

@section('content')
    <form action="{{route('user.update', $user)}}" method="post">
        @csrf @method('PUT')
        <div class="card">
            <div class="card-header">
                修改个人信息
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="email">邮箱</label>
                    <input disabled type="text" class="form-control" name="email" id="email" value="{{$user['email']}}">
                </div>
                <div class="form-group">
                    <label for="name">昵称</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{$user['name']}}">
                </div>
                <div class="form-group">
                    <label for="password">密码</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <div class="form-group">
                    <label for="password_confirmation">重复密码</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                </div>
            </div>
            <div class="card-footer text-muted">
                <button type="submit" class="btn btn-success">修改</button>
            </div>
        </div>
    </form>
@stop