<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory;
    protected $fillable = [
        'user_id',
        'post_id',
        'comment',
    ];

    public function author(): User {
        return $this->belongsTo(User::class, 'user_id')->firstOrFail();
    }

    public function post(): BelongsTo {
        return $this->belongsTo(Post::class, 'post_id');
    }
}
