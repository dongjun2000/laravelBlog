@foreach(['success', 'danger', 'info', 'warning'] as $message)
    @if (session($message))
        <div class="alert alert-dismissible alert-{{$message}}" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>{{session($message)}}</strong>
        </div>
    @endif
@endforeach