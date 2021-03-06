<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        return view('posts.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // auth()->user()->posts()->attach(2);
        $request['file_id']=1;
       $post = Post::create($request->all());
        $iteration = -1;
        foreach ($request->username as $username){
            $iteration++;
                if ($username == null){
                    if ($request->author[$iteration] != null){
                       $user = User::create(['name'=>$request->author[$iteration]]);
                       $user->posts()->attach($post->id);
                    }
                }
                if ($username != null) {
                $user = User::where('username', $username)->first();
//                $user_id = $user->id;
                $user->posts()->attach($post->id);
            }

        }
    return back();
        //dd($request->username);
        //$user->posts()->attach(2);
    }
    public function autocomplete(Request $request)
    {
        $term = $request->term;
        if (strlen($term)>=3) {
            $queries = DB::table('users') //Your table name
            ->where('name', 'like', '%' . $term . '%') //Your selected row
            ->orWhere('surname', 'like', "%{$term}%")
                ->orWhere('username', 'like', "%{$term}%")
                ->orWhere('slug', 'like', "%{$term}%")
                ->orWhere('email', 'like', "%{$term}%")->orderBy('name', 'ASC')
                ->take(6)->get();

            foreach ($queries as $query) {
                $results[] = ['id' => $query->id, 'value' => $query->name . " " . $query->surname, 'username' => $query->username]; //you can take custom values as you want
            }
            return response()->json($results);
        }
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
    public function destroy($id)
    {
        //
    }
}