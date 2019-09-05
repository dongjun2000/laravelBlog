@extends('layouts.main')

@section('content')
    <form action="{{ route('resetPasswordStore') }}" method="post">
        @csrf
        <input type="hidden" name="email_token" value="{{$user['email_token']}}">
        <div class="card">
            <div class="card-header">
                重置密码
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="email">邮箱</label>
                    <input disabled type="text"
                           class="form-control" name="email" id="email" value="{{$user['email']}}">
                </div>
                <div class="form-group">
                    <label for="password">密码</label>
                    <input type="password"
                           class="form-control" name="password" id="password">
                </div>
                <div class="form-group">
                    <label for="password_confirmation">确认密码</label>
                    <input type="password"
                           class="form-control" name="password_confirmation" id="password_confirmation">
                </div>
            </div>
            <div class="card-footer text-muted">
                <button type="submit" class="btn btn-primary">提交</button>
            </div>
        </div>
    </form>
@stop