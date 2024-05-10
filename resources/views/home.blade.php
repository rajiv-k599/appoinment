@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach($users as $user)
       <div class="col-3 shadow p-3 m-2  rounded" style="background-color: rgb(157, 116, 195)">
        <div class="d-flex">
            <div class="col-8" style="color: aliceblue">
                <h4>{{$user->name}}</h4>
                <span>{{$user->specialization}}</span>
            </div>
            <div class="col-4 pt-3 ps-3">
               <a href="{{route('appointment',['id' =>$user->id])}}" class="btb btn-success rounded" >Book</a>
            </div>
            
        </div>
       </div>
  @endforeach
     
        
    </div>
</div>
@endsection
