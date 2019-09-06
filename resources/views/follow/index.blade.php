@extends('layouts.main')

@section('content')
    <div class="card">
        <div class="card-header">
            {{ $title }}
        </div>
        <div class="card-body">
            <div class="list-group">
                @foreach($users as $user)
                    <a href="{{ route('user.show', $user) }}" class="list-group-item list-group-item-action">{{ $user->name }}</a>
                @endforeach
            </div>
        </div>
        <div class="card-footer text-muted">
            {{ $users->links() }}
        </div>
    </div>
@stop