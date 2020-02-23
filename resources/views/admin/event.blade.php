@extends('admin.adminLayout')

@section('main')
    <!-- Preloader -->
    <div class="preloader" id="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Event Controller</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="{{ route('adminHome') }}">Home</a></li>
                            <li class="active">Event List</li>
                        </ol>
                    </div>
                </div>
@if($errors->any())
    <div class="alert alert-danger">
      @foreach ($errors->all() as $error)      
        <li>{{$error}}</li>
      @endforeach
    </div>
@endif
                <div class="row">
                    <div class="white-box" style="height: 400px">
                        <h3 class="box-title">Create Event</h3>
                        <form action="{{ route('createEvent') }}" method="POST">
                            @csrf
                            <div>
                                <input type="text" placeholder="Event name.." class="form-control" name="event_name">
                            </div>
                            <br>
                            <div>
                                <input type="number" min="20" max="2000" step="1" placeholder="Event Price Example 20$" class="form-control" name="event_price" required="required">
                            </div>
                            <br>
                            <div>
                               <input min="5" placeholder="Member Size.." class="form-control" type="number" name="event_member_size" step="1" required="required">
                            </div>
                            <br>
                            <div>
                               <textarea name="event_description" class="form-control" placeholder="Event Description..." style="max-height: 20%;max-width: 100%;min-height: 10%;min-width: 100%"></textarea>
                            </div>
                            <br>
                            <div>
                                <button class="btn btn-primary">Lets Create</button> 
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box" >
                            <h3 class="box-title">Event List</h3>
                            <p class="text-muted">Add class <code>.event</code></p>
                            <div>
                        <form role="search" action="" method="POST"  class="app-search hidden-xs">
                            <input type="text" style="width: 100%;background: lightgrey;" placeholder="Search..." class="form-control">
                        </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Event Name</th>
                                            <th>Description</th>
                                            <th>Member Size</th>
                                            <th>Price Per-Person</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if ($event->count() > 0)
                                        @foreach ($event as $events)
                                            <tr>
                                                <td>{{$events->tour_id}}</td>
                                                <td>{{$events->tour_name}}</td>
                                                <td>{{$events->description}}</td>
                                                <td>{{$events->limited_member}}</td>
                                                <td>{{$events->tour_price}}$</td>
                                                <td>
                                                    <form method="POST" action="">
                                                        @csrf
                                                        <input type="hidden" name="tour_id" value="{{$events->id}}">
                                                        <button style="background: green;border:none;border-radius: 5px;" class="btn btn-danger">View</button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form method="POST" action="{{ route('editEventPage') }}">
                                                        @csrf
                                                        <input type="hidden" name="tour_id" value="{{$events->tour_id}}">
                                                        <button style="background: orange;border:none;border-radius: 5px;" class="btn btn-warning">Edit</button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form method="POST" action="">
                                                        @csrf
                                                        <input type="hidden" name="tour_id" value="{{$events->id}}">
                                                        <button id="delete" style="background: darkred;border:none;border-radius: 5px;" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                    <td>0</td>
                                    <td>No Result</td>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
  

@endsection
@section('script')
<script type="text/javascript">
    setInterval(function(){
        document.getElementById('preloader').remove();
    },1500);

</script>
@endsection