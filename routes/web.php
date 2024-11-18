<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ItemController;
use App\Models\Note;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    $notesToDelete = Note::where('content', '')->where('user_id', Auth::user()->id)->get();
    if($notesToDelete){
        foreach($notesToDelete as $note){
            $note->delete();
        }
        return Inertia::render('Dashboard', [
            'notes' => Note::orderBy('id', 'desc')->where('user_id', Auth::user()->id)->where('trashed', false)->get(),
        ]);
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard/note/{chat_id}', [NoteController::class, 'index'])->name('note.display');
    Route::post('/dashboard/note/{chat_id}', [NoteController::class, 'update'])->name('note.upate');
    Route::get('/dashboard/new-note', [NoteController::class, 'create'])->name('note.new');
    Route::post('/dashboard/delete/{note_id}', [NoteController::class, 'trashed'])->name('note.new');
    Route::get('dashboard/trashed_notes', [NoteController::class, 'fetchTrasedNotes'])->name('note.trashed');
    Route::post('/dashboard/restor/{note_id}', [NoteController::class, 'restorTrashedNote'])->name('note.restor');
    Route::get('/dashboard/trashed_note/{note_id}', [NoteController::class, 'viewTrashedNote'])->name('note.trashedView');
//    Route::post('/dashboard/new-note', [NoteController::class, 'store'])->name('note.store');
});



Route::get('api/items', [ItemController::class, 'index']);

Route::prefix('api/item')->group( function () {
    Route::post('/store', [ItemController::class, 'store']);
    Route::put('/{id}', [ItemController::class, 'update']);
    Route::put('/{id}/corrected', [ItemController::class, 'corrected']);
    Route::delete('/{id}', [ItemController::class, 'destroy']);
    Route::get('/{id}/edit', [ItemController::class, 'edit']);
});

require __DIR__.'/auth.php';
