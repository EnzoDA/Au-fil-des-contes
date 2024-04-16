<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;
use App\Models\caverne;
use Illuminate\Database\Eloquent\Relations\belongsTo;

class Histoire extends Model
{
    use HasFactory;

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function caverne(): belongsTo
    {
        return $this->belongsTo(Caverne::class);
    }

}
