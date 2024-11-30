<?php

namespace App\Models;

use App\Models\SharedNotes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    /** @use HasFactory<\Database\Factories\NoteFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'trashed',
        'content',
        'user_id',
        'shared',
    ];


    public function sharedNotes()
    {
        return $this->hasMany(SharedNotes::class);
    }

}
