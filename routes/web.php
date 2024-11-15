<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NoteController;
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
            'notes' => Note::orderBy('id', 'desc')->where('user_id', Auth::user()->id)->get(),
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
    Route::delete('/dashboard/delete/{note_id}', [NoteController::class, 'destroy'])->name('note.new');
//    Route::post('/dashboard/new-note', [NoteController::class, 'store'])->name('note.store');
});

require __DIR__.'/auth.php';
