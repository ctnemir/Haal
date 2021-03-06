<?php

use Illuminate\Http\Request;
use App\Models\Kind;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ConfirmItemController;
use App\Http\Controllers\ConfirmMoneyController;
use App\Http\Controllers\OrderRequestController;
use App\Http\Controllers\ChartController;

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
    return redirect('/login');
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');


Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
//    Route::get('/test', [OrderController::class , 'export']);
    Route::any('/test', function (Request $request){
        return $request;
    });
    Route::get('itemToggle',[ItemController::class,'toggle'])->name('itemToggle');
    Route::get('dashboard', function (){
        $currency = collect(json_decode(file_get_contents('https://api.genelpara.com/embed/para-birimleri.json'), true));
        return view('dashboard')->with('data' , $currency);
    })->name('dashboard');
    Route::view('forms', 'forms')->name('forms');
    Route::view('cards', 'cards')->name('cards');
    Route::view('charts', 'charts')->name('charts');
    Route::view('buttons', 'buttons')->name('buttons');
    Route::view('modals', 'modals')->name('modals');
    Route::view('tables', 'tables')->name('tables');
    Route::view('calendar', 'calendar')->name('calendar');

    Route::resource('order',OrderController::class);
    Route::get('/calc' , [OrderController::class , 'calc'])->name('calc');
    Route::any('/export' , [OrderController::class , 'export'])->name('export');
    Route::resource('item',ItemController::class);
    Route::resource('confirmItem',ConfirmItemController::class);
    Route::resource('confirmMoney',ConfirmMoneyController::class);
    Route::resource('orderRequest',OrderRequestController::class);
    Route::view('dashchart','chartdash')->name('dashchart');

});
