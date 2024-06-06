@extends('dashboard-layout')


@section('content')
<br><br>

@include('partials.side-menu')

<x-supply_created />

<center>
    <div class="admin-dashboard-container">
        <div class="inventory-dashboard">
            <h1>Inventory</h1><br><br><hr><hr><hr><br>
            <form action="/inventory" method="GET" class="search-single-supply">
                @csrf
                <input type="text" name="search" id="" placeholder="Search"><button type="submit"><i class="fa fa-search"></i></button>
            </form><br><br>

            <p>No data found!</p>

        </div>
        <div class="inventory-in-out-manage">
            <p>Stock In/Out List</p>
            <button class="managem-inventory-supply">Manage Supply</button><br><br><hr><hr><hr>
            <div class="load-supply-component"><br>
                <form action="/inventory" method="GET" class="search-single-supply">
                    @csrf
                    <input type="text" name="search" id="" placeholder="Search"><button type="submit"><i class="fa fa-search"></i></button>
                </form><br><br>

                @if (count($supplies) == 0)
                <p>No supply history found!</p>
                @else

                <table>
                    <tr>
                        <th>Date</th>
                        <th>Supply Name</th>
                        <th>Quantity</th>
                        <th>Type</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($supplies as $supply)
                    <tr>
                        <td>{{$supply->date}}</td>
                        <td>{{$supply->supply_name}}</td>
                        <td>{{$supply->quantity}}</td>
                        <td>{{$supply->type}}</td>
                        <td><form action="/delete/supply/{{$supply->id}}" method="POST" class="delete-component-supply">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="color: maroon;"><i class="fas fa-trash"></i></button>
                        </form></td>
                    </tr>
                    @endforeach
                </table>

                @endif
                <br>
                <div class="paginate-link-builder">
                    {{$supplies->links()}}
                </div>

            </div>
            <br>
        </div>

        <form action="/supplies" method="POST" class="manage-supply-ajax">
            @csrf
            <h1>Manage Supply</h1><br><br><hr><hr>
            <input type="hidden" name="date" id="" class="current_Date">
            <label for="">Supply Name</label><br>
            <select name="supply_name" id="">
                <option value="//">Choose</option>
                <option value="Baking Soda">Baking Soda</option>
                <option value="Fabric Conditioner">Fabric Conditioner</option>
                <option value="Fabric Detergent">Fabric Detergent</option>
            </select><br><br>
            <label for="">Quantity</label><br>
            <input type="number" name="quantity" id="" value="1"><br><br>
            <label for="">Supply Type</label><br>
            <select name="type" id="">
                <option value="Stock In">Stock In</option>
                <option value="Stock Out (Use)">Stock Out (Use)</option>
            </select><br><br>
            <button type="submit">Submit</button><br><br>
        </form>
    </div>

    <script>
        const current_Date=new Date();
        const currentDateOption={weekly: 'long', year: 'numeric', month: 'long', day: 'numeric'};
        const FormattedDatee=current_Date.toLocaleDateString('en-US', currentDateOption);
        document.querySelector('.current_Date').value=FormattedDatee;
    </script>

    <script>
        document.querySelector('.managem-inventory-supply').addEventListener('click', function(){
            document.querySelector('.manage-supply-ajax').classList.toggle('activated');
            document.querySelector('.manage-supply-ajax').style.opacity='1';
        });
    </script>
</center>


@endsection
