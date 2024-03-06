<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;
use App\Models\caverne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Histoire extends Model
{
    use HasFactory;

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function cavernes(): BelongsToMany
    {
        return $this->belongsToMany(Caverne::class);
    }

}
