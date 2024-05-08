@extends('layouts.master')

@section('page-title')
  {{__('admin.Edit Room')}}
@endsection

@section('page-content')
<div class="card">
<div class="container card-body">
  <h1 class="text-center text-light bg-dark"><i class="fa-solid fa-pen-to-square"></i> {{__('admin.Edit Room')}}</h1>
  <form action="{{route('rooms.update',$room->id)}}" method="post" class="row">
    @csrf
    @method('PUT')

    <div class="form-group col-12">
      <label for="room_number">{{__('admin.Room Number')}}</label>
      <input type="number" name="room_number" id="room_number" value="{{$room->room_number}}" class="form-control @error('room_number') is-invalid @enderror">
      @error('room_number')
         <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="type">{{__('admin.Type')}}</label>
        <input type="text" name="type" id="type" value="{{$room->type}}" class="form-control @error('type') is-invalid @enderror">
        @error('type')
         <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

      <div class="form-group col-md-6">
        <label for="price">{{__('admin.Price')}}</label>
        <input type="number" name="price" id="price" value="{{$room->price}}" class="form-control @error('price') is-invalid @enderror">
        @error('price')
         <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group col-md-12">
        <label for="hotel_id"> <i class="fa-solid fa-city"></i> {{__('admin.Hotel')}}</label>
        <select name="hotel_id" id="hotel_id" class="form-select">
            @foreach ($hotels as $hotel)
              <option value="{{$hotel->id}}"  {{ $hotel->id == $room->hotel_id ? 'selected' : ''}}>{{$hotel->name}}</option>
            @endforeach
        </select>
      </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-lg">{{__('admin.Update')}}</button>
            <button type="reset" class="btn btn-secondary btn-lg">{{__('admin.Reset')}}</button>
        </div>

</form>


@endsection
