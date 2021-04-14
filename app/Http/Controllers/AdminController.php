<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }
    public function users(){
        $users = User::orderBy('name', 'ASC')->paginate(20);
        return view('admin.users',compact('users'));
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
            if ($user->photo_id != 1){
                if (file_exists(public_path() .'/images/'. $user->photo->name)) {//kontrollo nese ekziston foto ne storage para se te fshihet
                    unlink(public_path() .'/images/'. $user->photo->name);
                }
            }

            foreach ($user->posts->where('user_id',$user->id) as $post){
                if (file_exists(public_path() .'/files/'. $post->file->name)) {//kontrollo nese ekziston foto ne storage para se te fshihet
                    unlink(public_path() .'/files/'. $post->file->name);
                }
                foreach ($post->user as $user){ //fshij te gjithe perdoruesit qe jane tag ne ate post te perdoruesit
                    if ($user->posts->contains($post->id)) {
                        $user->posts()->detach($post->id);
                    }
                }
                foreach ($post->tags as $tag){
                    $post->tags()->detach($tag->id);
                }


                $post->delete();
            }

//           dd($user->posts->where('user_id','<>',$user->id));
            foreach ($user->posts->where('user_id','<>',$user->id) as $post) { // fshij veten ne te gjitha postimet qe je etiketuar
                if ($post->user->contains($user->id)) {
                    $post->user()->detach($user->id);
                }
            }

            $user->delete();

            return back();






    }
}
