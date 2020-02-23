@extends('admin.adminLayout')

@section('main')
	 <div class="preloader" id="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Profile page</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
                        <ol class="breadcrumb">
                            <li><a href="#">Home</a></li>
                            <li class="active">Profile page</li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <!-- .row -->
                <div class="row">
                    <div class="col-md-4 col-xs-12">
                        <div class="white-box">
                            <div class="user-bg"> {{-- <img width="100%" alt="user" src="{{ asset('image/img.gif') }}"> --}}
                                <div class="overlay-box">
                                    <div class="user-content">
                                        
                                            @if ($profileImage)                  
                                                <a href="javascript:void(0)">
                                                    @foreach ($profileImage as $profileImages)
                                                     <img style="text-align: center;z-index: -1;" src="{{asset($profileImages->image_url)}}" class="thumb-lg img-circle" alt="img">
                                                   @endforeach
                                                </a>
                                             @endif
                                        
                                        <h4 class="text-white">{{\auth::user()->name}}</h4>
                                        <h5 class="text-white">{{\auth::user()->email}}</h5> </div>
                                </div>
                            </div>
                            <div class="user-btm-box">
                                <div class="col-md-4 col-sm-4 text-center">
                                    <p class="text-purple"><i class="ti-facebook"></i></p>
                                    <h1>258</h1> </div>
                                <div class="col-md-4 col-sm-4 text-center">
                                    <p class="text-blue"><i class="ti-twitter"></i></p>
                                    <h1>125</h1> </div>
                                <div class="col-md-4 col-sm-4 text-center">
                                    <p class="text-danger"><i class="ti-dribbble"></i></p>
                                    <h1>556</h1> </div>
                            </div>
                            <div class="user-btm-box">
                                <form action="{{ route('uploadPhoto') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                   <div class="col-md-6">
                                        <input type="file" name="image_input" class="form-control" required>
                                    </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-success">Upload</button>
                                </div>
                                </form>
                            </div>
                            <div class="user-btm-box">
                                 <p class="text-purple"><i class="ti-facebook"></i></p>
                            </div>
                            @foreach ($commentList as $commentLists)
                             <div class="user-btm-box">
                                <p class="text-danger"><i class="ti-dribbble"></i></p>
                                    <h1>556</h1> </div>
                             </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-8 col-xs-12">
                        <div class="white-box">
                            <form class="form-horizontal form-material">
                                <div class="form-group">
                                    <label class="col-md-12">Full Name</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="{{\Auth::user()->name.' '.\Auth::user()->lastname}}" class="form-control form-control-line"> </div>
                                </div>
                                <div class="form-group">
                                    <label for="example-email" class="col-md-12">Email</label>
                                    <div class="col-md-12">
                                        <input type="email" placeholder="{{\Auth::user()->email}}" class="form-control form-control-line" name="example-email" id="example-email"> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Password</label>
                                    <div class="col-md-12">
                                        <input type="password" value="password" class="form-control form-control-line"> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Phone No</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="123 456 7890" class="form-control form-control-line"> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Message</label>
                                    <div class="col-md-12">
                                        <textarea rows="5" class="form-control form-control-line"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-12">Select Country</label>
                                    <div class="col-sm-12">
                                        <select class="form-control form-control-line">
                                            <option>Georgia</option>
                                            <option>London</option>
                                            <option>Usa</option>
                                            <option>Canada</option>
                                            <option>Thailand</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-success">Update Profile</button>
                                    </div>
                                </div>
                            </form>
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