@extends('layouts.main')

@section('content')
    <form action="{{route('user.store')}}" method="post">
        @csrf
        <div class="card">
            <div class="card-header">
                用户注册
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="name">昵称：</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label for="email">邮箱：</label>
                    <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <label for="password">密码：</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <div class="form-group">
                    <label for="password_confirmation">确认密码：</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                </div>
            </div>
            <div class="card-footer text-muted">
                <button type="submit" class="btn btn-success">注册</button>
            </div>
        </div>
    </form>
@stop