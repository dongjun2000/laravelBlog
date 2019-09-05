@extends('layouts.main')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="text-center">{{$user['name']}}</h1>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>博客</th>
                    <th width="100px">用户</th>
                    <th width="150px">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($blogs as $blog)
                    <tr>
                        <td scope="row">{{$blog['id']}}</td>
                        <td>{{$blog['content']}}</td>
                        <td><a href="{{ route('user.show', $blog['user_id']) }}">{{$user['name']}}</a></td>
                        <td>
                            @can('delete', $blog)
                                <form onsubmit="return confirm('确定要删除吗？')" action="{{ route('blog.destroy', $blog) }}"
                                      method="post">
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
            {{ $blogs->links() }}
        </div>
    </div>
@stop