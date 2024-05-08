@extends('layouts.master')

@section('page-title')
  {{__('admin.Trashed Rooms')}}
@endsection

@section('page-content')
    <div class="row">
        <div class="card-body text-center">
            <div class="table-responsive">
                <h1 class="text-center bg-danger text-light"><i class="fas fa-trash"></i> {{__('admin.Trashed Rooms')}}</h1>
                 @if($trashedRooms->isEmpty())
                 <div class="d-flex justify-content-center">
                  <img src="{{asset('assets/img/trash.jpg')}}" width="500">
                  </div>
                  <h3 class="text-center mt-2">{{ __('admin.No Trashed Rooms Found!') }}</h3>

                @else
                 <table class="table table-striped table-bordered">
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
                       @foreach($trashedRooms as $room)
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
                                <form action="{{ route('rooms.restore',$room->id) }}" method="post" style="display: inline-block">
                                   @csrf
                                   @method('PUT')
                                   <button type="submit" class="btn btn-outline-success" style="display: inline-block">{{__('admin.Restore')}}</button>
                                </form>
                                 <button type="submit" class="btn btn-outline-danger" data-toggle="modal" data-target="#postModal">{{__('admin.Delete')}}</button>
                            </td>
                        </tr>

    <!-- Modal -->
     <div class="modal fade" id="postModal" tabindex="-1" role="dialog" aria-labelledby="postModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="postModalLabel">{{__('admin.Delete Room')}}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              {{__('admin.Are you Sure you Want to Delete the Room?')}}
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="submit" class="btn btn-danger btn-lg">{{__('admin.Yes')}}</button>
                <form action="{{ route('rooms.delete',$room->id) }}" method="POST" class="d-none">
                    @csrf
                    @method('delete')
                </form>
                <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">{{__('admin.No')}}</button>
            </div>
          </div>
        </div>
      </div>
    @endforeach
      </tbody>
      </table>
      @endif
        </div>
        </div>
    </div>


@endsection

