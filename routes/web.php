<?php
use App\Http\Controllers\FileController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SettingController;
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

Route::get('/home', function () {
    SettingController::validStoreTime();
    return view('home');
})->name('home');


Route::resource('/users', 'UserController')->only('create', 'store', 'show')
    ->names(['create' => 'registerPage']);

Route::group(['prefix' => '/user'] , function (){
    Route::get('/loginPage', [AuthController::class, 'showLoginPage'])->name('loginPage');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/level', [AuthController::class, 'userLevel'])->name('level');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});


Route::resource('/files', 'FileController')->except('create');

Route::resource('/guestFile' , 'GuestFileController')->only('create' , 'store');

Route::group(['prefix' => '/setting'], function (){
    Route::get('/show' , 'SettingController@showValidTypeSetting')->name('settings');
    Route::post('/validTypes' , 'SettingController@addToValidFileTypes')->name('addValidTypes');
    Route::post('/deleteValidTypes' , 'SettingController@deleteValidFileTypes')->name('deleteValidTypes');
    Route::post('/validSize' , 'SettingController@ValidSizeUploadManaging')->name('changeValidSize');
    Route::get('/StoreTimeView' , 'SettingController@storeSettingView')->name('storeTimeView');
    Route::get('/validStoreTime' , 'SettingController@updateValidStoreTime')->name('validStoreTime');

});


Route::group(['middleware'=> 'auth'] , function (){
    Route::get('/userPanelPage', 'UserController@userPanel')->name('userPanel');
    Route::get('/file/user' , 'FileController@create')->name('userFile');
});

Route::group(['middleware' => 'Admin'], function (){
    Route::get('/users' , 'UserController@index')->name('users.index');
    Route::post('/deleteUsers/{id}' , 'UserController@destroy')->name('users.destroy');
    Route::get('/editUsers{id}' , 'UserController@edit')->name('users.edit');
});

Route::get('/fileManage' , 'FileController@list')->name('files.list');
