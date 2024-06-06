@if (session()->has('news_posted'))
<div class="show-flash-message">
    <p>{{session('news_posted')}}</p>
</div>
@endif
