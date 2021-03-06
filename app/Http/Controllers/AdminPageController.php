<?php

namespace App\Http\Controllers;
use App\Tour;
use App\User;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Auth;
use redirect,input;
use App\UserImage;
use App\TourReviews;
use App\TourImages;
use App\Logger;
use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    	$this->middleware('admin');
    }
    public function profile()
    {
        $commentList = TourReviews::join('users','users.id','=','tour_reviews.user_id')->get();
    	$profileImage = UserImage::where('user_id',\auth::user()->id)->where('equiped',1)->get();
    	return view('admin.adminProfile',compact('profileImage','commentList'));
    }
    public function home()
    {
    	$tourComments = Tour::join('tour_reviews','tours.tour_id','=','tour_reviews.tour_id')->join('users','users.id','=','tour_reviews.user_id')->get();

    	return view('admin.home',compact('tourComments'));
    }
    public function tourPage()
    {
        $event = Tour::all();
    	return view('admin.event',compact('event'));
    }
    public function createEvent(Request $request)
    {

        $this->validate($request,[
            'event_name' => 'required|string|max:255|min:5',
            'event_price' => 'required|integer|min:20',
            'event_member_size' => 'required|integer|min:5',
            'event_description' => 'required|string|max:255|min:20',
            // 'event_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $checkIfExists = Tour::where('tour_name',$request->input('event_name'))->count();
        if ($checkIfExists == 0) {
            $createEvent = new Tour;
            $createEvent->user_id = Auth::user()->id;
            $createEvent->tour_name = $request->input('event_name');
            $createEvent->tour_price = $request->input('event_price');
            $createEvent->description = $request->input('event_description');
            $createEvent->limited_member = $request->input('event_member_size');
            $createEvent->save();

                if ($createEvent) {
                    $log = new Logger;
                    $log->user_id = Auth::user()->id;
                    $log->info_is = 'Event :'.$request->input('event_name')." - Price :".$request->input('event_price')." - Desc :".$request->input('event_description')." - Size :".$request->input('event_member_size');
                    $log->info_was = "Exist";
                    $log->crud_type = "create";
                    $log->save();
                }
            }
        return redirect('admin/event');
    }
    public function editEventPage(Request $request)
    {
        $this->validate($request,[ 
            'tour_id' => 'required|integer' 
        ]);

        $event = Tour::where('tour_id',$request->input('tour_id'))->get();
        $eventImages = TourImages::where('tour_id',$request->input('tour_id'))->get();

        return view('admin.adminEventEdit',compact('event','eventImages'));
    }
    public function editEventImage(Request $request)
    {
            $this->validate($request,[
                'event_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'tour_id' => 'required|integer'
            ]);

            if($request->hasFile('event_image')) {
                $image = time().'.'.$request->file('event_image')->getClientOriginalExtension();
                $checkImageName = TourImages::where('image_url',$image)->count();

                if ($checkImageName == 0) {
                        $request->event_image->move(public_path('eventImages'),$image);
                        $filePath = 'eventImages/'.$image;

                        $image = new TourImages;
                        $image->image_url = $filePath;
                        $image->tour_id = $request->input('tour_id');
                        $image->user_id = Auth::user()->id;
                        if ($filePath) {
                            $image->save(); 
                            if ($image) {
                                $log = new Logger;
                                $log->user_id = Auth::user()->id;
                                $log->info_is = $filePath;
                                $log->info_was = "Exist";
                                $log->crud_type = "create";
                                $log->save();
                            }
                        } 
                        
                }
            }   
        return redirect('/admin/event',);
    }
    public function uploadPhoto(Request $request)
    {
    	$this->validate($request,[
    		'image_input' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    	]);
    	
    	if($request->hasFile('image_input')) {
            $image = time().'.'.$request->file('image_input')->getClientOriginalExtension();
            $filePath2 = $request->image_input->move(public_path('uploadedImage'),$image);
			$filePath = 'uploadedImage/'.$image;


            $checkImageName = UserImage::where('image_url',$image)->count();

            if ($checkImageName == 0) {
                $makeProfile = UserImage::where('user_id',Auth::user()->id)->where('equiped',1)->update(['equiped' => 0]);

                    $image = new UserImage;
                    $image->image_url = $filePath;
                    $image->user_id = Auth::user()->id;
                    $image->equiped = 1;
                    if ($filePath) {
                    	$image->save(); 
                        if ($image) {
                            $log = new Logger;
                            $log->user_id = Auth::user()->id;
                            $log->info_is = $filePath;
                            $log->info_was = "Exist";
                            $log->crud_type = "create";
                            $log->save();
                        }
                    } 
            }
        }

        return redirect('/admin/profile');
    }
    public function deleteEvent(Request $request)
    {
        $this->validate($request,['tour_id' => 'required|integer']);

        $first = Tour::where('tour_id',$request->input('tour_id'))->delete();

                $log = new Logger;
                $log->crud_type = "delete";
                $log->info_was = "Event-id :".$request->input('tour_id');
                $log->info_is = "empty";
                $log->user_id = Auth::user()->id;
                $log->save();

        foreach (TourImages::select('image_url')->where('tour_id',$request->input('tour_id'))->get() as $images) {
            $image_path = public_path($images->image_url);

            if (\File::exists($image_path)) {
                $file = \File::delete($image_path);
                $second = TourImages::where('tour_id',$request->input('tour_id'))->delete();     
            }
        }
       
        
        return redirect('admin/event')->with('success','Successfully Deleted!');
    }
    public function infoPage()
    {
       $log = Logger::select('users.id as user_id','loggers.crud_type','loggers.info_was','loggers.info_is','loggers.created_at','users.name')->join('users','users.id','=','loggers.user_id')->orderBy('loggers.created_at','desc')->get();
       
        return view('admin.info',compact('log'));
    }
}
