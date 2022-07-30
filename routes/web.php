<?php

use App\Http\Controllers\admin\AnnouncementController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\ChangepasswordController;
use App\Http\Controllers\admin\CompanyController;
use App\Http\Controllers\admin\GeoLocationController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\LogController;
use App\Http\Controllers\admin\MenuController;
use App\Http\Controllers\admin\OddsSettingController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\ProfileController;
use App\Http\Controllers\admin\ResultController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\admin\UndertakeLimitController;
use App\Http\Controllers\admin\UndertakeSettingController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\admin\SwitchoffonController;

use App\Http\Controllers\LangController;
use App\Http\Controllers\SitemapController;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;


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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cache/route', function () {
    Artisan::call('route:clear');
    return 'Route cache cleared';
})->name('cache-route');
Route::get('/docache/route', function () {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear config cache
Route::get('/cache/config', function () {
    Artisan::call('config:clear');
    return 'Config cache cleared';
})->name('cache-config');

// Clear application cache
Route::get('/cache/clear', function () {
    Artisan::call('cache:clear');
    return 'Application cache cleared';
})->name('cache-clear');

// Clear view cache
Route::get('/cache/view', function () {
    Artisan::call('view:clear');
    return 'View cache cleared';
})->name('cache-view');
Route::get('/docache/view', function () {
    Artisan::call('view:cache');
    return 'View cache done';
})->name('docache-view');

// Clear cache using reoptimized class
Route::get('/cache/optimize', function () {
    Artisan::call('optimize:clear');
    return 'View cache cleared';
})->name('cache-optimize');

Auth::routes();



Route::get('sitemap.xml', [SitemapController::class, 'index']);
Route::get('admin/logout', function(){
    Auth::logout();
    return Redirect::to('admin/login');
 });
Route::group(['prefix' => RouteServiceProvider::ADMIN_URL_SUFFIX], function () {
    Route::get('/', function () {
        return redirect('admin/login');
    });
    Route::get('google-registration', [LoginController::class, 'googleRegistration'])->name('google.registration');
    Route::get('complete-registration', [LoginController::class, 'completeRegistration'])->name('complete.registration');
    

    Route::group(['middleware' => 'auth'], function () {
        Route::group(['middleware' => 'checkstatus'], function () {

            // 2fa middleware
            Route::middleware(['2fa'])->group(function () {

                // HomeController
                //Route::get('/home', [HomeController::class, 'index'])->name('home');  
                Route::match(['get', 'post'] , '/home', [HomeController::class, 'index'])->name('home');
                Route::post('/2fa', function () {
                    return redirect(route('home'));
                })->name('2fa');

            });

            Route::get('lang/change', [LangController::class, 'change'])->name('changeLang');

           // Route::get('/home', [HomeController::class, 'index'])->name('home');

            Route::get('setting/menu', [MenuController::class, 'index'])->name('menu');
            Route::get('setting/menu/add', [MenuController::class, 'create'])->name('menu_add');
            Route::POST('setting/menu/add', [MenuController::class, 'store'])->name('menu_add');
            Route::get('setting/menu/edit/{id}', [MenuController::class, 'edit'])->name('menu_edit');
            Route::POST('setting/menu/edit/{id}', [MenuController::class, 'update'])->name('menu_edit');
            Route::get('setting/menu/changeStatus', [MenuController::class, 'changeStatus'])->name('admin_menu_changeStatus');
            Route::get('setting/menu/delete/{id}', [MenuController::class, 'destroy'])->name('admin_menu_delete');

            Route::get('user/role', [RoleController::class, 'index'])->name('role');
            Route::get('user/role/add', [RoleController::class, 'create'])->name('role_add');
            Route::POST('user/role/add', [RoleController::class, 'store'])->name('role_add');
            Route::get('user/role/edit/{id}', [RoleController::class, 'edit'])->name('role_edit');
            Route::POST('user/role/edit/{id}', [RoleController::class, 'update'])->name('role_edit');
            Route::get('user/role/changeStatus', [RoleController::class, 'changeStatus'])->name('admin_role_changeStatus');
            Route::get('user/role/delete/{id}', [RoleController::class, 'destroy'])->name('admin_role_delete');

            Route::get('/announcement', [AnnouncementController::class, 'index'])->name('announcement');
            Route::get('/announcement/add', [AnnouncementController::class, 'create'])->name('announcement_add');
            Route::POST('/announcement/add', [AnnouncementController::class, 'store'])->name('announcement_add');
            Route::get('/announcement/edit/{id}', [AnnouncementController::class, 'edit'])->name('announcement_edit');
            Route::POST('/announcement/edit/{id}', [AnnouncementController::class, 'update'])->name('announcement_edit');
            Route::get('/announcement/changeStatus', [AnnouncementController::class, 'changeStatus'])->name('admin_announcement_changeStatus');
            Route::get('/announcement/delete/{id}', [AnnouncementController::class, 'destroy'])->name('admin_announcement_delete');

            Route::get('result/product', [ProductController::class, 'index'])->name('product');
            Route::get('result/product/add', [ProductController::class, 'create'])->name('product_add');
            Route::POST('result/product/add', [ProductController::class, 'store'])->name('product_add');
            Route::get('result/product/edit/{id}', [ProductController::class, 'edit'])->name('product_edit');
            Route::POST('result/product/edit/{id}', [ProductController::class, 'update'])->name('product_edit');
            Route::get('result/product/changeStatus', [ProductController::class, 'changeStatus'])->name('admin_product_changeStatus');
            Route::get('result/product/delete/{id}', [ProductController::class, 'destroy'])->name('admin_product_delete');

            Route::get('brand', [BrandController::class, 'index'])->name('brand');
            Route::get('brand/add', [BrandController::class, 'create'])->name('brand_add');
            Route::POST('brand/add', [BrandController::class, 'store'])->name('brand_add');
            Route::get('brand/edit/{id}', [BrandController::class, 'edit'])->name('brand_edit');
            Route::POST('brand/edit/{id}', [BrandController::class, 'update'])->name('brand_edit');
            Route::get('brand/changeStatus', [BrandController::class, 'changeStatus'])->name('admin_brand_changeStatus');
            Route::get('brand/delete/{id}', [BrandController::class, 'destroy'])->name('admin_brand_delete');
            Route::get('brand/export', [BrandController::class, 'export'])->name('brand_export');
            Route::get('brand/import', [BrandController::class, 'importPage'])->name('brand_import');
            Route::post('brand/import', [BrandController::class, 'import'])->name('brand_import');
            Route::get('brand/downloadExcelSample', [BrandController::class, 'downloadSample'])->name('brand_sample_file');
            Route::get('brand/show/{id}', [BrandController::class, 'show'])->name('brand_show');
            Route::get('brand/forceDelete/{id}', [BrandController::class, 'forceDelete'])->name('admin_brand_force_delete');
            Route::get('brand/restore/{id}', [BrandController::class, 'restore'])->name('admin_brand_restore');

            Route::get('result/result', [ResultController::class, 'index'])->name('result');
            Route::get('result/result/add', [ResultController::class, 'create'])->name('result_add');
            Route::POST('result/result/add', [ResultController::class, 'store'])->name('result_add');
            Route::get('result/result/edit/{id}', [ResultController::class, 'edit'])->name('result_edit');
            Route::POST('result/result/edit/{id}', [ResultController::class, 'update'])->name('result_edit');
            Route::get('result/result/changeStatus', [ResultController::class, 'changeStatus'])->name('admin_result_changeStatus');
            Route::get('result/result/delete/{id}', [ResultController::class, 'destroy'])->name('admin_result_delete');
            Route::get('result/result/export', [ResultController::class, 'export'])->name('result_export');
            Route::get('result/result/import', [ResultController::class, 'importPage'])->name('result_import');
            Route::post('result/result/import', [ResultController::class, 'import'])->name('result_import');
            Route::get('result/result/downloadExcelSample', [ResultController::class, 'downloadSample'])->name('result_sample_file');
            Route::get('result/result/show/{id}', [ResultController::class, 'show'])->name('result_show');
            Route::get('result/result/forceDelete/{id}', [ResultController::class, 'forceDelete'])->name('admin_result_force_delete');
            Route::get('result/result/restore/{id}', [ResultController::class, 'restore'])->name('admin_result_restore');

            Route::get('company', [CompanyController::class, 'index'])->name('company');
            Route::get('company/add', [CompanyController::class, 'create'])->name('company_add');
            Route::POST('company/add', [CompanyController::class, 'store'])->name('company_add');
            Route::get('company/edit/{id}', [CompanyController::class, 'edit'])->name('company_edit');
            Route::POST('company/edit/{id}', [CompanyController::class, 'update'])->name('company_edit');
            Route::get('company/changeStatus', [CompanyController::class, 'changeStatus'])->name('admin_company_changeStatus');
            Route::get('company/delete/{id}', [CompanyController::class, 'destroy'])->name('admin_company_delete');

            Route::get('user/user', [UserController::class, 'index'])->name('user');
            Route::get('user/user/add', [UserController::class, 'create'])->name('user_add');
            Route::POST('user/user/add', [UserController::class, 'store'])->name('user_add');
            Route::get('user/user/edit/{user_id}', [UserController::class, 'edit'])->name('user_edit');
            Route::POST('user/user/edit/{user_id}', [UserController::class, 'update'])->name('user_edit');
            Route::get('user/user/changeStatus', [UserController::class, 'changeStatus'])->name('admin_user_changeStatus');
            Route::get('user/user/delete/{id}', [UserController::class, 'destroy'])->name('admin_user_delete');
            Route::get('user/user/reset/{id}', [UserController::class, 'reset'])->name('admin_user_reset');
            Route::get('user/user/forceDelete/{id}', [UserController::class, 'forceDelete'])->name('admin_user_force_delete');
            Route::get('user/user/restore/{id}', [UserController::class, 'restore'])->name('admin_user_restore');
            Route::get('status', [UserController::class, 'userOnlineStatus']);

            Route::get('result/undertake_setting', [UndertakeSettingController::class, 'create'])->name('undertake_setting');
            Route::POST('result/undertake_setting', [UndertakeSettingController::class, 'store'])->name('undertake_setting');
            Route::POST('result/undertake_setting1', [UndertakeSettingController::class, 'save'])->name('undertake_setting1');

            Route::get('result/undertake_limit', [UndertakeLimitController::class, 'create'])->name('undertake_limit');
            Route::POST('result/undertake_limit', [UndertakeLimitController::class, 'store'])->name('undertake_limit');
            Route::POST('result/undertake_limit1', [UndertakeLimitController::class, 'save'])->name('undertake_limit1');

            Route::get('result/odds_setting', [OddsSettingController::class, 'create'])->name('odds_setting');
            Route::POST('result/odds_setting', [OddsSettingController::class, 'store'])->name('odds_setting');
            Route::POST('result/odds_setting', [OddsSettingController::class, 'save'])->name('odds_setting1');

            Route::get('/setting/setting', [SettingController::class, 'create'])->name('setting');
            Route::POST('/setting/setting', [SettingController::class, 'store'])->name('setting');

            Route::get('switchoffon', [SwitchoffonController::class, 'create'])->name('switchoffon');
            Route::POST('switchoffon', [SwitchoffonController::class, 'store'])->name('switchoffon');

            Route::POST('changestatus', [SwitchoffonController::class, 'changestatus'])->name('changestatus');

            Route::get('/test', [TestController::class, 'index'])->name('test');
            Route::get('/test/add', [TestController::class, 'create'])->name('test_add');
            Route::POST('/test/add', [TestController::class, 'store'])->name('test_add');
            Route::get('/test/edit/{id}', [TestController::class, 'edit'])->name('test_edit');
            Route::POST('/test/edit/{id}', [TestController::class, 'update'])->name('test_edit');
            Route::get('/test/changeStatus', [TestController::class, 'changeStatus'])->name('admin_test_changeStatus');
            Route::get('/test/delete/{id}', [TestController::class, 'destroy'])->name('admin_test_delete');
            Route::get('/profile', [ProfileController::class, 'index'])->name('admin_profile');
            Route::POST('/profile', [ProfileController::class, 'update'])->name('admin_profile');
            Route::get('/change_password', [ChangepasswordController::class, 'index'])->name('admin_change_password');
            Route::POST('/change_password', [ChangepasswordController::class, 'update'])->name('admin_change_password');
            Route::get('/get-address-from-ip', [GeoLocationController::class, 'index']);
            Route::get('/log', [LogController::class, 'index'])->name('log');
            Route::get('/log/changeStatus', [LogController::class, 'changeStatus'])->name('admin_log_changeStatus');
            Route::get('/log/delete/{id}', [LogController::class, 'destroy'])->name('admin_log_delete');
            Route::post('get-senior-manager', [UserController::class, 'getSeniorManager']);
            Route::post('get-master-agent', [UserController::class, 'getMasterAgent']);

            Route::post('get-agent', [UserController::class, 'getAgent']);


            Route::post('saveprizes', [OddsSettingController::class, 'saveprizes'])->name('saveprizes');
            Route::post('savedropprizes', [OddsSettingController::class, 'savedropprizes'])->name('savedropprizes');
            Route::get('getGameDetailsVal/{slug}', [OddsSettingController::class, 'getGameDetailsVal']);

            
            Route::post('saveCommissionSettings', [OddsSettingController::class, 'saveCommissionSettings'])->name('saveCommissionSettings');
            
            Route::post('updateCommissionSettings', [OddsSettingController::class, 'updateCommissionSettings'])->name('updateCommissionSettings');
            Route::get('onDeletePns/{id}', [OddsSettingController::class, 'onDeletePns'])->name('onDeletePns');


            Route::get('odd-settings/{page?}', [OddsSettingController::class, 'oddSettings'])->name('odd-settings');

        });
    });
});
