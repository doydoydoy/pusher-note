<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MessageSent;
use Storage;
use App\Notes;
use Auth;

class NoteController extends Controller
{

    public $content;

    public function __construct() 
    {
        $this->middleware('auth');
        $this->content = '';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('note');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Notes::where('user_id', Auth::id())->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $note = new Notes;
        $note->user_id = Auth::id();
        $note->content = "";
        $note->save();

        $notes = Notes::where('user_id', Auth::id())->get();

        broadcast(new MessageSent($note, $notes))->toOthers();

        return $notes;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($noteId)
    {
        return Notes::find($noteId);
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
        $note = Notes::find($request->id);

        if($request->content == null || empty($request->content)) {
            $note->content = '';
        } else {
            $note->content = $request->content;
        }

        $note->save();

        $notes = Notes::where('user_id', Auth::id())->get();

        broadcast(new MessageSent($note, $notes))->toOthers();

        return [
            'status' => 'Note Updated!',
            'Notes' => $request->content,
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $note = Notes::find($id);
        $note->delete();
        return ['status' => 'deleted'];
    }
}
