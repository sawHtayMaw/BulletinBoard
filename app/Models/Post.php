<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    /**
     * @var string
     */
    protected $table = "posts";
    /**
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'status', 'create_user_id', 'updated_user_id',
    ];
    /**
     * Get the user record associated with post.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'create_user_id', 'id');
    }
}
