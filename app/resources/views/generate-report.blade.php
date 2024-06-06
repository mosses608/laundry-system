@extends('dashboard-layout')


@section('content')
<br><br>

@include('partials.side-menu')

<x-supply_created />

<center>
    <div class="admin-dashboard-container">
        <div class="filter-generate-report-lgx">
            <form action="/generate-report" method="GET" class="filter-data-generate-report">
                @csrf
                <input type="date" name="search" id="" class="current_all_date"><button type="submit" class="submit-data">Filter</button>
                <button type="button" class="print-report-doc"><i class="fa fa-print"></i> Print</button>
            </form><br><br>
            <hr><hr><hr><br>

            @if (count($laundries) == 0)
            <p>No laundry recorded yet...!</p>
            @else
            <table class="printable-table">
                <tr>
                    <th>Date</th>
                    <th>Customer Name</th>
                    <th>Total Amount</th>
                </tr>
                @foreach ($laundries as $laundry)
                <tr>
                    <td>{{$laundry->date}}</td>
                    <td>{{$laundry->customer_name}}</td>
                    <td>{{$laundry->price}}</td>
                </tr>
                @endforeach
            </table>
            @endif
        </div>
    </div>
    <script>
        const currentDateReport=new Date();
        const currentDateReportOption={weekly: 'long', year: 'numeric', month: 'long', day: 'numeric'};
        const formattedCurrentDateReport=currentDateReport.toLocaleDateString('en-US',currentDateReportOption);
        document.querySelector('.current_all_date').value=formattedCurrentDateReport;
        document.querySelector('.current_all_date').textContent=formattedCurrentDateReport;
    </script>

    <script>

    document.addEventListener('DOMContentLoaded', function () {
        // Add event listener to the print button
        document.querySelector('.print-report-doc').addEventListener('click', function () {
            // Select the content to be printed
            var contentToPrint = document.querySelector('.printable-table').innerHTML;

            //contentToPrint.style.border='2px solid #000';

            // Create a new window for printing
            var printWindow = window.open('', '_blank');

            // Write the content into the new window
            printWindow.document.write('<html><head><title></title></head><body>' + contentToPrint + '</body></html>');

            // Close the document after printing
            printWindow.document.close();

            // Initiate printing
            printWindow.print();
        });
    });
    </script>

</center>


@endsection
