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
@stop