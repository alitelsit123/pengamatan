@extends('layouts.auth')

@section('page')
<div class="form-header">
    <h1>Siteawos</h1>
    <h2>Sign in</h2>
    <p>Sign in for access simoawos</p>
</div>
<form method="post" action="{{ url('/login') }}">
    @csrf
    <div class="form-group">
        <input type="text" name="username" placeholder="login" required="required"/> 
    </div>
    <div class="form-group">
        <input type="password" name="password" placeholder="password" required="required"/> 
    </div>
    @error('login')
    <div class="form-group" style="justify-content: center">
        <a class="form-recovery">{{ $message }}</a>
    </div>
    @enderror
    <div class="form-group">
        <input type="checkbox" name="remember" id="cbx" class="inp-cbx" style="display: none;"/> 
        <label class="cbx" for="cbx">
            <span>
                <svg width="12px" height="10px" viewbox="0 0 12 10">
                    <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                </svg>
            </span>
            <span>Remember me</span>
        </label>
        <a href="{{ url('/forget') }}" class="form-recovery">Forget password</a>
    </div>

    <div class="form-group">
        <button type="submit">Log In</button>
    </div>
</form>
@endsection