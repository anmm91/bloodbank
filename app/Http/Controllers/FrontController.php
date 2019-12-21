<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Mail;
use App\Mail\OrderShipped;
use App\Models\BloodType;
use App\Models\City;
use App\Models\Client;
use App\Models\ClientPost;
use App\Models\DonationRequest;
use App\Models\Governorate;
use App\Models\Post;
use App\User;
use Illuminate\Http\Request;

class FrontController extends Controller
{
public function index(Request $request){
    $blood_types=BloodType::all();
    $cities=City::all();
    $client_post=ClientPost::all();
    $posts=Post::all();

    $donations=DonationRequest::where(function ($q) use ($request){
        if($request->city_id)
        {
            $q->where('city_id' , $request->city_id);
        }

        if($request->blood_type_id)
        {
            $q->where('blood_type_id' , $request->blood_type_id);
        }
    })->get();
//    if($request->has('blood_type'))
    return view('front.index',compact('blood_types','cities','client_post','posts','donations'));

}
public function aboutus(){
    return view('front.about');
}


public function donations(Request $request){
    $donations=DonationRequest::where(function ($q) use ($request){
        if($request->city_id)
        {
            $q->where('city_id' , $request->city_id);
        }

        if($request->blood_type_id)
        {
            $q->where('blood_type_id' , $request->blood_type_id);
        }
    })->get();
    return view('front.donations' , compact('donations'));
}
    public function donation(){
        return view('front.donation');
    }
public function who(){
        return view('front.who');
    }
    public function contactus(){
        return view('front.contact');
    }
    public function signup(){
    $blood_types=BloodType::all();
    $governorates=Governorate::all();
    $cities=City::all();
        return view('front.signup',compact(['blood_types','cities','governorates']));
    }
public function postSignup(request $request){

    //validation

    $rules=[
        'phone'=>'required',
        'password'=>'required',
        'name'=>'required',

        'email'=>'required',
        'dob'=>'required',
        'last_donation_date'=>'required',
        'blood_type_id'=>'required|exists:blood_types,id',
        'city_id'=>'required|exists:cities,id',


    ];
    $message=['name.required'=>'الاسم مطلوب'];
    $this->validate($request,$rules,$message);
//    return $request->all();

    //encrypt password
    $request->merge(['password'=>bcrypt($request->password)]);
    //create user
    $client=Client::create($request->all());
    //dd($client);
    $code = rand(111111,999999);
    $update = $client->update(['pin_code' => $code]);
    Mail::to($client->email)
        ->bcc('a7madtharwat2016@gmail.com')
        ->send(new OrderShipped($code));


    //flash
    flash()->success('تم التسجيل بنحاح');
    //return login
    return redirect()->route('front-login');
}
    public function login(){
        return view('front.login');
    }
    public function articles(){
        return view('front.articles');
    }
    public function article($id){
        $post=Post::findOrFail($id);
        return view('front.article',compact('post'));
    }
    public function postLogin(Request $request){

        $this->validate($request, [
            'email'    => 'required',
            'password' => 'required',
        ]);
        $client = Client::where('email', $request->email)->first();
        //dd($client);
        if(Auth::guard('client')->attempt($request->only('email','password'))){
            flash()->success('تم التسجيل بنجاح');
            return redirect('/');
        }
    }
    public function toggleFavourite(request $request){
        $toggle=$request->user('client')->posts()->toggle($request->post_id);
        return responseJson(1,'success',$toggle);

    }
    public function createDonation(){
     return view('front.create-donation');
    }

}
