@extends('layouts.main')

@section('content')
    <form action="{{route('blog.store')}}" method="post">
        @csrf
        <div class="card">
            <div class="card-header">
                发表博客
            </div>
            <div class="card-body">
                <div class="form-group">
                    @auth
                        <textarea class="form-control" name="content" id="content" rows="3"
                                  style="resize: none"></textarea>
                    @else
                        <textarea disabled class="form-control" name="content" id="content" rows="3"
                                  style="resize: none"></textarea>
                    @endauth
                </div>
            </div>
            <div class="card-footer text-muted text-right">
                @auth
                    <button class="btn btn-primary btn-sm">发表</button>
                @else
                    <a href="{{route('login')}}" class="btn btn-primary btn-sm">请先登录</a>
                @endauth
            </div>
        </div>
    </form>

    <div class="card mt-2">
        <div class="card-header">
            博客列表
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>博客</th>
                    <th>用户</th>
                    <th width="150px">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($blogs as $blog)
                    <tr>
                        <td scope="row">{{$blog['id']}}</td>
                        <td>{{$blog['content']}}</td>
                        <td>{{$blog->user->name}}</td>
                        <td></td>
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