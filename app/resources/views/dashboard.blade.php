@extends('dashboard-layout')

@section('content')
<br><br>

@include('partials.side-menu')

<x-login_success />

<center>
    <div class="admin-dashboard-container">
        <div class="child-component-clax">
            <div class="head-component">
                <h1>Welcome back {{Auth::guard('web')->user()->name}}</h1>
                <h2>Role: {{Auth::guard('web')->user()->role}}</h2>
            </div>
           <br><br><hr style="border: 2px solid #999;">
           <br>
           <div class="profit-side-component">
            <p><i class="fa fa-dollar"></i> Total Profit Today</p><br><hr style="border: 1px solid #555;">
            <br id="breake">
            <p>Tsh 0.00</p>
           </div>
           <div class="customer-side-component">
            <p><i class="fas fa-user-tie"></i> Total Customer Today</p><br><hr style="border: 1px solid #555;">
            <br id="breake">
            <p>{{count($laundries)}}</p>
           </div>
           <div class="total-claimed-laund">
            <p><i class="fa fa-tasks"></i> Total Claimed Laundry Today</p><br><hr style="border: 1px solid #555;">
            <br id="breake">
            <p>{{count($laundries)}}</p>
           </div><br><br><br><br><br><br>
        </div>
<br>
        <div class="graphical-analytical-data">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>


        <canvas id="lineChart"></canvas>

        <style>
            /* CSS for responsive container */
            @media(max-width:768px){
                #lineChart {
                width: 100%;
                max-width: 800px; /* Optional: Limit maximum width of the chart */
                margin: 0 auto; /* Center the container */
            }
            }
        </style>

    <script>
        var ctx = document.getElementById('lineChart').getContext('2d');
        var lineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Total Customers',
                    data: <?php echo json_encode($data); ?>,
                    borderColor: 'blue',
                    backgroundColor: 'rgba(0, 0, 255, 0.3)'
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                animation: {
                    duration: 2000, // Set animation duration in milliseconds
                    easing: 'easeInOutQuart', // Set animation easing function
                },
                elements: {
                    line: {
                        tension: 0.4 // Set line tension to curve the line
                    }
                },

            }
        });
    </script>
        </div>
    </div>
</center>
@endsection
