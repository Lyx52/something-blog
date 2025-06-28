<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

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

    public function author(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
