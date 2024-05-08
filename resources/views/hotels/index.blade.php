@extends('layouts.master')

@section('page-title')
  {{__('admin.All Hotels')}}
@endsection
<style>
    .table-responsive {
        overflow-x: hidden;
    }
    .pagination {
        flex-wrap: wrap;
    }
</style>
@section('page-content')
    <div class="row">
        <div class="card-body">
            <div class="table-responsive">
                <h1 class="text-center bg-primary text-light"><i class="fa-solid fa-list"></i> {{__('admin.All Hotels')}}</h1>
                <form action="{{ route('hotels.index') }}" method="get" class="row mb-4">
                    @csrf
                    <div class="col-10">
                        <div class="input-group">
                            <input type="text" name="term" id="term" class="form-control" value="{{ request('term') != "" ? request('term') : '' }}" placeholder="{{__('admin.Search')}}...">
                        </div>
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-primary">{{__('admin.Filter')}}</button>
                         <a href="{{route('hotels.index')}}" class="btn btn-secondary">{{__('admin.Reset')}}</a>
                    </div>
                </form>
                <table class="table table-hover table-bordered">
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
                        @forelse($hotels as $hotel)
                        <tr>
                            <td>{{$hotel->id}}</td>
                            <td>{{$hotel->name}}</td>
                            <td>{{$hotel->address}}</td>
                            <td>
                            @foreach($hotel->images as $image)
                                <img src="{{asset('storage/'.$image->path)}}" width="70px" class="mr-2">
                            @endforeach
                            </td>
                            <td>
                                <a href="{{ route('hotels.show',$hotel->id) }}" class="btn btn-info">{{__('admin.Show')}}</a>
                                <a href="{{ route('hotels.edit',$hotel->id) }}" class="btn btn-success">{{__('admin.Edit')}}</a>
                                <form action="{{route('hotels.destroy' ,$hotel->id)}}" method="post" style="display: inline-block">
                                    @csrf
                                    @method('delete')
                                     <button type="submit" class="btn btn-danger" style="display: inline-block">{{__('admin.Trash')}}</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                         <h1 class="text-center">No Hotels Found!</h1>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    <nav aria-label="...">
                        <ul class="pagination">
                          <li class="page-item {{ $hotels->previousPageUrl() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $hotels->previousPageUrl() }}">{{__('pagination.Previous')}}</a>
                          </li>
                          @foreach($hotels->getUrlRange(1, $hotels->lastPage()) as $page => $url)
                            <li class="page-item {{ $page == $hotels->currentPage() ? 'active' : '' }}" aria-current="page">
                              <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                          @endforeach
                          <li class="page-item {{ $hotels->nextPageUrl() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $hotels->nextPageUrl() }}">{{__('pagination.Next')}}</a>
                          </li>
                        </ul>
                      </nav>
                    </div>
        </div>
    </div>


@include('layouts.messages')
@endsection

