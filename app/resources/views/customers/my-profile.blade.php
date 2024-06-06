@extends('customers.customer-layout')

@section('content')
<br><br>
@include('partials.customer-navbar')


<center>
    <div class="admin-dashboard-container">
        <div class="main-container-profile-builder">
            <h1>My Profile</h1>
            <p>Name: {{Auth::guard('customer')->user()->name}}</p><br><br>
            <p>Email: {{Auth::guard('customer')->user()->email}}</p><br><br>
            <p>Phone Number: {{Auth::guard('customer')->user()->phone_number}}</p><br><br>
            <p>Address: {{Auth::guard('customer')->user()->address}}</p><br><br>
            <p>Username: {{Auth::guard('customer')->user()->username}}</p><br><br>
            <button class="edit-formy-data" onclick="showEditForm()"><i class="fa fa-edit"></i> Edit</button><br><br>
        </div>

        <form action="/customers/editdata/{{Auth::guard('customer')->user()->id}}" method="POST" class="edit-formy-data-builder">
            @csrf
            @method('PUT')
            <label for="">Name</label><br>
        <input type="text" name="name" id=""  value="{{Auth::guard('customer')->user()->name}}"><br><br>
        <label for="">Email</label><br>
        <input type="email" name="email" id=""  value="{{Auth::guard('customer')->user()->email}}"><br><br>
        <label for="">Address</label><br>
        <input type="text" name="address" id=""  value="{{Auth::guard('customer')->user()->address}}"><br><br>
        <label for="">Phone Number</label><br>
        <input type="number" name="phone_number" id=""  value="{{Auth::guard('customer')->user()->phone_number}}"><br><br>
        <label for="">Username</label><br>
        <input type="text" name="username" id=""  value="{{Auth::guard('customer')->user()->username}}"><br><br>
        <label for="">Password</label><br>
        <input type="password" name="password" id="" value="{{Auth::guard('customer')->user()->password}}"><br>
        <br>
        <button type="submit">Register</button>
        <button type="button" class="close-form-button" style="float: right; background-color:#444;color:#FFFFFF;" onclick="closeForm()">Close</button>
        <br><br>
        </form>
    </div>
    <script>
        function showEditForm(){
            document.querySelector('.edit-formy-data-builder').style.display='block';
        }
        function closeForm(){
            document.querySelector('.edit-formy-data-builder').style.display='none';
            location.reload();
        }
    </script>
</center>

@endsection
