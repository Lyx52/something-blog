<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Stevebauman\Purify\Facades\Purify;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'body',
        'user_id',
        'slug',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function (Post $model) {
            $model->slug = $model->id . "-" . Str::slug($model->title);
            $model->save();
        });

        static::updating(function (Post $model) {
            $model->slug = $model->id . "-" . Str::slug($model->title);
        });
    }

    public function author(): User {
        return $this->belongsTo(User::class, 'user_id')->firstOrFail();
    }

    public function comments(): HasMany {
        return $this->hasMany(Comment::class, 'post_id')
            ->with('author');
    }

    public function intro(): string {
        return Purify::config('intro')->clean($this->body);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
