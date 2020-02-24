@extends('admin.adminLayout')

@section('main')
	<div class="preloader" id="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
	<div id="page-wrapper">
	            <div class="container-fluid">
	                <div class="row bg-title">
	                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
	                        <h4 class="page-title">Info Log</h4> </div>
	                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
	                        <ol class="breadcrumb">
	                        	<li class="active"><a href="{{ route('adminHome') }}">Home</a></li>
	                            <li><a> Info Controller </a></li>
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
	                <!-- /row -->
	                <div class="row">
	                    <div class="col-sm-12">
	                    	<div class="white-box">
	                    		<p>Search</p>
	                    		<form  action="" method="POST">
	                    			<input style="border-radius: 5px;" class="form-control" type="search" name="">
	                    		</form>
	                    	</div>
	                        <div class="white-box">
	                        	<div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th><b style= "color:orange;">Admin</b></th>
                                            <th>Category</th>
                                            <th>Info (<code>Was</code>)</th>
                                            <th>Info (<code>Is</code>)</th>
                                            <th>Log creation date</th>
                                        </tr>
                                    </thead>
                                    @foreach ($log as $logs)
                                    	<tbody>
	                                    	<td>{{ $logs->name }}</td>
	                                    	<td>{{ $logs->crud_type }}</td>
	                                    	<td>{{ $logs->info_was }}</td>
	                                    	<td>{{ $logs->info_is }}</td>
	                                    	<td>{{ $logs->created_at }}</td> 
                                    	</tbody>
                                    @endforeach
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