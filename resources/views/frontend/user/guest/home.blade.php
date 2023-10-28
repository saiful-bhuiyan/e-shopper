
@extends('frontend.layout.master')

@section('body')
<style>
    .guest-left-dashboard {
    box-shadow: 0px 1px 2px 1px #e5e5e5;
    margin-top: 20px;
    padding: 13px 0px;
}
.guest-menu li {
    list-style: none;
    display: block;
    padding: 10px 16px;
    border-bottom: 1px dashed lightgray;
}
.guest-menu li.active {
    border-left: 6px solid green;
    color: green !important;
    background : lightgray;
}

.guest-menu li.active>.guest-menu li a {
    color: black !important;
}
.guest-menu li a{
    text-decoration: none;
    color:  black;
}
.guest-dashboard-body {
    box-shadow: 0px 1px 1px 1px lightgray;
    margin-top: 19px;
}
.profile-header{
    border-bottom: 1px solid lightgray;
}
.inputBorder{
    border: 1px solid;
    padding: 5px;
}
.saveButton{
    margin-top: 30px;
}
</style>
        </div>
    </div>
</div>
<!-- Navbar End -->



<div class="row container-fluid">
    <div class="col-3">
        <div class="guest-left-dashboard">
            <div class="guest-header" style="text-align: center;">
                <img src="{{asset('backend')}}/img/guestUserImage/{{Auth::guard('guest')->user()->image}}" height="100px" width="100px" class="rounded-circle"><br>
                <b>{{Auth::guard('guest')->user()->first_name}} {{Auth::guard('guest')->user()->last_name}}</b><br>
                <span>{{Auth::guard('guest')->user()->mobile}}</span>
            </div>
            @component('components.guest_sidebar')

            @endcomponent
        </div>
    </div>

    <div class="col-9">
        <div class="guest-dashboard-body">
            <div class="profile-header text-center">
                <h2 class="font-weight-bold p-2">Profile</h2>
            </div>
            <form action="{{url('guest_user_update')}}" method="post" enctype="multipart/form-data">
            @csrf
                <div class="row profile-body form-group p-4">
                    <div class="col-lg-4 p-2">
                        <label class="form-label">First Name :</label>
                        <input type="text" class="form-control inputBorder w-80"
                        value="{{Auth::guard('guest')->user()->first_name}}"
                        name="first_name"
                        required>
                    </div>
                    <div class="col-lg-4 p-2">
                        <label class="form-label">Last Name :</label>
                        <input type="text" class="form-control inputBorder"
                        value="{{Auth::guard('guest')->user()->last_name}}"
                        name="last_name"
                        required>
                    </div>
                    <div class="col-lg-4 p-2">
                        <label class="form-label">Email :</label>
                        <input type="email" class="form-control inputBorder"
                        value="{{Auth::guard('guest')->user()->email}}"
                        name="email"
                        required>
                    </div>
                    <div class="col-lg-4 p-2">
                        <label class="form-label">Mobile :</label>
                        <input type="text" class="form-control inputBorder"
                        value="{{Auth::guard('guest')->user()->mobile}}"
                        name="mobile"
                        required>
                    </div>
                    <div class="col-lg-4 p-2">
                        <label class="form-label">Image :</label>
                        <input type="file" class="form-control-file inputBorder"
                        value=""
                        name="image"
                        required>
                    </div>
                    <div class="col-lg-4 p-2">
                        <input type="submit" class="btn btn-success saveButton" required>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>








@endsection
