@extends('dashboard-layout')


@section('content')
<br><br>

@include('partials.side-menu')

<x-sucess_message />

<x-user_deleted_message />

<center>
    <div class="admin-dashboard-container">
        <div class="ajax-logg-user-mgt">
            <h1>User Management</h1>
            <button class="user-management-button"><i class="fa fa-plus"></i> New User</button><br><br><hr><hr><hr><br>

            @if (count($users) == 0)
            <p>No user registered yet...!</p>

            @else

            <table>
                <tr>
                    <th>S/N</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Username</th>
                    <th>Action</th>
                </tr>
                @foreach ($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->role}}</td>
                    <td>{{$user->username}}</td>
                    <td><a href="/view-actions/{{$user->id}}"><i class="fa fa-eye"></i></a></td>
                </tr>
                @endforeach
            </table>
            @endif
        </div>

        <form action="/users" method="POST" class="register-new-user-form">
            @csrf
            <h1>New User</h1><br><br><hr><hr><hr><br>
            <label for="">Name</label><br>
            <input type="text" name="name" id="" placeholder="Name" value="{{old('name')}}"><br><br>
            <label for="">Username</label><br>
            <input type="text" name="username" id="" placeholder="Username" value="{{old('username')}}"><br><br>
            <label for="">Password</label><br>
            <input type="password" name="password" id="" placeholder="Password" value="{{old('password')}}"><br><br>
            <label for="">User Role</label><br>
            <select name="role" id="">
                <option value="//">Choose role</option>
                <option value="Staff">Staff</option>
                <option value="Admin">Admin</option>
            </select><br><br>
            <button type="submit">Submit</button><br><br>
        </form>
    </div>

    <script>
        document.querySelector('.user-management-button').addEventListener('click', function(){
            document.querySelector('.register-new-user-form').classList.toggle('activated');
        });
    </script>
</center>


@endsection
