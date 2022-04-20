<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class post extends Model
{

    
    use Sluggable;
    use HasFactory;
    protected $attributes = [
        'image_path' => null,
    ];
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'slug',
        'image_path'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function comments() {
       return $this->morphMany(Comment::class,'commentable');
      // return $this->belongsTo(Comment::class);
    }

}
