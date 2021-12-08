<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Nette\Schema\ValidationException;

class GuestFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

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

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
