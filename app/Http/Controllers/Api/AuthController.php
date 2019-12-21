<?php

namespace App\Http\Controllers\Api;

use App\Mail\OrderShipped;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Mail;
class AuthController extends Controller


{
    public function resetPassword(Request $request){
        $user = Client::where('phone',$request->phone)->first();
        if ($user)
        {
            $code = rand(111111,999999);
            $update = $user->update(['pin_code' => $code]);
            if ($update)
            {
                Mail::to($user->email)
                    ->bcc('a7madtharwat2016@gmail.com')
                    ->send(new OrderShipped($code));
                return responsejson(1,'برجاء فص هاتفك',['pin_code_for_test' => $code]);
            }else{
                return responsejson(0,'حدث خطا حاول مرة اخرى');
            }
        }else{
            return responsejson(0,'لا يوجد اى حساب مرتبط بهذا الهاتف');
        }
    }
    public function newPassword(Request $request)
    {
        $validator = validator()->make($request->all(),[
            'pin_code' => 'required',
            'phone' => 'required',
            'password' => 'required|confirmed',
        ]);
        if ($validator->fails()){
            $data = $validator->errors();
            return responsejson(0,$validator->errors(),$data);
        }
        $user = Client::where('pin_code',$request->pin_code)->where('pin_code','!=',0)->where('phone',$request->phone)->first();
        if ($user){
            $user->password = bcrypt($request->password);
            $user->pin_code = null;
            if ($user->save()){
                return responsejson(1,'تم تغير كلمة المرور بنجاح');
            }else{
                return responsejson(0,'حدث خطأ حاول مرة اخرى');
            }
        }else{
            return responsejson(0,'هذا الكود غير صالح');
        }
    }

    public function register(request $request){
        //make validation
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

        //create new client
        $client=Client::create($request->all());


        //create api token
        $client->api_token=str_random(60);
        $client->save();
        return responseJson(1,'تم اضافه مستخدم جديد',[
            'api_token'=>$client->api_token,
            'client'=>$client
        ]);


    }
    public function login(request $request){

        //validation
        $validator=validator()->make($request->all(),[
            'phone'=>'required',
            'password'=>'required',



        ]);
        if($validator->fails()){

            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }
        $client=Client::where('phone',$request->phone)->first();
        if($client){
            if(Hash::check($request->password,$client->password)){
                return responseJson(1,'تم تسجيل الدخول بنجاح',[
                    'api_token'=>$client->api_token,
                    'client'=>$client
                ]);
            }else{
                return responseJson(0,'بيانتك غير سليمه برجاء محاوله مره اخرى');
            }
        }else{
            return responseJson(0,'بيانتك غير سليمه برجاء محاوله مره اخرى');

        }

    }
    //
}
