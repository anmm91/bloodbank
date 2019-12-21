<?php

namespace App\Http\Controllers\Api;

use App\Models\BloodType;
use App\Models\City;
use App\Models\ClientPost;
use App\Models\Contact;
use App\Models\DonationRequest;
use App\Models\Governorate;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Token;
use http\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\controller;
class MainController extends Controller
{
    public function createDonation(Request $request)
    {
        $validator = Validator()->make($request->all(), [
            'name' => 'required',
            'age' => 'required|numeric',
            'blood_type_id' => 'required|exists:blood_types,id',
            'bags_num' => 'required|numeric',
            'hospital_name' => 'required',
            'hospital_address' => 'required',
            'city_id' => 'required|exists:cities,id',
            'phone' => 'required',
            'latitude'=>'required',
            'longitude'=>'required',
            'notes'=>'required',
        ]);
        if ($validator->fails()) {
            return responseJson(0, 'Failed', $validator->errors());
        }

        //create donation request
        $newRequest = $request->user()->donations()->create($request->all());
        // Find Suitable Clients for this Request
        $clientIds = $newRequest->city->governorate->clients()
            ->whereHas('bloodTypes', function ($q) use ($request, $newRequest) {
                $q->where('blood_types.id', $newRequest->blood_type_id);
            })->pluck('clients.id')->toArray();

//        dd($clientIds);

        //notification
        if (count($clientIds)) {
            $notification = $newRequest->notification()->create([
                'title' => '  يوجد حالة تبرع قريبة منك',
                'content' => $newRequest->bloodType->name . 'احتاج متبرع لفصيلة',
            ]);
            // Attach Clients to this Notification.
            $notification->clients()->attach($clientIds);
            $tokens = Token::whereIn('client_id', $clientIds)->where('token', '!=', null)->pluck('token')->toArray();
            if (count($tokens)) {
                $title = $notification->title;
                $body = $notification->content;
                $data = [
                    'donation_request_id' => $newRequest->id,
                ];
                $send = notifyByFirebase($title, $body, $tokens, $data);
                info('firebase result: ' . $send);
            }
        }
        return responseJson(1, 'Added Successfully',$newRequest);
    }


    public function registerToken(Request $request)
    {
        $validator=validator()->make($request->all(),[

            'token'=>'required',
            'type'=>'required|in:android,ios'

        ]);
        if($validator->fails()){
            $data=$validator->errors();

            return responseJson(0,$validator->errors()->first(),$data);
        }
        Token::where('token',$request->token)->delete();
//        Token::create([
//            'token'=>'',
//            'type'=>'',
//            'client_id'=>$request->client()->id
//        ]);
        $request->user()->tokens()->create($request->all());  //through tokens method get id

        return responseJson(1,'تم التسجيل بنجاح');

    }

    public function removeToken(Request $request)
    {
        $validator=validator()->make($request->all(),[

            'token'=>'required'


        ]);
        if($validator->fails()){
            $data=$validator->errors();

            return responseJson(0,$validator->errors()->first(),$data);
        }
        Token::where('token',$request->token)->delete();
        return responseJson(1,'تم الحذف بنجاح');

    }



    public function donation(request $request){
        $validator=validator()->make($request->all(),[

            'donation_id' => 'required|exists:donation_requests,id'

        ]);
        if($validator->fails()){

            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }
      //  $donation=DonationRequest::with('city','bloodType')->find($request->donation_id);
        $donation = DonationRequest::where('id',$request->donation_id)->get();
//        dd($donation);
            return responseJson(1,'success',$donation);
    }
    public function donations(){
        $donations=DonationRequest::all();
        return responseJson(1,'success',$donations);
    }
    public function listFavourite(request $request){

        $list_favourite=$request->user()->posts()->paginate(10);
        return responseJson(1,'success',$list_favourite);
    }
    public function toggleFavourite(request $request){
        $validator=validator()->make($request->all(),[

            'post_id' => 'required|exists:posts,id'

        ]);
        if($validator->fails()){

            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }
        if($request->has('post_id')){
            $request->user()->posts()->toggle($request->post_id);

        }

        return responseJson(1,'نم التحديث');


    }
    public function bloodTypes(){

        $blood_type=BloodType::all();
        return responseJson(1,'success',$blood_type);


    }
    public function notificationSettings(request $request){
        $validator=validator()->make($request->all(),[
            'governorates' => 'array|exists:governorates,id',
            'blood_types' => 'array|exists:blood_types,id'

        ]);
        if($validator->fails()){

            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }

        if($request->has('governorates')){
            $request->user()->governorates()->sync($request->governorates);
        }
        if($request->has('blood_types')){
            $request->user()->bloodTypes()->sync($request->blood_types);
        }

        $data = [
            'governorates' => $request->user()->governorates()->pluck('governorates.id')->toArray(),
            'blood_types' => $request->user()->bloodTypes()->pluck('blood_types.id')->toArray()
        ];
        return responseJson(1,'success',$data);

    }

    public function post(request $request){
        $post=Post::find($request->post_id);
        if($post){
            return responseJson(1,'success',$post);

        }

    }


    public function editProfile(request $request){
        //validation
        $validator=validator()->make($request->all(),[
            'phone'=>'required',
            'password'=>'required|confirmed',
            'name'=>'required',
            'email'=>'required|unique:clients',
            'dob'=>'required',
            'last_donation_date'=>'required',
            'blood_type'=>'required|in:o+,o-,b+,b-,a+,a-,ab+,ab-',
            'city_id'=>'required'


        ]);
        if($validator->fails()){

            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }
        //encrypt password
        $request->merge(['password'=>bcrypt($request->password)]);

        //update client
//        $client = auth()->client();
//        $client->update($request->all());
        auth()->user()->update($request->all());
//        $client=\App\Models\Client::all();

        //return response
        return responseJson(1,'تم تعديل بياناتك');
    }

    public function contact(request $request){
        //validation
        $validator=validator()->make($request->all(),[
            'phone'=>'required',

            'name'=>'required',
            'email'=>'required',
            'subject'=>'required',
            'message'=>'required'


        ]);
        if($validator->fails()){

            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }
        //create data
        $contact=Contact::create($request->all());

        //return response
        return responseJson(1,'تمت اضافه بياناتك',$contact);


    }
    public function settings(){
        $settings=Setting::all();
        return responseJson(1,'success',$settings);
    }
    public function posts(){
        $posts=Post::with('category')->paginate(10);
        return responseJson(1,'success',$posts);
    }
    public function governorates(){
        $governorates=Governorate::all();
        return responseJson(1,'success',$governorates);
    }

    public function cities(request $request){
        $cities=City::where(function($query)use ($request){
            if($request->has('governorate_id')){
                $query->where('governorate_id',$request->governorate_id);
            }

        })->get();

        return responseJson(1,'success',$cities);
    }



    //
}
