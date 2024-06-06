@extends('layout')

@section('content')

<center>
   <div class="laundry-container-main">
    <img src="{{asset('assets/images/laundry-img2.jpg')}}" alt="Image Pro">
    <form action="/customers" method="POST" class="authentication-form-lgx">
        @csrf
        <h1>Laundry Management System</h1>
        <label for="">Name</label><br>
        <input type="text" name="name" id="" placeholder="Customer name"><br><br>
        <label for="">Email</label><br>
        <input type="email" name="email" id="" placeholder="Customer email"><br><br>
        <label for="">Address</label><br>
        <input type="text" name="address" id="" placeholder="Customer address/location"><br><br>
        <label for="">Phone Number</label><br>
        <input type="number" name="phone_number" id="" placeholder="Customer phone number"><br><br>
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
        <button type="submit">Register</button><br><br>
    </form>
   </div>
</center>
@endsection
