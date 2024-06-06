@if (session()->has('category_created'))
<div class="show-flash-message">
    <p>{{session('category_created')}}</p>
</div>
@endif
