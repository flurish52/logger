<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SharedNotesController;
use App\Models\Note;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    $userId = Auth::user()->id;

    $sharedNotes = Note::whereHas('sharedNotes', function ($query) use ($userId) {
        $query->where('user_id', $userId)->where('trashed', false);
    })->get();
    $notesToDelete = Note::where('content', '')->where('user_id', Auth::user()->id)->get();
    if($notesToDelete){
        foreach($notesToDelete as $note){
            $note->delete();
        }
        return Inertia::render('Dashboard', [
            'users' => User::all(),
            'currentNotes' => Note::orderBy('id', 'desc')->where('user_id', Auth::user()->id)->where('trashed', false)->get(),
            'notes' => Note::orderBy('id', 'desc')->where('user_id', Auth::user()->id)->where('trashed', false)->get(),
            'trashedNotes' => Note::orderBy('id', 'desc')->where('user_id', Auth::user()->id)->where('trashed', true)->get(),
            'sharedNotes' => $sharedNotes
        ]);
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard/note/{note_id}', [NoteController::class, 'index'])->name('note.display');
    Route::post('/dashboard/note/{note_id}', [NoteController::class, 'update'])->name('note.upate');
    Route::get('/dashboard/new-note', [NoteController::class, 'create'])->name('note.new');
    Route::post('/dashboard/delete/{note_id}', [NoteController::class, 'trashed'])->name('note.new');
    Route::delete('/dashboard/note_delete/{note_id}', [NoteController::class, 'destroy'])->name('note.deletePermenently');


    Route::get('dashboard/trashed_notes', [NoteController::class, 'fetchTrasedNotes'])->name('note.trashed');
    Route::post('/dashboard/restor/{note_id}', [NoteController::class, 'restorTrashedNote'])->name('note.restor');
    Route::get('/dashboard/trashed_note/{note_id}', [NoteController::class, 'viewTrashedNote'])->name('note.trashedView');
    Route::delete('/dashboard/empty_trash', [NoteController::class, 'emptyTrash'])->name('empty.trash');
    Route::post('/dashboard/share_note', [SharedNotesController::class, 'store'])->name('sharenote');
    //    Route::get('/dashboard/share_note', [SharedNotesController::class, 'index'])->name('sharenote');
    Route::delete('/dashboard/delete_shared_note/{note_id}', [SharedNotesController::class, 'destroy'])->name('delete.share');
    Route::get('/dashboard/shared_note/{note_id}', [SharedNotesController::class, 'index'])->name('view.share');
});



Route::get('api/items', [ItemController::class, 'index']);

Route::prefix('api/item')->group( function () {
    Route::post('/store', [ItemController::class, 'store']);
    Route::put('/{id}', [ItemController::class, 'update']);
    Route::put('/{id}/corrected', [ItemController::class, 'corrected']);
    Route::delete('/{id}', [ItemController::class, 'destroy']);
    Route::get('/{id}/edit', [ItemController::class, 'edit']);
});



Route::get('/run-command/{command}', function ($command) {


    $output = Artisan::call($command);
    return response()->json(['output' => $output]);;
});



require __DIR__.'/auth.php';
