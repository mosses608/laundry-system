@if (session()->has('update_message'))
<div class="show-flash-message">
    <p>{{session('update_message')}}</p>
</div>
@endif
