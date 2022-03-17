<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cat;
use App\Models\Subcat;
use App\Models\Brand;
use App\Models\Guest;
use App\Models\Producttype;
use App\Models\Unit;
use Image;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function showproduct(Request $request)
    {
      $search = $request->query('search');
      if ($search) {
        $allproduct =Product::where('junk', 0)->where('product_code','LIKE',"%{$search}%")->orWhere('name', 'LIKE',"%{$search}%")->join('cats', 'products.cat_id', '=', 'cats.id')
        ->join('subcats', 'products.subcat_id', '=', 'subcats.id')
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->join('producttypes', 'products.product_type_id', '=', 'producttypes.id')
        ->join('units', 'products.unit_id', '=', 'units.id')
        ->paginate(30);

      }else{


        $allproduct =Product::where('junk', 0)->join('cats', 'products.cat_id', '=', 'cats.id')
        ->join('subcats', 'products.subcat_id', '=', 'subcats.id')
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->join('producttypes', 'products.product_type_id', '=', 'producttypes.id')
        ->join('units', 'products.unit_id', '=', 'units.id')
        ->paginate(30);
      }
      return view('user.product',compact('allproduct'));
  }
public function returnviewpr($code)
{
  $productview = Product::where('product_code', '=',$code)->first();
  return view('user.productview',compact('productview'));
}

    public function productbytitle($code)

    {

        $prtest = Product::where('product_code', '=',$code)->first();
        if ($prtest==null) {
            return redirect('product');
        }
        $singlepr =Product::join('cats', 'products.cat_id', '=', 'cats.id')
        ->join('subcats', 'products.subcat_id', '=', 'subcats.id')
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->join('producttypes', 'products.product_type_id', '=', 'producttypes.id')
        ->join('units', 'products.unit_id', '=', 'units.id')->where('products.product_code', '=',$code)
        ->first();
        $data = Cat::all();
        $subcats = Subcat::all();
        $allbrand = Brand::all();
        $allpt = Producttype::all();
        $allunit = Unit::all();
        return view('user.upproduct',compact('singlepr','data','subcats','allbrand','allpt','allunit'));

    }



    public function addnewproduct()
    {

       // $data = Cat::all();
        $allbrand = Brand::all();
        $allpt = Producttype::all();
        $allunit = Unit::all();
        $data = DB::table('cats')->pluck("cat_name","id");

        return view('user.addproduct',compact('data','allbrand','allpt','allunit'));

    }
    public function getStates($id)
    {
            $states = DB::table("subcats")->where("cat_id",$id)->pluck("subcat_name","id");
            return json_encode($states);
    }
    public function inserproduct(Request $request)
    {

        $request->validate([
            'cat_id' =>'required',
            'subcat_id' =>'required',
            'brand_id' =>'required',
            'product_type_id' =>'required',
            'product_code' => 'required|unique:products|max:20',
            'name' => 'required|unique:products|max:150',
            'quantity' => 'required',
            'unit_id' =>'required',
            'buy_price' => 'required|numeric|min:1',
            'sell_price' =>'required|numeric|min:1',
            'discount' =>'required|numeric',
            'image1' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',


         ]);



         if ($request->file("image1") !="") {
             $file=$request->file("image1");
             $file_name=time().$file->getClientOriginalName();
             $img =\Image::make($file);

             $productsins = Product::insert([
                'cat_id'=>$request->input('cat_id'),
                'subcat_id'=>$request->input('subcat_id'),
                'brand_id'=>$request->input('brand_id'),
                'product_type_id'=>$request->input('product_type_id'),
                'product_code'=>$request->input('product_code'),
                'name'=>$request->input('name'),
                'details'=>$request->input('details'),
                'quantity'=>$request->input('quantity'),
                'unit_id'=>$request->input('unit_id'),
                'buy_price'=>$request->input('buy_price'),
                'sell_price'=>$request->input('sell_price'),
                'discount'=>$request->input('discount'),
                'image_one'=>$file_name,

                'junk'=>0
            ]);

          if ($productsins) {
              $img->save(\public_path('images/'.$file_name),10);
            return back()->with('success','Successfully New Product Created');
          }
          else{
            return back()->with('fail','Something Went wrong Try Again!');
          }
         }







    }


    public function updateproduct(Request $request)
    {
        $id = $request->input('id');
        $request->validate([
            'cat_id' =>'required',
            'brand_id' =>'required',
            'product_type_id' =>'required',
            'product_code' => 'required',
            'name' => 'required|max:190',
            'quantity' => 'required',
            'unit_id' =>'required',
            'buy_price' => 'required|numeric|min:1',
            'sell_price' =>'required|numeric|min:1',
            'discount' =>'required|numeric|',


         ]);



         if ($request->file("image1") !="") {
            $file=$request->file("image1");
            $file_name=time().$file->getClientOriginalName();
            $img =\Image::make($file);

            $updateproduct = Product::where('id', $id)->update([
                'cat_id'=>$request->input('cat_id'),
                'subcat_id'=>$request->input('subcat_id'),
                'brand_id'=>$request->input('brand_id'),
                'product_type_id'=>$request->input('product_type_id'),
                'product_code'=>$request->input('product_code'),
                'name'=>$request->input('name'),
                'details'=>$request->input('details'),
                'quantity'=>$request->input('quantity'),
                'unit_id'=>$request->input('unit_id'),
                'buy_price'=>$request->input('buy_price'),
                'sell_price'=>$request->input('sell_price'),
                'image_one'=>$file_name,
                'discount'=>$request->input('discount')
           ]);
 $img->save(\public_path('images/'.$file_name),0);

}elseif ($request->file("image1")==""){
    $updateproduct = Product::where('id', $id)->update([
        'cat_id'=>$request->input('cat_id'),
        'subcat_id'=>$request->input('subcat_id'),
        'brand_id'=>$request->input('brand_id'),
        'product_type_id'=>$request->input('product_type_id'),
        'product_code'=>$request->input('product_code'),
        'name'=>$request->input('name'),
        'details'=>$request->input('details'),
        'quantity'=>$request->input('quantity'),
        'unit_id'=>$request->input('unit_id'),
        'buy_price'=>$request->input('buy_price'),
        'sell_price'=>$request->input('sell_price'),
        'discount'=>$request->input('discount')
        ]);
}
         if ($updateproduct) {

           return back()->with('success','Successfully New Product Updated');
         }
         else{
           return back()->with('fail','Something Went wrong Try Again!');
         }




    }

    public function junkproduct(Request $request)
    {
       $id = $request->input('id');
        $subcatins = Product::where('id', $id)->update([
            'junk'=>1


        ]);

        if ($subcatins) {
          return back()->with('success','Successfully Remove at Junk Created');
        }
        else{
          return back()->with('fail','Something Went wrong Try Again!');
        }
    }



    public function showbanner()
    {
        $allsubcat = Subcat::all();
        $banners  =Subcat::join('banners', 'subcats.subcat_name', '=', 'banners.subcat_name')->paginate(10);
        return view('user.banner',compact('allsubcat','banners'));
    }
    public function createbanner(Request $request)
    {
        $request->validate([
            'subcat_name' =>'required',
            'banner_flag' =>'required',
            'details' =>'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
         ]);

         if ($request->file("image") !="") {
            $file=$request->file("image");
            $file_name=time().$file->getClientOriginalName();
            $img =\Image::make($file);

            $banner = Banner::insert([

               'subcat_name'=>$request->input('subcat_name'),
               'banner_flag'=>$request->input('banner_flag'),
               'details'=>$request->input('details'),
               'image'=>$file_name

           ]);

         if ($banner) {
             $img->save(\public_path('images/'.$file_name),100);
           return back()->with('success','Successfully New Banner Addd');
         }
         else{
           return back()->with('fail','Something Went wrong Try Again!');
         }
        }
    }
    public function delbanner(Request $request)
{
$id =$request->input('id');
$image=  Banner::where('id', '=',$id)->first();
unlink('images/'.$image['image']);

$remove = Banner::where('id', '=',$id)->delete();
if ($remove) {

return redirect('banner')->with('sss', 'Data Removed');
}
else{
return back()->with('fff','Something went wrong Try Again!');
}
}

}
