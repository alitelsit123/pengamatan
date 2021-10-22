@extends('layouts.auth')
@section('page')
<div class="form-header">
    <h1>Siteawos</h1>
    <h2>Forgot Password</h2>
    <p>Hubungi admin untuk mendaftar akun atau permintaan lupa password</p>
</div>
<form>
    <div class="form-group">
        <button type="button" onclick="window.location.href='https://api.whatsapp.com/send?phone=6282229402603&text='">Whatsapp</button>
    </div>
    <div class="form-group">
        <button type="button" onclick="window.location.href='https://www.facebook.com/Elyas09/'">Facebook</button>
    </div>
    <div class="form-group">
        <button type="button" onclick="window.location.href='https://www.instagram.com/elyas_stwnn/?hl=en'">Instagram</button>
    </div>
    <div class="form-group">
        <a href="{{ url('/login') }}" class="form-recovery">Back to login menu</a>
    </div>
</form>    
@endsection