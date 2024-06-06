@extends('dashboard-layout')

@section('content')
<br><br>

@include('partials.side-menu')

<x-news_posted />

<center>
    <div class="admin-dashboard-container">
        <form action="/updates" method="POST" class="post-news-form-lgx">
            @csrf
            <label for="">News Title</label><br>
            <input type="text" name="title" id="" placeholder="News Title"><br><br>
            <label for="">News Content</label><br>
            <textarea name="content" id="" placeholder="News Contents"></textarea><br><br>
            <button type="submit"><i class="fa fa-paper-plane"></i> Send News</button><br><br>
        </form>
    </div>
</center>
@endsection
