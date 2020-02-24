@extends('admin.adminLayout')

@section('main')
<style>
#grid-container {
  display: grid;
  grid-template-columns: auto auto auto auto auto auto;
  padding: 10px;
}
#grid-item {
  padding: 20px;
  font-size: 30px;
  text-align: center;
}
</style>
	@foreach ($event as $events)
	<div id="page-wrapper">
	            <div class="container-fluid">
	                <div class="row bg-title">
	                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
	                        <h4 class="page-title">Event Edit</h4> </div>
	                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
	                        <ol class="breadcrumb">
	                        	<li class="active"><a href="{{ route('adminHome') }}">Home</a></li>
	                            <li><a href="{{ route('tourPage') }}">Event Controller</a></li>
	                            <li class="active">Event Edit</li>
	                        </ol>
	                    </div>
	                </div>
	                <!-- /row -->
	                <div class="row">
	                    <div class="col-sm-12">
	                        <div class="white-box" >
	                        	 <h3 class="box-title">Upload Photo</h3>
	                        	@if (\Auth::check())
									<form  method="POST" action="{{ route('editEventImage') }}"  enctype="multipart/form-data">
										@csrf
										<input type="hidden" name="tour_id" value="{{$events->tour_id}}">
										<input type="file" name="event_image" required="required">
										<button style="background: orange;" class="btn btn-primary">Accept Edit</button>
									</form>
								@endif
	                        </div>
	                        <div class="white-box" >
	                        	 <h3 class="box-title">Uploaded Photos ({{$eventImages->count()}})</h3>
	                        	<div id="grid-container">
									@foreach ($eventImages as $eventImage)
										<div class="grid-item">
											<img height="100" src="{{ asset($eventImage->image_url) }}">
										</div>
									@endforeach
								</div>
	                        </div>
	                        <div class="white-box">
	                        	<div class="table-responsive">
	                                <table class="table">
	                                    <thead>
	                                        <tr>
	                                            <th>Event Name</th>
	                                            <th>Description</th>
	                                            <th>Member Size</th>
	                                            <th>Price Per-Person</th>
	                                            <th>Creation Time</th>
	                                        </tr>
	                                    </thead>
	                                    <tbody>
	                                   		
	                                   			<td>{{$events->tour_name}}</td>
	                                   			<td>{{$events->description}}</td>
	                                   			<td>{{$events->limited_member}}</td>
	                                   			<td>{{$events->tour_price}}$</td>
	                                   			<td>{{$events->created_at}}</td>
	                                   		
	                                    </tbody>
	                                </table>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	                <!-- /.row -->
	            </div>
	@endforeach
@endsection