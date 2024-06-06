@if (session()->has('supply_created'))
<div class="show-flash-message">
    <p>{{session('supply_created')}}</p>
</div>
@endif
