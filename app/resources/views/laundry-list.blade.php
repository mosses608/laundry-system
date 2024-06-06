@extends('dashboard-layout')


@section('content')
<br><br>

@include('partials.side-menu')

<x-laundry_recorded />

<x-update_message />

<x-record_deleted />

<center>
    <div class="admin-dashboard-container">
        <div class="laundry-management-list">

            <form action="/laundry-list" method="GET" class="search-single-laundry-comp">
                @csrf
                <input type="text" name="search" id="" placeholder="Search a laundry"><button type="submit"><i class="fa fa-search"></i></button>
            </form>
            <button type="button" class="manage-laundry-button"><i class="fa fa-plus"></i> <span class="value-holder">New Laundry</span></button><br>
            <br><hr><hr><hr><br>

            @if (count($laundries) == 0)
            <p>No laundry records submitted yet!</p>

            @else

            <table>
                <tr class="head-tr">
                    <th>Date</th>
                    <th>Customer</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Category</th>
                    <th>Quantity</th>
                    <th>Weight(Kg)</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>

                @foreach ($laundries as $laundry)
                <tr>
                    <td>{{$laundry->date}}</td>
                    <td>{{$laundry->customer_name}}</td>
                    <td>{{$laundry->phone_number}}</td>
                    <td>{{$laundry->address}}</td>
                    <td>{{$laundry->category}}</td>
                    <td>{{$laundry->que_number}}</td>
                    @if ($laundry->weight == "")
                    <td>Unconfirmed</td>
                    @else
                    <td>{{$laundry->weight}}</td>
                    @endif
                    @if ($laundry->status == "")
                    <td><button class="pending-button-view">Pending...</button></td>
                    @else
                    <td><button class="claimed-button-view">Claimed...</button></td>
                    @endif
                    <td>
                        <a href="/single-list/{{$laundry->id}}"><i class="fa fa-eye" style="color: #0000FF;"></i></a>
                    </td>
                </tr>
                @endforeach


            </table>

            @endif



            <form action="/laundries" method="POST" class="add-laundry-new-data">
                @csrf
                <p>Add New Laundry</p>
                <input type="hidden" name="date" id="" class="date-child">
                <input type="hidden" name="price" id="" value="5000.00">

                <div class="left-side-panel-x">
                <label for="">Customer Name</label><br>
                <input type="text" name="customer_name" id="" placeholder="Enter customer name" value="{{old('customer_name')}}"><br><br>

                <label for="">Phone Number</label><br>
                <input type="number" name="phone_number" id="" placeholder="Enter customer number" value="{{old('phone_number')}}"><br><br>

                <label for="">Customer Address</label><br>
                <input type="text" name="address" id="" placeholder="Enter customer address" value="{{old('address')}}"><br><br>

                </div>

                <div class="right-side-panel-x">
                <label for="">Laundry Category</label><br>
                <select name="category" id="">
                    <option value="//">Choose Category</option>
                    @foreach ($categories as $category)
                    <option value="{{$category->category}}">{{$category->category}}</option>
                    @endforeach
                </select><br><br>

                <label for="">Weight (Kg)</label><br>
                <input type="number" name="weight" id="" placeholder="Laundry weight"><br><br>

                <label for="">Quantity</label><br>
                <input type="number" name="que_number" id="" placeholder="Que number"><br><br>

                <button type="submit">Submit Laundry</button><br><br>
                </div>
            </form>

            <br>
            <div class="paginate-link-builder">
                {{$laundries->links()}}
            </div>
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
