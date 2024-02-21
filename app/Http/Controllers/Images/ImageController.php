<?php

namespace App\Http\Controllers\Images;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImagesSavedRequest;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function index()
    {
        $img = Image::with("user")->get(); //lazy loading

        return response()->json([
            "status" => true,
            "message" => $img
        ], 200);

    }

    
    public function store(ImagesSavedRequest $request)
    {
        $img = time() . "_" . $request->file("url_image")->getClientOriginalName();        
        $nameImgServer = "user_photo" . $request["user_id"] . $img;
       
        $imgServer = Storage::disk("test")->put($nameImgServer, "public/images/");
        $imgSaved = Image::create([
            "url_image" => "/storage/images/" . $nameImgServer,
            "user_id" => $request["user_id"]
        ]);

        if(!$imgSaved) return response()->json([
            "status" => false,
            "message" => "No se guardo la imagen en la base de datos"
        ]);

        return response()->json([
            "status" => true,
            "message" => "{$imgSaved}"
        ], 201);
        // return $request->validated();
    }

    /**
     * Display the specified resource.
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        $urlDelete = str_replace("storage", "public", $image->url_image);
        Storage::delete($urlDelete);

        $image->delete();
        return response()->json([
            "status" => true,
            "message" => "images deleted"
        ]);
    }
}
