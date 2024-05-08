@extends('layouts.master')

@section('page-title')
    {{ __('admin.Search') }}
@endsection

@section('page-content')

    <div class="d-flex justify-content-center align-items-center vh-60">
        <div class="card" style="width: 60rem;">
            <div class="card-body">
                <h2 class="card-title text-center bg-success">
                    <i class="fa-solid fa-eye"></i> {{ $searchResults->count() }} {{ __('admin.Results') }}
                </h2>
            </div>
            <ul class="list-group list-group-flush">
                @foreach($searchResults as $result)
                    @if($result->searchable instanceof \App\Models\Booking)
                        <li class="list-group-item">{{ $result->searchable->check_in_date }}</li>
                        <li class="list-group-item">{{ $result->searchable->check_out_date }}</li>
                        <li class="list-group-item">{{ $result->searchable->hotel->name }}</li>
                        <li class="list-group-item">{{ $result->searchable->user->name }}</li>

                    @elseif ($result->searchable instanceof \App\Models\Hotel)
                        <li class="list-group-item">
                            {{ $result->searchable->name }}
                        </li>
                        <li class="list-group-item">
                            {{ $result->searchable->description }}
                        </li>
                        <li class="list-group-item">
                            {{ $result->searchable->address }}
                        </li>

                    @elseif ($result->searchable instanceof \App\Models\Room)
                        <h3 class="list-group-item">
                            {{__('admin.Room Number')}}: {{ $result->searchable->room_number }}
                        </h3>
                        <h3 class="list-group-item">
                            {{__('admin.Type')}}: {{ $result->searchable->type }}
                        </h3>
                        <h3 class="list-group-item">
                            {{__('admin.Price')}}: {{ $result->searchable->price }}
                        </h3>
                        <h3 class="list-group-item">
                            {{__('admin.Hotel')}}: {{ $result->searchable->hotel->name }}
                        </h3>
                    @else
                    <li class="list-group-item">
                        {{__('admin.No Results Found!')}}
                    </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>

@endsection
