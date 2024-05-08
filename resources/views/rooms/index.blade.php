@extends('layouts.master')

@section('page-title')
  {{__('admin.All Rooms')}}
@endsection

@section('page-content')
    <div class="row">
        <div class="card-body">
            <div class="table-responsive">
                <h1 class="text-center bg-primary text-light"><i class="fa-solid fa-list"></i> {{__('admin.All Rooms')}}</h1>
                <table class="table table-hover table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>{{__('admin.ID')}}</th>
                            <th>{{__('admin.Room Number')}}</th>
                            <th>{{__('admin.Type')}}</th>
                            <th>{{__('admin.Price')}}</th>
                            <th>{{__('admin.Hotel')}}</th>
                            <th>{{__('admin.Image')}}</th>
                            <th>{{__('admin.Actions')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rooms as $room)
                        <tr>
                            <td>{{$room->id}}</td>
                            <td>{{$room->room_number}}</td>
                            <td>{{$room->type}}</td>
                            <td>${{$room->price}}</td>
                            <td>{{$room->hotel->name}}</td>
                            <td>
                             @foreach($room->hotel->images as $image)
                                <img src="{{asset('storage/'.$image->path)}}" width="70px" class="mr-2">
                             @endforeach
                            </td>
                            <td>
                                <a href="{{ route('rooms.show',$room->id) }}" class="btn btn-info">{{__('admin.Show')}}</a>
                                <a href="{{ route('rooms.edit',$room->id) }}" class="btn btn-success">{{__('admin.Edit')}}</a>
                                <form action="{{route('rooms.destroy',$room->id)}}" method="post" style="display: inline-block">
                                    @csrf
                                    @method('delete')
                                     <button type="submit" class="btn btn-danger" style="display: inline-block">{{__('admin.Trash')}}</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                         <h1 class="text-center">No Rooms Found!</h1>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    <nav aria-label="...">
                        <ul class="pagination">
                          <li class="page-item {{ $rooms->previousPageUrl() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $rooms->previousPageUrl() }}">{{__('pagination.Previous')}}</a>
                          </li>
                          @foreach($rooms->getUrlRange(1, $rooms->lastPage()) as $page => $url)
                            <li class="page-item {{ $page == $rooms->currentPage() ? 'active' : '' }}" aria-current="page">
                              <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                          @endforeach
                          <li class="page-item {{ $rooms->nextPageUrl() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $rooms->nextPageUrl() }}">{{__('pagination.Next')}}</a>
                          </li>
                        </ul>
                      </nav>
                    </div>
        </div>
    </div>


@include('layouts.messages')
@endsection

