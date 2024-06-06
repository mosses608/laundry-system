@if (session()->has('updated_message'))
<div class="show-flash-message">
    <p>{{session('updated_message')}}</p>
</div>
@endif
