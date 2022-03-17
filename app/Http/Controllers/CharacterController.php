<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Character;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CharacterController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the profile for a given data.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $character = Http::get("https://swapi.dev/api/people/$id");
        $character->status();
        $characterData = $character->json();
        $savedCharacterId = 0;
        if ($character = Character::firstWhere(['character_id'=> $id,'user_id'=>auth()->user()->id] )) {
            $savedCharacterId = $character->id;
        }
        $data = array('characterData'=>$characterData,'savedCharacterId'=>$savedCharacterId);
        return view('characters.show', compact('data'));
    }

    /**
     * Show the profile for a given data.
     *
     * @return \Illuminate\View\View
     */
    public function list(Request $request)
    {
        $page = $request->input('page');
        $page = ($page) ? $page : 1;
        $characters = Http::get("https://swapi.dev/api/people/?page=$page");
        $characters->status();
        $charactersList = $characters->json();
        
        $myCollectionObj = collect($charactersList['results']);
  
        $data = $this->paginate($myCollectionObj,$charactersList['count']);
   
        $data=array('characters_title'=>'Characters Listing Page', 'characters_sub_title'=>'Characters', 'data'=>$data);

        return view('characters.index', compact('data'));

        //return view('characters.index', compact('charactersList'));
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userlist()
    {
        //$data =  Character::latest()->paginate(5);
        $data =  Character::where('user_id','=',auth()->user()->id)->Paginate(10);
        $data=array('characters_title'=>'Saved Characters', 'characters_sub_title'=>'Saved Characters', 'data'=>$data);

        return view('characters.index',compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request->validate([
            'name' => 'required',
            'gender' => 'required',
            'character_id' => 'required',
        ]);
        $user = auth()->user();

        $request->request->add(['user_id' => $user->id]);
        Character::create($request->all());
     
        return redirect()->route('characters')
                        ->with('success','Character saved for later use.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function destroy(Character $character)
    {
        $character->delete();
    
        return redirect()->route('user_characters')
                        ->with('success','Character deleted from saved list');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function paginate($items, $totalCount, $perPage = 10, $page = null, $options = ['path'=>'characters','currentPage'=>1])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        //$items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items, $totalCount, $perPage, $page, $options);
    }

}
