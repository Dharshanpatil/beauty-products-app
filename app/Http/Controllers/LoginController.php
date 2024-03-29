<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Http\RedirectResponse;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use MongoDB\Driver\Manager;
use App\Models\DeliveryBoy;
use Illuminate\Support\Facades\Storage;

class LoginController extends Controller
{
    public function login()
    {
       return view('login');
    }

    public function driverLogin(Request $request){
        
         $user = DeliveryBoy::where('email',$request->email)->first();
         
        if (isset($user)) {
            if($user->password == $request->pass){
             return response()->json(  [
            'response_code' => '200',
            'user_id'=>$user->id,
            'message' => 'Login Successfully'
                ], 200);
            }else{
              return response()->json(  [
            'response_code' => '201',
            'user_id'=>$user->id,
            'message' => 'Incorrect Password!'
                ], 200);
            }
      
        }
      return response()->json(  [
        'response_code' => '201',
        'message' => 'Invalid Credentials'
            ], 201);
    }

    public function admin_login(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'email_or_phone' => 'required',
            'password' => 'required',    
        ], [
              ]);

        $user = User::where('email',$request->email_or_phone)->first();
    
        if (isset($user) && $request['password']== $user['password']) {
         
            // if (auth()->login($user)){
                    return redirect()->route('admin.dashboard');
          //  }
            
            return back();
        }

        Toastr::error('Invalid Credentials');
        return back();
    }
    
      public function changePass(Request $request){
           $user = DeliveryBoy::find($request->user_id);
           if($user->password == $request->old){
                       $user->password = $request->pass;
        $user->save();
return response()->json(  [
        'response_code' => '200',
        'message' => 'Updated Credentials'
            ], 200);
           }else{
              return response()->json(  [
        'response_code' => '201',
        'message' => 'Invalid Password'
            ], 201);  
           }
     
      }
      
    public function customer_login(Request $request){
        
        $user = User::where('phone',$request->email)->first();
    
        if (isset($user)) {
            if($user['is_active']==1){
                
            
             return response()->json(  [
            'response_code' => '200',
            'user_id'=>$user->id,
            'user_type'=>$user->type,
            'message' => 'Successfully registered'
                ], 200);
            }
             return response()->json(  [
        'response_code' => '201',
        'message' => 'Shop is Under approval'
            ], 201);
        }
      return response()->json(  [
        'response_code' => '201',
        'message' => 'Invalid Credentials'
            ], 201);
    }
    
    
    public function customer_register(Request $request){
        
                $exist = User::where('phone',$request->email)->first();
if($exist){
     return response()->json(  [
        'response_code' => '201',
        'message' => 'Account already exists'
            ], 201);
    
}
        $user = new User();
        $user->name = $request->name;
        $user->password = $request->pass;
        $user->email = $request->email;
        $user->phone = $request->mobile;
        $user->type=0;
        $user->is_active=1;
        $user->save();
        
     return response()->json(  [
        'response_code' => '200',
        'message' => 'Successfully registered'
            ], 200);
    }
    
    public function store_register(Request $request){
        
                $exist = User::where('email',$request->email)->first();
if($exist){
     return response()->json(  [
        'response_code' => '201',
        'message' => 'Account already exists'
            ], 201);
    
}
        $user = new User();
        $user->name = $request->name;
        $user->store_name = $request->store_name;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = $request->pass;
        $user->latitude = $request->latitude;
        $user->longitude = $request->longitude;
$user->location = [
    'type' => 'Point',
    'coordinates' => [
        floatval($request->longitude), // Longitude first
        floatval($request->latitude)   // Latitude second
    ]
];
        $dir ='docs/';
        $imageName = \Carbon\Carbon::now()->toDateString() . "-" . uniqid() . ".png";
        if (!Storage::disk('public')->exists($dir)) {
            Storage::disk('public')->makeDirectory($dir);
        }
        Storage::disk('public')->put($dir . $imageName, file_get_contents($request->file('logo')));

        $user->document = $imageName;
        
        $user->type=2;
        $user->is_active=0;
        $user->save();
        
     return response()->json(  [
        'response_code' => '200',
        'message' => 'Successfully registered'
            ], 200);
    }
    
    
        public function add_boys(Request $request){
        
                $exist = DeliveryBoy::where('email',$request->email)->first();
        if($exist){
             return response()->json(  [
                'response_code' => '201',
                'message' => 'Delivery Boy already exists'
                    ], 201);
            
        }
        $user = new DeliveryBoy();
        $user->name = $request->name;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = $request->pass;
                $user->shop_id = $request->shop_id;

        $user->is_active=0;
        $user->save();
        
     return response()->json(  [
        'response_code' => '200',
        'message' => 'Successfully registered'
            ], 200);
    }


}
