<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ["tag_name"];

    // Relación muchos a muchos
    function images(): BelongsToMany {
        return $this->belongsToMany(Image::class);
    }
}
