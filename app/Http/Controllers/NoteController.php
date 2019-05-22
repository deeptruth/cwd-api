<?php

namespace App\Http\Controllers;

use App\Note;
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
    public function store(CreateNoteRequest $request)
    {
        $note = Note::create($request->toArray());

        return response($note);
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

        return $id;
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
