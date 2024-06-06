@extends('dashboard-layout')


@section('content')
<br><br>

@include('partials.side-menu')

<x-updated_message />

<center>
    <div class="admin-dashboard-container">
        <div class="ajax-logg-user-mgt">
            <h1>Update User</h1><br><br><hr><hr><hr><br>

            <table>
                <tr>
                    <th>S/N</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Username</th>
                    <th>Action</th>
                </tr>
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->role}}</td>
                    <td>{{$user->username}}</td>
                    <td><button class="edit-form-data"><i class="fa fa-edit"></i></button>
                        <form action="/users/delete/{{$user->id}}" method="POST" class="delete-data-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="submit-delet-button"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            </table>
        </div>

        <form action="/users/edit/{{$user->id}}" method="POST" class="register-new-user-form">
            @csrf
            @method('PUT')
            <h1>Update User</h1><br><br><hr><hr><hr><br>
            <label for="">Name</label><br>
            <input type="text" name="name" id="" value="{{$user->name}}"><br><br>
            <label for="">Username</label><br>
            <input type="text" name="username" id="" value="{{$user->username}}"><br><br>
            <label for="">Password</label><br>
            <input type="password" name="password" id="" value="{{$user->password}}"><br><br>
            <label for="">User Role</label><br>
            <select name="role" id="">
                <option value="{{$user->role}}">{{$user->role}}</option>
                <option value="Staff">Staff</option>
                <option value="Admin">Admin</option>
            </select><br><br>
            <button type="submit">Submit</button> <button type="button" onclick="closeForm()" style="background-color:#333;">Close</button>
            <br><br>
        </form>
    </div>

    <script>
        document.querySelector('.edit-form-data').addEventListener('click', function(){
            document.querySelector('.register-new-user-form').classList.toggle('activated');
        });

        function closeForm(){
            location.reload();
        }
    </script>
</center>


@endsection
