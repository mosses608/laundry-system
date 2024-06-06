@extends('dashboard-layout')


@section('content')
<br><br>

@include('partials.side-menu')

<x-category_created />

<center>
    <div class="admin-dashboard-container">
        <form action="/categories" method="POST" class="laundry-category-form">
            @csrf
            <p>Laundry Category</p><br><hr><hr><hr><br>
            <label for="">Category</label><br><br>
            <textarea name="category" id="" placeholder="Laundry category"></textarea><br><br>
            <label for="">Price per 1Kg</label><br><br>
            <input type="number" name="price" id="" placeholder="Price"><br><br>
            <button type="submit">Submit</button><br><br>
        </form>

        <div class="laundry-category-list">
            <table>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>

            @foreach ($categories as $category)
            <tr>
                <td>{{$category->id}}</td>
                <td>Name:{{$category->category}} <br> Price: {{$category->price}}</td>
                <td>
                    <button class="edit-button-action"><i class="fa fa-edit"></i> Edit</button>
                    <form action="/deletecategory/{{$category->id}}" method="POST" class="delete-form-data">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="erase-button-action"><i class="fas fa-trash-alt"></i> Erase</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>

        </div>
    </div>
</center>


@endsection
