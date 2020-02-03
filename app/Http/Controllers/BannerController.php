<?php

namespace App\Http\Controllers;

use App\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return view('admin.banners.index')->with(['banners' => Banner::paginate(10)]);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('admin.banners.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        \Validator::make($request->all(),[
            'image'         => 'required|mimes:jpg,jpeg,png'
        ]);

        $new_banner = new \App\Banner;

        $image = $request->file('image');

        if ($image) {
            $image_path = $image->store('images_banner', 'public');

            $new_banner->image = $image_path;
        }

        $new_banner->save();
        return back()->with('success', 'Banner berhasil ditambahkan');
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Banner  $banner
    * @return \Illuminate\Http\Response
    */
    public function show(Banner $banner)
    {
        // return view('admin.banners.show' compact('banner'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Banner  $banner
    * @return \Illuminate\Http\Response
    */
    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Banner  $banner
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request)
    {
        \Validator::make($request->all(),[
            'image'         => 'required|mimes:jpg,jpeg,png'
        ]);

        // dd($request->get('id'));

        $banner = \App\Banner::findOrFail($request->get('id'));

        $new_banner = $request->file('image');

        if ($new_banner) {
            if  ($banner->image && file_exists(storage_path('app/public/' . $banner->image)))
            {
                \Storage::delete('public/'. $banner->image);
            }

            $new_banner_path = $new_banner->store('image_banner', 'public');

            $banner->image = $new_banner_path;
        }

        $banner->save();

        return back()->with('success', 'Banner berhasil diupdate!');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Banner  $banner
    * @return \Illuminate\Http\Response
    */
    public function destroy(Request $request)
    {
        // dd($request->get('id'));
        Banner::destroy($request->get('id'));
        return back()->with('success', ' Banner berhasil dihapus');
    }
}
