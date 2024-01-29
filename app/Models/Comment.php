<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['commentable_id', 'commentable_type' ,'content', 'user_id'];
    protected $dates = ['deleted_at'];

    public function commentable()
    {
        return $this->morphTo();
    }
}
