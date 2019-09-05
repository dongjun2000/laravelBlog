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
                    <th width="200px">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td scope="row">{{$user['id']}}</td>
                        <td>{{$user['name']}}</td>
                        <td>{{$user['email']}}</td>
                        <td>
                            <a href="{{route('user.show', $user)}}" class="btn btn-success btn-sm float-left m-1">查看</a>
                            @can('update', $user)
                                <a href="{{route('user.edit', $user)}}"
                                   class="btn btn-primary btn-sm float-left m-1">修改</a>
                            @endcan

                            @can('delete', $user)
                                <form onsubmit="return confirm('确定删除吗？')" class="float-left m-1"
                                      action="{{route('user.destroy', $user)}}" method="post">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">删除</button>
                                </form>
                            @endcan
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