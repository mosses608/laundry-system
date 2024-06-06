@if (session()->has('laundry_recorded'))
<div class="show-flash-message">
    <p>{{session('laundry_recorded')}}</p>
</div>
@endif
