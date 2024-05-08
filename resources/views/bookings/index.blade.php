@extends('layouts.master')

@section('page-title')
  {{__('admin.All Bookings')}}
@endsection

@include('layouts.messages')

@section('page-content')
    <div class="row">
        <div class="card-body">
            <div class="table-responsive">
                <h1 class="text-center bg-primary text-light"><i class="fa-solid fa-list"></i> {{__('admin.All Pending Bookings')}}</h1>
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>{{__('admin.ID')}}</th>
                            <th>{{__('admin.Check in')}}</th>
                            <th>{{__('admin.Check out')}}</th>
                            <th>{{__('admin.User')}}</th>
                            <th>{{__('admin.Hotel')}}</th>
                            <th>{{__('admin.Image')}}</th>
                            <th>{{__('admin.Actions')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                        <tr>
                            <td>{{$booking->id}}</td>
                            <td>{{\Carbon\Carbon::parse($booking->check_in_date)->diffForHumans()}}</td>
                            <td>{{\Carbon\Carbon::parse($booking->check_out_date)->diffForHumans()}}</td>
                            <td>
                                @if($booking->user)
                                    {{$booking->user->name}}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>{{$booking->hotel->name}}</td>
                            <td>
                            @foreach ($booking->hotel->images as $image)
                                <img src="{{asset('storage/'.$image->path)}}" width="100px" class="mr-2">
                            @endforeach

                            </td>
                            <td>
                                <form action="{{route('bookings.accept',$booking->id)}}" method="post" style="display: inline-block">
                                    @csrf
                                    @method('PUT')
                                      <button type="submit" class="btn btn-outline-success" style="display: inline-block">{{__('admin.Accept')}}</button>
                                </form>
                                <form action="{{route('bookings.reject',$booking->id)}}" method="post" style="display: inline-block">
                                    @csrf
                                    @method('PUT')
                                      <button type="submit" class="btn btn-outline-danger" style="display: inline-block">{{__('admin.Reject')}}</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@include('layouts.messages')
@endsection

