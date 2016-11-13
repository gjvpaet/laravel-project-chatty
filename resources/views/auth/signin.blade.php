@extends('templates.default')

@section('content')
    <h3>Sign In</h3>
    <div class="row">
        <div class="col-lg-6">
            <form action="{{ route('auth.signin') }}" class="form-verical" method="post" role="form">
                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="email" class="control-label">Email</label>
                    <input type="text" class="form-control" name="email" id="email" value="{{ Request::old('email') ?: '' }}">
                    @if($errors->has('email'))
                        <span class="help-block">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
                    <label for="password" class="control-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                    @if($errors->has('password'))
                        <span class="help-block">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember"> Remember Me
                    </label>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-default">Sign In</button>
                </div>
                {{ csrf_field() }}
            </form>
        </div>
    </div>
@endsection