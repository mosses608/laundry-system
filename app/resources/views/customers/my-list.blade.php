@extends('customers.customer-layout')

@section('content')
<br><br>

@include('partials.customer-navbar')

<x-update_message />

<center>
    <div class="admin-dashboard-container">
        <div class="laundry-management-list">
            <h1>Laundry Record Management</h1>
            <hr><hr><hr><br>
            <table>
                <tr class="head-tr">
                    <th>Date</th>
                    <th>Customer</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Category</th>
                    <th>Quantity</th>
                    <th>Weight(Kg)</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>

                <tr>
                    <td>{{$laundry->date}}</td>
                    <td>{{$laundry->customer_name}}</td>
                    <td>{{$laundry->phone_number}}</td>
                    <td>{{$laundry->address}}</td>
                    <td>{{$laundry->category}}</td>
                    <td>{{$laundry->que_number}}</td>
                    @if ($laundry->weight == "")
                    <td>Unconfrimed</td>
                    @else
                    <td>{{$laundry->weight}}</td>
                    @endif
                    <td>Tsh {{$laundry->price * $laundry->weight}}.00</td>
                    @if ($laundry->status == "")
                    <td><button class="pending-button-view">Pending...</button></td>
                    @else
                    <td><button class="claimed-button-view">Claimed...</button></td>
                    @endif
                    <td>
                        <button class="edit-action" onclick="showEditForm()" type="button"><i class="fas fa-edit"></i></button>

                        <form action="/laundries/my_laundry/{{$laundry->id}}" method="POST" class="edit-laundry-details">
                            @csrf
                            @method('PUT')
                            <h1>Update Laundry Records</h1>

                            <div class="left-side-panel-x">
                            <label for="">Due Date</label><br>
                            <input type="text" name="date" id="" class="date-child-ch" value="{{$laundry->date}}"><br><br>
                            <label for="">Customer Name</label><br>
                            <input type="text" name="customer_name" id="" placeholder="Enter customer name" value="{{$laundry->customer_name}}"><br><br>

                            <label for="">Phone Number</label><br>
                            <input type="number" name="phone_number" id="" placeholder="Enter customer number" value="{{$laundry->phone_number}}"><br><br>

                            <label for="">Customer Address</label><br>
                            <input type="text" name="address" id="" placeholder="Enter customer address" value="{{$laundry->address}}"><br><br>
                            </div>

                            <div class="right-side-panel-x">
                            <label for="">Laundry Category</label><br>
                            <select name="category" id="">
                                <option value="{{$laundry->category}}">{{$laundry->category}}</option>
                                @foreach ($categories as $catego)
                                <option value="{{$catego->category}}">{{$catego->category}}</option>
                                @endforeach
                            </select><br><br>

                            <label for="">Quantity</label><br>
                            <input type="number" name="que_number" id="" value="{{$laundry->que_number}}"><br><br>

                            <button type="submit">Update Records</button><br><br>
                            </div>
                        </form>
                        <form action="/delete/{{$laundry->id}}" method="POST" class="erase-data-component">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-earase"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>

            </table>

        </div>
    </div>

    <script>
        const currentDate=new Date();
        const dateOption={weekly: 'long', year: 'numeric', month: 'long', day: 'numeric'};
        const formattedDate=currentDate.toLocaleDateString('en-US',dateOption);
        document.querySelector('.date-child').value=formattedDate;

        document.querySelector('.manage-laundry-button').addEventListener('click', function(){
    document.querySelector('.add-laundry-new-data').classList.toggle('activated');
});

function showEditForm(){
    document.querySelector('.edit-laundry-details').classList.toggle('activated');
}
    </script>
</center>
@endsection
