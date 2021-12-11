<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;

class GuestFileController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
      @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fileViews.guestFileUpload');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        self::guestFileValidation($request);
        $name = time() . $_FILES['file_name']['name'];
        $dirPath = storage_path('/app/public/uploads');
        $request->file_name->move($dirPath, $name);
        $link = 'storage/app/public/uploads' . '/' . $name;

        $fileType = strtolower(pathinfo($_FILES["file_name"]["name"], PATHINFO_EXTENSION));

        $file = File::query()->create(['file_name' => $_FILES['file_name']['name'],
            'size' => $_FILES['file_name']['size'], 'price' => $request->price,
            'type' => $fileType, 'description' => $request->description,
            'upload_date' => date('Y-m-d'), 'is_guest' => 1, 'guest_ip' => $request->ip,
            'link' => $link]);
    }

    public static function guestFileValidation($request)
    {
        $errors = '';
        $allFileSize = File::query()->where('upload_date', date('Y-m-d'))->where('guest_ip', $request->ip)
            ->where('is_guest', 1)->sum('size');
        $thisSize = $_FILES['file_name']['size'];
        $validSize = SettingController::getvalidUploadSize();

        if ((($allFileSize + $thisSize) / (1024 * 1024)) > $validSize)
        {
            $errors .= "ححجم مجاز آپلد تمام شده است" . '<br>';
        }

        $thisType = strtolower(pathinfo($_FILES["file_name"]["name"], PATHINFO_EXTENSION));

        $validTypes = SettingController::ValidFileTypes();
        if (!in_array($thisType, $validTypes))
        {
            $errors .= " تنها فایل های با فرمت pdf ، png و jpeg مجاز هستند . " . "<br>";
        }
        if(!empty($errors))
            die($errors);
    }
}
