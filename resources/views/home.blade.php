@extends('layouts.master')

@section('page-title')
   {{__('admin.Home Page')}}
@endsection

@section('page-content')

@include('layouts.messages')

<body id="page-top">

     <!-- Begin Page Content -->
     <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{__('admin.Dashboard')}}</h1>
        </div>

        <!-- Content Row -->
        <div class="row">

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    {{__('admin.Hotels')}}
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$hotels}}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="ion-image fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    {{__('admin.Rooms')}}</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$rooms}}</div>

                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    {{__('admin.Users')}}</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$latestUsersCount}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="ion-person fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    {{__('admin.Reviews')}}</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$reviewsCount}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-solid fa-thumbs-up fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>





        </div>



        <!-- Content Row -->
        <div class="row">

        <div class="col-xl-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa-regular fa-calendar-days"></i> {{__('admin.Bookings Today')}}</h3>
                </div>

         <table class="table table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>{{__('admin.Check in')}}</th>
                    <th>{{__('admin.Check out')}}</th>
                    <th>{{__('admin.User')}}</th>
                    <th>{{__('admin.Hotel')}}</th>
                    <th>{{__('admin.Image')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookingsToday as $booking)
                <tr>
                    <td>{{\Carbon\Carbon::parse($booking->check_in_date)->diffForHumans()}}</td>
                    <td>{{\Carbon\Carbon::parse($booking->check_out_date)->diffForHumans()}}</td>
                    <td>{{$booking->user->name}}</td>
                    <td>{{$booking->hotel->name}}</td>
                    <td>
                        @foreach ($booking->hotel->images as $image)
                            <img src="{{asset('storage/'.$image->path)}}" width="70px">
                        @endforeach
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>


     </div>
    </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

@endsection































































































































