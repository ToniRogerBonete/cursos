<?php

namespace App\Http\Controllers;

use App\File;
use App\Http\Requests\FileRequest;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $files = File::where('file_type',$request->file_type)
            ->orderBy('id','DESC')
            ->get();
        return response()->json($files);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FileRequest $request)
    {
        $nameFile = null;
        if($request->hasFile($request->file_type)) {
            $name = $request->file($request->file_type)->getClientOriginalName();
            $extension = $request->file($request->file_type)->extension();
            $nameFile = "{$name}";
            $path = $request->file($request->file_type)->storeAs($request->file_type, $nameFile);
            if($request->file_type=='imagem') {
                $file = $request->file($request->file_type);
                $path = 'imagem\/p_' . $nameFile;
                $image = Image::make($file);

                $width = $image->width();
                $height = $image->height();

                $image->fit($width, $height, function ($constraint) {
                    $constraint->aspectRatio();
                });
                Storage::put($path, (string)$image->encode());
            }
            $file = new File;
            $file->account_id = Auth::user()->account_id;
            $file->file = $nameFile;
            $file->file_type = $request->file_type;
            $file->save();
        }
        return response()->json($path);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        //
    }
}
