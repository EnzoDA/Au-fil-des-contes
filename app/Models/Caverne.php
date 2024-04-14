<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Histoire;
use Illuminate\Database\Eloquent\Relations\hasMany;
class Caverne extends Model
{
    use HasFactory;

    public function histoires(): hasMany
    {
        return $this->hasMany(Histoire::class);
    }
}
