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
                            <a href="" class="btn btn-success">查看</a>
                            <a href="" class="btn btn-danger">删除</a>
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