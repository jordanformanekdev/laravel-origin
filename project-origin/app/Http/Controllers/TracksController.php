<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Track;
use Illuminate\Support\Facades\Input;
use Storage;
use File;

class TracksController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  // TrackController.php
  public function index() {
      $files = Track::all();

      return view('user.tracks.index', compact('files'));
  }

  // TrackController.php
  public function create() {
      return view('user.profile-image-upload');
  }

  public function store(Request $request)
  {
    $file = Input::file('file');
    $filename = $file->getClientOriginalName();
    $user = auth()->user();

    $path = hash( 'sha256', time());

    if(Storage::disk('audioTracks')->put($path.'/'.$filename,  File::get($file))) {
       $input['filename'] = $filename;
       $input['user_id'] = 1;
       $input['mime'] = $file->getClientMimeType();
       $input['path'] = $path;
       $input['size'] = $file->getClientSize();
       $file = Track::create($input);

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
