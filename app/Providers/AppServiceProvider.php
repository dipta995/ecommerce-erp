<?php

namespace App\Providers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Producttype;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultstringLength(191);
        view()->composer(
            'layouts.master',
            function ($view) {
                $sId = Auth::id();
                $data = Cart::where('session_id', '=',$sId)->get();
                // $data = count($data);
                $view->with('diptad', $data);


            }
        );
        view()->composer(
            'layouts.guest',
            function ($view) {
                $sId = Auth::id();
                $data = Cart::where('session_id', '=',$sId)->get();
                // $data = count($data);
                $view->with('diptad', $data);


            }
        );


        view()->composer(
            'layouts.master',
            function ($view) {

                $data = Producttype::all();
                // $data = count($data);
                $view->with('producttype', $data);


            }
        );

        view()->composer(
            'layouts.guest',
            function ($view) {

                $data = Producttype::all();
                // $data = count($data);
                $view->with('producttype', $data);


            }
        );


        view()->composer(
            'layouts.popular',
            function ($view) {

        $data =Product::where('junk', 0)->join('cats', 'products.cat_id', '=', 'cats.id')
        ->join('subcats', 'products.subcat_id', '=', 'subcats.id')
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->join('producttypes', 'products.product_type_id', '=', 'producttypes.id')
        ->join('units', 'products.unit_id', '=', 'units.id')->orderBy('total_rat', 'desc')->limit(12)->get();
        $datas= $data->shuffle();
        $view->with('mostpopular', $datas);
    }
);








    }
}
