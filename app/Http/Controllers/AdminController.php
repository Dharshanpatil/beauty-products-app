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

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
      $pcount=  Products::count();
       $ucount=  User::where('type',0)->count();
      $scount= User::where('type',2)->where('is_active',1)->count();

        return view('dashboard',[
            "pcount"=>$pcount,
            "user"=>$ucount,
            "shops"=>$scount,
            ]);
    }


    public function category(Request $request)
    {
        $search = $request->has('search') ? $request['search'] : '';
        $query_param = ['search' => $search];

       
              $categories = Category::where('parent_id', "0")->when($request->has('search'), function ($query) use ($request) {
                $keys = explode(' ', $request['search']);
                return $query->where(function ($query) use ($keys) {
                    foreach ($keys as $key) {
                        $query->orWhere('name', 'LIKE', '%' . $key . '%');
                    }
                });
            })
            ->latest()->get();
        return view('category', compact('categories','search'));
    }
    
    
    
      public function categoryStore(Request $request){
          
          $exists = Category::where('name',$request->category)->get();
          \Log::info($exists);
          if(!$exists->isEmpty()){
                Toastr::error('Category already added');
              return back();
          }
        $category = new Category();
        $category->name = $request->category;
        $category->parent_id = $request->parent_id;
        $category->save();
                      Toastr::success('Category added Successfully');

        return back();
    }
    
    public function categoryUpdate($id,Request $request,)
   {
        $exists = Category::where('name',$request->category)->get();
         if(!$exists->isEmpty()){
                Toastr::error('Category already added');

        return back();
          }
       $category = Category::find($id);
      $category->name = $request->name;
       $category->save();
      Toastr::success('Category updated Successfully');

        return back();    
   }
   
     public function shopdestroy($id,Request $request)
    {
         $delete = User::find($id);
     $delete->delete();
                              Toastr::success('Deleted Successfully');

         return back();
    }
    
    
    public function categoryDestroy($id,Request $request)
    {
         $delete = Category::find($id);
     $delete->delete();
                              Toastr::success('Deleted Successfully');

         return back();
    }
    
            public function getSubs($id,Request $request)
    {
                $categories = Category::where('parent_id',$id)->orderBY('name', 'asc')->get();
                  $sub_category_id = $request->sub_category_id??null;

        // return response()->json([
        //     'template' => view('_childes-selector', compact('categories', 'sub_category_id'))->render()
        // ], 200);
 return response()->json([
            'data'=>$categories
            ], 200);
    }
        public function subCategory(Request $request)
    {
        $search = $request->has('search') ? $request['search'] : '';
        $query_param = ['search' => $search];

              $mcategories =  Category::where('parent_id', "0")->get();

              $categories =  Category::where('parent_id','!=', "0")->when($request->has('search'), function ($query) use ($request) {
                $keys = explode(' ', $request['search']);
                return $query->where(function ($query) use ($keys) {
                    foreach ($keys as $key) {
                        $query->orWhere('name', 'LIKE', '%' . $key . '%');
                    }
                });
            })
            ->latest()->get();
            
        return view('subcategory', compact('categories','mcategories','search'));
    }
    
       public function users(Request $request)
    {
        $search = $request->has('search') ? $request['search'] : '';
        $query_param = ['search' => $search];

       
              $users = User::where('type',0)->when($request->has('search'), function ($query) use ($request) {
                $keys = explode(' ', $request['search']);
                return $query->where(function ($query) use ($keys) {
                    foreach ($keys as $key) {
                        $query->orWhere('name', 'LIKE', '%' . $key . '%');
                    }
                });
            })
            ->latest()->get();
        return view('user', compact('users','search'));
    }
    
    
      public function usersDestroy($id,Request $request)
    {
         $delete = User::find($id);
         $delete->delete();
          Toastr::success('Deleted Successfully');
         return back();
    }
    
      public function shops(Request $request)
    {
        $search = $request->has('search') ? $request['search'] : '';
        $query_param = ['search' => $search];

       
              $users = User::where('is_active',1)->where('type',2)->when($request->has('search'), function ($query) use ($request) {
                $keys = explode(' ', $request['search']);
                return $query->where(function ($query) use ($keys) {
                    foreach ($keys as $key) {
                        $query->orWhere('name', 'LIKE', '%' . $key . '%');
                    }
                });
            })
            ->latest()->get();
        return view('shops', compact('users','search'));
    }
    
        public function requsts_shops(Request $request)
    {
        $search = $request->has('search') ? $request['search'] : '';
        $query_param = ['search' => $search];

       
              $users = User::where('type',2)->where('is_active',0)->when($request->has('search'), function ($query) use ($request) {
                $keys = explode(' ', $request['search']);
                return $query->where(function ($query) use ($keys) {
                    foreach ($keys as $key) {
                        $query->orWhere('name', 'LIKE', '%' . $key . '%');
                    }
                });
            })
            ->latest()->get();
        return view('reqshops', compact('users','search'));
    }
    
        public function approveShop($id,Request $request,)
   {
       $shop = User::find($id);
       $shop->is_active = 1;
       $shop->save();
      Toastr::success('Shop approved Successfully');
        return redirect('admin/requsts_shops');    
   }
    
}