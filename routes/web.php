<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\SubSubCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SliderController;

use App\Http\Controllers\Frontend\UserFrontEndController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\LanguageController;


use App\Models\User;
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
// Route for guest
Route::get('/', [IndexController::class, 'index']);


// route for admin
Route::group(['prefix'=>'admin','middleware'=>['admin:admin']], function(){
    Route::get('/login', [AdminController::class, 'loginForm']);
    Route::post('/login', [AdminController::class, 'store'])->name('admin.login');
});

Route::middleware(['auth:admin'])->group(function(){
    // dashboard
    Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
        return view('admin.index');
    })->name('dashboard')->middleware('auth:admin');;

    Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');
    Route::get('/admin/profile', [AdminProfileController::class, 'adminProfile'])->name('admin.profile');
    Route::get('/admin/profile/edit', [AdminProfileController::class, 'editProfile'])->name('admin.profile.edit');
    Route::post('/admin/profile/update', [AdminProfileController::class, 'updateProfile'])->name('admin.profile.update');
    Route::get('/admin/change/password', [AdminProfileController::class, 'changePassword'])->name('admin.change.password');
    Route::post('/admin/password/update', [AdminProfileController::class, 'updatePassword'])->name('admin.password.update');

}); 

//route group for admin brands
Route::prefix('brand')->group(function(){
    Route::get('/view', [BrandController::class, 'viewBrands'])->name('all.brands');
    Route::post('/store', [BrandController::class, 'storeBrand'])->name('brand.store');
    Route::get('/edit/{id}', [BrandController::class, 'editBrand'])->name('brand.edit');
    Route::post('/update', [BrandController::class, 'updateBrand'])->name('brand.update');
    Route::get('/delete/{id}', [BrandController::class, 'deleteBrand'])->name('brand.delete');
});

Route::prefix('category')->group(function(){
    Route::get('/view', [CategoryController::class, 'viewCategories'])->name('all.categories');
    Route::post('/store', [CategoryController::class, 'storeCategory'])->name('category.store');
    Route::get('/edit/{id}', [CategoryController::class, 'editCategory'])->name('category.edit');
    Route::post('/update/{id}', [CategoryController::class, 'updateCategory'])->name('category.update');
    Route::get('/delete/{id}', [CategoryController::class, 'deleteCategory'])->name('category.delete');
    
    Route::get('/subcategory/ajax/{category_id}', [SubCategoryController::class, 'GetSubCategory']);
    Route::get('/sub/view', [SubCategoryController::class, 'viewSubCategories'])->name('all.sub.categories');
    Route::post('/sub/store', [SubCategoryController::class, 'storeSubCategory'])->name('subcategory.store');
    Route::get('/sub/edit/{id}', [SubCategoryController::class, 'editSubCategory'])->name('subcategory.edit');
    Route::post('/sub/update', [SubCategoryController::class, 'updateSubCategory'])->name('subcategory.update');
    Route::get('/sub/delete/{id}', [SubCategoryController::class, 'deleteSubCategory'])->name('subcategory.delete');

    Route::get('/sub-subcategory/ajax/{subcategory_id}', [SubSubCategoryController::class, 'GetSubSubCategory']);
    Route::get('/sub/sub/view', [SubSubCategoryController::class, 'viewSubSubCategories'])->name('all.sub.sub.categories');
    Route::post('/sub/sub/store', [SubSubCategoryController::class, 'storeSubSubCategory'])->name('subsubcategory.store');
    Route::get('/sub/sub/edit/{id}', [SubSubCategoryController::class, 'editSubSubCategory'])->name('subsubcategory.edit');
    Route::post('/sub/sub/update', [SubSubCategoryController::class, 'updateSubSubCategory'])->name('subsubcategory.update');
    Route::get('/sub/sub/delete/{id}', [SubSubCategoryController::class, 'deleteSubSubCategory'])->name('subsubcategory.delete');

});

Route::prefix('product')->group(function(){
    Route::get('/add', [ProductController::class, 'addProduct'])->name('add-product');
    Route::post('/store', [ProductController::class, 'productStore'])->name('product-store');
    Route::get('/manage', [ProductController::class, 'manageProduct'])->name('manage-product');
    Route::get('/edit/{id}', [ProductController::class, 'editProduct'])->name('product.edit');
    Route::post('/data/update', [ProductController::class, 'productDataUpdate'])->name('product-update');
    Route::post('/image/update', [ProductController::class, 'MultiImageUpdate'])->name('update-product-image');
    Route::post('/thambnail/update', [ProductController::class, 'ThambnailImageUpdate'])->name('update-product-thambnail');
    Route::get('/multiimg/delete/{id}', [ProductController::class, 'MultiImageDelete'])->name('product.multiimg.delete');
    Route::get('/inactive/{id}', [ProductController::class, 'ProductInactive'])->name('product.inactive');
    Route::get('/active/{id}', [ProductController::class, 'ProductActive'])->name('product.active');
    Route::get('/delete/{id}', [ProductController::class, 'ProductDelete'])->name('product.delete');
});

// Admin Slider All Routes 

Route::prefix('slider')->group(function(){
    Route::get('/view', [SliderController::class, 'SliderView'])->name('manage-slider');
    Route::post('/store', [SliderController::class, 'BrandStore'])->name('slider.store');
    Route::get('/edit/{id}', [SliderController::class, 'BrandEdit'])->name('slider.edit');
    Route::post('/update', [SliderController::class, 'BrandUpdate'])->name('slider.update');
    Route::get('/delete/{id}', [SliderController::class, 'BrandDelete'])->name('slider.delete'); 
    Route::get('/inactive/{id}', [SliderController::class, 'SliderInactive'])->name('slider.inactive');
    Route::get('/active/{id}', [SliderController::class, 'SliderActive'])->name('slider.active');   
});

// Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/profile', [AdminProfileController::class, 'adminProfile'])->name('admin.profile');



// User Register Email verification
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


//Route for users
Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/user/logout', [UserFrontEndController::class, 'userLogout'])->name('user.logout');
Route::get('/user/profile', [UserFrontEndController::class, 'userProfile'])->name('user.profile');
Route::post('/user/profile/store', [UserFrontEndController::class, 'userProfileStore'])->name('user.profile.store');
Route::get('/user/change/password', [UserFrontEndController::class, 'changePassword'])->name('user.change.password');
Route::post('/user/password/update', [UserFrontEndController::class, 'updatePassword'])->name('user.password.update');

//// Frontend All Routes /////
/// Multi Language All Routes ////

Route::get('/language/indonesia', [LanguageController::class, 'Indonesia'])->name('indonesia.language');
Route::get('/language/english', [LanguageController::class, 'English'])->name('english.language');
