<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\menu;
use App\Models\categorie;
use App\Models\sub_categorie;
use App\Models\add_product_to_trend;
use App\Models\role;
use View;
use Auth;
use Illuminate\Support\Facades\Route;

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
        View::composer('*',function($view){

            $view->with('menu',menu::orderby('order_by','ASC')->where('status',1)->get());
            $view->with('categorie',categorie::orderby('order_by','ASC')->where('status',1)->get());
            $view->with('sub_categorie',sub_categorie::orderby('order_by','ASC')->where('status',1)->get());
            $view->with('add_trend_product',add_product_to_trend::where('status',1)->get());
            $view->with('add_product_to_trend',add_product_to_trend::leftjoin('trends','trends.id','add_product_to_trends.trend_id')
                    ->leftjoin('categories','categories.id','add_product_to_trends.cat_id')
                    ->where('add_product_to_trends.status',1)
                    ->select('trends.id','trends.trend_name_en','trends.trend_name_bn','categories.id','categories.cat_name_en','categories.cat_name_bn')
                    ->get());
            // $view->with('role',role::find(Auth::user()->role_id));

            // $view->with('url',Route::current());

            $view->with('lang',\Illuminate\Support\Facades\App::getLocale());
        });
    }
}
