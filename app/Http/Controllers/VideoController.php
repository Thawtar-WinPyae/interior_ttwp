<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\UpdateVideoRequest;
use App\Models\Video;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos=Video::all();
        return view('video.index',compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('video.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVideoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVideoRequest $request)
    {
        $video=new Video();
        $video->title=$request->title;
        $video->date=$request->date;
        $video->link=$request->link;
        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $newName = uniqid() . "_video." . $file->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('videos', $file, $newName);
            $video->url = $newName;
        }
        $video->save();
        return redirect()->route('video.index')->with('success', 'Video created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        // return view('video.show', compact('video'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        return view('video.edit', compact('video'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVideoRequest  $request
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVideoRequest $request, Video $video)
    {
        $video->title=$request->title;
        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $newName = uniqid() . "_video." . $file->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('videos', $file, $newName);
            $video->url = $newName;
        }
        $video->update();
        return redirect()->route('video.index')->with('success', 'Video created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        if ($video->video) {
            $videoPath = 'public/videos/' . $video->video;
    
            if (Storage::exists($videoPath)) {
                Storage::delete($videoPath);
            }
        }
        $video->delete();

        return redirect()->route('video.index')->with('success', 'Video deleted successfully.');
    
    }
}
