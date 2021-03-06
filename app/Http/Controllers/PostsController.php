<?php

namespace App\Http\Controllers;
use App\Http\Requests\UserStorePostRequest;
use App\Models\Category;
use App\Models\File;
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
        $categories = Category::all();
        return view('posts.create', compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStorePostRequest $request)
    {
        $user = auth()->user();
        $input = $request->all();

        $category = Category::find($request->category_id);
        if (!$category){
            session()->flash('category_error', 'Oops... Kategoria nuk u gjet.');
            return back();
        }
       // dd($request->all());
        $iteration = -1;
        $usernames =[];
        foreach($request->username as $username) {//shiko te gjithe usernamet e shtypur ne forme dhe futi ne vargun usernames
            if ($username != null) {
                $usernames[] = $username;
            }
        }
        $usernames[] = $user->username; // merr usernamin e perdoruesit te kyqur
        if (count($usernames) !== count(array_unique($usernames))){ //nese vlerat perseriten
            session()->flash('duplicate_username', 'Nuk mund të jenë 2 autorë të njejtë.');
            return back();
            }


        if ($file = $request->file('file_id')){ //shto filen ne storage
                if (strpos($file->getClientOriginalName(),'chat') !== false) {
                    $file_name = $file->getClientOriginalName();
                    $name = time().str_replace("chat",$user->username,$file_name); //Per shkak te serverit qe se perkrah fjalen chat
                }
                else{
                    $name = time() . $file->getClientOriginalName();
                }

                $file->move('files', $name);
            $file = File::create(['name'=>$name]);
                $input['file_id'] = $file->id;
            }
       $post = Post::create($input); //krijo postimin

        $iteration = -1;
        foreach ($request->username as $username){ //krijo postimet per userat tjere
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

        auth()->user()->attach($post->id);//krijo postim per vete
        session()->flash('added_post', 'Postimi u krijua me sukses.');
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
