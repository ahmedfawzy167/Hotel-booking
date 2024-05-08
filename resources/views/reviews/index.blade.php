@extends('layouts.master')

@section('page-title')
   {{__('admin.All Reviews')}}
@endsection

@section('page-content')
    <div class="row">
        <div class="card-body">

            <div class="table-responsive">
                <h1 class="text-center bg-primary text-light"><i class="fa-solid fa-list"></i> {{__('admin.All Reviews')}}</h1>
                <table class="table table-hover table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>{{__('admin.ID')}}</th>
                            <th>{{__('admin.Hotel')}}</th>
                            <th>{{__('admin.User')}}</th>
                            <th>{{__('admin.Content')}}</th>
                            <th>{{__('admin.Rating')}}</th>
                            <th>{{__('admin.Image')}}</th>
                            <th>{{__('admin.Actions')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reviews as $review)
                        <tr>
                            <td>{{$review->id}}</td>
                            <td>{{$review->hotel->name}}</td>
                            <td>{{$review->user->name}}</td>
                            <td>{{$review->content}}</td>
                            <td>{{$review->rating}}</td>
                            <td>
                                @foreach($review->hotel->images as $image)
                                   <img src="{{asset('storage/'.$image->path)}}" width="70px">
                                @endforeach
                            </td>
                            <td>
                                <form action="{{route('reviews.destroy' ,$review->id)}}" method="post" style="display: inline-block">
                                    @csrf
                                    @method('delete')
                                      <button type="submit" class="btn btn-danger" style="display: inline-block">{{__('admin.Delete')}}</button>
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

