@extends('customers.customer-layout')

@section('content')
<br><br>
@include('partials.customer-navbar')


<center>
    <div class="admin-dashboard-container">
        <div class="child-component-clax">
            <div class="head-component">
                <h1>Welcome back {{Auth::guard('customer')->user()->name}}</h1>
                <h2>Role: Customer</h2>
            </div>
            <br><br><hr style="border: 2px solid #999;">
           <br>

           <div class="customer-side-component" style="margin-left: 15%;">
            <p><i class="fas fa-shopping-cart"></i> My Orders</p><br><hr style="border: 1px solid #555;">
            <br id="breake">
            <p>
                @foreach ($laundries as $laundry)
                @if ($laundry->customer_name == Auth::guard('customer')->user()->name)
                {{count($laundries)}}
                @endif
                @endforeach
            </p>
           </div>
           <div class="total-claimed-laund">
            <p><i class="fa fa-tasks"></i> My Claimed Laundry</p><br><hr style="border: 1px solid #555;">
            <br id="breake">
            <p>0</p>
           </div><br><br><br><br><br><br>
        </div><br>
        <div class="updates-class-container">
            @if(count($updates) == 0)
            <p>No news updated here!</p>
            @else
            <h1 class="news-title-head">News Updates</h1><br>
            <div class="slide-text-content">
            @foreach ($updates as $update)

                <div class="main-news-builder">
                    <h1>Title: {{$update->title}}</h1><br>
                    <p><strong>Content:</strong> {{$update->content}} <span>{{$update->created_at}}</span></p>
                </div>

            @endforeach

        </div>
            @endif

           </div>
    </div>

    <script>
        const textSlider=document.querySelectorAll('.slide-text-content div');
        const intervalTime=10000;
        let initialSlide=0;

        function showNextTextContent(){
            textSlider[initialSlide].style.display='none';
            initialSlide++;

            if(initialSlide>=textSlider.length){
                initialSlide=0;
            }

            textSlider[initialSlide].style.display='block';
        }

        setInterval(showNextTextContent,intervalTime);
    </script>
</center>

@endsection
