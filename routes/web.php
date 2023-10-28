<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\BackendCotroller;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\SubcategorieController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PricerangeController;
use App\Http\Controllers\GuestLoginContoller;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\CupponController;
use App\Http\Controllers\TrendController;
use App\Http\Controllers\AddProductToTrendController;
use App\Http\Controllers\GuestOrderController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });



Route::get('/',[FrontendController::class,'index']);
Route::get('/registration',[FrontendController::class,'registration']);
Route::get('/login_guest',[FrontendController::class,'login_guest']);
Route::post('/guestLoginAttempt',[GuestLoginContoller::class,'guestLoginAttempt']);
Route::get('/guestLogout',[GuestLoginContoller::class,'guestLogout']);
Route::get('/shop',[FrontendController::class,'shop']);
Route::get('/shop_details/{id}',[FrontendController::class,'shop_details']);
Route::get('/categorie_product/{id}',[FrontendController::class,'categorie_product']);
Route::get('/sub_categorie_product/{id}',[FrontendController::class,'sub_categorie_product']);
Route::post('/submitOrder',[FrontendController::class,'submitOrder']);

Route::get('guest_dashboard',[FrontendController::class,'guest_dashboard']);
Route::get('check_order',[FrontendController::class,'check_order']);


Route::post('productCart',[FrontendController::class,'productCart']);
Route::post('AddWishList',[FrontendController::class,'AddWishList']);

Route::post('/register_guest',[FrontendController::class,'register_guest']);
Route::post('/guest_user_update',[FrontendController::class,'guest_user_update']);
Route::get('/loadCheckoutData',[FrontendController::class,'loadCheckoutData']);
Route::post('/loadDistrict',[FrontendController::class,'loadDistrict']);
Route::post('/loadUpazila',[FrontendController::class,'loadUpazila']);
Route::post('/shipingCostUpdate',[FrontendController::class,'shipingCostUpdate']);
Route::post('/updateCupponAmount',[FrontendController::class,'updateCupponAmount']);

Route::get('/add_cart_user/{id}',[FrontendController::class,'add_cart_user']);
Route::get('/checkout/{id}',[FrontendController::class,'checkout']);


Route::post('filterCatProductByColor',[FrontendController::class,'filterCatProductByColor']);
Route::post('filterCatProductBySize',[FrontendController::class,'filterCatProductBySize']);
Route::post('filterProductByRange',[FrontendController::class,'filterProductByRange']);

Route::post('filterSubCatProductByColor',[FrontendController::class,'filterSubCatProductByColor']);
Route::post('filterSubCatProductBySize',[FrontendController::class,'filterSubCatProductBySize']);
Route::post('filterSubCatProductByRange',[FrontendController::class,'filterSubCatProductByRange']);
Route::post('/change_lang',[BackendCotroller::class,'change_lang']);

Route::get('getProductCart',[FrontendController::class,'getProductCart']);
Route::get('getCartData',[FrontendController::class,'getCartData']);
Route::get('productQtyUpdate/{id}',[FrontendController::class,'productQtyUpdate']);
Route::get('deleteProduct/{id}',[FrontendController::class,'deleteProduct']);

Route::get('totalWishList',[FrontendController::class,'totalWishList']);
Route::get('/wishlist/{id}',[FrontendController::class,'wishlist']);
Route::get('/wishListToCart/{id}',[FrontendController::class,'wishListToCart']);
Route::get('getWishList',[FrontendController::class,'getWishList']);
Route::get('WishListDelete/{id}',[FrontendController::class,'WishListDelete']);

Route::get('user_order',[GuestOrderController::class,'user_order']);
Route::get('updateOrderStatus/{id}',[GuestOrderController::class,'updateOrderStatus']);






Auth::routes();

Route::get('/change_pass',[BackendCotroller::class,'change_pass']);
Route::post('/submitChangeEmail',[BackendCotroller::class,'submitChangeEmail']);

Route::get('otp/{email}',[BackendCotroller::class,'otp']);
Route::post('submitOtp',[BackendCotroller::class,'submitOtp']);
Route::get('new_password/{email}',[BackendCotroller::class,'new_password']);
Route::post('changePassword',[BackendCotroller::class,'changePassword']);
Route::get('adminLogout',[BackendCotroller::class,'adminLogout']);


Route::group(['middleware' => 'auth'], function (){

    Route::get('/dashboard',[BackendCotroller::class,'index'])->middleware('auth');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resources([
        'menu'=>MenuController::class,
        'role'=>RoleController::class,
        'user'=>UserController::class,
        'categorie'=>CategorieController::class,
        'sub_categorie'=>SubcategorieController::class,
        'brand'=>BrandController::class,
        'size_setting'=>SizeController::class,
        'color'=>ColorController::class,
        'product'=>ProductController::class,
        'price_range'=>PricerangeController::class,
        'shipping'=>ShippingController::class,
        'cuppon'=>CupponController::class,
        'trend'=>TrendController::class,
        'add_product_to_trend'=>AddProductToTrendController::class,

    ]);

    Route::get('menuStatusChange/{id}',[MenuController::class,'menuStatusChange']);
    Route::get('retrive_menu/{id}',[MenuController::class,'retrive_menu']);
    Route::get('menu_per_delete/{id}',[MenuController::class,'menu_per_delete']);

    Route::get('roleStatusChange/{id}',[RoleController::class,'roleStatusChange']);
    Route::get('/permissions/{id}',[RoleController::class,'permissions']);
    Route::post('/setPermission',[RoleController::class,'setPermission']);

    Route::get('userStatusChange/{id}',[UserController::class,'userStatusChange']);

    Route::get('categorieStatusChange/{id}',[CategorieController::class,'categorieStatusChange']);
    Route::get('retrive_categorie/{id}',[CategorieController::class,'retrive_categorie']);
    Route::get('categorie_per_delete/{id}',[CategorieController::class,'categorie_per_delete']);

    Route::get('subcategorieStatusChange/{id}',[SubcategorieController::class,'subcategorieStatusChange']);
    Route::get('retrive_subcategorie/{id}',[SubcategorieController::class,'retrive_subcategorie']);
    Route::get('subcategorie_per_delete/{id}',[SubcategorieController::class,'subcategorie_per_delete']);

    Route::get('brandStatusChange/{id}',[BrandController::class,'brandStatusChange']);
    Route::get('retrive_brand/{id}',[BrandController::class,'retrive_brand']);
    Route::get('brand_per_delete/{id}',[BrandController::class,'brand_per_delete']);


    Route::get('sizeStatusChange/{id}',[SizeController::class,'sizeStatusChange']);
    Route::get('retrive_size/{id}',[SizeController::class,'retrive_size']);
    Route::get('size_per_delete/{id}',[SizeController::class,'size_per_delete']);

    Route::get('colorStatusChange/{id}',[ColorController::class,'colorStatusChange']);
    Route::get('retrive_color/{id}',[ColorController::class,'retrive_color']);
    Route::get('color_per_delete/{id}',[ColorController::class,'color_per_delete']);

    Route::get('PriceRangeStatusChange/{id}',[PricerangeController::class,'PriceRangeStatusChange']);
    Route::get('retrive_price_range/{id}',[PricerangeController::class,'retrive_price_range']);
    Route::get('price_range_per_delete/{id}',[PricerangeController::class,'price_range_per_delete']);

    Route::get('cupponStatusChange/{id}',[CupponController::class,'cupponStatusChange']);
    Route::get('retrive_cuppon/{id}',[CupponController::class,'retrive_cuppon']);
    Route::get('cuppon_per_delete/{id}',[CupponController::class,'cuppon_per_delete']);

    Route::get('trendStatusChange/{id}',[TrendController::class,'trendStatusChange']);
    Route::get('retrive_trend/{id}',[TrendController::class,'retrive_trend']);
    Route::get('trend_per_delete/{id}',[TrendController::class,'trend_per_delete']);

    Route::get('GetSelectProduct/{cat_id}',[AddProductToTrendController::class,'GetSelectProduct']);

    Route::get('GetSubCategorie/{cat_id}',[ProductController::class,'GetSubCategorie']);
    Route::get('productStatusChange/{id}',[ProductController::class,'productStatusChange']);
    Route::get('retrive_product/{id}',[ProductController::class,'retrive_product']);
    Route::get('product_per_delete/{id}',[ProductController::class,'product_per_delete']);

    Route::get('GetDistrict/{division_id}',[ShippingController::class,'GetDistrict']);
    Route::get('GetUpazila/{district_id}',[ShippingController::class,'GetUpazila']);
    Route::get('shippingStatusChange/{id}',[ShippingController::class,'shippingStatusChange']);

});

