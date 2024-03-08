<?php

namespace App\Http\Controllers\Images;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImagesSavedRequest;
use App\Models\Image;
use App\Repositories\ImageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;



class ImageController extends Controller
{

    private $imageRepository;

    function __construct(ImageRepository $imageRepository)
    {
        $this->imageRepository = $imageRepository; 
    }

    public function index()
    {
        $img = $this->imageRepository->allRepository();

        return response()->json([
            "status" => true,
            "message" => $img
        ], 200);

    }

    public function store(ImagesSavedRequest $request)
    {
        $imgSaved = $this->imageRepository->createServerRepository($request);
        $imgSavedDB = $this->imageRepository->creacteBDRepository($request);

        if(!$imgSaved) return response()->json([
            "status" => false,
            "message" => "No se guardo la imagen en la base de datos"
        ]);

        return response()->json([
            "status" => true,
            "message" => $imgSavedDB
        ], 201);
    }

    public function show(Image $image)
    {
        //
    }
    
    public function edit(Image $image)
    {
        //
    }
    
    public function update(Request $request, Image $image)
    {
        //
    }

    public function destroy(Image $image)
    {
        $imgDeleted = $this->imageRepository->destroyRepository($image);
        
        if(!$imgDeleted) 
            return response()->json([
                "status" => false,
                "message" => "No se Eliminó la imagen en la base de datos"
            ]);
        
        return response()->json([
            "status" => true,
            "message" => "Imagen eliminada"
        ]);
    }


}
