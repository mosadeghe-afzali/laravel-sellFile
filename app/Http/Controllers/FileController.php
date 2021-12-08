<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileUploadRequest;
use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
      @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = File::query()->select('id', 'link', 'is_confirmed', 'user_id', 'is_guest')->
        where('is_confirmed', 1)->get();

        return view('fileViews.showFiles', ['files' => $files]);
    }

    /**
     * Show the form for creating a new resource.
     *
      @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fileViews.userFileUpload');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(FileUploadRequest $request)
    {
        if (session()->has('username'))
        {
            $name = time() . $_FILES['file_name']['name'];
            $dirPath = storage_path('/app/public/uploads');
            $request->file_name->move($dirPath, $name);
            $link = 'storage/app/public/uploads' . '/' . $name;

                $userUsername = session()->get('username');
                $userId = User::query()->where('username', $userUsername)->value('id');
            $fileType = strtolower(pathinfo($_FILES["file_name"]["name"], PATHINFO_EXTENSION));

            $file = File::query()->create(['file_name' => $_FILES['file_name']['name'],
                'size' => $_FILES['file_name']['size'], 'price' => $request->price,
                'type' => $fileType, 'description' => $request->description,
                'upload_date' => date('Y-m-d'), 'user_id' => $userId, 'is_guest' => 0, 'link' => $link]);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
      @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $file = File::query()->select('file_name', 'type', 'size', 'is_confirmed', 'download_numbers')
            ->where('id', $id)->get();
        return view('fileViews.fileData', ['file' => $file]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
      @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(AuthController::userLevel() == 'confirmer'){
            $file = File::query()->find($id);
            $file->is_confirmed = 1;
            $file->save();
        }
        else{
         return Redirect::back()->withErrors(['msg' => 'you can not access this section']);
        }

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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
      @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(AuthController::userLevel() == 'confirmer') {
            $file = File::query()->find($id);
            $file->delete();
        }
        else{
            return Redirect::back()->withErrors(['msg' => 'you can not access this section']);

        }
    }
    public function list(){
        if(AuthController::userLevel() == 'confirmer') {
            $files = File::query()->get();
            return view('fileViews.fileManaging', ['files' => $files]);
        }
        else{
         return Redirect::back()->withErrors(['msg' => 'you can not access this section']);
        }
    }
}
