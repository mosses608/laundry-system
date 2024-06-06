@if (session()->has('user_deleted_message'))
<div class="show-flash-message">
    <p>{{session('user_deleted_message')}}</p>
</div>
@endif
