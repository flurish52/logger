<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use inertia\inertia;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $existingNote = Note::find($id);
        return inertia::render('Dashboard', [
            'notes' => Note::orderBy('id', 'desc')->where('user_id', Auth::user()->id)->where('trashed', false)->get(),
            'existingNote' => $existingNote,
        ]);
    }
    public function viewTrashedNote($id)
    {
        $existingNote = Note::find($id);
        return inertia::render('Dashboard', [
            'notes' => Note::orderBy('id', 'desc')->where('user_id', Auth::user()->id)->where('trashed', true)->get(),
            'existingNote' => $existingNote,
        ]);
    }

    public function fetchTrasedNotes()
    {
//        $existingNote = Note::find($id);
        return inertia::render('Dashboard', [
            'trashedNotes' => Note::orderBy('id', 'desc')->where('user_id', Auth::user()->id)->where('trashed', true)->get(),
//            'existingNote' => $existingNote,
        ]);
    }

    public function restorTrashedNote($id)
    {
        $noteToRestor = Note::where('id', $id)->get();
        $noteToRestor[0]->trashed =  false;

        $noteToRestor[0]->save();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $notesToDelete = Note::where('content', '')->where('user_id', Auth::user()->id)->get();
        if($notesToDelete->count() === 1 ){
            return inertia::render('Dashboard', [
                'notes' => Note::orderBy('id', 'desc')->where('user_id', Auth::user()->id)->where('trashed', false)->get(),
                'existingNote' => $notesToDelete,
            ]);
        }else if($notesToDelete->count() > 1){
            foreach($notesToDelete as $note){
                $note->delete();
            }

            $newNote =  Note::create([
                'title' => 'New note',
                'content' => '',
                'user_id' => Auth::user()->id,
                'trashed' => false,
            ]);

            return inertia::render('Dashboard', [
                'notes' => Note::orderBy('id', 'desc')->where('user_id', $newNote->user_id)->where('trashed', false)->get(),
                'existingNote' => $newNote,
            ]);
        }else if ($notesToDelete->count() === 0){
            $newNote =  Note::create([
                'title' => 'New note',
                'content' => '',
                'trashed' => false,
                'user_id' => Auth::user()->id,
            ]);
            return inertia::render('Dashboard', [
                'notes' => Note::orderBy('id', 'desc')->where('user_id', Auth::user()->id)->where('trashed', false)->get(),
                'existingNote' => $newNote,
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    public function trashed($id)
    {
        $noteToDelete = Note::where('id', $id)->get();
        $noteToDelete[0]->trashed =  true;

        $noteToDelete[0]->save();
    }





    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $noteToUpate = Note::where('id', $id)->get();
        $noteToUpate[0]->title = substr($request['content']['content'], 0, 20);
        $noteToUpate[0]->content = $request['content']['content'];
        $noteToUpate[0]->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $note)
    {

        }

}
