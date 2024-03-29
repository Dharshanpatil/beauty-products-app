<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Http\RedirectResponse;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use MongoDB\Driver\Manager;
use App\Models\Category;
use App\Models\DeliveryBoy;
use App\Models\ShopProducts;
use App\Models\Orders;
use Illuminate\Support\Facades\Http;
use MongoDB\BSON\Decimal128;
use MongoDB\BSON\ObjectId;
use App\Models\Blogs;
use Illuminate\Database\Query\Expression;

class ApiController extends Controller
{
    
    
        public function place_api_autocomplete(Request $request)
    {
       

                $google_map_base_api = 'https://maps.googleapis.com/maps/api';
        $google_map = 'AIzaSyCVLAwdE33jwAiKPKkLIoUTHhJJOqAyLUc';
        $response = Http::get($google_map_base_api . '/place/autocomplete/json?input=' . $request['search_text'] . '&key=' . $google_map);
        $data=[
            'response_code' => 'default_200',
                 'content' => $response->json()
            ];
        return response()->json($data);
    }
    
    
     public function place_api_details(Request $request)
    {
        
        $google_map = 'AIzaSyCVLAwdE33jwAiKPKkLIoUTHhJJOqAyLUc';
        $response = Http::get('https://maps.googleapis.com/maps/api/place/details/json?placeid=' . $request['placeid'] . '&key=' .$google_map);

                $data=[
            'response_code' => 'default_200',
                 'content' => $response->json()
            ];
        return response()->json($data);
    }

    public function geocode_api(Request $request)
    {
    

           $google_map = 'AIzaSyCVLAwdE33jwAiKPKkLIoUTHhJJOqAyLUc';

        $response = Http::get('https://maps.googleapis.com/maps/api/geocode/json?latlng=' . $request->lat . ',' . $request->lng . '&key=' .$google_map);
            $data=[
            'response_code' => 'default_200',
                 'content' => $response->json()
            ];
        return response()->json($data);
    }
    
    
      public function search($search ,Request $request)
    {
       
                          $categories = User::where('type',2)->where('is_active',1)->where('name', 'like', '%' . $search . '%')->latest()->get();


        $data = [
            'data' => $categories
        ];
        return response()->json($data, 200);
    }
    
    
         public function getBlogs(Request $request)
    {
         
        $categories = Blogs::latest()->get();
        $data = [
            'data' => $categories
        ];
        
        return response()->json($data, 200);
    }
    
     public function getShops(Request $request)
    {
         $latitude = floatval($request->lattitude);
         $longitude = floatval($request->longitude);
       $radius = 10000;
     $categories = User::where('type',2)->where('is_active',1)->get();
$userDistances = [];
        $google_map = 'AIzaSyCVLAwdE33jwAiKPKkLIoUTHhJJOqAyLUc';

foreach ($categories as $key => $user) {
            $response = Http::get('https://maps.googleapis.com/maps/api/distancematrix/json?origins=' .$latitude . ',' .$longitude . '&destinations=' .$user->latitude . ',' . $user->longitude . '&key=' . $google_map);

$data = $response->json();
$distanceInMeters = $data['rows'][0]['elements'][0]['distance']['value'];
  if ($distanceInMeters != -1) {
        $distanceInKilometers = $distanceInMeters / 1000; // Convert meters to kilometers
        $user->distance = $distanceInKilometers;
    } else {
       $user->distance = 999;
    }
    
    // if ($distanceInKilometers > 300) {
    //     $categories->forget($key);
    // }

}
//$categoriesArray = $categories->sortBy('distance');

// usort($categoriesArray, function($a, $b) {
//     return $a->distance <=> $b->distance;
// });
// // Step 3: Order users by distance
// asort($userDistances); // Sort the distances in ascending order, maintaining the keys

// // Retrieve users in the sorted order
// $sortedUsers = [];
// foreach ($userDistances as $userId => $distance) {
//     $user = User::find($userId);
//     $sortedUsers[] = $user;
// }

  $point = [
            'type' => 'Point',
            'coordinates' => [$longitude, $latitude],
        ];


// $categories = User::selectRaw(
//     '*, ( 6371 * acos( cos( radians(?) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?)) + sin( radians(?) ) * sin( radians( latitude ) ) ) ) AS distance',
//     [$latitude, $longitude, $latitude]
// )
// ->selectRaw(new Expression('CAST(distance AS CHAR) AS distance'))
// ->where('type', 2)
// ->where('is_active', 1)
// ->orderBy('distance')
// ->get();
    
    //   $categories = User::where('location', [
    //     '$geoWithin' => [
    //         '$centerSphere' => [
    //             $point['coordinates'],
    //             100000000000 / 6371 / 1000, // Convert distance from meters to radians
    //         ],
    //     ],
    // ])
    // ->where('type', 2)
    // ->where('is_active', 1)
    // ->orderBy('location', 'asc')
    // ->get();
// $filteredShopList = $categories->filter(function ($shop) {
//     return $shop['distance'] <= 300;
// });
        $data = [
            'data' => $categories,
                        'coordinates' => [$longitude, $latitude],

        ];
        
        return response()->json($data, 200);
    }
    
     public function deleteProduct(Request $request)
     {
       
       $categories = ShopProducts::find($request->id);
            $categories->delete();

        $data = [
            'data' => $categories
        ];
        return response()->json($data, 200);
    }
    
        public function productsbyshop($cat,$shop,Request $request){
            if($cat == "all"){
                                    $categories = ShopProducts::where('shop_id',$shop)->latest()->get();

            }else{
                                    $categories = ShopProducts::where('shop_id',$shop)->where('category_id',$cat)->latest()->get();
            }

        $data = [
            'data' => $categories
        ];
        return response()->json($data, 200);
}

    public function getShopProducts($shop,Request $request){
                    $categories = ShopProducts::where('shop_id',$shop)->latest()->get();

        $data = [
            'data' => $categories
        ];
        return response()->json($data, 200);
   }

 public function getOrders($user,Request $request){
       $categories = Orders::where('shop_id',$user)->where('is_assign',0)->where('status',"Pending")->latest()->get();

        $data = [
            
            'data' => $categories
        ];
        return response()->json($data, 200);
   }
   
    public function getDriverOrders($user,Request $request){
       $categories = Orders::where('driver_id',$user)->where('is_assign',1)->where('status',"On the Way")->latest()->get();

        $data = [
            'data' => $categories
        ];
        return response()->json($data, 200);
   }
   
   
      public function cancelOrder(Request $request)
    {
       
        $categories = Orders::find($request->id);
        $categories->status = 'Canceled';
        $categories->save();
       
        $data = [
            'data' => $categories
        ];
        return response()->json($data, 200);
    }
    
     public function completeOrder(Request $request)
    {
       
        $categories = Orders::find($request->id);
        $categories->status = 'Delivered';
        $categories->save();
       
        $data = [
            'data' => $categories
        ];
        return response()->json($data, 200);
    }
   
         public function assignDriver(Request $request)
    {
       
        $categories = Orders::find($request->order_id);
        $categories->status = 'On the Way';
                $categories->is_assign = 1;
                $categories->driver_id = $request->driver_id;

        $categories->save();
       
        $data = [
            'data' => ''
        ];
        return response()->json($data, 200);
    }
    
    public function getDriverHistory($user,Request $request){
                                     $categories = Orders::where('driver_id',$user)->latest()->get();
  $data = [
            'data' => $categories
        ];
        return response()->json($data, 200);
    }
    
     public function getHistory($user,$type,Request $request){
     if($type == 2){
                             $categories = Orders::with('shop')->where('shop_id',$user)->latest()->get();

     }else{
                             $categories = Orders::with('shop')->where('user_id',$user)->latest()->get();
     }

      foreach ($categories as $category) {
if($category->is_assign == 1){
        $category->driver = DeliveryBoy::find($category->driver_id);
}
         }
        $data = [
            'data' => $categories
        ];
        return response()->json($data, 200);
   }
   
     public function buyProductForUser(Request $request){
         

        $products=  new Orders();
        $products->shop_id = $request->shop_id;
        $products->user_id = $request->user_id;
        $products->product_id = $request->product_id;
        $products->name = $request->name;
        $products->category_id = $request->cat_id;
        $products->sub_category_id = $request->subcat_id;
        $products->description = $request->description;
        $products->thumbnail =  $request->image;
        $products->amount = $request->cost;
        $products->quntyty = $request->quntyty;
        $products->is_assign = 0;
        $products->status = 'Pending';

        $products->save();
         $data = [
            'data' => 'Purchase  Successfully',
        ];
        return response()->json($data, 200);
     
    }


     public function buyProductForShop(Request $request){
         
$isexists = ShopProducts::where('product_id', $request->product_id)->where('shop_id',$request->shop_id)->first();

if($isexists){
         $isexists->shop_id = $request->shop_id;
        $isexists->product_id = $request->product_id;
        $isexists->name = $request->name;
        $isexists->category_id = $request->cat_id;
        $isexists->sub_category_id = $request->subcat_id;
        $isexists->description = $request->description;
        $isexists->thumbnail =  $request->image;
        $isexists->amount = $request->cost;
        $isexists->quntyty = $isexists->quntyty+$request->quntyty;
        $isexists->save();
        
         $data = [
            'data' => 'Product added Successfully',
        ];
        return response()->json($data, 200);
}
        $products=  new ShopProducts();
        $products->shop_id = $request->shop_id;
        $products->product_id = $request->product_id;
        $products->name = $request->name;
        $products->category_id = $request->cat_id;
        $products->sub_category_id = $request->subcat_id;
        $products->description = $request->description;
        $products->thumbnail =  $request->image;
        $products->amount = $request->cost;
        $products->quntyty = $request->quntyty;
        $products->save();
         $data = [
            'data' => 'Product added Successfully',
        ];
        return response()->json($data, 200);
     
    }
    
    public function categories(Request $request)
    {
        $search = $request->has('search') ? $request['search'] : '';
        $query_param = ['search' => $search];

       $categories = Category::where('parent_id', "0")
            ->latest()->get();

        $data = [
            'data' => $categories
        ];
        return response()->json($data, 200);
    }
    
      
    public function products(Request $request)
    {
      
       $categories = Products::latest()->get();

        $data = [
            'data' => $categories
        ];
        return response()->json($data, 200);
    }
    
     public function productsbycat($cat,Request $request)
    {
      
       $categories = Products::where('category_id',$cat)->latest()->get();

        $data = [
            'data' => $categories
        ];
        return response()->json($data, 200);
    }
    
      
    public function getBoys($user,Request $request)
    {
       
       $categories = DeliveryBoy::where('shop_id', $user)
            ->latest()->get();

        $data = [
            'data' => $categories
        ];
        return response()->json($data, 200);
    }
    
     public function deleteBoys(Request $request)
    {
       
       $categories = DeliveryBoy::find($request->id);
            $categories->delete();

        $data = [
            'data' => $categories
        ];
        return response()->json($data, 200);
    }
}