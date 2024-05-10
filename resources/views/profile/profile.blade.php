@extends('layouts.app')

@section('content')
<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                 <span class="font-weight-bold">{{Auth::User()->type}}</span>
                 <br>
                <span class="font-weight-bold">{{Auth::User()->name}}</span>
               
                <span class="text-black-50">{{Auth::User()->email}}</span><span> </span></div>
        </div>
        <div class="col-md-5 border-right">
            <form action="{{ route('profileEdit')}}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Settings</h4>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Name</label><input type="text" class="form-control" placeholder="Name" name="name" value="{{Auth::User()->name}}"></div>
                 
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Mobile Number</label><input type="text" class="form-control" placeholder="enter phone number"  name="phone" value="{{Auth::User()->phone}}"></div>
                     @if(Auth::User()->type == "Patient")
                    <div class="col-md-12"><label class="labels">Address</label><input type="text" class="form-control" placeholder="enter address line 1"  name="address" value="{{Auth::User()->address}}"></div>
                     @endif
                    <div class="col-md-12"><label class="labels">Email ID</label><input type="text" class="form-control" placeholder="enter email id"  name="email" value="{{Auth::User()->email}}"></div>
                    
                </div>
                @if(Auth::User()->type == "Doctor")
               
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Specialization</label><input type="text" class="form-control"  name="specialization" value="{{Auth::User()->specialization}}"></div>
                   
                </div>
                @endif
                <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Save Profile</button></div>
            </form>
            </div>
        </div>
        <div class="col-md-4">
            {{-- <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center experience"><span>Edit Experience</span><span class="border px-3 p-1 add-experience"><i class="fa fa-plus"></i>&nbsp;Experience</span></div><br>
                <div class="col-md-12"><label class="labels">Experience in Designing</label><input type="text" class="form-control" placeholder="experience" value=""></div> <br>
                <div class="col-md-12"><label class="labels">Additional Details</label><input type="text" class="form-control" placeholder="additional details" value=""></div>
            </div> --}}
        </div>
    </div>
</div>
</div>
</div>
@endsection