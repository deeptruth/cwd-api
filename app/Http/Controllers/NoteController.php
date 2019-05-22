<?php

namespace App\Http\Controllers;

use App\Note;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateNoteRequest;

class NoteController extends Controller
{
    /**
     * Display a listing of the note.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $note = Note::all();

        return response($note);
    }

    /**
     * Store a newly created note in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $notes = $request->toArray();
        
        foreach ($notes as $key => $note) {
            $notes[$key]['created_at'] = Carbon::now()->toDateTimeString();
            $notes[$key]['updated_at'] = Carbon::now()->toDateTimeString();
        }

        Note::insert($notes);

        return response('Successfully Created');
    }

    /**
     * Update the specified note in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $note = Note::findOrFail($id);

        $note->fill($request->toArray());
        $note->update();

        return $note;
    }

    /**
     * Remove the specified note from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $note = Note::findOrFail($id);

        $note->delete();
    }
}
