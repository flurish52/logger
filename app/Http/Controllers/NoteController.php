<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
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
        $userId = Auth::user()->id;
        $sharedNotes = Note::whereHas('sharedNotes', function ($query) use ($userId) {
            $query->where('user_id', $userId)->where('trashed', false);
        })->get();
        $existingNote = Note::find($id);
        return inertia::render('Dashboard', [
            'users' => User::all(),
            'currentNotes' => Note::orderBy('id', 'desc')->where('user_id', Auth::user()->id)->where('trashed', false)->get(),
            'notes' => Note::orderBy('id', 'desc')->where('user_id', Auth::user()->id)->where('trashed', false)->get(),
            'trashedNotes' => Note::orderBy('id', 'desc')->where('user_id', Auth::user()->id)->where('trashed', true)->get(),
            'existingNote' => $existingNote,
            'sharedNotes' => $sharedNotes,
            'editable' => true
        ]);
    }

    public function viewTrashedNote($id)
    {
        $userId = Auth::user()->id;
        $sharedNotes = Note::whereHas('sharedNotes', function ($query) use ($userId) {
            $query->where('user_id', $userId)->where('trashed', false);
        })->get();

        $existingNote = Note::find($id);
        return inertia::render('Dashboard', [
            'users' => User::all(),
            'notes' => Note::orderBy('id', 'desc')->where('user_id', Auth::user()->id)->where('trashed', false)->get(),
            'currentNotes' => Note::orderBy('id', 'desc')->where('user_id', Auth::user()->id)->where('trashed', true)->get(),
            'trashedNotes' => Note::orderBy('id', 'desc')->where('user_id', Auth::user()->id)->where('trashed', true)->get(),
            'existingNote' => $existingNote,
            'sharedNotes' => $sharedNotes,
            'editable' => true
        ]);
    }

    public function fetchTrasedNotes()
    {
        $userId = Auth::user()->id;
        $sharedNotes = Note::whereHas('sharedNotes', function ($query) use ($userId) {
            $query->where('user_id', $userId)->where('trashed', false);
        })->get();
        return inertia::render('Dashboard', [
            'users' => User::all(),
            'notes' => Note::orderBy('id', 'desc')->where('user_id', Auth::user()->id)->where('trashed', false)->get(),
            'currentNotes' => Note::orderBy('id', 'desc')->where('user_id', Auth::user()->id)->where('trashed', true)->get(),
            'trashedNotes' => Note::orderBy('id', 'desc')->where('user_id', Auth::user()->id)->where('trashed', true)->get(),
            'sharedNotes' => $sharedNotes,
            'editable' => true

        ]);
    }

    public function restorTrashedNote($id)
    {
        $noteToRestor = Note::where('id', $id)->get();
        $noteToRestor[0]->trashed = false;

        $noteToRestor[0]->save();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $userId = Auth::user()->id;
        $sharedNotes = Note::whereHas('sharedNotes', function ($query) use ($userId) {
            $query->where('user_id', $userId)->where('trashed', false);
        })->get();

        $notesToDelete = Note::where('content', '')->where('user_id', Auth::user()->id)->get();
        if ($notesToDelete->count() === 1) {
            return inertia::render('Dashboard', [
                'users' => User::all(),
                'currentNotes' => Note::orderBy('id', 'desc')->where('user_id', Auth::user()->id)->where('trashed', false)->get(),
                'notes' => Note::orderBy('id', 'desc')->where('user_id', Auth::user()->id)->where('trashed', false)->get(),
                'trashedNotes' => Note::orderBy('id', 'desc')->where('user_id', Auth::user()->id)->where('trashed', true)->get(),
                'sharedNotes' => $sharedNotes,
                'existingNote' => $notesToDelete,
                'editable' => true

            ]);
        } else if ($notesToDelete->count() > 1) {
            foreach ($notesToDelete as $note) {
                $note->delete();
            }

            $newNote = Note::create([
                'title' => '',
                'content' => '',
                'user_id' => Auth::user()->id,
                'trashed' => false,
            ]);

            return inertia::render('Dashboard', [
                'users' => User::all(),
                'trashedNotes' => Note::orderBy('id', 'desc')->where('user_id', Auth::user()->id)->where('trashed', true)->get(),
                'currentNotes' => Note::orderBy('id', 'desc')->where('user_id', $newNote->user_id)->where('trashed', false)->get(),
                'notes' => Note::orderBy('id', 'desc')->where('user_id', $newNote->user_id)->where('trashed', false)->get(),
                'existingNote' => $newNote,
                'sharedNotes' => $sharedNotes,
                'editable' => true

            ]);
        } else if ($notesToDelete->count() === 0) {
            $newNote = Note::create([
                'title' => '',
                'content' => '',
                'trashed' => false,
                'user_id' => Auth::user()->id,
            ]);
            return inertia::render('Dashboard', [
                'users' => User::all(),
                'trashedNotes' => Note::orderBy('id', 'desc')->where('user_id', Auth::user()->id)->where('trashed', true)->get(),
                'currentNotes' => Note::orderBy('id', 'desc')->where('user_id', Auth::user()->id)->where('trashed', false)->get(),
                'notes' => Note::orderBy('id', 'desc')->where('user_id', Auth::user()->id)->where('trashed', false)->get(),
                'existingNote' => $newNote,
                'sharedNotes' => $sharedNotes,
                'editable' => true

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
        $noteToDelete[0]->trashed = true;

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
        if ($request['content']['title']){
            $noteToUpate[0]->title = substr($request['content']['title'], 0, 30);
        }else{
            $noteToUpate[0]->title = substr($request['content']['content'], 0, 30);
        }
        $noteToUpate[0]->content = $request['content']['content'];
        $noteToUpate[0]->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $noteToDeletePermenently = Note::find($id);

        $noteToDeletePermenently->delete();
    }

    public function emptyTrash()
    {
        $trashedNotes = Note::orderBy('id', 'desc')->where('user_id', Auth::user()->id)->where('trashed', true)->get();

        foreach ($trashedNotes as $note){
            $note->delete();
        }

    }

}
