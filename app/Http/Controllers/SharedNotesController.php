<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\SharedNotes;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateSharedNotesRequest;

use Illuminate\Support\Facades\Auth;
use inertia\inertia;

class SharedNotesController extends Controller
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
            'notes' => Note::orderBy('id', 'desc')->where('user_id', Auth::user()->id)->where('trashed', false)->get(),
            'trashedNotes' => Note::orderBy('id', 'desc')->where('user_id', Auth::user()->id)->where('trashed', true)->get(),
            'existingNote' => $existingNote,
            'sharedNotes' => $sharedNotes,
            'currentNotes' => $sharedNotes,
            'editable' => false
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $alreadyShared = SharedNotes::where('user_id', $request->user_id)
            ->where('note_id', $request->note_id)->get()->first();
        $noteToShare = Note::where('id', $request->note_id)->get()->first();
        if (!$alreadyShared) {
            $newShareNote = SharedNotes::create([
                'user_id' => $request->user_id,
                'note_id' => $request->note_id,
            ]);
            $noteToShare->shared = true;
            $noteToShare->save();
        return response()->json([
            'success' => true,
            'message' => 'The note has been successfully shared with ',
        ], 201);
        }else{
        return response()->json(['success' => false,
            'message' => 'This note has already been shared with ',], 200);

    }

        }



    /**
     * Display the specified resource.
     */
    public
    function show(SharedNotes $sharedNotes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public
    function edit(SharedNotes $sharedNotes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public
    function update(UpdateSharedNotesRequest $request, SharedNotes $sharedNotes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sharedNoteToDelete = SharedNotes::where('note_id', $id)->where('user_id',Auth::user()->id)->get();
        $sharedNoteToDelete[0]->delete();
    }
}
