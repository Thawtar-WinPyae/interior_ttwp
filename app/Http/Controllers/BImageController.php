<?php

namespace App\Http\Controllers;

use App\Models\BImage;
use App\Http\Requests\StoreBImageRequest;
use App\Http\Requests\UpdateBImageRequest;
use Illuminate\Support\Str;

class BImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = BImage::all();
        return view('image.index',compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('image.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBImageRequest $request)
    {
        return $request->all();
        $image = new BImage();
        $image->title = Str::slug($request->title, '_');
        $image = $request->file('image');
        $newName = uniqid() . "_image." . $image->getClientOriginalExtension();
        $image_resize = Image::make($image);
        $image_resize->resize(400, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $image_resize->save(storage_path('app/public/images/' . $newName));
        $image->img = $newName;
        $image->save();

        return redirect()->route('image.index')->with('success', 'Image created successfully.');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BImage  $bImage
     * @return \Illuminate\Http\Response
     */
    public function show(BImage $bImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BImage  $bImage
     * @return \Illuminate\Http\Response
     */
    public function edit(BImage $bImage)
    {
        return view('image.edit',compact('bImage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBImageRequest  $request
     * @param  \App\Models\BImage  $bImage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBImageRequest $request, BImage $bImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BImage  $bImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(BImage $bImage)
    {
        //
    }
}
