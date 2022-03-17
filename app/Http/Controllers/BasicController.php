<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cat;
use App\Models\Subcat;
use App\Models\Brand;
use App\Models\Producttype;
use App\Models\Unit;
use App\Models\Product;
use App\Models\Color;
use App\Models\Colorcreate;
use App\Models\Dailycost;
use App\Models\Guestpay;
use App\Models\Order;
use App\Models\Productimage;
use App\Models\Size;
use App\Models\Sizecreate;
use App\Models\Sleep;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Auth;
use Image;

class BasicController extends Controller
{

    // public function __construct()
    // {

    //     $this->middleware('auth');
    // }

public $a = 20;

  //CAT
    public function showcat()
    {

        $allcat = Cat::where('cat_junk','0')->paginate($this->a);
        return view('user.cat',compact('allcat'));
    }
    public function showcatbyid($id)
    {

        $catbyid = Cat::where('id', '=',$id)->first();
        $allcat = Cat::where('cat_junk','0')->paginate($this->a);
        return view('user.upcat',compact('catbyid','allcat'));
    }
    public function createcat(Request $request)
    {

         $request->validate([
            'cat_name' => 'required|unique:cats|max:150',
        ]);
        $catins = Cat::insert([
          'cat_name'=>$request->input('cat_name')
      ]);
      if ($catins) {
        return back()->with('success','Successfully New Category Created');
      }
      else{
        return back()->with('fail','Something Went wrong Try Again!');
      }
    }
    public function updatecat(Request $request)
    {

      $id = $request->id;
        $request->validate([
            'cat_name' => 'required|unique:cats|max:150',

        ]);
       $catup = Cat::where('id', $id)->update([
            'cat_name' => $request->cat_name

            ]);
            if ($catup) {
                return back()->with('success','Category Updated Successfully');
              }
              else{
                return back()->with('fail','Something went wrong Try Again!');
              }
    }
    public function delcats(Request $request)
    {

      $id = $request->id;

     $catup = Cat::where('id', $id)->delete();
          if ($catup) {
              return back()->with('success','Category Removed Successfully');
            }
            else{
              return back()->with('fail','Something went wrong Try Again!');
            }
    }



    //SUB CAT

    public function showsubcat()
    {
     $allsubcat =  Cat::join('subcats', 'cats.id', '=', 'subcats.cat_id')->where('subcat_junk','0')->paginate($this->a);
        $allcat = Cat::all();
        return view('user.subcat',compact('allsubcat','allcat'));
    }
    public function showsubcatbyid($id)
    {
        $subcatbyid = Subcat::where('id', '=',$id)->first();
        $allsubcat =  Cat::join('subcats', 'cats.id', '=', 'subcats.cat_id')->where('subcat_junk','0')->paginate($this->a);
        return view('user.upsubcat',compact('subcatbyid','allsubcat'));
    }
    public function createsubcat(Request $request)
    {
         $request->validate([
           'cat_id' =>'required',
            'subcat_name' => 'required|max:150',
        ]);
        $subcatins = Subcat::insert([
          'cat_id'=>$request->input('cat_id'),
          'subcat_name'=>$request->input('subcat_name')
      ]);
      if ($subcatins) {
        return back()->with('success','New subCategory Created Successfully');
      }
      else{
        return back()->with('fail','Something Went wrong Try Again!');
      }
    }
    public function updatesubcat(Request $request)
    {
      $id = $request->id;
        $request->validate([
            'subcat_name' => 'required|max:150',

        ]);
       $catup = Subcat::where('id', $id)->update([
            'subcat_name' => $request->subcat_name

            ]);
            if ($catup) {
                return back()->with('success','SubCategory Updated Successfully');
              }
              else{
                return back()->with('fail','Something went wrong Try Again!');
              }
    }
    public function delsubcats(Request $request)
    {
      $id = $request->id;
        $request->validate([
            'subcat_name' => 'required|max:150',

        ]);
       $catup = Subcat::where('id', $id)->delete();
            if ($catup) {
                return back()->with('success','SubCategory Removed Successfully');
              }
              else{
                return back()->with('fail','Something went wrong Try Again!');
              }
    }
//Brand




public function showbrand()
{
 $allbrand =  Brand::where('brand_junk','0')->paginate($this->a);

    return view('user.brand',compact('allbrand'));
}
public function showbrandbyid($id)
{
    $brandbyid = Brand::where('id', '=',$id)->first();
    $allbrand =  Brand::where('brand_junk','0')->paginate($this->a);
    return view('user.upbrand',compact('brandbyid','allbrand'));
}
public function createbrand(Request $request)
{
     $request->validate([

        'brand_name' => 'required|unique:brands|max:150',
    ]);
    $brandins = Brand::insert([

      'brand_name'=>$request->input('brand_name')
  ]);
  if ($brandins) {
    return back()->with('success','Successfully New Brand Created');
  }
  else{
    return back()->with('fail','Something Went wrong Try Again!');
  }
}
public function updatebrand(Request $request)
{
  $id = $request->id;
    $request->validate([
        'brand_name' => 'required|unique:brands|max:150',

    ]);
   $brandup = Brand::where('id', $id)->update([
        'brand_name' => $request->brand_name

        ]);
        if ($brandup) {
            return back()->with('success','Successfully subCategory Updated');
          }
          else{
            return back()->with('fail','Something went wrong Try Again!');
          }
}
public function delbrand(Request $request)
{
  $remove = Brand::where('id', $request->id)->delete();
  if ($remove) {
    return redirect('brand')->with('sss', 'Data Removed');
  }
  else{
    return back()->with('fff','Something went wrong Try Again!');
  }
}

//COLOR  NEW
public function showcolornew()
{
  $createcolor = Colorcreate::where('color_junk','0')->paginate($this->a);
    return view('user.createcolor',compact('createcolor'));
}
public function createcolornew(Request $request)
{
     $request->validate([

        'color_name' => 'required|unique:colorcreates|max:150',
    ]);
    $brandins = Colorcreate::insert([

      'color_name'=>$request->input('color_name')
  ]);
  if ($brandins) {
    return back()->with('success','Successfully New Brand Created');
  }
  else{
    return back()->with('fail','Something Went wrong Try Again!');
  }
}
public function delcolornew(Request $request)
{
  $remove = Colorcreate::where('id', $request->id)->update([
    'color_junk' => 1

    ]);
  if ($remove) {
    return redirect('color/create')->with('sss', ' Removed');
  }
  else{
    return back()->with('fff','Something went wrong Try Again!');
  }
}

//SIZE  NEW
public function showsizenew()
{
  $createsize = Sizecreate::where('size_junk','0')->paginate($this->a);
    return view('user.createsize',compact('createsize'));
}
public function createsizenew(Request $request)
{
     $request->validate([

        'size_name' => 'required|unique:sizecreates|max:150',
    ]);
    $brandins = Sizecreate::insert([

      'size_name'=>$request->input('size_name')
  ]);
  if ($brandins) {
    return back()->with('success','Successfully New Brand Created');
  }
  else{
    return back()->with('fail','Something Went wrong Try Again!');
  }
}
public function delsizenew(Request $request)
{
  $remove = Brand::where('id', $request->id)->update([
    'size_junk' => 1

    ]);
  if ($remove) {
    return redirect('size/create')->with('sss', 'Data Removed');
  }
  else{
    return back()->with('fff','Something went wrong Try Again!');
  }
}
//COLOR

public function showcolor()
{
  $products = Product::where('junk', 0)->get();
  $createcolor = Colorcreate::all();
  $colors =Product::join('colors', 'products.product_code', '=', 'colors.product_code')

        ->paginate($this->a);

    return view('user.color',compact('colors','products','createcolor'));
}

public function createcolor(Request $request)
{
     $request->validate([

        'color' => 'required|max:150',
    ]);

    $brandins = Color::insert([

      'product_code'=>$request->input('product_id'),
      'color'=>$request->input('color')
  ]);
  if ($brandins) {
    return back()->with('success','Successfully New Brand Created');
  }
  else{
    return back()->with('fail','Something Went wrong Try Again!');
  }
}

public function delcolor(Request $request)
{
  $remove = Color::where('id', '=',$request->id)->delete();
  if ($remove) {
    return redirect('color')->with('sss', 'Data Removed');
  }
  else{
    return back()->with('fff','Something went wrong Try Again!');
  }
}


//SIZE




public function showsize()
{
  $products = Product::where('junk', 0)->get();
  $allsize = Sizecreate::where('size_junk', 0)->get();
  $sizes =Product::join('sizes', 'products.product_code', '=', 'sizes.product_code')

        ->paginate($this->a);

    return view('user.size',compact('sizes','products','allsize'));
}

public function createsize(Request $request)
{
     $request->validate([

        'size' => 'required|max:150',
    ]);
    $brandins = Size::insert([

      'product_code'=>$request->input('product_id'),
      'size'=>$request->input('size')
  ]);
  if ($brandins) {
    return back()->with('success','Successfully Added');
  }
  else{
    return back()->with('fail','Something Went wrong Try Again!');
  }
}

public function delsize(Request $request)
{
  $remove = Size::where('id', '=',$request->id)->delete();
  if ($remove) {
    return redirect('size')->with('sss', 'Data Removed');
  }
  else{
    return back()->with('fff','Something went wrong Try Again!');
  }
}




//COST




public function showcost(Request $request)
{
    $today = $request->query('todaydate');

    if ($today) {
        $allcost = Dailycost::where('created_at','LIKE',"%{$today}%")
        ->paginate($this->a);
        return view('user.dailycost',compact('allcost'));
    } elseif ($request->query('yesterday')) {
        $allcost =Dailycost::where('created_at','LIKE',"%{$request->query('yesterday')}%")
        ->paginate($this->a);
        return view('user.dailycost',compact('allcost'));

    }elseif($request->query('month') && $request->query('month1')){
        $allcost =Dailycost::whereBetween('created_at', array($request->query('month1'), $request->query('month')))
        ->paginate($this->a);
        return view('user.dailycost',compact('allcost'));

    }else{

        $allcost =Dailycost::orderBy('dailycosts.created_at', 'desc')->paginate($this->a);

          return view('user.dailycost',compact('allcost'));
    }

}

public function createcost(Request $request)
{
     $request->validate([

        'cost' => 'required|max:150',
        'report' => 'required',
    ]);
    $brandins = Dailycost::insert([

      'cost'=>$request->input('cost'),
      'report'=>$request->input('report')
  ]);
  if ($brandins) {
    return back()->with('success','Successfully New Brand Created');
  }
  else{
    return back()->with('fail','Something Went wrong Try Again!');
  }
}

public function delcost(Request $request)
{
  $remove = Dailycost::where('id', '=',$request->id)->delete();
  if ($remove) {
    return redirect('dailycost')->with('sss', 'Data Removed');
  }
  else{
    return back()->with('fff','Something went wrong Try Again!');
  }
}



//PRODUCT TYPE
public function showprtype()
{
    $allprtype = Producttype::where('producttype_junk','0')->paginate($this->a);
    return view('user.producttype',compact('allprtype'));
}
public function showprtypebyid($id)
{
    $prtypebyid = Producttype::where('id', '=',$id)->first();
    $allprtype = Producttype::where('producttype_junk','0')->paginate($this->a);
    return view('user.upproducttype',compact('prtypebyid','allprtype'));
}
public function createprtype(Request $request)
{
     $request->validate([
        'product_type' => 'required|unique:producttypes|max:150',
    ]);
    $catins = Producttype::insert([
      'product_type'=>$request->input('product_type')
  ]);
  if ($catins) {
    return back()->with('success','Successfully New Category Created');
  }
  else{
    return back()->with('fail','Something Went wrong Try Again!');
  }
}
public function updateprtype(Request $request)
{
  $id = $request->id;
    $request->validate([
        'product_type' => 'required|unique:producttypes|max:150',

    ]);
   $catup = Producttype::where('id', $id)->update([
        'product_type' => $request->product_type

        ]);
        if ($catup) {
            return back()->with('success','Successfully Category Updated');
          }
          else{
            return back()->with('fail','Something went wrong Try Again!');
          }
}
public function delprtype(Request $request)
{
  $id = $request->id;
  $remove = Producttype::where('id', $id)->update([
    'producttype_junk' => '1'

    ]);
  if ($remove) {
    return redirect('producttype')->with('sss', 'Data Removed');
  }
  else{
    return back()->with('fff','Something went wrong Try Again!');
  }
}




// UNIT
public function showunit()
{
    $allunit = Unit::where('unit_junk','0')->paginate(3);
    return view('user.unit',compact('allunit'));
}
public function showunitbyid($id)
{
    $unitbyid = Unit::where('id', '=',$id)->first();
    $allunit = Unit::where('unit_junk','0')->paginate($this->a);
    return view('user.upunit',compact('unitbyid','allunit'));
}
public function createunit(Request $request)
{
     $request->validate([
        'unit_name' => 'required|unique:units|max:150',
    ]);
    $catins = Unit::insert([
      'unit_name'=>$request->input('unit_name')
  ]);
  if ($catins) {
    return back()->with('success','Successfully New Category Created');
  }
  else{
    return back()->with('fail','Something Went wrong Try Again!');
  }
}
public function updateunit(Request $request)
{
  $id = $request->id;
    $request->validate([
        'unit_name' => 'required|unique:units|max:150',

    ]);
   $catup = Unit::where('id', $id)->update([
        'unit_name' => $request->unit_name

        ]);
        if ($catup) {
            return back()->with('success','Successfully Category Updated');
          }
          else{
            return back()->with('fail','Something went wrong Try Again!');
          }
}
public function delunit(Request $request)
{
  $id = $request->id;
  $remove = Unit::where('id', $id)->update([
    'unit_junk' => '1'

    ]);
  if ($remove) {
    return redirect('unit')->with('sss', 'Data Removed');
  }
  else{
    return back()->with('fff','Something went wrong Try Again!');
  }
}




//IMAGE FOR ADMIN

public function showimage()
{
  $products = Product::where('junk', 0)->get();
  $images =Product::join('productimages', 'products.product_code', '=', 'productimages.product_code')

        ->paginate($this->a);

    return view('user.imageup',compact('images','products'));
}

public function creatimages(Request $request)
{
    $filetest =$request->validate([

        //'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
        'file' => 'required',

     ]);
    $x=10;


   if ($request->file !="") {
$getfile = $request->file("file");
    foreach ($getfile as  $file) {

       //$file=$request->file("file");
       $file_name=time().$file->getClientOriginalName();
       $img =\Image::make($file);
       $imgins = Productimage::insert([
        'image'=>$file_name,

        'product_code'=>$request->input('product_id')

      ]);
      $img->save(\public_path('images/'.$file_name),$x);
  }
    if ($imgins) {

      return back()->with('success','Successfully New subCategory Created');
    }
    else{
      return back()->with('fail','Something Went wrong Try Again!');
    }

   }
}

public function delimage(Request $request)
{
    $image=  Productimage::where('id', '=',$request->id)->first();
unlink('images/'.$image['image']);

  $remove = Productimage::where('id', '=',$request->id)->delete();
  if ($remove) {
    return redirect('image')->with('sss', 'Data Removed');
  }
  else{
    return back()->with('fff','Something went wrong Try Again!');
  }
}



//SELL HISTORY

public function viewsellhistory(Request $request)
{
    $today = $request->query('todaydate');


    if ($today) {
        $totalsell = Order::join('sleeps', 'orders.sleep_no', '=', 'sleeps.sleep_no')->where('delivery_status', '=','2')->where('orders.order_at','LIKE',"%{$today}%")->paginate(50);
        $collection = Sleep::where('pay_status', '=','1')->where('delivery_status', '=','2')->where('updated_at','LIKE',"%{$today}%")->get();
        $paid=0;
        foreach ($collection as $col) {
         $paid += $col->total_amount;
        }
        $collection1 = Guestpay::where('created_at','LIKE',"%{$today}%")->get();
        $paid1=0;
        foreach ($collection1 as $col1) {
         $paid1 += $col1->paid_amount;
        }
        $totalcollect = $paid+$paid1;

        $daily = Dailycost::where('created_at','LIKE',"%{$today}%")->get();
        $totalcost=0;
        foreach ($daily as $value) {
         $totalcost +=$value->cost;
        }
        $totalcost;


    } elseif ($request->query('yesterday')) {
        $totalsell = Order::join('sleeps', 'orders.sleep_no', '=', 'sleeps.sleep_no')->where('delivery_status', '=','2')->where('orders.order_at','LIKE',"%{$request->query('yesterday')}%")->paginate(50);
        $collection = Sleep::where('pay_status', '=','1')->where('delivery_status', '=','2')->where('updated_at','LIKE',"%{$request->query('yesterday')}%")->get();
        $paid=0;
        foreach ($collection as $col) {
         $paid += $col->total_amount;
        }


        $collection1 = Guestpay::where('created_at','LIKE',"%{$request->query('yesterday')}%")->get();
        $paid1=0;
        foreach ($collection1 as $col1) {
         $paid1 += $col1->paid_amount;
        }
        $totalcollect = $paid+$paid1;

        $daily = Dailycost::where('created_at','LIKE',"%{$request->query('yesterday')}%")->get();
        $totalcost=0;
        foreach ($daily as $value) {
         $totalcost +=$value->cost;
        }
        $totalcost;


    }elseif($request->query('month') && $request->query('month1')){
        $totalsell =Order::join('sleeps', 'orders.sleep_no', '=', 'sleeps.sleep_no')->where('delivery_status', '=','2')->whereBetween('orders.order_at', array($request->query('month1'), $request->query('month')))->paginate(50);
        $collection = Sleep::where('pay_status', '=','1')->where('delivery_status', '=','2')->whereBetween('orders.updated_at', array($request->query('month1'), $request->query('month')))->get();
        $paid=0;
        foreach ($collection as $col) {
         $paid += $col->total_amount;
        }
        $collection1 = Guestpay::whereBetween('orders.order_at', array($request->query('month1'), $request->query('month')))->get();
        $paid1=0;
        foreach ($collection1 as $col1) {
         $paid1 += $col1->paid_amount;
        }
        $totalcollect = $paid+$paid1;

        $daily = Dailycost::whereBetween('created_at', array($request->query('month1'), $request->query('month')))->get();
        $totalcost=0;
        foreach ($daily as $value) {
         $totalcost +=$value->cost;
        }
        $totalcost;



    }elseif ($request->query('mostsold')) {
        $totalsell = Order::join('sleeps', 'orders.sleep_no', '=', 'sleeps.sleep_no')->where('delivery_status', '=','2')->orderBy('orders.order_quantity','desc')->paginate(50);
        $collection = Sleep::where('pay_status', '=','1')->where('delivery_status', '=','2')->orderBy('orders.order_quantity','desc')->get();
        $paid=0;
        foreach ($collection as $col) {
         $paid += $col->total_amount;
        }
        $collection1 = Guestpay::where('created_at','LIKE',"%{$today}%")->get();
        $paid1=0;
        foreach ($collection1 as $col1) {
         $paid1 += $col1->paid_amount;
        }
        $totalcollect = $paid+$paid1;

        $daily = Dailycost::where('created_at','LIKE',"%{$today}%")->get();
        $totalcost=0;
        foreach ($daily as $value) {
         $totalcost +=$value->cost;
        }
        $totalcost;


    }else{

        $totalsell =Order::join('sleeps', 'orders.sleep_no', '=', 'sleeps.sleep_no')->where('delivery_status', '=','2')->paginate(50);
        $collection = Sleep::where('pay_status', '=','1')->where('delivery_status', '=','2')->where('updated_at','LIKE',"%{$today}%")->get();
        $paid=0;
        foreach ($collection as $col) {
         $paid += $col->total_amount;
        }
        $collection1 = Guestpay::where('created_at','LIKE',"%{$today}%")->get();
        $paid1=0;
        foreach ($collection1 as $col1) {
         $paid1 += $col1->paid_amount;
        }
        $totalcollect = $paid+$paid1;

        $daily = Dailycost::where('created_at','LIKE',"%{$today}%")->get();
        $totalcost=0;
        foreach ($daily as $value) {
         $totalcost +=$value->cost;
        }
        $totalcost;


    }
    return view('user.sellhistory',compact('totalsell','totalcollect','totalcost'));
}


}
