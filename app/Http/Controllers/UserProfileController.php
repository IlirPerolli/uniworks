<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserEditRequest;
use App\Models\City;
use App\Models\Photo;
use App\Models\University;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function autocomplete(Request $request)
    {
        $term = $request->term;
        $separated_input = preg_split('/(?<=\w)\b\s*[!?.]*/', $term, -1, PREG_SPLIT_NO_EMPTY);
        if (strlen($term)>=3) {
            $university_by_sentence = University::Where(DB::raw('name'), 'like', '%' . $term . '%')->orderBy('name','ASC');//kerko me fjali
            $university_by_word = University::where(function ($q) use ($separated_input) {
                foreach ($separated_input as $input) {
                    if (strlen($input)<2){continue;}
                    $q->orWhere('name', 'like', "%{$input}%")
                     ->orderBy('name','ASC');
                }
            });
            $universities_from_search = $university_by_sentence->union($university_by_word)->take(6)->get();

//            $queries = DB::table('users') //Your table name
//            ->where('name', 'like', '%' . $term . '%')
//            ->orWhere('surname', 'like', "%{$term}%")
//                ->orWhere('username', 'like', "%{$term}%")
//                ->orWhere('slug', 'like', "%{$term}%")
//                ->orWhere('email', 'like', "%{$term}%")->orderBy('name', 'ASC')
//                ->take(6)->get();

            foreach ($universities_from_search as $query) {

                $results[] = ['id' => $query->id, 'value' => $query->name];
            }
            return response()->json($results);
        }
    }

    public function autocomplete_city(Request $request)
    {
        $term = $request->term;
        $separated_input = preg_split('/(?<=\w)\b\s*[!?.]*/', $term, -1, PREG_SPLIT_NO_EMPTY);
        if (strlen($term)>=3) {
            $cities_by_sentence = City::Where(DB::raw('name'), 'like', '%' . $term . '%')->orderBy('name','ASC');//kerko me fjali
            $city_by_word = City::where(function ($q) use ($separated_input) {
                foreach ($separated_input as $input) {
                    if (strlen($input)<2){continue;}
                    $q->orWhere('name', 'like', "%{$input}%")
                        ->orderBy('name','ASC');
                }
            });
            $cities_from_search = $cities_by_sentence->union($city_by_word)->take(6)->get();

//            $queries = DB::table('users') //Your table name
//            ->where('name', 'like', '%' . $term . '%')
//            ->orWhere('surname', 'like', "%{$term}%")
//                ->orWhere('username', 'like', "%{$term}%")
//                ->orWhere('slug', 'like', "%{$term}%")
//                ->orWhere('email', 'like', "%{$term}%")->orderBy('name', 'ASC')
//                ->take(6)->get();

            foreach ($cities_from_search as $query) {

                $results[] = ['id' => $query->id, 'value' => $query->name];
            }
            return response()->json($results);
        }
    }


    public function index()
    {
        //
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
    public function show($slug)
    {
        $user = User::findBySlugOrFail($slug);
        $posts = $user->posts()->orderBy('created_at', 'desc')->paginate(10);
        return view('user.show', compact('user', 'posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = auth()->user();
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request)
    {
        $user = auth()->user();
        $inputs = $request->all();

        if($request->university_id != null){
            $university = University::find($request->university_id);

            if (($request->university != $university->name)){
                $request->university_id = null;
            }
        }

        if (($request->university_id == null) && ($request->university != $user->university->name)){
            $university = University::create(['name'=>$request->university]);
            $inputs['university_id'] = $university->id;
        }
        else if (($request->university_id  == null) && ($request->university == $user->university->name)){
            $inputs['university_id'] = $user->university_id;
    }


        if($request->city_id != null){
            $city = City::find($request->city_id);

            if (($request->city != $city->name)){
                $request->city_id = null;
            }
        }

        if (($request->city_id == null) && ($request->city != $user->city->name)){
            $city = City::create(['name'=>$request->city]);
            $inputs['city_id'] = $city->id;
        }
        else if (($request->city_id  == null) && ($request->city == $user->city->name)){
            $inputs['city_id'] = intval($user->city_id);
        }

        $user->update($inputs);
        session()->flash('updated_user', 'Profili u ndryshua me sukses.');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
