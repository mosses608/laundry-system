@if (session()->has('logout_message'))
<div class="show-flash-message" style="background-color: red;">
    <p style="color: #FFFFFF;">{{session('logout_message')}}</p>
</div>
@endif
