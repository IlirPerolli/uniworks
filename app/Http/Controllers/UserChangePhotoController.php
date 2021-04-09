<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class UserChangePhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        return view('user.change_photo',compact('user'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
    $user = auth()->user();
    $input = $request->all();
        if($file = $request->file('photo_id')){
            if ($user->photo_id !=1) {
                if (file_exists(public_path() .'/images/'. $user->photo->name)) {//kontrollo nese ekziston foto ne storage para se te fshihet
                    unlink(public_path() .'/images/'. $user->photo->name);
                }
            }
            if (strpos($file->getClientOriginalName(),'chat') !== false) {
                $file_name = $file->getClientOriginalName();
                $name = time().str_replace("chat",$user->username,$file_name); //Per shkak te serverit qe se perkrah fjalen chat
            }
            else{
                $name = time() . $file->getClientOriginalName();
            }
            $image_resize = Image::make($file->getRealPath());
            $image_resize->fit(300, 300);
            $image_resize->save('images/'.$name);
            $photo = Photo::create(['name'=>$name]);
            $input['photo_id'] = $photo->id;
            $user->update($input);
            session()->flash('updated_photo', 'Foto e profilit u ndryshua me sukses.');
            return back();
        }
        else{
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = auth()->user();
        if ($user->photo_id == 1){
            abort(403, 'Unauthorized action.');
        }
        else{
            if (file_exists(public_path().'/images/'.$user->photo->name)) {//kontrollo nese ekziston foto ne storage para se te fshihet

                unlink(public_path().'/images/'. $user->photo->name);
            }
            $user->update(['photo_id'=>1]);
            session()->flash('deleted_photo', 'Foto e profilit u fshi me sukses.');
            return back();
        }
    }
}
