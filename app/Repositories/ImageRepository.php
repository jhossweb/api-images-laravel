<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ImagesSavedRequest;
use App\Models\Image;

class ImageRepository
{
    protected $model;

    function __construct() {
        $this->model = new Image;
    }

    function all () {
        return $this->model->with("user")->get(); //lazy loading
    }

    function createServer(ImagesSavedRequest $request) {

        $img = time() . "_" . $request->file("url_image")->getClientOriginalName();        
        $nameImgServer = "user_photo" . $request["user_id"] . $img;
       
        Storage::disk("test")->put($nameImgServer, "public/images/");
       
        return $nameImgServer;
    }
    
    function creacteBD (ImagesSavedRequest $request) {
        $imgSaved = Image::create([
            "url_image" => "/storage/images/" . $this->createServer($request),
            "user_id" => $request["user_id"]
        ]);
        return $imgSaved;
    }
}