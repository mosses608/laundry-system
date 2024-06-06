@extends('customers.customer-layout')

@section('content')
<br><br>
@include('partials.customer-navbar')


<center>
    <div class="admin-dashboard-container">
        <div class="laundry-management-list">

            <form action="/customers/order-history" method="GET" class="search-single-laundry-comp">
                @csrf
                <input type="text" name="search" id="" placeholder="Search a laundry"><button type="submit"><i class="fa fa-search"></i></button>
            </form><br>
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
                </tr>

                @foreach ($laundries as $laundry)

                @if (Auth::guard('customer')->user()->name == $laundry->customer_name)

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
                </tr>

                @endif
                @endforeach


            </table>

            @endif

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
