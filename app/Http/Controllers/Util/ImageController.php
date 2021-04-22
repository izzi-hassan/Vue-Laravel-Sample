<?php

namespace App\Http\Controllers\Util;

use Carbon\Carbon;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic;

class ImageController extends Controller
{
    //

    public function upload(Request $request) {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image64:jpeg,jpg,png'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()]);
        } else {
            $imageData = $request->get('image');
            $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];

            ImageManagerStatic::make($request->get('image'))->save(public_path('images/uploads/').$fileName);

            return response()->json(array('error'=>false, 'filename' => $fileName));
        }
    }
}
