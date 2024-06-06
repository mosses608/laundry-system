@if (session()->has('record_deleted'))
<div class="show-flash-message">
    <p>{{session('record_deleted')}}</p>
</div>
@endif
