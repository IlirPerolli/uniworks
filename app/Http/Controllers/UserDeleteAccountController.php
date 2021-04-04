<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserDeleteAccountRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserDeleteAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        return view('user.delete_account', compact('user'));
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
    public function destroy(UserDeleteAccountRequest $request)
    {
        $user = auth()->user();
        $current_password = auth()->user()->password;

        if(Hash::check($request->current_password, $current_password))
        {
//mos fshi dokumentet se mund te jene edhe te nje autorit tjeter...

            if (file_exists(public_path() .'/images/'. $user->photo->name)) {//kontrollo nese ekziston foto ne storage para se te fshihet
                unlink(public_path() .'/images/'. $user->photo->name);
            }

            $user->delete();

            if (auth()->user()->slug == $user->slug){
                return redirect()->route('login');
            }
            else{
                return back();
            }

        }
        else
        {
            session()->flash('invalid-current-password', 'Fjalëkalimi i tanishëm është gabim.');
            return back();
        }



    }
}
