@extends('layouts.master')

@section('page-title')
  {{__('admin.Trashed Hotels')}}
@endsection

@section('page-content')
    <div class="row">
        <div class="card-body text-center">
            <div class="table-responsive">
                <h1 class="text-center bg-danger text-light mt-3"><i class="fas fa-trash"></i> {{__('admin.Trashed Hotels')}}</h1>
                 @if($trashedHotels->isEmpty())
                 <div class="d-flex justify-content-center">
                  <img src="{{asset('assets/img/trash.jpg')}}" width="500">
                  </div>
                  <h3 class="text-center mt-2">{{ __('admin.No Trashed Rooms Found!') }}</h3>

                @else
                 <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>{{__('admin.ID')}}</th>
                            <th>{{__('admin.Name')}}</th>
                            <th>{{__('admin.Address')}}</th>
                            <th>{{__('admin.Image')}}</th>
                            <th>{{__('admin.Actions')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach($trashedHotels as $hotel)
                        <tr>
                            <td>{{$hotel->id}}</td>
                            <td>{{$hotel->name}}</td>
                            <td>{{$hotel->address}}</td>
                            <td>
                                @foreach ($hotel->images as $image)
                                   <img src="{{asset('storage/'.$image->path)}}" width="70px">
                                @endforeach
                            </td>
                            <td>
                                <form action="{{ route('hotels.restore',$hotel->id) }}" method="post" style="display: inline-block">
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
              <h5 class="modal-title" id="postModalLabel">{{__('admin.Delete Hotel')}}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              {{__('admin.Are you Sure you Want to Delete the Hotel?')}}
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="submit" class="btn btn-danger btn-lg">{{__('admin.Yes')}}</button>
                <form action="{{ route('hotels.delete',$hotel->id) }}" method="POST" class="d-none">
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

