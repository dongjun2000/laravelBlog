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
                    <textarea class="form-control" name="content" id="content" rows="3" style="resize: none"></textarea>
                </div>
            </div>
            <div class="card-footer text-muted text-right">
                <button class="btn btn-primary btn-sm">发表</button>
            </div>
        </div>
    </form>
@stop