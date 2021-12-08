<?php
namespace App\Http\Controllers;
date_default_timezone_set('Asia/Tehran');

use App\Models\File;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SettingController extends Controller
{

    public static function ValidFileTypes()
    {
        $settings = Setting::query()->get();
        foreach ($settings as $setting) {
            $validTypes = explode(',', $setting->valid_type);
            return $validTypes;
        }
    }

    public function showValidTypeSetting()
    {
        if(AuthController::userLevel() == 'admin'){
            return view('settingViews.validTypeManaging', ['types' => self::ValidFileTypes()]);
        }
        else return Redirect::back()->withErrors(['msg' => 'you can not access this section']);

    }

    public function addToValidFileTypes(Request $request)
    {
        $allTypes = self::ValidFileTypes();
        array_push($allTypes, $request->type);
        $stringValidTypes = implode(',', $allTypes);
        $types = Setting::query()->find(1);
        $types->valid_type = $stringValidTypes;
        $types->save();
    }

    public function deleteValidFileTypes(Request $request)
    {
        $allTypes = self::ValidFileTypes();

        if (($key = array_search($request->types,  $allTypes)) !== false) {
            unset($allTypes[$key]);
            $stringValidTypes = implode(',', $allTypes);

            $types = Setting::query()->find(1);
            $types->valid_type = $stringValidTypes;
            $types->save();
        }
    }

    public function ValidSizeUploadManaging(Request $request){

        $setting = Setting::query()->find(1);
         $setting->valid_size = $request->size;
         $setting->save();
    }
    public static function getvalidUploadSize()
    {
        return Setting::query()->value('valid_size');
    }

    public static function validStoreTime()
    {
        $storeTime = Setting::query()->value('store_time');

        $uploadTime= File::query()->where('is_guest', 1)->get();


        foreach ($uploadTime as $item)
        {
            $uploadTimestamp = strtotime($item->created_at);
            $time = $storeTime + $uploadTimestamp;

            if(time()  > $time){
                $file =  File::query()->find($item->id);
                $file->delete();
            }
        }
    }

    public function storeSettingView()
    {
        if(AuthController::userLevel() == 'admin'){
            $setting = Setting::query()->value('store_time');
            return view('settingViews.storeSettings', ['setting' => $setting]);
        }
        else{
            return redirect::back()->withErrors('you can not access this section');
        }

    }

    public function updateValidStoreTime(Request $request){
        $time = Setting::query()->find(1);
        $time->store_time = (($request->time) * 3600);
        $time->save();
    }

}
