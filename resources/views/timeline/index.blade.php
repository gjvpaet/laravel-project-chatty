@extends('templates.default')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <form action="{{ route('status.post') }}" method="post" role="form">
                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                    <textarea name="status" rows="2" class="form-control" placeholder="What's up {{ Auth::user()->getFirstNameOrUsername() }}?"></textarea>
                    @if($errors->has('status'))
                        <span class="help-block">{{ $errors->first() }}</span>
                    @endif
                </div>
                <button type="submit" class="btn btn-default">Update Status</button>
                {{ csrf_field() }}
            </form>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-5">
            @if(!$statuses->count())
                <p>There's nothing in your timeline, yet.</p>
            @else
                @foreach($statuses as $status)
                    <div class="media">
                        <a href="{{ route('profile.index', ['username' => $status->user->username]) }}" class="pull-left">
                            <img src="{{ $status->user->getAvatarUrl() }}" alt="{{ $status->user->getNameOrUsername() }}" class="media-object">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><a href="{{ route('profile.index', ['username' => $status->user->username]) }}">{{ $status->user->getNameOrUsername() }}</a></h4>
                            <p>{{ $status->body }}</p>
                            <ul class="list-inline">
                                <li>{{ $status->created_at->diffForHumans() }}</li>
                                @if($status->user->id !== Auth::user()->id)
                                    <li><a href="{{ route('status.like', ['statusId' => $status->id]) }}">Like</a></li>
                                @endif
                                <li>{{ $status->likes->count() }} {{ str_plural('like', $status->likes->count()) }}</li>
                            </ul>
                            @foreach($status->replies as $reply)
                                <div class="media">
                                    <a href="{{ route('profile.index', ['username' => $reply->user->username]) }}" class="pull-left">
                                        <img src="{{ $reply->user->getAvatarUrl() }}" alt="{{ $reply->user->getNameOrUsername() }}" class="media-object">
                                    </a>
                                    <div class="media-body">
                                        <h5 class="media-heading"><a href="{{ route('profile.index', ['username' => $reply->user->username]) }}">{{ $reply->user->getNameOrUsername() }}</a></h5>
                                        <p>{{ $reply->body }}</p>
                                        <ul class="list-inline">
                                            <li>{{ $reply->created_at->diffForHumans() }}</li>
                                            @if($reply->user->id !== Auth::user()->id)
                                                <li><a href="{{ route('status.like', ['statusId' => $reply->id]) }}">Like</a></li>  
                                            @endif
                                            <li>{{ $reply->likes->count() }} {{ str_plural('like', $reply->likes->count()) }}</li>  
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                            <form action="{{ route('status.reply', ['statusId' => $status->id]) }}" role="form" method="post">
                                <div class="form-group {{ $errors->has("reply-{$status->id}") ? 'has-error' : '' }}">
                                    <textarea name="reply-{{ $status->id }}" rows="2" class="form-control" placeholder="Reply to this status"></textarea>
                                    @if($errors->has("reply-{$status->id}"))
                                        <span class="help-block">{{ $errors->first("reply-{$status->id}") }}</span>
                                    @endif
                                </div>
                                <input type="submit" value="Reply" class="btn btn-default btn-sm">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                @endforeach
                {!! $statuses->render() !!}
            @endif
        </div>
    </div>
@endsection