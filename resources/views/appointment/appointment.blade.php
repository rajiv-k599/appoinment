@extends('layouts.app')

@section('content')
 <div class="continer">
    <div class="row justify-content-center">
      <div class="col-6">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @elseif(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
      <form action="{{route('appoint')}}" method="post">
        <div class="card" style="">
              @csrf
     
          <div class="card-header"> Book An Appointment </div>
       

          <div class="mb-3">
            <label for="" class="form-label">{{$doctor->name}}</label>
           
          </div>
          <div class="mb-3">
            <label for="" class="form-label">{{$doctor->specialization}}</label>
          {{-- necessary id --}}
          <input type="hidden" name="user_id" value="{{Auth::User()->id}}">
           <input type="hidden" name="doctor_id" value="{{$doctor->id}}">
          </div>
          <div class="mb-3 ">
            <label class="form-label" for=""> Select Appointment Date:</label>
            <input type="date" class="form-control" name="appointment_datetime" required>
          
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
 </div>
    </form>
    
      </div>
   
   </div>
    
 </div>
@endsection