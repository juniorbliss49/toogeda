<?php

namespace App\Http\Controllers;

use App\Library\NearestPostalCode;
use App\Library\PostalCoder;
use App\LocalTrip;
use App\LongDistanceTrip;

use App\Post;
use App\User;
use App\Setting;
use App\campaign;
use App\secondarygoalsvalue;
use App\campaigndonation;
use App\campaigndonationvalues;
use App\secondarygoals;
use App\cashlessdonations;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    /**
     *  Welcome Page
     */
    public function welcome()
    {
        //If authenticated redirect to home
        if(! Auth::guest()){

            return  redirect('/choose');

        }

        $membership_fee = cache()->remember('settings.user_membership_fee', 10, function(){

            return Setting::find('user_membership_fee')->value;

        });

        $announcement = Setting::find('public_announcement');

        return view('welcome', compact('membership_fee', 'announcement'));

    }

    public function choose()
    {
       //If authenticated redirect to home
      /* if(! Auth::guest()){
           return  redirect('/home');
       } */

       $membership_fee = cache()->remember('settings.user_membership_fee', 10, function(){
           return Setting::find('user_membership_fee')->value;

       });

       $announcement = Setting::find('public_announcement');

       return view('choose', compact('membership_fee', 'announcement'));

    }

    /**
     * Test search query
     * @param Request
     * @return Response
     */
     public function search(Request $request)
     {
       //Validate input
       $this->validate($request, [
         'postal_start' => 'sometimes|required',
         'radius' => 'sometimes|required|numeric',
         'type' => 'sometimes|required'
       ]);

       //Get the form data
       $home = $request->input('home_address');
       $office = $request->input('office_address');
       $radius = ($request->radius) ? intval($request->radius) : 25;
       $starts = $request->input('postal_start');
       $ends = $request->input('postal_end');

       $id = Auth::User()->id;
       $user = User::findOrFail($id);

        $user->update([
            'home_address' => $home,
            'office_address' => $office,
            'nearest_bus_stop_to_home' => $starts,
            'nearest_bus_stop_to_office' => $ends
       ]);

       if ( $user->home_address !== $home || $user->office_address !== $office 
                || $user->nearest_bus_stop_to_home !== $starts || $user->nearest_bus_stop_to_office !== $ends ) 

            {
                $user->save();
            }
        

       $search = [
         'radius' => $radius,
         'postal_start' => $starts,
         'postal_end' => $ends
       ];

       if ($search['postal_start'] || $search['postal_end'])
        {
           $posts = Post::where('departure_pcode', 'LIKE', "%$starts%")->orWhere('destination_pcode', 'LIKE', "%$ends%")->get();
       }


       // Get Trips //Not completed trips
       $current_trips = Auth::user()->rides()->whereNull('arrival_datetime')->get();

       // Hosted trips //Not completed trips
       $posted_trips = Auth::user()->hosts()->whereNull('arrival_datetime')->get();

       //Notifications
       $notifications = Auth::user()->unreadNotifications()->get();

       //Announcement
       $announcement = Setting::find('public_announcement');

        return view('home', compact('user', 'posts', 'search', 'current_trips', 'posted_trips', 'notifications', 'announcement'));
     }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, PostalCoder $postalCoder)
    {
        $posts = Post::with('poster');

        //Initialize
        $nearestPCoder = new NearestPostalCode();
        $radius = ($request->radius) ? intval($request->radius) : 25;
        $search = [
            'radius' => $radius,
            'postal_start' => '',
            'postal_end' => ''
        ];

        $this->validate($request, [
            'postal_start' => 'sometimes|required',
            'radius' => 'sometimes|required|numeric',
            'type' => 'sometimes|required'
        ]);

        //Filtering the starting point.

        if($request->postal_start == null){

            //Attempt to find some results automatically.
            $location = null;

            try{
                $location = app('geocoder')->using('free_geo_ip')->geocode((env('APP_DEBUG') ? '132.205.244.34' : $request->ip()))
                    ->first();
            } catch (\Geocoder\Exception\UnsupportedOperation $e) {}

            $starts = $nearestPCoder->nearestUsingCoordinates($location->getLatitude(), $location->getLongitude(), $radius);

            $posts->where(function($query) use ($starts) {
                foreach($starts as $p_code => $distance) {
                    $query->orWhere('departure_pcode', 'like', $p_code . '%');
                }
            });

            $search['postal_start'] = $location->getPostalCode();

        } else {

            $postal_start = $postalCoder->geocode(trim($request->postal_start));

            if($postal_start == null){
                return back()->withErrors(['postal_start' => "Couldn't find postal code."]);
            }

            $starts = $nearestPCoder->nearestUsingCoordinates($postal_start->getLatitude(), $postal_start->getLongitude(), $radius);

            $posts->where(function($query) use ($starts) {
                foreach($starts as $p_code => $distance) {
                    $query->orWhere('departure_pcode', 'like', $p_code . '%');
                }
            });

            $search['postal_start'] = $postal_start->getPostalCode();

        }

        //Filtering the destination.
        if($request->postal_end) {

            $postal_end = $postalCoder->geocode(trim($request->postal_end));

            if($postal_start == null){
                return back()->withErrors(['postal_end' => "Couldn't find postal code."]);
            }

            $ends = $nearestPCoder->nearestUsingCoordinates($postal_end->getLatitude(), $postal_end->getLongitude(), $radius);

            $posts->where(function($query) use ($ends) {
                foreach($ends as $p_code => $distance) {
                    $query->orWhere('destination_pcode', 'like', $p_code . '%');
                }
            });

            $search['postal_end'] = $postal_end->getPostalCode();
        }

        //Filtering the post type
        if($request->type == 1){

            $posts->where('postable_type', LocalTrip::class);

        } else if ($request->type == 2) {

            $posts->where('postable_type', LongDistanceTrip::class);
        }

        //Filtering out old posts
        $posts->where(function($query){
            $query->orWhere(function($query){
                $query->where('one_time', 1);
                $query->whereDate('departure_date', '>', Carbon::now());
            });
            $query->orWhere(function($query){
                $query->where('one_time', 0);
            });
        });


//finding the start trip (Dave Partner)
//$posts->where('departure_pcode', $request->postal_start);
//$posts->where('destination_pcode', $request->postal_end);
        //Execute Query
        $posts->with('messages')->with('poster')->orderBy('created_at');
        $posts = $posts->get();

        // Get Trips //Not completed trips
        $current_trips = Auth::user()->rides()->whereNull('arrival_datetime')->get();

        // Hosted trips //Not completed trips
        $posted_trips = Auth::user()->hosts()->whereNull('arrival_datetime')->get();

        //Notifications
        $notifications = Auth::user()->unreadNotifications()->get();

        //Announcement
        $announcement = Setting::find('public_announcement');

        //user
        $user = User::findOrFail(Auth::user()->id);

        return view('home', compact('user', 'posts', 'search', 'current_trips', 'posted_trips', 'notifications', 'announcement'));
    }

    public function clearNotifications(){
        Auth::user()->unreadNotifications()->update(['read_at' => Carbon::now()]);

        return back();
    }

    public function addcampaign()
    {
        return view('campaign/addcampaign');
    }

    public function viewcampaign($id)
    {
        $campaign = campaign::where('id', $id)->first();
        $secondarygoals = secondarygoalsvalue::where('campaign_id', $id)->get();
        $campaigndonation = campaigndonationvalues::where('campaign_id', $id)->get();
        return view('campaign/viewcampaign', compact('secondarygoals', 'campaigndonation', 'campaign'));
    }

    public function donate($id)
    {
        $campaign = campaign::where('id', $id)->first();
        $campaigndonate = campaigndonationvalues::where('campaign_id', $id)->get();
        $view = '';
        $campaigndonation = '';
        foreach ($campaigndonate as $key) {
        $campaigndonation = campaigndonation::where('id', $key->donation_id)->first();
        $view .= "<label class='checkbox-inline'><input type='radio' name='donation' class='donation' id='donation' value=$key->donation_id> $campaigndonation->name</label>";
        }
        $user = User::where('id', $campaign->user_id)->first();
        $donation = cashlessdonations::where('campaign_id', $id)->take(10)->get();
        $donationall = cashlessdonations::where('campaign_id', $id)->get();
        $countdonation = cashlessdonations::where('campaign_id', $id)->count();
        return view('campaign/donate', compact('campaign', 'campaigndonate','view', 'user', 'donation', 'donationall', 'countdonation'));
    }

    public function insertdonation()
    {
        $val = $_GET['val'];
        $campaign = $_GET['campaign'];
        $full_name = $_GET['full_name'];
        $phone_number = $_GET['phone_number'];
        $email = $_GET['email'];
        $anonymous = $_GET['anonymous'];

        $cashlessdonations = new cashlessdonations;
        $cashlessdonations->campaign_id = $campaign;
        $cashlessdonations->donation_id = $val;
        $cashlessdonations->name = $full_name;
        $cashlessdonations->phone_number = $phone_number;
        $cashlessdonations->email = $email;
        $cashlessdonations->anonymous = $anonymous;
        $cashlessdonations->save();

        echo "<b>Thank you for participating. Details will be sent to your email soon<b>";

    }

    public function campaignadded()
    {
        return view('campaign/campaignadded');
    }

}








