<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ["url_image", "user_id"];

    function user() {
        return $this->belongsTo(User::class);
    }


    // Relación muchos a muchos
    
    function tags(): BelongsToMany {
        return $this->belongsToMany(Tag::class);
    }
}
