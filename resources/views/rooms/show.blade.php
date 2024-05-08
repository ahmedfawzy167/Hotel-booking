@extends('layouts.master')

@section('page-title')
   {{__('admin.Show Room')}}
@endsection

@section('page-content')

<div class="d-flex justify-content-center align-items-center vh-60">
    <div class="card" style="width: 60rem;">
      <div class="card-body">
        <h2 class="card-title text-center bg-info text-white"><i class="fa-solid fa-eye"></i> {{__('admin.Room Details')}}</h2>
      </div>
      <ul class="list-group list-group-flush">
        <h4 class="list-group-item">{{__('admin.Room Number')}}: {{$room->room_number}}</h4>
        <h4 class="list-group-item">{{__('admin.Type')}}: {{$room->type}}</h4>
        <h4 class="list-group-item">{{__('admin.Price')}}: ${{$room->price}}</h4>
        <h4 class="list-group-item">{{__('admin.Hotel')}}: {{$room->hotel->name}}</h4>

     </ul>
    </div>
  </div>
  <div class="text-center">
     <a href="{{route('rooms.index')}}" class="btn btn-info mt-2">{{__('admin.Back to List')}}</a>
  </div>


@endsection
