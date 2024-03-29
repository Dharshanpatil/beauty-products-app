<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use MongoDB\Driver\Manager;
use Illuminate\Support\Facades\Storage;
use App\Models\Blogs;

class ProductsController extends Controller
{
    //
    
    
     public function blogindex(Request $request)
    {
      
       
              $products = Blogs::latest()->paginate(10);


        return view('blogs', compact('products'));
    }
    
    public function index(Request $request)
    {
         $search = $request->has('search') ? $request['search'] : '';
        $query_param = ['search' => $search];

       
              $products = Products::with('categorys','subcategorys')->when($request->has('search'), function ($query) use ($request) {
                $keys = explode(' ', $request['search']);
                return $query->where(function ($query) use ($keys) {
                    foreach ($keys as $key) {
                        $query->orWhere('name', 'LIKE', '%' . $key . '%');
                    }
                });
            })
                        ->latest()->paginate(10)->appends($query_param);


        return view('products', compact('products','search'));
    }
    
    public function  blogupload(){
                        return view('addblog');

    }
    
       public function blogstore(Request $request){
        $products=  new Blogs();
        $products->title = $request->name;
        $products->blog = $request->description;
        

$dir ='blogs/';
        $imageName = \Carbon\Carbon::now()->toDateString() . "-" . uniqid() . ".png";
        if (!Storage::disk('public')->exists($dir)) {
            Storage::disk('public')->makeDirectory($dir);
        }
        Storage::disk('public')->put($dir . $imageName, file_get_contents($request->file('thumbnail')));

        $products->thumbnail = $imageName;
        $products->save();
        
        Toastr::success('Blog added Successfully');
         return back();
    }
    
    
      public function blogdestroy($id,Request $request)
    {
         $delete = Blogs::find($id);
     $delete->delete();
                              Toastr::success('Deleted Successfully');

         return back();
    }
    
    public function upload(){
        
                      $categories =  Category::where('parent_id', "0")->get();

                return view('addproducts', compact('categories'));

    }
    
    public function store(Request $request){
        $products=  new Products();
        $products->name = $request->name;
        $products->category_id = $request->category;
        $products->sub_category_id = $request->sub_category_id;
        $products->description = $request->description;
        

$dir ='products/';
        $imageName = \Carbon\Carbon::now()->toDateString() . "-" . uniqid() . ".png";
        if (!Storage::disk('public')->exists($dir)) {
            Storage::disk('public')->makeDirectory($dir);
        }
        Storage::disk('public')->put($dir . $imageName, file_get_contents($request->file('thumbnail')));

        $products->thumbnail = $imageName;
        $products->amount = $request->amount;
        $products->save();
        
        Toastr::success('Product added Successfully');
         return back();
    }
    
        public function update($id,Request $request){
         $products = Products::find($id);
        $products->name = $request->name;
        $products->description = $request->description;
        $products->amount = $request->amount;
        $products->save();
        
        Toastr::success('Product updated Successfully');
         return back();
    }
      public function destroy($id,Request $request)
    {
         $delete = Products::find($id);
     $delete->delete();
                              Toastr::success('Deleted Successfully');

         return back();
    }
}
