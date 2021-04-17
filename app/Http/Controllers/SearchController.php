<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserSearchRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function users(UserSearchRequest $request)
    {

        $input = $request->q;
        // $separated_input = preg_split('/\s+/', $input, -1, PREG_SPLIT_NO_EMPTY);
        $separated_input = preg_split('/(?<=\w)\b\s*[!?.]*/', $input, -1, PREG_SPLIT_NO_EMPTY);
        if ($input!='') {
            if (strlen($input)<=2){
                session()->flash('min_length_input', "Ju lutem jepni një fjalë më të gjatë");
                return redirect()->route('index');
            }

            //Metoda tani duke i ndare fjalet e fjalise edhe duke kerkuar bazuar ne ato fjale
            $users_by_sentence = User::Where(DB::raw('CONCAT(name, " ", surname)'), 'like', '%' . $input . '%')->orWhere(DB::raw('CONCAT(surname, " ", name)'), 'like', '%' . $input . '%')->orderBy('name','ASC');//kerko me fjali
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
            $users_from_search = $users_by_sentence->union($users_by_word)->paginate(10)->appends(request()->query());
            $users_count = $users_from_search->count();

            //Kjo appends per te marrur edhe get requestat tjere ne get metoden
            return view('search.users', compact('users_from_search',  'users_count'));

        }

        return redirect()->route('index'); //nese inputi eshte i zbrazet
    }

        public function posts(UserSearchRequest $request)
        {

            $input = $request->q;

            $categories = Category::all();
            if ($request->order == 'asc'){$order = "asc";}
            else if ($request->order == 'desc'){$order = "desc";}
            else{$order = "desc";}

            if (isset($request->startyear) && isset($request->endyear)){
                $start_year = $request->startyear;
                $end_year = $request->endyear;
            }
            else{
                $start_year = 1900;
                $end_year = 2021;}
            if (isset($request->year)){$year = $request->year;}
            else{$year = 1900;}
            if (isset($request->category)){
                $category = Category::findBySlugOrFail($request->category);
                $category = $category->id;
            }



            $separated_input = preg_split('/(?<=\w)\b\s*[!?.]*/', $input, -1, PREG_SPLIT_NO_EMPTY);

            if ($input!='') {
                if (strlen($input)<=2){
                    session()->flash('min_length_input', "Ju lutem jepni nje fjale me te gjate");
                    return redirect()->route('index');
                }

                $posts_by_sentence = Post::Where('title', 'like', "%{$input}%")->orderBy('title','ASC');//kerko me fjali
                $posts_by_word = Post::Where(function ($q) use ($separated_input) { //kerko me fjale
                    foreach ($separated_input as $input) {
                        if (strlen($input)<2){
                            continue;
                        }
                        $q->orWhere('title', 'like', "%{$input}%")
                            ->orWhere('slug', 'like', "%{$input}%")
                            ->orderBy('title','ASC');
                    }
                });
                if (isset($request->category)) {
                    $posts = $posts_by_sentence->whereBetween('year', [$start_year, $end_year])->where('year', '>=', $year)->where('category_id',$category)->union($posts_by_word->whereBetween('year', [$start_year, $end_year])->where('year', '>=', $year)->where('category_id',$category))->orderBy('id', $order)->paginate(10)->appends(request()->query());
                }
                else{
                    $posts = $posts_by_sentence->whereBetween('year', [$start_year, $end_year])->where('year', '>=', $year)->union($posts_by_word->whereBetween('year', [$start_year, $end_year])->where('year', '>=', $year))->orderBy('id', $order)->paginate(10)->appends(request()->query());

                }
                $posts_count = $posts->count();
                //Kjo appends per te marrur edhe get requestat tjere ne get metoden

                return view('search.posts', compact('posts','posts_count', 'categories'));

            }
            return redirect()->route('index'); //nese inputi eshte i zbrazet

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
