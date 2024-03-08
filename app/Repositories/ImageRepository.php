<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ImagesSavedRequest;
use App\Models\Image;
use App\Models\Tag;

class ImageRepository
{
    protected $model;

    function __construct() {
        $this->model = new Image;
    }

    function allRepository () {
        return $this->model->with(["user", "tags"])->get(); // Carga ansiosa
    }

    function createServerRepository (ImagesSavedRequest $request) {

        $img = time() . "_" . $request->file("url_image")->getClientOriginalName();        
        $nameImgServer = "user_photo" . $request["user_id"] . $img;
       
        Storage::disk("test")->put($nameImgServer, "public/images/");
       
        return $nameImgServer;
    }
    
    function creacteBDRepository (ImagesSavedRequest $request) {
        $imgSaved = Image::create([
            "url_image" => "/storage/images/" . $this->createServerRepository($request),
            "user_id" => $request["user_id"]
        ]);

        $tags = $request->input("tag_name");
        if($tags) {
            $tag_name = json_decode($tags, true);
            
            foreach ($tag_name as $tagName) {
                $tag = Tag::firstOrCreate(["tag_name" => $tagName]);
                $imgSaved->tags()->attach($tag->id);
            }
        }
        return $imgSaved;
    }

    function destroyRepository (Image $image) {

        $urlDelete = str_replace("storage", "public", $image->url_image);
        Storage::delete($urlDelete);

        $image->delete();
        
        return $image;
    }
}