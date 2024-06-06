@if (session()->has('login_success'))
<div class="show-flash-message">
    <p>{{session('login_success')}}</p>
</div>
@endif
