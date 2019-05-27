<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProfileImage;
use Illuminate\Support\Facades\Input;
use Storage;
use File;

class ProfileImageController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  // ImageController.php
  public function index() {
      $files = ProfileImage::all();

      return view('user.profile-image-edit', compact('files'));
  }

  // ImageController.php
  public function create() {
      return view('user.profile-image-upload');
  }

  public function store(Request $request)
  {
    $file = Input::file('file');
    $filename = $file->getClientOriginalName();
    $user = auth()->user();

    $path = hash( 'sha256', time());

    if(Storage::disk('userProfileImage')->put($path.'/'.$filename,  File::get($file))) {
       $input['filename'] = $filename;
       $input['user_id'] = 1;
       $input['mime'] = $file->getClientMimeType();
       $input['path'] = $path;
       $input['size'] = $file->getClientSize();
       $file = ProfileImage::create($input);

       return response()->json([
           'success' => true,
           'id' => $file->id,
           'redirect' => '/user/profile'
       ], 200);
    }
    return response()->json([
       'success' => false
    ], 500);
  }
}
