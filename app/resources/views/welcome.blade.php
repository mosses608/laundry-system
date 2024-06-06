@extends('layout')

@section('content')

<x-error_message />

<x-logout_message />

<center>
   <div class="laundry-container-main">
    <img src="{{asset('assets/images/laundry-img2.jpg')}}" alt="Image Pro">
    <form action="/authenticate" method="POST" class="authentication-form">
        @csrf
        <h1>Laundry Management System</h1>
        <label for="">Username</label><br>
        <input type="text" name="username" id="" placeholder="Enter username" value="{{old('username')}}"><br>
        @error('username')
            <span>Username is required!</span>
        @enderror
        <br>
        <label for="">Password</label><br>
        <input type="password" name="password" id="" placeholder="Enter password"><br>
        @error('password')
            <span>Password is required!</span>
        @enderror
        <br>
        <button type="submit"><i class="fa fa-sign-in"></i> Login</button>
        <p>New Customer?<a href="/register"> Register</a></p><br><br>
    </form>
   </div>
</center>
@endsection
