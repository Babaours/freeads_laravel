<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Ads;
use Auth;
//use 
class AdsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads = Ads::latest()->paginate(10);
        return view('ads.index',compact('ads'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        return view('ads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            request()->validate([
            'title' => 'required',
            'description' => 'required',
            'filename' => 'required',
            'price' => 'required'
        ]);

        $ad = new Ads;
        $ad->title = request()->input('title');
        $ad->description = request()->input('description');
        $ad->user_id = Auth::id();
        $ad->price = request()->input('price');
   
        $photo = Input::file('filename');

        $link = $photo->storeAs('public' , Input::file('filename')->getClientOriginalName());

        $ad->filename = 'storage/' . Input::file('filename')->getClientOriginalName();  
        
        
        $ad->save();

        // Ads::create($request->all());
        return redirect()->route('ads.index')
                        ->with('success','ad created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ads $ads)
    {
        return view('ads.show', compact('ads'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Ads $ads)
    {
         return view('ads.edit',compact('ads'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Ads $ads)
    {
            request()->validate([
            'title' => 'required',
            'description' => 'required',
            'filename' => 'required',
            'price' => 'required'
        ]);

        $ad = new Ads;
        $ad->title = request()->input('title');
        $ad->description = request()->input('description');
        $ad->user_id = Auth::id();
        $ad->price = request()->input('price');
   
        $photo = Input::file('filename');

        $link = $photo->storeAs('public' , Input::file('filename')->getClientOriginalName());

        $ad->filename = 'storage/' . Input::file('filename')->getClientOriginalName();  
        
        
        $ad->save();

        $ads->update($request->all());
        return redirect()->route('ads.index')
                        ->with('success','ad updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ads)
    {
        Ads::destroy($ads);
        return redirect()->route('ads.index')
                        ->with('success','ad deleted successfully');
    }

}