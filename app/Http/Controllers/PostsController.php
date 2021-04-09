<?php

namespace App\Http\Controllers;
use App\Http\Requests\UserStorePostRequest;
use App\Http\Requests\UserUpdatePostRequest;
use App\Models\Category;
use App\Models\File;
use App\Models\Photo;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Cviebrock\EloquentSluggable\Services\SlugService;


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
//        dd($request->all());
        $user = auth()->user();
        $input = $request->all();

        $category = Category::find($request->category_id);

        if (!$category){
            session()->flash('category_error', 'Oops... Kategoria nuk u gjet.');
            return back();
        }
//dd($input);
//        $iteration = -1;
//        $ids =[]; //merr ne varg te gjitha id e shtypur ne forme
//        foreach($request->id as $id) {//shiko te gjithe usernamet e shtypur ne forme dhe futi ne vargun ids
//            if ($id != null) {
//                $ids[] = $id;
//            }
//        }
//        $ids[] = $user->id; // merr id e perdoruesit te kyqur
//        if (count($ids) !== count(array_unique($ids))){ //nese vlerat perseriten
//            session()->flash('duplicate_username', 'Nuk mund të jenë 2 autorë të njejtë.');
//            return back();
//            }


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
        $input['user_id'] = auth()->user()->id; //per identifikimin e perdoruesit qe ka krijuar postimin
       $post = Post::create($input); //krijo postimin

        $iteration = -1;
        foreach ($request->id as $id){ //krijo postimet per userat tjere
            $iteration++;
            if($id != null){
                $user = User::find($id);
                if (($request->author[$iteration] != $user->name . " " . $user->surname) && ($request->author[$iteration] != $user->name)){
                    $id = null;
                }
            }
                if ($id == null){
                    if ($request->author[$iteration] != null){
                        $slug = SlugService::createSlug(User::class, 'slug', $request->author[$iteration]);
                        $user = User::create(['name'=>$request->author[$iteration],'slug'=>$slug]);
                    if (!$user->posts->contains($post->id)) { //nese nuk eshte useri pronar i postimit atehere shto
                        $user->posts()->attach($post->id);
                    }
                    }
                }
                if ($id != null) {
                    $user = User::find($id);
                    if (!$user){
                        session()->flash('user_error', 'Oops... Përdoruesi nuk u gjet.');
                        return back();
                    }

                $user = User::where('id', $id)->first();
//                $user_id = $user->id;
                    if (!$user->posts->contains($post->id)) { //nese nuk eshte useri pronar i postimit atehere shto
                        $user->posts()->attach($post->id);
                    }
            }
        }

        if (!auth()->user()->posts->contains($post->id)) { //nese nuk eshte useri pronar i postimit atehere shto
            auth()->user()->posts()->attach($post->id);//krijo postim per vete
        }
        session()->flash('added_post', 'Postimi u krijua me sukses.');
    return back();
        //dd($request->username);
        //$user->posts()->attach(2);
    }
    public function autocomplete(Request $request)
    {
        $term = $request->term;
        $separated_input = preg_split('/(?<=\w)\b\s*[!?.]*/', $term, -1, PREG_SPLIT_NO_EMPTY);
        if (strlen($term)>=3) {
            $users_by_sentence = User::Where(DB::raw('CONCAT(name, " ", surname)'), 'like', '%' . $term . '%')->orWhere(DB::raw('CONCAT(surname, " ", name)'), 'like', '%' . $term . '%')->orWhere(DB::raw('CONCAT(name)'), 'like', '%' . $term . '%')->orderBy('name','ASC');//kerko me fjali
            $users_by_word = User::where(function ($q) use ($separated_input) {
                foreach ($separated_input as $input) {
                    if (strlen($input)<2){continue;}
                    $q->orWhere('name', 'like', "%{$input}%")
                        ->orWhere('surname', 'like', "%{$input}%")
                        ->orWhere('username', 'like', "%{$input}%")
                        ->orWhere('slug', 'like', "%{$input}%")
                        ->orWhere('email', 'like', "%{$input}%")->orderBy('name','ASC');
                }
            });
            $users_from_search = $users_by_sentence->union($users_by_word)->take(6)->get();

//            $queries = DB::table('users') //Your table name
//            ->where('name', 'like', '%' . $term . '%')
//            ->orWhere('surname', 'like', "%{$term}%")
//                ->orWhere('username', 'like', "%{$term}%")
//                ->orWhere('slug', 'like', "%{$term}%")
//                ->orWhere('email', 'like', "%{$term}%")->orderBy('name', 'ASC')
//                ->take(6)->get();

            foreach ($users_from_search as $query) {
                $photo = $query->photo_id;
                $photo = Photo::find($photo);
                $photo = $photo->name;
                $results[] = ['id' => $query->id, 'value' => $query->name . " " . $query->surname, 'photo'=>$photo];
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
    public function show($slug)
    {
        $post = Post::findBySlugOrFail($slug);
        $users = $post->user;
        if (auth()->check()){
            $suggested_users = User::where('id','<>' , auth()->user()->id)->take(15)->get();
        }
        else{
            $suggested_users = User::take(15)->get();
        }

        $other_posts = Post::where('category_id',$post->category_id)->where('id','<>',$post->id)->take(5)->get();;
        return view('posts.show', compact('users', 'post', 'suggested_users', 'other_posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $user = auth()->user();
        $post = Post::findBySlugOrFail($slug);
        if ($post->user_id != $user->id){
            abort(403, 'Unauthorized action.');
        }
        $post_user_count = count($post->user); //shiko sa usera ka ky postim
        $categories = Category::all();
        return view('posts.edit',compact('user', 'post', 'categories', 'post_user_count'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdatePostRequest $request, $slug)
    {
//        dd($request->all());
        $user = auth()->user();
        $input = $request->all();
        $post = Post::findBySlugOrFail($slug);
        $category = Category::find($request->category_id);
        if ($post->user_id != $user->id){
            abort(403, 'Unauthorized action.');
        }
        if (!$category){
            session()->flash('category_error', 'Oops... Kategoria nuk u gjet.');
            return back();
        }

        $post->update($input);

            $author_iteration = 0; //shiko sa autore jane krijuar ne forme
            foreach ($request->author as $author){
                if ($author != null){$author_iteration++;}
            }
        $post_user_count = count($post->user); //shiko sa usera ka ky postim
            if (($post_user_count + $author_iteration)>5){//nese ka shuma e ketyre eshte me e madhe se 5 atehere mos lejo
                session()->flash('user_error', 'Oops... Ky postim ka shume autor.');
                return back();
            }
            else{
        $iteration = -1;
        foreach ($request->id as $id){ //krijo postimet per userat tjere
            $iteration++;
            if($id != null){
                $user = User::find($id);
                if (($request->author[$iteration] != $user->name . " " . $user->surname) && ($request->author[$iteration] != $user->name)){
                    $id = null;
                }
            }
            if ($id == null){
                if ($request->author[$iteration] != null){
                    $slug = SlugService::createSlug(User::class, 'slug', $request->author[$iteration]);
                    $user = User::create(['name'=>$request->author[$iteration],'slug'=>$slug]);
                    if (!$user->posts->contains($post->id)) { //nese nuk eshte useri pronar i postimit atehere shto
                        $user->posts()->attach($post->id);
                    }
                }
            }
            if ($id != null) {
                $user = User::find($id);
                if (!$user){
                    session()->flash('user_error', 'Oops... Përdoruesi nuk u gjet.');
                    return back();
                }
                $user = User::where('id', $id)->first();
                if (!$user->posts->contains($post->id)) { //nese nuk eshte useri pronar i postimit atehere shto
                    $user->posts()->attach($post->id);
                }
            }
        }
        if (!auth()->user()->posts->contains($post->id)) { //nese nuk eshte useri pronar i postimit atehere shto
            auth()->user()->posts()->attach($post->id);//krijo postim per vete
        }
        session()->flash('updated_post', 'Postimi u ndryshua me sukses.');
        return redirect()->route('post.edit',$post->slug);
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $post = Post::findBySlugOrFail($slug);

        if (auth()->user()->id != $post->originalUser->id){ //nese eshte pronari i postimit atehere lejo
            abort(403, 'Unauthorized action.');
        }
        foreach ($post->user as $user){
            $user->posts()->detach($post->id);
        }
        if (file_exists(public_path() .'/files/'. $post->file->name)) {//kontrollo nese ekziston foto ne storage para se te fshihet
            unlink(public_path() .'/files/'. $post->file->name);
        }
        $post->delete();
        session()->flash('deleted_post', 'Postimi u fshi me sukses.');
        return redirect()->route('user.show',auth()->user()->slug);
    }
    public function remove_tag($slug)
    {
        $post = Post::findBySlugOrFail($slug);
        $user = auth()->user();
        if (!$user->posts->contains($post->id)) { //nese nuk eshte useri pronar i postimit atehere shto
            abort(403, 'Unauthorized action.');
        }

            $user->posts()->detach($post->id);

       return back();
    }
}
