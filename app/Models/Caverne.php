<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Histoire;
use Illuminate\Database\Eloquent\Relations\HasOne;
class Caverne extends Model
{
    use HasFactory;

    public function histoire(): HasOne
    {
        return $this->hasOne(Histoire::class);
    }
}
