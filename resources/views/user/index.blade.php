@extends('layouts.main')

@section('content')
    <div class="card">
        <div class="card-header">
            用户列表
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>昵称</th>
                    <th>邮箱</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td scope="row">{{$user['id']}}</td>
                        <td>{{$user['name']}}</td>
                        <td>{{$user['email']}}</td>
                        <td>
                            <a href="{{route('user.show', $user)}}" class="btn btn-success btn-sm">查看</a>
                            <a href="{{route('user.edit', $user)}}" class="btn btn-success btn-sm">修改</a>
                            <a href="" class="btn btn-danger btn-sm">删除</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer text-muted">
            {{$users->links()}}
        </div>
    </div>
@stop