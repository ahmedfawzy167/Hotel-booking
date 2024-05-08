@extends('layouts.master')

@section('page-title')
  {{__('admin.Users')}}
@endsection

@section('page-content')
    <div class="row">
        <div class="card-body">
            <div class="table-responsive">
                <h1 class="text-center bg-primary text-light"><i class="fa-solid fa-list"></i> {{__('admin.All Users from Aswan')}}</h1>
                <table class="table table-hover table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>{{__('admin.ID')}}</th>
                            <th>{{__('admin.Name')}}</th>
                            <th>{{__('admin.Email')}}</th>
                            <th>{{__('admin.City')}}</th>
                            <th>{{__('admin.Actions')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->city->name}}</td>
                            <td>
                                <a href="{{ route('users.show',$user->id) }}" class="btn btn-info">{{__('admin.Show')}}</a>
                                <a href="{{ route('users.edit',$user->id) }}" class="btn btn-success">{{__('admin.Edit')}}</a>
                                <form action="{{route('users.destroy' ,$user->id)}}" method="post" style="display: inline-block">
                                    @csrf
                                    @method('delete')
                                     <button type="submit" class="btn btn-danger" style="display: inline-block">{{__('admin.Delete')}}</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- <div class="d-flex justify-content-center">
                    <nav aria-label="...">
                        <ul class="pagination">
                          <li class="page-item {{ $users->previousPageUrl() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $users->previousPageUrl() }}">{{__('pagination.Previous')}}</a>
                          </li>
                          @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                            <li class="page-item {{ $page == $users->currentPage() ? 'active' : '' }}" aria-current="page">
                              <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                          @endforeach
                          <li class="page-item {{ $users->nextPageUrl() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $users->nextPageUrl() }}">{{__('pagination.Next')}}</a>
                          </li>
                        </ul>
                      </nav>
                    </div> --}}
        </div>
    </div>


@include('layouts.messages')
@endsection

