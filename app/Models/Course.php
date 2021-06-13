<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    
    /**
     * Get the user that owns the Course
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the post for the Course
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function post()
    {
        return $this->hasMany(Post::class);
    }

    //config del campo virtual excerpt

    public function getExcerptAttribute() {

        return substr( $this->description, 0, 80 ) . "...";
    }

    //metoro personalizado
    public function similar(){

        return $this->where('category_id', $this->category_id)
                    ->with('user')
                    ->take(2)
                    ->get();
    }
}
