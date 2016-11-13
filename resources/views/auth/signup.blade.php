@extends('templates.default')

@section('content')
    <h3>Sign Up</h3>
    <div class="row">
        <div class="col-lg-6">
            <form action="{{ route('auth.signup') }}" class="form-vertical" method="post">
                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="email" class="control-label">Your Email Address</label>
                    <input type="text" class="form-control" name="email" id="email" value="{{ Request::old('email') ?: '' }}">
                    @if($errors->has('email'))
                        <span class="help-block">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                    <label for="username" class="control-label">Choose a Username</label>
                    <input type="text" class="form-control" name="username" id="username" value="{{ Request::old('username') ?: '' }}">
                    @if($errors->has('username'))
                        <span class="help-block">{{ $errors->first('username') }}</span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                    <label for="password" class="control-label">Choose a Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                    @if($errors->has('password'))
                        <span class="help-block">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <button class="btn btn-default" type="submit">Sign up</button>
                </div>
                {{ csrf_field() }}
            </form>
        </div>
    </div>
@stop