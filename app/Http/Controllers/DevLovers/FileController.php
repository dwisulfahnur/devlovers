<?php

namespace App\Http\Controllers\DevLovers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use File;

class FileController extends Controller
{
    public function getImage($profile_picture)
    {
        $path = storage_path() . '/images/' . $profile_picture;

        if(!File::exists($path)) abort(404);

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = \Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }
}
